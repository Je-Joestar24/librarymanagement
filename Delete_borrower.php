<?php
    require_once('DBconnect.php');
    $borrowersId = $_POST['borrowing_id'];
    $sql = "DELETE FROM `borrowings` WHERE borrowing_id = '$borrowersId';";
    mysqli_query($connect, $sql);
?>