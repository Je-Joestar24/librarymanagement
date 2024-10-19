<?php
session_start();

if(isset($_SESSION['user_id'])) {
    $specific_user_id = $_SESSION['user_id']; // Get the specific user ID

    // Destroy the session if the specific user ID matches
    if ($_SESSION['user_id'] == $specific_user_id) {
        session_unset();
        session_destroy();
        
        // Redirect the user to the login page or any other appropriate page
        header("Location: login.php"); // Replace "login.php" with the desired URL
        exit();
    }
}
?>
