<?php
session_start(); // Make sure to start the session
include('DBconnect.php');

if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
	exit();
}
$usersID = $_SESSION['user_id'];

$row = mysqli_fetch_assoc(mysqli_query($connect, "Select * from users where user_id = '$usersID'"));
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Library Management System - Book Search</title>
	<link rel="stylesheet" href="/CICTE/BOOTSTRAP/css/bootstrap.min.css">
	<link rel="stylesheet" href="/CICTE/Font/css/all.css">
	<script src="/CICTE/js/bootstrap.min.js"></script>
	<script src="/CICTE/JS/popper.min.js"></script>
	<link rel="stylesheet" href="/CICTE/Design/datatables.css">

	<script src="/CICTE/DataTables/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/CICTE/DataTables/dataTables.bootrap5.min.css">

	<!-- Add the DataTables plugin script and its dependencies -->
	<script defer src="/CICTE/DataTables/jquery.dataTables.min.js"></script>
	<script defer src="/CICTE/DataTables/dataTables.bootstrap5.min.js"></script>


	<link rel="stylesheet" href="/CICTE/Design/datatables.css">
	<link rel="stylesheet" href="/CICTE/Design/side.css">
	<!-- Include the DataTables CSS file -->

	<link rel="stylesheet" href="/CICTE/Design/select2.min.css">
	<script src="/CICTE/JS/select2.min.js"></script>
	<style>
		/* Custom scroll bar styles */
		::-webkit-scrollbar {
			width: 8px;
		}

		::-webkit-scrollbar-track {
			background: #f1f1f1;
		}

		::-webkit-scrollbar-thumb {
			background: #888;
			border-radius: 4px;
		}

		::-webkit-scrollbar-thumb:hover {
			background: #555;
		}

		body {
			background-color: #f5f5f5;
		}

		.navbar {
			background-color: #ffffff;
			border-bottom: 1px solid #e0e0e0;
		}

		.navbar-brand {
			font-weight: bold;
			color: #333333;
		}

		.navbar-nav .nav-link {
			color: #333333;
		}

		.container-fluid {
			margin-top: 20px;
		}

		.page-title {
			margin-bottom: 20px;
			font-size: 28px;
			font-weight: bold;
			color: #333333;
		}

		.search-bar {
			margin: 0 auto;

			max-width: 80vh;
		}

		.search-input {
			width: 100%;
			padding: 10px 20px;
			border: none;
			border-radius: 20px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}
	</style>
	<!-- Navbar -->
	<link rel="stylesheet" href="font/css/all.min.css">
</head>

<body>
	<?php include 'upper.php' ?>



	<!-- Main content -->
	<main class="container">
		<div class="row justify-content-center">
			<div class="col-lg-12">
				<div class="search-bar text-center">
					<h3 class="py-4" style="font-weight: bold;">Borrow Requests</h3>
				</div>

				<div class="card border-0 bg-transparent text-black rounded-4">
					<div class="card-header bg-transparent">
						<div id="message" class="mt-2"></div>
					</div>
					<div class="card-body">
						<div class="bg-light border-0 ">
							<div class="border-success d-grid p-3 rounded-3" style="height: 65vh;  overflow:auto;">
								<div class="book-list">
									<ul class="list-group">
										<?php
										include 'DBconnect.php';
										$query = "SELECT u.user_id, br.req_id, b.title, br.requested_date, br.added FROM users u INNER JOIN user_course uc on uc.user_id = u.user_id INNER JOIN courses c on c.course_id = uc.course_id INNER JOIN borrow_request br on br.user_id = u.user_id INNER JOIN book b on b.book_id = br.book_id where u.user_id = '$usersID' && br.added = 0";
										$result = mysqli_query($connect, $query);
										$ctr = 1;
										while ($row = mysqli_fetch_array($result)) {
										?>
											<li class="list-group-item my-2">
												<div class="d-flex align-items-center w-100 justify-content-between">
													<div class="mr-auto col-auto">
														<h5 class="mb-0" style="font-weight: bold;">Title: <?php echo $row['title']; ?></h5>
													</div>
													<div class=" w-50 d-flex justify-content-between">
													<p class="mb-0 col-auto">Requested Date: <?php echo $row['requested_date']; ?></p>
													<a href="process_cancel.php?r_id=<?php echo $row['req_id']; ?>" class="col-auto btn btn-sm btn-danger delete-btn" >Cancel</a>
													</div>
												</div>
											</li>
										<?php
											$ctr++;
										}
										?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</main>

	<!-- Logout confirmation modal -->
	<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="logoutModalLabel">Logout Confirmation</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to log out?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
					<a href="logout.php" class="btn btn-dark">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<script>
		var searchInput = document.getElementById('search');

		searchInput.addEventListener('change', filterTable);

		// Function to filter the table based on the selected month and year
		// Function to filter the table based on the selected month and year
		function filterTable() {

			var selectedSearch = searchInput.value;

			// Make an AJAX request to fetch the filtered data
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function() {
				if (xhr.readyState === 4 && xhr.status === 200) {
					$('#tableBody').html(xhr.responseText); // Insert the fetched data into the table body
				}
			};
			xhr.open('GET', 'filter_Book.php?search=' + selectedSearch, true);
			xhr.send();
		}
		$(document).ready(function() {
			// Trigger the filtering function when the page loads
			filterTable();
		});
	</script>
</body>


</html>