<?php
include 'DBconnect.php';

// Check if user ID or email already exists
$user_id = mysqli_real_escape_string($connect, $_POST['userId']);
$email = mysqli_real_escape_string($connect, $_POST['email']);
$sql = "SELECT * FROM users WHERE user_id='$user_id' OR email='$email'";
$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) > 0) {
    echo 'duplicate';
} else {
    // Insert new user into database
    $first_name = mysqli_real_escape_string($connect, $_POST['firstName']);
    $last_name = mysqli_real_escape_string($connect, $_POST['lastName']);
    $year = mysqli_real_escape_string($connect, $_POST['year']);
    $course_id = mysqli_real_escape_string($connect, $_POST['course']);
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);


    // Get course name based on course ID
    $sql = "SELECT course_name FROM courses WHERE course_id='$course_id'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    $course_name = $row['course_name'];

    // Insert new user into users table
    $sql = "INSERT INTO users (user_id, email, first_name, last_name, year, username, password) VALUES ('$user_id', '$email', '$first_name', '$last_name', '$year', '$username', '$password')";
    if (mysqli_query($connect, $sql)) {
        // Insert user and course into user_course table
        $sql = "INSERT INTO user_course (user_id, course_id) VALUES ('$user_id', '$course_id')";
        if (mysqli_query($connect, $sql)) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
}

mysqli_close($connect);
?>
