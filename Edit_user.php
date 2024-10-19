<?php
// Include DB connection
require_once 'DBconnect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $user_id = $_POST['user_id'];
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['pass'];
    $course_id = $_POST['course_id'];
    $year = $_POST['year'];

    // Update the user information in the users table
    if(is_numeric($year)){
        $sql = "UPDATE users SET first_name = '$firstname', last_name = '$lastname', email = '$email', username = '$username', password = '$password', year = '$year' WHERE user_id = $user_id";
        mysqli_query($connect, $sql);
        // Update the user's course in the user_course table
        $sql = "UPDATE user_course SET course_id = '$course_id' WHERE user_id = '$user_id'";
        mysqli_query($connect, $sql);
    } else {
        echo "error";
    }
}

// Close the database connection
$connect->close();
?>
