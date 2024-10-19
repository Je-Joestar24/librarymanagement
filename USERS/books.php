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
    <link rel="stylesheet" href="Font/css/all.min.css">
    <script src="JS/popper.min.js"></script>

    <script src="/CICTE/package/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="/CICTE/package/dist/sweetalert2.min.css">

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
				<div class="search-bar">
					<input type="text" id="search" placeholder="Enter book title or author" name="search" class="search-input my-5">
				</div>

				<div class="card border-0 bg-transparent text-black rounded-4">
					<div class="card-header bg-transparent">
						<div id="message" class="mt-2"></div>
					</div>
					<div class="card-body">
						<div class="bg-light border-0 " id="BooksTable">
							<div class="border-success d-grid p-3 rounded-3" id="tableBody" style="height: 65vh;  overflow:auto;">
								<!-- Table rows will be dynamically populated here -->
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

		function filterTable() {

			var selectedSearch = searchInput.value;

			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function() {
				if (xhr.readyState === 4 && xhr.status === 200) {
					$('#tableBody').html(xhr.responseText);
				}
			};
			xhr.open('GET', 'filter_Book.php?search=' + selectedSearch, true);
			xhr.send();
		}

		function sendBookers(dt) {
            Swal.fire({
                title: 'Loading...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                }
            });
			$.ajax({
				type: 'POST',
				url: 'Request_borrow.php',
				data: {book_id: dt},
				success: function(response) {
					swal.close();
					if(response == "success"){
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Book Successfully Requested',
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
								filterTable();
                            }
                        });
						
					}else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed requesting book',
                        })

					}
				},
				error: function(error) {
					//alert(error);
					console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while requesting.',
                    })
				}
			});
		}

		$(document).ready(function() {
			filterTable();
		});
	</script>
</body>


</html>