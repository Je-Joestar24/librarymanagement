<?php
include 'DBconnect.php';

// Get the borrowing ID from the AJAX request
$borrowingId = $_POST['borrowingId'];

// Get the book ID from the borrowing ID
$bookResult = mysqli_query($connect, "SELECT book_id FROM borrowings WHERE borrowing_id = $borrowingId");
$bookRow = mysqli_fetch_assoc($bookResult);
$bookId = $bookRow['book_id'];

// Update the book count and return the book
mysqli_query($connect, "UPDATE book SET no_copies = no_copies + 1 WHERE book_id = $bookId");
mysqli_query($connect, "UPDATE borrowings SET return_date = NOW() WHERE borrowing_id = $borrowingId");



$row1 = mysqli_fetch_assoc(mysqli_query($connect, "SELECT b.title, u.user_id, concat(u.first_name, ' ', u.last_name) as userN, u.email FROM borrowings br INNER JOIN book b on b.book_id = br.book_id INNER JOIN users u on u.user_id = br.user_id WHERE borrowing_id = '$borrowingId';"));

$uid = $row1['user_id'];
$nm = $row1['userN'];
$email = $row1['email'];
$b_book = $row1['title'];
$rdate = date('m-d-y');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
  $mail->Username   = 'jpar1252003@gmail.com';                     //SMTP username
  $mail->Password   = 'kohtvfcpkosscpfg';                               //SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
  $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

  //Recipients
  $mail->setFrom('from@example.com', 'CICTE Library');
  $mail->addAddress($email);
  $message = "
<html>
<head>
  <style>
      body {
          font-family: Arial, sans-serif;
          line-height: 1.5;
      }
      .container {
          max-width: 600px;
          margin: 0 auto;
      }
      .header {
          background-color: #f2f2f2;
          padding: 20px;
          text-align: center;
      }
      .content {
          padding: 20px;
      }
      .footer {
          background-color: #f2f2f2;
          padding: 20px;
          text-align: center;
      }
  </style>
</head>
<body>
  <div class='container'>
      <div class='header'>
          <h1>CICTE Library</h1>
      </div>
      <div class='content'>
          <p>Dear ".$nm.",</p>
          <p>This is to inform you that you have returned a book to the CICTE Library at Western Leyte College. Please find below the details of the returned book:</p>
          <ul>
              <li><strong>Book Title:</strong> ".$b_book."</li>
              <li><strong>Returned Date:</strong> ".$rdate." </li>
          </ul>
          <p>Thank you for returning the book on time. If you have any questions or need further assistance, please don't hesitate to contact our library staff.</p>
          <p>Best regards,</p>
          <p><br>CICTE Library<br>Western Leyte College</p>
      </div>
      <div class='footer'>
          <p>&copy; CICTE Library, Western Leyte College</p>
      </div>
  </div>
</body>
</html>";


  
  //Content
  $mail->isHTML(true);                                  //Set email format to HTML
  $mail->Subject = 'Here is the subject';
  $mail->Body    = $message;
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  $mail->send();
  
$sql = "UPDATE `notifications` SET `notification_type`=1 WHERE notifications.user_id = '$uid' && notifications.book_id = '$bookId';";
mysqli_query($connect, $sql);
  mysqli_close($connect);  
  echo "Book returned successfully";
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
