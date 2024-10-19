<?php
require_once('DBconnect.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accountId = $_POST['account_id'];
    $accountNo = $_POST['account_no'];
    
    $c = "select COUNT(*) as c from accounts where account_no = '$accountNo' and account_id != '$accountId'";
    $row = mysqli_fetch_assoc(mysqli_query($connect,$c));
    // Check if account number is empty
    if (empty($accountNo) || !is_numeric($accountNo) || $row['c'] >= 1) {
        if($row['c'] >= 1) echo "Account number: ".$accountNo." already exists!";
        else if(!is_numeric($accountNo) ) echo "Invalid Account number : ".$accountNo;
        else echo "Empty Account number is invalid";
        
        exit;
    }

    // Update the account
    $sql = "UPDATE accounts SET account_no = '$accountNo' WHERE account_id = '$accountId'";

    if (mysqli_query($connect, $sql)) {
        echo "success";
    } else {
        echo "Error updating account: " . mysqli_error($connect);
    }
}
?>
