<?php
include 'DBconnect.php';
   $bookId = $_POST['book_id'];
   $sql = "DELETE FROM `notifications` WHERE book_id = '$bookId';";
   mysqli_query($connect, $sql);
   $sql = "DELETE FROM `borrow_request` WHERE book_id = '$bookId';";
   mysqli_query($connect, $sql);
   $sql = "DELETE FROM `added_book` WHERE book_id = '$bookId';";
   mysqli_query($connect, $sql);
   // Delete the book record from the book, book_authors, book_category and book_accounts tables
   $sql = "DELETE FROM borrowings WHERE book_id = '$bookId';";
   mysqli_query($connect, $sql);
   $sql = "DELETE FROM book_authors WHERE book_id = '$bookId';";
   mysqli_query($connect, $sql);
   $sql = "DELETE FROM book_accounts WHERE book_id = '$bookId';";
   mysqli_query($connect, $sql);
   $sql = "DELETE FROM book_category WHERE book_id = '$bookId';";
   mysqli_query($connect, $sql);
   $sql = "DELETE FROM book WHERE book_id = '$bookId'";
   mysqli_query($connect, $sql);
?>
