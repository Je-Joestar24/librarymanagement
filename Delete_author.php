<?php
    require_once('DBconnect.php');
    $author = $_POST['author_id'];
    $sql = "DELETE FROM `book_authors` WHERE author_id = '$author'";
    mysqli_query($connect, $sql);
    $sql = "DELETE FROM author WHERE author_id = '$author'";
    mysqli_query($connect, $sql);
?>