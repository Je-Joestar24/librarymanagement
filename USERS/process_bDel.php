<?php 

include 'DBconnect.php';

$rid =  $_GET['r_id'];

$result = mysqli_query($connect, "UPDATE `borrow_request` SET  `added`= 2 WHERE req_id = '$rid';");

if($result) header('location: Borrowed.php');

?>