<?php 
include 'DBconnect.php';

$rId = $_GET['r_id'];
echo $rId;

$result = mysqli_query($connect, "DELETE FROM borrow_request WHERE req_id = '$rId'");

if ($result) {
    header('Location: Requested.php');
    exit; // Add this line to prevent further execution of the script
}
?>
