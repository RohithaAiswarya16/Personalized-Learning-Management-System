<?php
session_start();
include "db_conn.php";
echo "Reached login.php";
if(isset($_POST['email']) && isset($_POST['password'])){

    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Validate input
    if(empty($email) || empty($pass)){
        header("Location: index.php?error=Email and password are required");
        exit();
    }

    // Check if user exists
    $sql = "SELECT * FROM users WHERE email='$email'AND password='$pass'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if($row['email'] === $email && $row['password'] === $pass){
            $_SESSION['email'] = $row['email'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['id'] = $row['id'];
            header("Location: home.php?login_success=true");
            exit();
        } else {
            header("Location: index.php?error=incorrect_password");
            exit();
        }
    } else {
        header("Location: index.php?error=user_not_found");
        exit();
    }
}