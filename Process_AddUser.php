<?php
    include 'DBconnect.php';
    
    extract($_POST);

    if(isset($_POST['idSend']) && isset($_POST['lnameSend']) && isset($_POST['fnameSend']) && isset($_POST['emailSend'])){
        $SQL = "INSERT INTO `users`(`user_id`, `last_name`, `first_name`, `email`,username, password) VALUES ('$idSend','$lnameSend','$fnameSend','$emailSend','$userSend', '$passSend')";
        $result = mysqli_query($connect,$SQL);
    }
?>