<?php
include 'DBconnect.php';

// Get the values from the form
$userId = $_POST['userId'];
$bookId = $_POST['bookId'];
$dueDate = $_POST['dueDate'];

// Check if the user and book exist
$userResult = mysqli_query($connect, "SELECT * FROM users WHERE user_id = $userId");
$bookResult = mysqli_query($connect, "SELECT * FROM book WHERE book_id = $bookId");

if (mysqli_num_rows($userResult) > 0 && mysqli_num_rows($bookResult) > 0) {
  // Get the user and book details
  $userRow = mysqli_fetch_assoc($userResult);
  $bookRow = mysqli_fetch_assoc($bookResult);

  // Check if the book has any copies available
  if ($bookRow['no_copies'] > 0) {
    // Decrease the number of book copies by 1
    mysqli_query($connect, "UPDATE book SET no_copies = no_copies - 1 WHERE book_id = $bookId");

    // Insert the borrowing record
    $checkoutDate = date('Y-m-d H:i:s');
    mysqli_query($connect, "INSERT INTO borrowings (user_id, checkout_date, duedate) VALUES ($userId, '$checkoutDate', '$dueDate')");
    $borrowingId = mysqli_insert_id($connect);

    // Insert the borrowed book record
    mysqli_query($connect, "INSERT INTO borrowed_books (borrowing_id, book_id) VALUES ($borrowingId, $bookId)");

    // Output success message
    echo "Borrowing record added successfully";
  } else {
    // Output error message if book is not available
    echo "This book is not available for borrowing at the moment";
  }
} else {
  // Output error message if user or book does not exist
  echo "User or book does not exist";
}

mysqli_close($connect);
?>
