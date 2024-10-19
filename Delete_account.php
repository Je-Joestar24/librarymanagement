<?php
include 'DBconnect.php';
   $accountID = $_POST['account_id'];
   $sql = "DELETE FROM book_accounts WHERE account_id = '$accountID'";
   mysqli_query($connect, $sql);
   $sql = "DELETE FROM accounts WHERE account_id = '$accountID'";
   mysqli_query($connect, $sql);
?>