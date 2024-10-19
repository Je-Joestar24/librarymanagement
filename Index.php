<?php
session_start(); // Make sure to start the session
include('DBconnect.php');

if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
	exit();
}
$librarianID = $_SESSION['user_id'];

$row = mysqli_fetch_assoc(mysqli_query($connect, "Select * from librarians where librarian_id = '$librarianID'"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>

	<link rel="stylesheet" href="BOOTSTRAP/css/bootstrap.min.css">
	<link rel="stylesheet" href="Font/css/all.css">
	<link rel="stylesheet" href="Font/css/all.min.css">
	<link href='boxicons/css/boxicons.min.css' rel='stylesheet'>
	<script src="js/bootstrap.min.js"></script>
	<script src="JS/popper.min.js"></script>
	<link rel="stylesheet" href="Design/datatables.css">

	<script src="DataTables/jquery.min.js"></script>
	<script src="package/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="package/dist/sweetalert2.min.css">

	<link rel="stylesheet" type="text/css" href="DataTables/dataTables.bootrap5.min.css">

	<!-- Add the DataTables plugin script and its dependencies -->
	<script defer src="DataTables/jquery.dataTables.min.js"></script>
	<script defer src="DataTables/dataTables.bootstrap5.min.js"></script>



	<link rel="stylesheet" href="Design/datatables.css">
	<link rel="stylesheet" href="Design/side.css">
	<style>
		.custom-scrollbar::-webkit-scrollbar {
			width: 6px;
			/* Adjust the width of the scrollbar */
			border-radius: 3px;
			/* Adjust the border-radius for rounded corners */
		}

		.custom-scrollbar::-webkit-scrollbar-thumb {
			background-color: #888;
			/* Adjust the color of the thumb */
			border-radius: 3px;
			/* Adjust the border-radius for rounded corners */
		}

		.custom-scrollbar::-webkit-scrollbar-thumb:hover {
			background-color: #555;
			/* Adjust the color of the thumb on hover */
		}
	</style>
</head>

<body>
	<?php include "sidebar.php" ?>
	<section class="home-section">
		<div class="home-content header">
			<i class='bx bx-menu'></i>
			<span class="text text-white m-0">LIBRARY MANAGEMENT SYSTEM</span>
		</div>
		<hr class=" text-white">
		<div class="col-md-9 col-lg-11 bg-light mt-3 rounded-start-4 bg-transparent" class="container-fuid px-4" role="main" id="main-content" style=" margin:auto; overflow:auto;">
			<main>
				<?php
				// Include database connection file
				include_once('DBconnect.php');

				// Count total overdued books
				$sql = "SELECT COUNT(*) as total_borrowed FROM borrowings";
				$result = mysqli_query($connect, $sql);
				$row = mysqli_fetch_assoc($result);
				$total_borrowed = $row['total_borrowed'];

				// Count total overdued books
				$sql = "SELECT COUNT(*) as total_categories FROM category";
				$result = mysqli_query($connect, $sql);
				$row = mysqli_fetch_assoc($result);
				$total_categories = $row['total_categories'];
				/* 
                    // Count all Entries today
                    $sql = "SELECT COUNT(*) as total_entry_today, DATE_FORMAT(login_time, '%b %d, %Y %h:%i %p') AS login_time FROM attendance WHERE DATE login_time = CURDATE() ORDER BY login_time ASC";
                    $result = mysqli_query($connect, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $total_entries = $row['total_entry_today']; */

				// Count total Librarians
				$sql = "SELECT COUNT(*) AS total_admin FROM librarians";
				$result = mysqli_query($connect, $sql);
				$row = mysqli_fetch_assoc($result);
				$total_admin = $row['total_admin'];

				// Count total books
				$sql = "SELECT COUNT(*) AS total_books FROM book";
				$result = mysqli_query($connect, $sql);
				$row = mysqli_fetch_assoc($result);
				$total_books = $row['total_books'];

				$sql = "SELECT COUNT(*) AS total_users FROM users";
				$result = mysqli_query($connect, $sql);
				$row = mysqli_fetch_assoc($result);
				$total_users = $row['total_users'];
				?>

				<div class="card border-0 bg-transparent">
					<div class="card-header bg-transparent">
						<div class="row">
							<div class="col-md-3 py-5">
								<div class="card bg-dark text-white shadow">
									<div class="card-body">
										<h5 class="card-title mx-3 mt-2"><i class="fas fa-book"></i> Total Books</h5>
										<p class="card-text mx-3"><?php echo $total_books; ?></p>
										<hr>
										<a class="card-link mx-3 mb-2 text-decoration-none" href="Table_books.php"><i class="fas fa-eye"></i> View all</a>
										<!-- <a class="card-link mx-3 mb-2 text-decoration-none" href=""><i class="fas fa-plus"></i> Add new</a>
									 -->
									</div>
									<div class="card-footer bg-dark border-top-0">
										<small class="text-white mx-3">
											<i class="fas fa-info-circle"></i> Click on the links above to view
										</small>
									</div>
								</div>
							</div>

							<div class="col-md-3 py-5">
								<div class="card bg-dark text-white shadow">
									<div class="card-body">
										<h5 class="card-title mx-3 mt-2"><i class="fas fa-user-tie"></i> Total Borrowed</h5>
										<p class="card-text mx-3"><?php echo $total_borrowed; ?></p>
										<hr>
										<a class="card-link mx-3 mb-2 text-decoration-none" href="Table_borrowers.php"><i class="fas fa-eye"></i> View all</a>
										<!-- <a class="card-link mx-3 mb-2 text-decoration-none" href=""><i class="fas fa-plus"></i> Add new</a>
									 -->
									</div>
									<div class="card-footer bg-dark border-top-0">
										<small class="text-white mx-3">
											<i class="fas fa-info-circle"></i> Click on the links above to view
										</small>
									</div>
								</div>
							</div>

							<div class="col-md-3 py-5">
								<div class="card bg-dark text-white shadow">
									<div class="card-body">
										<h5 class="card-title mx-3 mt-2"><i class="fas fa-book-reader"></i> Total Category</h5>
										<p class="card-text mx-3"><?php echo $total_categories; ?></p>
										<hr>
										<a class="card-link mx-3 mb-2 text-decoration-none" href="Table_categories.php"><i class="fas fa-eye"></i> View all</a>
										<!-- <a class="card-link mx-3 mb-2 text-decoration-none" href="userform.php"><i class="fas fa-plus"></i> Add new</a> -->
									</div>
									<div class="card-footer bg-dark border-top-0">
										<small class="text-white mx-3">
											<i class="fas fa-info-circle"></i> Click on the links above to view
										</small>
									</div>
								</div>
							</div>


							<div class="col-md-3 py-5">
								<div class="card bg-dark text-white shadow">
									<div class="card-body">
										<h5 class="card-title mx-3 mt-2"><i class="fas fa-user"></i> Total Users</h5>
										<p class="card-text mx-3"><?php echo $total_users; ?></p>
										<hr>
										<a class="card-link mx-3 mb-2 text-decoration-none" href="Table_userAcc.php"><i class="fas fa-eye"></i> View all</a>
										<!-- <a class="card-link mx-3 mb-2 text-decoration-none" href=""><i class="fas fa-plus"></i> Add new</a>
									 -->
									</div>
									<div class="card-footer bg-dark border-top-0">
										<small class="text-white mx-3">
											<i class="fas fa-info-circle"></i> Click on the links above to view
										</small>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<h5 class=" text-center bg-dark py-2 ps-2 text-light">Entry Record</h5>
						<div class="list-group custom-scrollbar" style="height: 15vh; overflow:auto;">
							<?php
							include 'DBconnect.php';
							$sql = "SELECT u.user_id, u.first_name, u.last_name, CONCAT(u.first_name, ' ', u.last_name) AS username,c.course_name, u.year, u.email, CONCAT(c.course_name, ' - ', u.year ) AS course_year, DATE_FORMAT(a.login_time, '%b %d, %Y %h:%i %p') AS login_time 
                                    FROM users u
                                    INNER JOIN user_course uc ON u.user_id = uc.user_id
                                    INNER JOIN courses c ON uc.course_id = c.course_id
                                    INNER JOIN attendance a ON u.user_id = a.user_id WHERE DATE(a.login_time) = CURDATE()
                                    ORDER BY a.login_time ASC";
							$result = mysqli_query($connect, $sql);

							if (mysqli_num_rows($result) > 0) {
								$counter = 1;
								while ($row = mysqli_fetch_assoc($result)) {
							?>
									<a href="#" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" class="list-group-item list-group-item-action clickable-row">
										<div class="d-flex w-100 justify-content-between">
											<h6 class="mb-1"><?php echo $counter . ". " . $row['username'] ?></h6>
											<div class="d-flex w-50 justify-content-between">
												<small><?php echo $row['course_year'] ?></small>
												<span class="mb-1"><?php echo "Login Time: " . $row['login_time'] ?></span>
											</div>
										</div>
									</a>
							<?php
									$counter++;
								}
							} else {
								echo "<p class='list-group-item text-center'>No records found</p>";
							}
							?>
						</div>

						<h5 class=" text-center bg-dark py-2 ps-2 text-light mt-5">Requests</h5>
						<div id="message" class="mt-2"></div>
						<div class="list-group custom-scrollbar" style="height: 15vh; overflow:auto;">
							<?php
							$sql = 'SELECT u.user_id, br.req_id, u.email,u.first_name, u.last_name, CONCAT(u.first_name, " ", u.last_name) AS user, c.course_name, u.year, b.book_id, b.title, br.requested_date, br.added FROM users u 
                                INNER JOIN user_course uc on uc.user_id = u.user_id 
                                INNER JOIN courses c on c.course_id = uc.course_id 
                                INNER JOIN borrow_request br on br.user_id = u.user_id
                                INNER JOIN book b on b.book_id = br.book_id where br.added != 2 && DATE(br.requested_date) = CURDATE()';
							$result = mysqli_query($connect, $sql);
							$count = 1;
							if (mysqli_num_rows($result) > 0) {
								while ($row = mysqli_fetch_array($result)) {
									if ($row['added'] == 0) {
							?>
										<div class="d-flex w-100 justify-content-between bg-white py-1 pt-2 text-dark">
											<span class="clickable-row1 col-1 mx-2" data-bs-toggle="modal" data-bs-target="#borrowerModal1" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['title'] ?>">User ID: <h6 class=" px-2 d-inline"><?php echo $row['req_id'] ?></h6></span>
											<div class=" d-flex w-75 justify-content-between">
												<span class="clickable-row1 col-auto" data-bs-toggle="modal" data-bs-target="#borrowerModal1" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['title'] ?>">Username: <h6 class=" px-2 d-inline"><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></h6></span>
												<div class=" d-flex w-50 justify-content-between">
													<span class="clickable-row1" data-bs-toggle="modal" data-bs-target="#borrowerModal1" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['title'] ?>">
														<h6 class=" px-2 d-inline"><?php echo $row['course_name'] . ' - ' . $row['year'] ?></h6>
													</span>
													<span class="w-50 clickable-row1 col-auto" data-bs-toggle="modal" data-bs-target="#borrowerModal1" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['title'] ?>">Requested book: <h6 class=" px-2 d-inline"><?php echo $row['title'] ?></h6></span>
												</div>
											</div>
											<span class=" col-auto">
												<div class="d-flex justify-content-center">
													<button type="button" class="btn btn-sm btn-dark me-2 accept" name data-req-u="<?php echo $row['user_id'] ?>" data-req-b="<?php echo $row['book_id'] ?>" data-req-id="<?php echo $row['req_id'] ?>" onclick="acceptBorrowing(this)">
														<i class="fa fa-arrow-down fa-2"></i> Accept
													</button>
												</div>
											</span>
										</div>
							<?php
										$count++;
									}
								}
							} else {
								echo "<p class='list-group-item text-center bg-white'>No requests found</p>";
							}
							mysqli_close($connect);
							?>
						</div>

						<form id="borrowForm" class="align-items-center d-flex w-100 justify-content-between gap-3 my-3">
							<div class="col-auto">
								<label for="userId" class="visually-hidden">Enter your ID:</label>
								<input type="text" id="user_id" name="user_id" class="form-control flex-fill" placeholder="USER ID" required readonly>
							</div>
							<div class="col-auto flex-fill">
								<label for="bookId" class="visually-hidden">Enter book ID:</label>
								<input type="text" id="book_ids" name="book_ids" class="form-control flex-fill" placeholder="BOOK ID" required readonly>
							</div>
							<div class="col-auto">
								<label for="dueDate" class="visually-hidden">Enter due date:</label>
								<input type="date" id="due_date" name="due_date" class="form-control flex-fill" placeholder="Enter due date" required>
							</div>
							<input type="hidden" id="req_id" name="req_id" value="">
							<div class="col-auto">
								<button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button>
							</div>
						</form>
					</div>
				</div>
		</div>
		</div>
		</main>
		</div>
	</section>


	<!-- User Information Modal -->
	<div class="modal fade" id="userInfoModal" tabindex="-1" role="dialog" aria-labelledby="userInfoModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content bg-dark text-white">
				<div class="modal-header">
					<h5 class="modal-title" id="userInfoModalLabel">User Information</h5>
					<button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="text-center mb-4">
						<i class="fa fa-user display-1"></i>
					</div>
					<div class="text-center mb-3">
						<h4 id="userName"></h4>
					</div>
					<div class="text-center mb-3">
						<p id="courseYear"></p>
					</div>
					<div class="text-center mb-3">
						<p id="email"></p>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="borrowerModal1" tabindex="-1" role="dialog" aria-labelledby="userInfoModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content bg-dark text-white">
				<div class="modal-header">
					<h5 class="modal-title" id="userInfoModalLabel">User Information</h5>
					<button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="text-center mb-4">
						<i class="fa fa-user display-1"></i>
					</div>
					<div class="text-center mb-3">
						<h4 id="userName1"></h4>
					</div>
					<div class="text-center mb-3">
						<p id="courseYear1"></p>
					</div>
					<div class="text-center mb-3">
						<p id="email1"></p>
					</div>
					<div class="text-center mb-3">
						<h5>Requested Book</h5>
						<div id="borrowedBooks1"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.clickable-row1').click(function() {
				var userName = $(this).data('user-name');
				var courseYear = $(this).data('course-year');
				var email = $(this).data('email');
				var borrowedBooks = $(this).data('borrowed-books').split(',');

				// Set the modal content with the retrieved data
				$('#userName1').text(userName);
				$('#courseYear1').text(courseYear);
				$('#email1').text(email);

				// Clear the previous borrowed books list
				$('#borrowedBooks1').empty();

				// Add each borrowed book to the list
				for (var i = 0; i < borrowedBooks.length; i++) {
					$('#borrowedBooks1').append(borrowedBooks[i].trim());
				}

				// Show the modal
				$('#borrowerModal1').modal('show');
			});
			$('#borrowForm').submit(function(e) {
				e.preventDefault();
				Swal.fire({
					title: 'Loading...',
					allowOutsideClick: false,
					allowEscapeKey: false,
					showConfirmButton: false,
					background: '#232323',
					color: 'white',
					onBeforeOpen: () => {
						Swal.showLoading();
					}
				});
				$.ajax({
					type: 'POST',
					url: 'Process_AddBorrowers.php',
					data: $(this).serialize(),
					success: function(response) {
						Swal.close(); // Close the loading alert

						if (response === 'Message has been sent') {
							Swal.fire({
								icon: 'success',
								title: 'Success',
								text: 'Borrower added successfully',
								background: '#232323',
								color: 'white',
								showConfirmButton: true,
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'OK',
							}).then((result) => {
								if (result.isConfirmed) {
									location.reload(); // Refresh the page
								}
							});
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Error!',
								text: response,
								background: '#232323',
								color: 'white',
								showConfirmButton: true,
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'OK',
							}).then((result) => {
								if (result.isConfirmed) {
									location.reload(); // Refresh the page
								}
							});
						}
					},
					error: function(error) {
						alert(error);
						console.log(error);
					}
				});
			});
			$('#BorrowerTable').DataTable({
				"searching": true,
				"lengthChange": false,
				"pageLength": 5,
				"language": {
					"search": "Search:",
					"zeroRecords": "No matching records found",
					"info": "Showing _START_ to _END_ of _TOTAL_ entries",
					"infoEmpty": "Showing 0 to 0 of 0 entries",
					"infoFiltered": "(filtered from _MAX_ total entries)"
				}
			});
		});

		function acceptBorrowing(button) {
			var userId = button.getAttribute('data-req-u');
			var bookId = button.getAttribute('data-req-b');
			var reqId = button.getAttribute('data-req-id');

			document.getElementById("user_id").value = userId;
			document.getElementById("book_ids").value = bookId;
			document.getElementById("req_id").value = reqId;
		}
	</script>
	<script>
		$(document).ready(function() {
			// Event delegation for the clickable rows
			$(document).on('click', '.clickable-row', function() {
				var userName = $(this).data('user-name');
				var courseYear = $(this).data('course-year');
				var email = $(this).data('email');
				//alert(userName + " " + courseYear + " " + email + " Hell na");

				// Set the modal content with the retrieved data
				$('#userName').text(userName);
				$('#courseYear').text(courseYear);
				$('#email').text(email);

				// Show the modal
				$('#userInfoModal').modal('show');
			});
		});
	</script>
	<script src="js/side.js"></script>
	<script>
		$(document).ready(function() {
			$(".dash").addClass('active');
		}); // Get the menu parent element
	</script>
	<script src="DataTables/jquery-3.6.0.min.js"></script>
</body>

</html>