<?php

require_once('DBconnect.php');
 $librarianId = $_POST['librarian_id'];
 $sql = "DELETE FROM `librarians` WHERE librarian_id = '$librarianId';";
 mysqli_query($connect, $sql);
 
?>