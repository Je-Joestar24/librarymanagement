<?php
include 'DBconnect.php';

if(isset($_POST['categoryName'])){
    $categoryNames = $_POST['categoryName'];
    
    // Split the category names by comma
    $categories = explode(',', $categoryNames);
    
    $ctr = 0;
    foreach ($categories as $category) {
        $category = trim($category); // Trim whitespace from each category name

        // Check if category name already exists
        $checkQuery = "SELECT * FROM category WHERE category_name='$category'";
        $checkResult = mysqli_query($connect, $checkQuery);

        if(mysqli_num_rows($checkResult) > 0){
            echo "<div class='alert alert-danger'>Category '$category' already exists!</div>";
            $ctr ++;
        } else {
            // Insert new category into database
            $insertQuery = "INSERT INTO category (category_name) VALUES ('$category')";
            if(!mysqli_query($connect, $insertQuery)){
                echo "<div class='alert alert-danger'>Error adding category '$category'!</div>";
                $ctr ++;
            }
        }
    }

    if($ctr == 0) echo "success";
    
    mysqli_close($connect);
}
?>
