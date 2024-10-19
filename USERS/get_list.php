<?php
include "DBconnect.php";

if(isset($_POST["userId"])){
	$userId = $_POST["userId"];
	$sql = "SELECT * FROM users WHERE user_id = '$userId'";
	$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		$userName = $row["first_name"]." ".$row["last_name"];
		$sql = "INSERT INTO attendance(user_id, login_time) VALUES ('$userId', NOW())";
		mysqli_query($connect, $sql);
		echo $userName;
	} else {
		echo "no record";
	}
}
mysqli_close($connect);
?>
