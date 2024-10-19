<?php
include 'DBconnect.php';

if(isset($_POST['Author'])){
    $authorNames = $_POST['Author'];
    
    $ctr = 0;
    // Split the author names by comma
    $authors = explode(',', $authorNames);
    
    foreach ($authors as $author) {
        $author = trim($author); // Trim whitespace from each author name

        // Check if author name already exists
        
        $checkQuery = "SELECT * FROM author WHERE name='$author'";
        $checkResult = mysqli_query($connect, $checkQuery);

        if(mysqli_num_rows($checkResult) > 0){
            echo "<div class='alert alert-danger my-2'>Author '$author' already exists!</div>";
            $ctr = 1;
        } else {
            // Insert new author into database
            $insertQuery = "INSERT INTO author (name) VALUES ('$author')";
            if(!mysqli_query($connect, $insertQuery)){
                $ctr = 1;
                echo "<div class='alert alert-danger my-2'>Error adding author '$author'!</div>";
            }
        }
    }

    if($ctr == 0) echo 'success';
    mysqli_close($connect);
}
?>
