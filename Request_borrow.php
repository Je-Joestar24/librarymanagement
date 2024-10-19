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
    <title>Requests</title>

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
                <div class="card border-0 bg-transparent text-white rounded-1 mt-lg-5 rounded-4 p-4">
                    <div class="card-header bg-transparent py-4">
                        <h2 class="mb-5 d-grid row card-title px-4">Borrower Requests</h2>
                        <form id="borrowForm" class="g-2 align-items-center d-flex w-100 justify-content-between gap-3">
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
                        <div id="message" class="mt-2"></div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover bg-light border-0" id="BorrowerTable">
                            <thead class="border-black table-success">
                                <tr class="rounded-top-4">
                                    <th scope="col">
                                        <div class="py-1">#</div>
                                    </th>
                                    <th scope="col">
                                        <div class="py-1">User Name</div>
                                    </th>
                                    <th scope="col">
                                        <div class="py-1">Course Year</div>
                                    </th>
                                    <th scope="col">
                                        <div class="py-1">Book Title</div>
                                    </th>
                                    <th scope="col">
                                        <div class="py-1">Requested Date</div>
                                    </th>
                                    <th scope="col" class="text-center">
                                        <div class="py-1">Action</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="table-light border-success">
                                <?php
                                include 'DBconnect.php';
                                $sql = 'SELECT u.user_id, br.req_id, u.email,u.first_name, u.last_name, CONCAT(u.first_name, " ", u.last_name) AS user, c.course_name, u.year, b.book_id, b.title, br.requested_date, br.added FROM users u 
                                INNER JOIN user_course uc on uc.user_id = u.user_id 
                                INNER JOIN courses c on c.course_id = uc.course_id 
                                INNER JOIN borrow_request br on br.user_id = u.user_id
                                INNER JOIN book b on b.book_id = br.book_id where br.added != 2;';
                                $result = mysqli_query($connect, $sql);
                                $count = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    if ($row['added'] == 0) {
                                ?>
                                        <tr>
                                            <th class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['title'] ?>" scope="row"><?php echo $row['req_id'] ?></th>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['title'] ?>"><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></td>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['title'] ?>"><?php echo $row['course_name'] . ' - ' . $row['year'] ?></td>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['title'] ?>"><?php echo $row['title'] ?></td>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['title'] ?>"><?php echo $row['requested_date'] ?></td>
                                            <!-- right fucking here -->

                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-sm btn-dark me-2 accept" name data-req-u="<?php echo $row['user_id'] ?>" data-req-b="<?php echo $row['book_id'] ?>" data-req-id="<?php echo $row['req_id'] ?>" onclick="acceptBorrowing(this)">
                                                        <i class="fa fa-arrow-up"></i> Accept
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                        $count++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
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
                    <div class="text-center mb-3">
                        <h5>Requested Book</h5>
                        <div id="borrowedBooks"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function acceptBorrowing(button) {
            var userId = button.getAttribute('data-req-u');
            var bookId = button.getAttribute('data-req-b');
            var reqId = button.getAttribute('data-req-id');

            document.getElementById("user_id").value = userId;
            document.getElementById("book_ids").value = bookId;
            document.getElementById("req_id").value = reqId;
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.clickable-row').click(function() {
                var userName = $(this).data('user-name');
                var courseYear = $(this).data('course-year');
                var email = $(this).data('email');
                var borrowedBooks = $(this).data('borrowed-books').split(',');

                // Set the modal content with the retrieved data
                $('#userName').text(userName);
                $('#courseYear').text(courseYear);
                $('#email').text(email);

                // Clear the previous borrowed books list
                $('#borrowedBooks').empty();

                // Add each borrowed book to the list
                for (var i = 0; i < borrowedBooks.length; i++) {
                    $('#borrowedBooks').append(borrowedBooks[i].trim());
                }

                // Show the modal
                $('#userInfoModal').modal('show');
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
    </script>


    <script src="js/side.js"></script>
    <script>
        $(document).ready(function() {
            $(".req").addClass('active');
        }); // Get the menu parent element
    </script>
    <script src="DataTables/jquery-3.6.0.min.js"></script>
</body>

</html>