<?php
require_once('DBconnect.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authorId = $_POST['author_id'];
    $author = $_POST['author_no'];

    // Check if author number is empty
    if (empty($author)) {
        echo "author is required";
        exit;
    }

    // Update the author
    $sql = "UPDATE `author` SET `name`='$author' WHERE author_id = '$authorId'";

    if (mysqli_query($connect, $sql)) {
        echo "author updated successfully";
    } else {
        echo "Error updating author: " . mysqli_error($connect);
    }
}
?>