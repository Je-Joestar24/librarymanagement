<?php

require_once('DBconnect.php');
 $userId = $_POST['user_id'];
 $sql = "DELETE FROM `notifications` WHERE user_id = '$userId';";
 mysqli_query($connect, $sql);
 $sql = "DELETE FROM `borrow_request` WHERE user_id = '$userId';";
 mysqli_query($connect, $sql);
 $sql = "DELETE FROM `added_book` WHERE user_id ='$userId';";
 mysqli_query($connect, $sql);
 $sql = "DELETE FROM attendance WHERE user_id = '$userId';";
 mysqli_query($connect, $sql);
 $sql = "DELETE FROM user_course WHERE user_id = '$userId';";
 mysqli_query($connect, $sql);
 $sql = "DELETE bb FROM borrowed_books bb JOIN borrowings b ON bb.borrowing_id = b.borrowing_id WHERE b.user_id = '$userId';";
 mysqli_query($connect, $sql);
 $sql = "DELETE FROM borrowings WHERE user_id = '$userId';";
 mysqli_query($connect, $sql);
 $sql = "DELETE FROM users WHERE user_id = '$userId';";
 mysqli_query($connect, $sql);

?>