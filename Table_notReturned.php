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
    <title>Not Returned</title>

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
                        <h2 class="mb-5 d-grid row card-title px-4">Not returned</h2>
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
                                        <div class="py-1">Borrowed Book</div>
                                    </th>
                                    <th scope="col">
                                        <div class="py-1">Borrowed Date</div>
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
                            <tbody>
                                <?php
                                include 'DBconnect.php';
                                $sql = "SELECT current_date() as cur, b.book_id, br.borrowing_id, GROUP_CONCAT(DISTINCT b.title SEPARATOR ', ') AS books, u.email, u.first_name, u.last_name, br.checkout_date, br.duedate, br.return_date, c.course_name, u.year, u.user_id FROM book b 
                                INNER JOIN borrowings br ON br.book_id = b.book_id
                                INNER JOIN users u ON br.user_id = u.user_id
                                INNER JOIN user_course uc ON uc.user_id = u.user_id
                                INNER JOIN courses c ON c.course_id = uc.course_id WHERE br.return_date IS NULL GROUP BY br.borrowing_id;";
                                $result = mysqli_query($connect, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    if ($row['borrowing_id']  != null) {
                                ?>
                                        <tr>
                                            <th class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['books'] ?>" scope="row"><?php echo $row['borrowing_id'] ?></th>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['books'] ?>"><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></td>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['books'] ?>"><?php echo $row['course_name'] . ' - ' . $row['year'] ?></td>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['books'] ?>"><?php echo $row['books'] ?></td>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['books'] ?>"><?php echo $row['checkout_date'] ?></td>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['books'] ?>"><?php echo $row['duedate'] ?></td>
                                            <td class="clickable-row text-center" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>" data-borrowed-books="<?php echo $row['books'] ?>">
                                                <?php if ($row['return_date'] >  $row['duedate'] || $row['duedate'] < $row['cur']) echo "<div class = 'text-white bg-danger rounded-5'>Overdued</div>";
                                                else echo "<div class = 'text-white bg-success rounded-5'>Under due</div>"; ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-sm btn-dark me-2 edit-borrowing" data-bs-toggle="offcanvas" data-bs-target="#edit-borrow-offcanvas" data-borrowing-id="<?php echo $row['borrowing_id'] ?>" data-user-id="<?php echo $row['user_id'] ?>" data-book-id="<?php echo $row['book_id'] ?>" data-due-date="<?php echo $row['duedate'] ?>" data-checkout-date="<?php echo $row['checkout_date'] ?>" data-return-date="<?php echo $row['return_date'] ?>">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-danger return-borrowed" id="return-borrowed" data-borrower-id="<?php echo $row['borrowing_id'] ?>">
                                                        <i class="bi bi-trash"></i> Returned
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
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

    <!-- Initialize the DataTables plugin -->
    <script>
        // Edit Button Click Event

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
                    $('#edit-borrow-offcanvas').hide();
                    Swal.close();
                    if (response != "error") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: "Borrower Succesfully edited.",
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
                        $('#message').html("<div class='alert alert-danger'>" + response + "</div>");
                    }
                },
                error: function(error) {
                    alert(error);
                    console.log(error);
                }
            });
        });
        $(document).ready(function() {

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
            $(document).on('click', '.return-borrowed', function() {
                var borrowingId = $(this).data('borrower-id');

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
                // Make an AJAX call to return the book
                $.ajax({
                    type: "POST",
                    url: "Process_return.php",
                    data: {
                        borrowingId: borrowingId
                    },
                    success: function(response) {
                        Swal.close();
                        if (response == "Book returned successfully") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
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
                        } else {
                            $('#message').html("<div class='alert alert-danger'>" + response + "</div>");
                        }
                    },
                    error: function() {
                        // Display an error message
                        alert('Error: Could not return book');
                    }
                });
            });
        });
    </script>

    <script src="js/side.js"></script>
    <script>
        $(document).ready(function() {
            $(".nret").addClass('active');
            $(".borrowers-li").addClass('nav-link');
        }); // Get the menu parent element
    </script>
    <script src="DataTables/jquery-3.6.0.min.js"></script>
</body>

</html>