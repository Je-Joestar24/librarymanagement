<?php 
    require_once('DBconnect.php');
    $categoryID = $_POST['category_id'];
    $sql = "DELETE FROM `book_category` WHERE category_id = '$categoryID';";
    mysqli_query($connect, $sql);
    $sql = "DELETE FROM category WHERE category_id = '$categoryID';";
    mysqli_query($connect, $sql);
?>