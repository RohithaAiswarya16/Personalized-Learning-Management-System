<?php
session_start();
include "db_conn.php";
echo "Reached register.php";
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])){

    $sql = "SELECT counter FROM id_counter";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $current_id = $row['counter'];

    $new_id = $current_id;
    $user_name = ($_POST['name']);
    $email = ($_POST['email']);
    $pass = ($_POST['password']);

    // Validate input
    if(empty($user_name) || empty($email) || empty($pass)){
        header("Location: index.php?error=All fields are required");
        exit();
    }

    // Check if user already exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        header("Location: index.php?error=User already exists");
        exit();
    }

    // Insert new user into database
    $sql = "INSERT INTO users (id,user_name, email, password) VALUES ('$new_id','$user_name', '$email', '$pass')";
    if(mysqli_query($conn, $sql)){
        $_SESSION['id'] = $new_id;
        $_SESSION['email'] = $email;
        $_SESSION['user_name'] = $user_name;
        $new_counter = $current_id + 1;
        $sql_update = "UPDATE id_counter SET counter='$new_counter'";
        mysqli_query($conn, $sql_update);
        header("Location: home.php?signup_success=true");
        exit();
    } else {
        // Registration failed
        header("Location: index.php?error=Signup failed");
        exit();
    }
}
