<?php
require_once('DBconnect.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = $_POST['category_id'];
    $category = $_POST['category_no'];

    // Check if category number is empty
    if (empty($category)) {
        echo "category is required";
        exit;
    }

    // Update the category
    $sql = "UPDATE `category` SET `category_name`='$category' WHERE category_id = '$categoryId'";

    if (mysqli_query($connect, $sql)) {
        echo "category updated successfully";
    } else {
        echo "Error updating category: " . mysqli_error($connect);
    }
}
?>