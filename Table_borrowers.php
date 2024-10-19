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
    <title>Borrowers</title>

    <link rel="stylesheet" href="BOOTSTRAP/css/bootstrap.min.css">
    <link rel="stylesheet" href="Font/css/all.css">
    <link href='boxicons/css/boxicons.min.css' rel='stylesheet'>
    <script src="js/bootstrap.min.js"></script>
    <script src="JS/popper.min.js"></script>
    <link rel="stylesheet" href="Design/datatables.css">

    <script src="DataTables/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="DataTables/dataTables.bootrap5.min.css">

    <script src="package/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="package/dist/sweetalert2.min.css">
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
                        <h2 class="mb-5 d-grid row card-title px-4">Borrowers Table</h2>
                        <form id="borrowForm" class="g-2 align-items-center d-flex w-100 justify-content-between gap-3">
                            <div class="col-auto">
                                <label for="userId" class="visually-hidden">Enter your ID:</label>
                                <input type="text" id="user_id" name="user_id" class="form-control flex-fill" placeholder="Enter your ID" required>
                            </div>
                            <div class="col-auto flex-fill">
                                <label for="bookId" class="visually-hidden">Enter book ID:</label>
                                <input type="text" id="book_ids" name="book_ids" class="form-control flex-fill" placeholder="Enter book ID" required>
                            </div>
                            <div class="col-auto">
                                <label for="dueDate" class="visually-hidden">Enter due date:</label>
                                <input type="date" id="due_date" name="due_date" class="form-control flex-fill" placeholder="Enter due date" required>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
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
                                        <div class="py-1">Borrowed Date</div>
                                    </th>
                                    <th scope="col">
                                        <div class="py-1">User Name</div>
                                    </th>
                                    <th scope="col">
                                        <div class="py-1">Course Year</div>
                                    </th>
                                    <th scope="col">
                                        <div class="py-1">Borrowed Book</div>
                                    </th>
                                    <th scope="col">
                                        <div class="py-1">Due Date</div>
                                    </th>
                                    <th scope="col" class="text-center">
                                        <div class="py-1">Status</div>
                                    </th>
                                    <th scope="col" class="text-center">
                                        <div class="py-1">Action</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="table-light border-success">
                                <?php
                                include 'DBconnect.php';
                                $sql = "SELECT b.book_id, br.borrowing_id, GROUP_CONCAT(DISTINCT b.title SEPARATOR ', ') AS books, u.email, u.first_name, u.last_name, br.checkout_date, br.duedate, br.return_date, c.course_name, u.year, u.user_id FROM book b 
                                INNER JOIN borrowings br ON br.book_id = b.book_id
                                INNER JOIN users u ON br.user_id = u.user_id
                                INNER JOIN user_course uc ON uc.user_id = u.user_id
                                INNER JOIN courses c ON c.course_id = uc.course_id GROUP BY br.borrowing_id order by br.checkout_date desc;";
                                $result = mysqli_query($connect, $sql);
                                $count = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    if ($row['borrowing_id'] != null) {
                                ?>
                                        <tr>
                                            <th class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['books'] ?>" scope="row"><?php echo $count ?></th>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['books'] ?>"><?php echo $row['checkout_date'] ?></td>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['books'] ?>"><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></td>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['books'] ?>"><?php echo $row['course_name'] . ' - ' . $row['year'] ?></td>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['books'] ?>"><?php echo $row['books'] ?></td>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['books'] ?>"><?php echo $row['duedate'] ?></td>
                                            <td class="clickable-row text-center" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['books'] ?>">
                                                <?php if ($row['return_date'] ==  null) echo "<div class = 'text-white rounded-5 bg-danger'>Not returned</div>";
                                                else echo "<div class = 'text-white bg-success rounded-5'>returned</div>"; ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <?php
                                                    $uid = $row['user_id'];
                                                    $brd = $row['checkout_date'];
                                                    $dd = $row['duedate'];
                                                    $r2 = mysqli_fetch_assoc(mysqli_query($connect, "SELECT b.book_id, br.borrowing_id, GROUP_CONCAT(DISTINCT b.title SEPARATOR ', ') AS books, u.email, u.first_name, u.last_name, br.checkout_date, br.duedate, br.return_date, c.course_name, u.year, u.user_id FROM book b 
                                                        INNER JOIN borrowings br ON br.book_id = b.book_id
                                                        INNER JOIN users u ON br.user_id = u.user_id
                                                        INNER JOIN user_course uc ON uc.user_id = u.user_id
                                                        INNER JOIN courses c ON c.course_id = uc.course_id WHERE u.user_id = '$uid' && br.checkout_date = '$brd' && br.duedate = '$dd' GROUP BY br.checkout_date, br.user_id;"));
                                                    ?>
                                                    <button type="button" id="pslip" class="btn btn-sm btn-primary mx-2" data-user-id="<?php echo $r2['user_id'] ?>" data-user-nm="<?php echo $r2['first_name'] . ' ' . $r2['last_name'] ?>" data-c-name="<?php echo $r2['course_name'] . ' - ' . $r2['year'] ?>" data-book-id="<?php echo $r2['books'] ?>" data-due-date="<?php echo $r2['duedate'] ?>" data-checkout-date="<?php echo $r2['checkout_date'] ?>">
                                                        <i class="fa fa-print"></i> Print
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-dark me-2 edit-borrowing" data-bs-toggle="offcanvas" data-bs-target="#edit-borrow-offcanvas" data-borrowing-id="<?php echo $row['borrowing_id'] ?>" data-user-id="<?php echo $row['user_id'] ?>" data-book-id="<?php echo $row['book_id'] ?>" data-due-date="<?php echo $row['duedate'] ?>" data-checkout-date="<?php echo $row['checkout_date'] ?>" data-return-date="<?php echo $row['return_date'] ?>">
                                                        <i class="fa fa-pen"></i> Edit
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-danger delete-borrowing" data-borrowing-id="<?php echo $row['borrowing_id'] ?>" data-bs-toggle="modal" data-bs-target="#delete-borrowing-modal">
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                    $count++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </main>
        </div>
    </section>

    <div id="slip" class="printable d-none">

        <style>
            .printable {
                font-family: Arial, sans-serif;
                margin: 10px;
                padding: 10px;
                max-width: 500px;
                position: relative;
            }

            .logo {
                width: 70px;
                height: auto;
                position: absolute;
                top: 2vh;
            }

            .school-info {
                margin-top: 70px;
                text-align: center;
            }

            .section {
                margin-bottom: 15px;
            }

            .section-title {
                font-weight: bold;
            }

            .signature {
                margin-top: 20px;
            }

            .note {
                margin-top: 20px;
                font-style: italic;
            }
        </style>
        <div class="header" style="
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 20px;
                position: relative;">
            <img src="photos/wlc.png" alt="School Logo" class="logo" style="left: 20px" />
            <div class="school-info">
                <h1>Western Leyte College</h1>
                <h3>
                    College of Information Communication Technology and Engineering
                    (CICTE)
                </h3>
                <p>A. Bonifacio St., Ormoc City, Leyte
                    Tel Nos. (053) 255-8549 ; 561-5310
                    E-mail Address: westernleytecollege@yahoo.com
                </p>
            </div>
            <img src="photos/image-removebg.png" alt="Department Logo" class="logo" style="right: 20px" />
        </div>
        <h2>BORROW SLIP</h2>
        <hr />
        <div class="section">
            <p class="section-title" style="font-size:larger;">User ID:</p>
            <p class="user-id" style="font-size:larger;"></p>
        </div>
        <div class="section">
            <p class="section-title" style="font-size:larger;">Name:</p>
            <p class="name" style="font-size:larger;"></p>
        </div>
        <div class="section">
            <p class="section-title" style="font-size:larger;">Borrow Date:</p>
            <p class="borrow-date" style="font-size:larger;"></p>
        </div>
        <div class="section">
            <p class="section-title" style="font-size:larger;">Due Date:</p>
            <p class="due-date" style="font-size:larger;"></p>
        </div>
        <div class="section">
            <p class="section-title" style="font-size:larger;">Borrowed Book/s:</p>
            <p class="borrowed-book" style="font-size:larger;"></p>
        </div>
        <hr />
        <div class="signature d-flex gap-2 justify-content-between">
            <div class="col-auto px-1" style="font-size:larger;">User Signature: ____________</div>
            <div class="col-auto px-1" style="font-size:larger;">Librarian Signature: ____________</div>
        </div>
        <hr />
        <p class="note">
            Please note: This slip serves as proof of borrowing. Kindly keep it
            safe.
        </p>
    </div>

    <!-- Delete borrowing modal -->
    <div class="modal fade" id="delete-borrowing-modal" tabindex="-1" aria-labelledby="delete-borrowing-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white" id="delete-borrowing-modal-label">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center mb-0">Are you sure you want to delete this borrowing?</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger btn-sm confirm-delete" id="confirm-delete-btn" data-borrowing-id="<?php echo $row['borrowing_id'] ?>">Yes</button>
                </div>
            </div>
        </div>
    </div>

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
                        <h5>Borrowed Book</h5>
                        <div id="borrowedBooks"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end border-0 text-white" id="edit-borrow-offcanvas" tabindex="-1" aria-labelledby="edit-borrow-modal-label">
        <div class="offcanvas-header" style="background-color: #333;">
            <h3 class="offcanvas-title text-white" id="edit-borrow-modal-label">Update Borrowed Info</h3>
            <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body py-5" style="background-color: #333;">
            <form id="editBorrowingForm" method="POST" action="edit_borrow.php">
                <input type="hidden" id="editBorrowingId" name="borrowing_id">

                <div class="mb-3">
                    <label for="editBookId" class="form-label">Book ID</label>
                    <input type="text" class="form-control border-0" id="editBookId" name="book_id" style="background-color: #555; color: #fff;" required>
                </div>

                <div class="mb-3">
                    <label for="editUserId" class="form-label">User ID</label>
                    <input type="text" class="form-control border-0" id="editUserId" name="user_id" style="background-color: #555; color: #fff;" required>
                </div>

                <div class="mb-3">
                    <label for="editCheckoutDate" class="form-label">Borrow Date</label>
                    <input type="date" class="form-control border-0" id="editCheckoutDate" name="checkout" style="background-color: #555; color: #fff;" required>
                </div>

                <div class="mb-3">
                    <label for="editDueDate" class="form-label">Due Date</label>
                    <input type="date" class="form-control border-0" id="editDueDate" name="due_date" style="background-color: #555; color: #fff;" required>
                </div>

                <div class="mb-3">
                    <label for="editReturnDate" class="form-label">Return Date</label>
                    <input type="date" class="form-control border-0" id="editReturnDate" name="return_date" style="background-color: #555; color: #fff;">
                </div>

                <div class="text-center">
                    <button type="submit" id="saveChangesBtn" class="btn btn-dark my-3">Save Changes</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        // Edit Button Click Event
        $('#BorrowerTable').on("click", 'button[data-bs-target="#edit-borrow-offcanvas"]', function() {
            // Get the data from the button's data attributes
            var borrowingId = $(this).data("borrowing-id");
            var userId = $(this).data("user-id");
            var bookId = $(this).data("book-id");
            var dueDate = $(this).data("due-date");
            var checkoutDate = $(this).data("checkout-date");
            var returnDate = $(this).data("return-date");

            // Set the values in the modal
            $("#editBorrowingId").val(borrowingId);
            $("#editUserId").val(userId);
            $("#editBookId").val(bookId);
            $("#editDueDate").val(dueDate);
            $("#editCheckoutDate").val(checkoutDate);
            $("#editReturnDate").val(returnDate);
        });
        $('#editBorrowingForm').on('submit', function(e) {
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
                url: 'Edit_borrow.php',
                data: $('#editBorrowingForm').serialize(),
                success: function(response) {
                    Swal.close(); // Close the loading alert
                    if (response != "error") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Borrower Successfully Updated',
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
                        alert(response);
                    }
                },
                error: function(error) {
                    alert(error);
                    console.log(error);
                }
            });
        });
        $(document).on('click', '#pslip', function() {
            var userId = this.getAttribute('data-user-id');
            var userName = this.getAttribute('data-user-nm');
            var courseName = this.getAttribute('data-c-name');
            var bookId = this.getAttribute('data-book-id');
            var dueDate = this.getAttribute('data-due-date');
            var checkoutDate = this.getAttribute('data-checkout-date');

            slip.querySelector('.user-id').textContent = userId;
            slip.querySelector('.name').textContent = userName;
            slip.querySelector('.borrow-date').textContent = checkoutDate;
            slip.querySelector('.due-date').textContent = dueDate;
            slip.querySelector('.borrowed-book').textContent = bookId;

            var printContents = document.getElementById('slip').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            window.location.reload(); // Move to the next page after printing
            document.body.innerHTML = originalContents;
        });
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
            $('.delete-borrowing').click(function() {
                var borrowingId = $(this).data('borrowing-id');
                $('#delete-borrowing-modal').modal('show');
                $('#delete-borrowing-modal').data('borrowing-id', borrowingId);
            });

            $('#confirm-delete-btn').click(function() {
                var borrowingId = $('#delete-borrowing-modal').data('borrowing-id');
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
                    url: 'Delete_borrower.php',
                    type: 'POST',
                    data: {
                        borrowing_id: borrowingId
                    },
                    success: function(response) {
                        Swal.close(); // Close the loading alert

                        $('#delete-borrowing-modal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Borrower Succesfully Deleted',
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
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });

        });
    </script>


    <script src="js/side.js"></script>
    <script>
        $(document).ready(function() {
            $(".bor").addClass('active');
            $(".borrowers-li").addClass('nav-link');
        }); // Get the menu parent element
    </script>
    <script src="DataTables/jquery-3.6.0.min.js"></script>
</body>

</html>