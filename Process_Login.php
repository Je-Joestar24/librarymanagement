<?php
/* session_start();

include 'DBconnect.php';

if(isset($_POST['email']) && isset($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	//query to check if email and password match a librarian account
	$sql = "SELECT * FROM librarians WHERE email = '$email' AND password = '$password'";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_assoc($result);

	if($result->num_rows == 1) {
		$_SESSION['user_id'] = $row['librarian_id'];
		echo "success";
	} else {
		echo "Invalid email or password";
	}
}
 */
session_start();

include 'DBconnect.php';

if(isset($_POST['user']) && isset($_POST['password'])) {
	$user = $_POST['user'];
	$password = $_POST['password'];

	//query to check if email and password match a librarian account
	$sql = "SELECT * FROM Librarians WHERE (email = '$user' OR username =  '$user') AND password = '$password'";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_assoc($result);

	if($result->num_rows == 1) {
		$_SESSION['user_id'] = $row['librarian_id'];
		echo "success";
	} else {
		echo "Invalid email or password";
	}
}
?>