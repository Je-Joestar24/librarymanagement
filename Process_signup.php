<?php
    include 'DBconnect.php';
    
    extract($_POST);
    $sql = "SELECT Count(*) FROM `librarians` WHERE librarian_id = '$idSend' || phone_number = '$conSend' || username = '$userSend' || email = '$emailSend';";
    if($sql < 1){
    $sqli = "INSERT INTO `librarians`(`librarian_id`, `email`, `username` , `first_name`, `last_name`, `password`, `phone_number`) VALUES ('$idSend', '$emailSend', '$userSend','$fnameSend','$lnameSend','$passSend','$conSend')";
    $result = mysqli_query($connect,$sqli);
    echo "succes";
    }else{
    echo "fail";
    }

?> 