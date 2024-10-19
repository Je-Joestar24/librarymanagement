<?php
session_start();
include('DBconnect.php');

if (isset($_SESSION['user_id'])) {
    $bookID = $_POST['book_id'];
    $userID = $_SESSION['user_id'];
    $requestedDate = date('Y-m-d H:i:s'); 
    $added = 0; 
    
    $insertQuery = "INSERT INTO borrow_request (book_id, user_id, requested_date, added) 
                    VALUES ('$bookID', '$userID', CURDATE(), '$added')";
    if (mysqli_query($connect, $insertQuery)) {
        echo "success";
    } else {
        echo "error";
    }

    mysqli_close($connect);
}
?>
