<?php
include 'DBconnect.php';

// Get form data
$user_id = $_POST['user_id'];
$book_ids = $_POST['book_ids'];
$due_date = $_POST['due_date'];

if(isset($_POST['req_id'])){
	$rqId = $_POST['req_id'];
	mysqli_query($connect, "UPDATE `borrow_request` SET `added` = '1' WHERE `borrow_request`.`req_id` = '$rqId'");
}
if(!is_numeric($user_id) || !is_numeric($book_ids)){
	echo "Invalid ID's";
	exit();
}
// Check if user exists
$user_query = "SELECT * FROM users WHERE user_id = '$user_id'";
$user_result = mysqli_query($connect, $user_query);
if (mysqli_num_rows($user_result) == 0) {
	echo "User with ID $user_id does not exist.";
	exit();
}

// Check if books exist and are available
	$book_query = "SELECT * FROM book WHERE book_id = '$book_ids' AND no_copies > 0 AND no_cd_copy > 0";
	$book_result = mysqli_query($connect, $book_query);
	if (mysqli_num_rows($book_result) == 0) {
		echo "Book with ID $book_ids does not exist or is not available.";
		exit();
	}



$row1 = mysqli_fetch_assoc(mysqli_query($connect, "SELECT title From book WHERE book_id = '$book_ids';"));
$row2 = mysqli_fetch_assoc(mysqli_query($connect, "SELECT concat(first_name, ' ', last_name) as nam, email from users WHERE user_id = '$user_id';"));


  $nm = $row2['nam'];
  $email = $row2['email'];
  $b_book = $row1['title'];
  $br_date = date('Y-m-d');
  $d_date = $due_date;
//   echo $nm, $email, $b_book, $br_date, $d_date;
  

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
                <p>This is to inform you that you have borrowed a book from the CICTE Library at Western Leyte College. Please find below the details of the borrowed book:</p>
                <ul>
                    <li><strong>Book Title:</strong> ".$b_book."</li>
                    <li><strong>Borrowed Date:</strong> ".$br_date."</li>
                    <li><strong>Due Date:</strong> ".$d_date."</li>
                </ul>
                <p>Kindly ensure that the book is returned by the due date to avoid any late penalties. If you need to extend the borrowing period, please contact the library staff before the due date.</p>
                <p>For any questions or concerns regarding your borrowing status, feel free to reach out to our library staff for assistance.</p>
                <p>Thank you for utilizing our library services.</p>
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
	
// Insert into borrowings table
$insert_borrow_query = "INSERT INTO borrowings (user_id, checkout_date, duedate, book_id) VALUES ('$user_id', CURDATE(), '$due_date', '$book_ids')";
mysqli_query($connect, $insert_borrow_query);

$sql = "UPDATE `book` SET `no_copies`= no_copies - 1 WHERE book_id = '$book_ids';";
mysqli_query($connect, $sql);
// Get borrowing id
$borrowing_id = mysqli_insert_id($connect);
$sql = "INSERT INTO `notifications`(`user_id`, `book_id`, `notification_type`, `created_at`) VALUES ('$user_id','$book_ids','0',now())";
mysqli_query($connect, $sql);
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
