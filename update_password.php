<?php
session_start();
include "db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['user_name'])){
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $newPassword = $_POST['new-password'];

        // Update database
        $sql = "UPDATE users SET password='$newPassword' WHERE id=" . $_SESSION['id'];
        if(mysqli_query($conn, $sql)) {
            echo "Profile updated successfully";
            $_SESSION['password'] = $newPassword;
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
