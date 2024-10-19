<?php 
    $Servername = "localhost";
    $username = "root";
    $password = "";
    $DBname = "l_management";

    $connect = new mysqli($Servername, $username, $password, $DBname);

    if(!$connect){
        die("Connection failed ". mysqli_connect_error());
    }
?>