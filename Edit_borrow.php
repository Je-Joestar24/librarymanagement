<?php
include 'DBconnect.php';

  $borrowingId = $_POST['borrowing_id'];
  $bookId = $_POST['book_id'];
  $userId = $_POST['user_id'];
  $dueDate = $_POST['due_date'];
  $borrowDate = $_POST['checkout'];
  $returnDate = $_POST['return_date'];

  if(1 > mysqli_fetch_assoc(mysqli_query($connect, "select count(*) as count from book where book_id = '$bookId'"))['count']
    || 1 > mysqli_fetch_assoc(mysqli_query($connect, "select count(*) as count from users where user_id = '$userId'"))['count']
  ){
    echo "error" ;
    exit();
  }
  if($returnDate == "") 
  $sql = "UPDATE borrowings SET book_id = '$bookId', user_id = '$userId', duedate = '$dueDate', checkout_date = '$borrowDate', return_date = null WHERE borrowing_id = '$borrowingId'";

  else $sql = "UPDATE borrowings SET book_id = '$bookId', user_id = '$userId', duedate = '$dueDate', checkout_date = '$borrowDate', return_date = '$returnDate' WHERE borrowing_id = '$borrowingId'";

  $result = mysqli_query($connect, $sql);
  if(!$result){
    echo "error";
  }
?>
