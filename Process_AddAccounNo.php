<?php
include 'DBconnect.php';

if(isset($_POST['accountNo'])){
    $accountNo = $_POST['accountNo'];
    
    $ctr = 0;
    // Split the accounts account_nos by comma
    $accountNos = explode(',', $accountNo);
    
    foreach ($accountNos as $accountNo) {
        $accountNo = trim($accountNo); // Trim whitespace from each accounts account_no

        // Check if accounts account_no already exists
        
        $checkQuery = "SELECT * FROM accounts WHERE account_no='$accountNo'";
        $checkResult = mysqli_query($connect, $checkQuery);

        if(mysqli_num_rows($checkResult) > 0){
            echo "<div class='alert alert-danger my-2'>Account '$accountNo' already exists!</div>";
            $ctr = 1;
        } else {
            // Insert new accounts into database
            $insertQuery = "INSERT INTO accounts (account_no) VALUES ('$accountNo')";
            if(!mysqli_query($connect, $insertQuery)){
                $ctr = 1;
                echo "<div class='alert alert-danger my-2'>Error adding accounts '$accountNo'!</div>";
            }
        }
    }

    if($ctr == 0) echo 'success';
    mysqli_close($connect);
}
?>
