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
    <title>Books</title>
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
                        <h2 class="mb-5 d-grid row card-title px-4">Books Table</h2>
                        <h4>Add Book here: </h4>
                        <form id="add-book-form" class="align-items-center d-flex w-100 justify-content-between gap-2" method="POST">
                            <div class="col-auto flex-fill">
                                <label for="title" class="visually-hidden">Book Title</label>
                                <input type="text" class="form-control border-0" id="title" name="title" placeholder="Book Title" required>
                            </div>
                            <div class="col-auto">
                                <label for="categories" class="visually-hidden">Categories</label>
                                <input type="text" class="form-control border-0" id="categories" name="categories" placeholder="Categories" required>
                            </div>
                            <div class="col-1">
                                <label for="year" class="visually-hidden">Year</label>
                                <input type="number" class="form-control border-0" placeholder="Year" id="year" name="year">
                            </div>
                            <div class="col-auto">
                                <label for="authors" class="visually-hidden">Authors</label>
                                <input type="text" class="form-control border-0" id="authors" placeholder="Authors" name="authors">
                            </div>
                            <div class="col-auto">
                                <label for="accounts" class="visually-hidden">Accounts</label>
                                <input type="text" class="form-control border-0" id="accounts" placeholder="Accounts" name="accounts">
                            </div>
                            <div class="col-1">
                                <label for="copies" class="visually-hidden">Number of Copies</label>
                                <input type="number" class="form-control border-0" id="copies" name="copies" placeholder="No. Copies" required>
                            </div>
                            <div class="col-1">
                                <label for="cd-copies" class="visually-hidden">Number of CD Copies</label>
                                <input type="number" class="form-control border-0" id="cd_copies" name="cd_copies" placeholder="No. CD Copies" required>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success"><i class="fa fa-3 fa-add"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover text-center bg-white" id="BooksTable">
                            <thead class="border-black table-success">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col" class=" text-start">Title</th>
                                    <th scope="col" class=" text-start">Authors</th>
                                    <th scope="col">Categories</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">Accounts</th>
                                    <th scope="col">No. Copies</th>
                                    <th scope="col">No. Cd Copies</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-light border-success">
                                <?php
                                include 'DBconnect.php';
                                $cat = "";
                                if (isset($_GET['categoryId'])) {
                                    $categoryId = $_GET['categoryId'];
                                    $cat = "WHERE c.category_id = '$categoryId'";
                                }


                                $sql = "SELECT b.book_id, b.title, b.year, GROUP_CONCAT(DISTINCT a.name SEPARATOR ', ') 
                                AS authors, GROUP_CONCAT(DISTINCT c.category_name SEPARATOR ', ') 
                                AS categories, GROUP_CONCAT(DISTINCT ac.account_no SEPARATOR ', ') 
                                AS accountss, b.no_copies, b.no_cd_copy FROM book b LEFT JOIN 
                                book_category bc on bc.book_id = b.book_id LEFT JOIN category c 
                                on c.category_id = bc.category_id LEFT JOIN book_authors ba on b.book_id = ba.book_id 
                                LEFT JOIN author a on a.author_id = ba.author_id LEFT JOIN book_accounts 
                                bAc on bAc.book_id = b.book_id LEFT JOIN accounts ac on ac.account_id = bAc.account_id " . $cat . "
                                GROUP BY b.book_id";
                                $result = mysqli_query($connect, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    if ($row['book_id']  != null) {
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo $row['book_id'] ?></th>
                                            <td class="clickable-row text-start" data-bs-toggle="modal" data-bs-target="#bookInfoModal" data-v-book-id="<?php echo $row['book_id'] ?>" data-v-book-title="<?php echo $row['title'] ?>" data-v-book-year="<?php echo $row['year'] ?>" data-v-book-authors="<?php echo $row['authors'] ?>" data-v-book-categories="<?php echo $row['categories'] ?>" data-v-book-accounts="<?php echo $row['accountss'] ?>"> <span class="mx-2"><?php echo $row['title'] ?></span></td>
                                            <td class="clickable-row text-start" data-bs-toggle="modal" data-bs-target="#bookInfoModal" data-v-book-id="<?php echo $row['book_id'] ?>" data-v-book-title="<?php echo $row['title'] ?>" data-v-book-year="<?php echo $row['year'] ?>" data-v-book-authors="<?php echo $row['authors'] ?>" data-v-book-categories="<?php echo $row['categories'] ?>" data-v-book-accounts="<?php echo $row['accountss'] ?>"> <span class="mx-2"><?php echo $row['authors'] ?></span></td>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#bookInfoModal" data-v-book-id="<?php echo $row['book_id'] ?>" data-v-book-title="<?php echo $row['title'] ?>" data-v-book-year="<?php echo $row['year'] ?>" data-v-book-authors="<?php echo $row['authors'] ?>" data-v-book-categories="<?php echo $row['categories'] ?>" data-v-book-accounts="<?php echo $row['accountss'] ?>"><?php echo $row['categories'] ?></td>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#bookInfoModal" data-v-book-id="<?php echo $row['book_id'] ?>" data-v-book-title="<?php echo $row['title'] ?>" data-v-book-year="<?php echo $row['year'] ?>" data-v-book-authors="<?php echo $row['authors'] ?>" data-v-book-categories="<?php echo $row['categories'] ?>" data-v-book-accounts="<?php echo $row['accountss'] ?>"><?php echo $row['year'] ?></td>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#bookInfoModal" data-v-book-id="<?php echo $row['book_id'] ?>" data-v-book-title="<?php echo $row['title'] ?>" data-v-book-year="<?php echo $row['year'] ?>" data-v-book-authors="<?php echo $row['authors'] ?>" data-v-book-categories="<?php echo $row['categories'] ?>" data-v-book-accounts="<?php echo $row['accountss'] ?>"><?php echo $row['accountss'] ?></td>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#bookInfoModal" data-v-book-id="<?php echo $row['book_id'] ?>" data-v-book-title="<?php echo $row['title'] ?>" data-v-book-year="<?php echo $row['year'] ?>" data-v-book-authors="<?php echo $row['authors'] ?>" data-v-book-categories="<?php echo $row['categories'] ?>" data-v-book-accounts="<?php echo $row['accountss'] ?>"><?php echo $row['no_copies'] ?></td>
                                            <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#bookInfoModal" data-v-book-id="<?php echo $row['book_id'] ?>" data-v-book-title="<?php echo $row['title'] ?>" data-v-book-year="<?php echo $row['year'] ?>" data-v-book-authors="<?php echo $row['authors'] ?>" data-v-book-categories="<?php echo $row['categories'] ?>" data-v-book-accounts="<?php echo $row['accountss'] ?>"><?php echo $row['no_cd_copy'] ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-sm fs-6 btn-dark" data-bs-toggle="offcanvas" data-bs-target="#edit-book-offcanvas" data-book-id="<?php echo $row['book_id'] ?>" data-book-title="<?php echo $row['title'] ?>" data-book-year="<?php echo $row['year'] ?>" data-book-authors="<?php echo $row['authors'] ?>" data-book-categories="<?php echo $row['categories'] ?>" data-book-accounts="<?php echo $row['accountss'] ?>" data-no-copies="<?php echo $row['no_copies'] ?>" data-cd-copies="<?php echo $row['no_cd_copy'] ?>">
                                                        Edit
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-danger delete-book" data-book-id="<?php echo $row['book_id'] ?>" data-bs-toggle="modal" data-bs-target="#delete-book-modal">
                                                        Delete
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

    <!--Edit Book modal-->

    <!--Modal-->

    <div class="offcanvas offcanvas-end border-0 text-white" id="edit-book-offcanvas" tabindex="-1" aria-labelledby="edit-book-modal-label">
        <div class="offcanvas-header" style="background-color: #333;">
            <h5 class="offcanvas-title text-white" id="edit-book-modal-label">Update Book Info</h5>
            <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" style="background-color: #333;">
            <form id="updateBookForm">
                <div class="form-group">
                    <input type="hidden" name="book_id" id="book_id">
                    <label for="title">Title</label>
                    <input type="text" class="form-control border-0" name="Edittitle" id="Edittitle" style="background-color: #555; color: #fff;">
                </div>
                <div class="form-group">
                    <label for="categories">Categories</label>
                    <input type="text" class="form-control border-0" name="Editcategories" id="Editcategories" style="background-color: #555; color: #fff;">
                </div>
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="text" class="form-control border-0" name="Edityear" id="Edityear" style="background-color: #555; color: #fff;">
                </div>
                <div class="form-group">
                    <label for="authors">Authors</label>
                    <input type="text" class="form-control border-0" name="Editauthors" id="Editauthors" style="background-color: #555; color: #fff;">
                </div>
                <div class="form-group">
                    <label for="accounts">Accounts</label>
                    <input type="text" class="form-control border-0" name="Editaccounts" id="Editaccounts" style="background-color: #555; color: #fff;">
                </div>
                <div class="form-group">
                    <label for="no_copies">No. of Copies</label>
                    <input type="text" class="form-control border-0" name="Editno_copies" id="Editno_copies" style="background-color: #555; color: #fff;">
                </div>
                <div class="form-group">
                    <label for="no_cd_copy">No. of CD Copies</label>
                    <input type="text" class="form-control border-0" name="Editno_cd_copy" id="Editno_cd_copy" style="background-color: #555; color: #fff;">
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-dark my-3">Update Book</button>
                </div>
            </form>
        </div>
    </div>



    <!-- Delete book modal -->
    <div class="modal fade" id="delete-book-modal" tabindex="-1" aria-labelledby="delete-book-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white" id="delete-book-modal-label">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center mb-0">Are you sure you want to delete this book?</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger btn-sm confirm-delete" id="confirm-delete-btn" data-book-id="<?php echo $row['book_id'] ?>">Yes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- book Information Modal -->
    <div class="modal fade" id="bookInfoModal" tabindex="-1" role="dialog" aria-labelledby="bookInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookInfoModalLabel">User Information</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="fa fa-book display-1"></i>
                    </div>
                    <div class="text-center mb-3">
                        <h4 id="book_title"></h4>
                    </div>
                    <div class="text-center mb-3">
                        <p id="Book_Authors"></p>
                    </div>
                    <div class="text-center mb-3">
                        <p id="Book_Categories"></p>
                    </div>
                    <div class="text-center mb-3">
                        <p id="Book_Accounts"></p>
                    </div>
                    <div class="text-center mb-3">
                        <p id="Book_Year"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script type="text/javascript">
        $(document).ready(function() {

            $('#BooksTable').DataTable({
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
                var bookId = $(this).data('v-book-id');
                var bookTitle = $(this).data('v-book-title');
                var bookYear = $(this).data('v-book-year');
                var bookAuthors = $(this).data('v-book-authors');
                var bookCategories = $(this).data('v-book-categories');
                var bookAccounts = $(this).data('v-book-accounts');

                // Set the modal content with the retrieved data
                $('#book_title').text(bookTitle);
                $('#Book_Categories').text("Categories: " + bookCategories);
                $('#Book_Authors').text("Authors: " + bookAuthors);
                $('#Book_Accounts').text("Accounts: " + bookAccounts);
                $('#Book_Year').text("Year: " + bookYear);
            });
        });

        // Listen to the click event on the edit button
        $('#BooksTable').on('click', 'button[data-bs-target="#edit-book-offcanvas"]', function() {
            // Get the data from the table row
            var bookId = $(this).data('book-id');
            var bookTitle = $(this).data('book-title');
            var bookCategories = $(this).data('book-categories');
            var bookYear = $(this).data('book-year');
            var bookAuthors = $(this).data('book-authors');
            var bookAccounts = $(this).data('book-accounts');
            var noCopies = $(this).data('no-copies');
            var noCdCopies = $(this).data('cd-copies');

            // Populate the form fields in the modal
            $('#book_id').val(bookId);
            $('#Edittitle').val(bookTitle);
            $('#Editcategories').val(bookCategories);
            $('#Edityear').val(bookYear);
            $('#Editauthors').val(bookAuthors);
            $('#Editaccounts').val(bookAccounts);
            $('#Editno_copies').val(noCopies);
            // Eror here
            $('#Editno_cd_copy').val(noCdCopies);
        });
        // Use to update the book by submitting
        $('#updateBookForm').on('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Loading...',
                background: '#232323',
                color: 'white',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                type: 'POST',
                url: 'Edit_book.php',
                data: $('#updateBookForm').serialize(),
                success: function(response) {
                    $('#edit-book-offcanvas').hide();
                    Swal.close();
                    if (response != "empty") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Book Successfully Updated',
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
                            text: 'Failed while updating book',
                            background: '#232323',
                            color: 'white',
                        })
                    }
                },
                error: function(error) {
                    alert(error);
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while updating the book.',
                        background: '#232323',
                        color: 'white',
                    })
                }
            });
        });

        // Use to add new books
        $('#add-book-form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action') || window.location.href;
            var data = form.serialize();
            Swal.fire({
                title: 'Loading...',
                background: '#232323',
                color: 'white',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                type: 'POST',
                url: 'Process_AddBook.php',
                data: data,
                success: function(response) {
                    Swal.close(); // Close the loading alert
                    //form.trigger('reset');
                    if (response != 'exists') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Book Successfully Added',
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
                            text: 'Book Already Exists',
                            background: '#232323',
                            color: 'white',
                        })
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while adding the book.',
                        background: '#232323',
                        color: 'white',
                    })
                }
            });
        });

        $('.delete-book').click(function() {
            var bookId = $(this).data('book-id');
            $('#delete-book-modal').modal('show');

            $('#delete-book-modal').data('book-id', bookId);
        });

        // Handle confirm delete button click event
        $('#confirm-delete-btn').click(function() {
            // Get bookId from the modal

            Swal.fire({
                title: 'Loading...',
                background: '#232323',
                color: 'white',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                }
            });
            var bookId = $('#delete-book-modal').data('book-id');
            // Send AJAX request to delete_book.php with bookId
            $.ajax({
                url: 'delete_book.php',
                type: 'POST',
                data: {
                    book_id: bookId
                },
                success: function(response) {
                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Book Successfully Deleted',
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
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while Deleting the book.',
                        background: '#232323',
                        color: 'white',
                    })
                }
            });

            // Hide the modal
            $('#delete-book-modal').modal('hide');
        });
    </script>

    <script src="js/side.js"></script>
    <script>
        $(document).ready(function() {
            $(".boo").addClass('active');
            $(".book-li").addClass('nav-link');
        }); // Get the menu parent element
    </script>
    <script src="DataTables/jquery-3.6.0.min.js"></script>
</body>

</html>