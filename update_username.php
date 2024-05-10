<?php
session_start();
include "db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['user_name'])){
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $newUsername = $_POST['new-username'];

        // Update database
        $sql = "UPDATE users SET user_name='$newUsername' WHERE id=" . $_SESSION['id'];
        if(mysqli_query($conn, $sql)) {
            echo "Username updated successfully";
            $_SESSION['user_name'] = $newUsername;
            header("Location: profilesettings.php?update_success=true");
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>
