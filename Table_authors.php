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
    <title>Authors</title>
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
                        <h2 class="mb-5 d-grid row card-title px-4">Author Table</h2>
                        <h4>Add Authors here:</h4>
                        <form id="addAuthorsForm" method="POST" class="align-items-center d-flex w-100 justify-content-between gap-3">
                            <div class="col-auto flex-fill">
                                <input type="text" class="form-control" id="Author" placeholder="Enter Authors" name="Author" required>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success"><i class="fa fa-3 fa-add"></i></button>
                            </div>
                        </form>
                        <div id="message"></div>
                    </div>
                    <div class="card-body">
                        <table class="table  text-center table-bordered table-hover bg-light border-0" id="authorTable">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col">ID </th>
                                    <th scope="col" class="col-10">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-light border-success">
                                <?php
                                include 'DBconnect.php';
                                $result = mysqli_query($connect, "SELECT * FROM author");
                                while ($row = mysqli_fetch_array($result)) {
                                    if ($row['name'] != null) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['author_id'] ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-dark update-author" data-Eauthor-id="<?php echo $row['author_id'] ?>" data-Eauthor-no="<?php echo $row['name'] ?>" data-bs-toggle="modal" data-bs-target="#update-author-modal">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger delete-author" data-author-id="<?php echo $row['author_id'] ?>" data-bs-toggle="modal" data-bs-target="#delete-author-modal">
                                                    Delete
                                                </button>
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

    <!-- Update author Modal -->
    <div class="modal fade" id="update-author-modal" tabindex="-1" aria-labelledby="update-author-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-md text-white" style="background-color: #333;">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-author-modal-label">Edit author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="author-no-input">Author Name</label>
                        <input type="text" class="form-control" id="author-no-input" style="background-color: #555; color: #fff;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn bg-dark text-white" id="update-author-btn">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete author modal -->
    <div class="modal fade" id="delete-author-modal" tabindex="-1" aria-labelledby="delete-author-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white" id="delete-author-modal-label">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center mb-0">Are you sure you want to delete this author?</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger btn-sm confirm-delete" id="confirm-delete-btn" data-author-id="<?php echo $row['author_id'] ?>">Yes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Initialize the DataTables plugin -->
    <script>
        $(document).ready(function() {
            $('#authorTable').DataTable({
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
            $("#addAuthorsForm").submit(function(e) {
                e.preventDefault(); // prevent default form submit action

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
                    url: "Process_AddAuthors.php", // PHP script to handle form data
                    type: "POST",
                    data: $(this).serialize(), // serialize form data
                    success: function(response) {
                        Swal.close();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Author Successfully Added',
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
                });
            });
            $(document).on('click', '.delete-author', function() {
                var authorId = $(this).data('author-id');
                //alert(authorId);
                $('#delete-author-modal').modal('show');

                // Send authorId to the modal
                $('#delete-author-modal').data('author-id', authorId);
            });

            // Handle confirm delete button click event
            $('#confirm-delete-btn').click(function() {
                // Get authorId from the modal
                var authorId = $('#delete-author-modal').data('author-id');
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
                    url: 'Delete_author.php',
                    type: 'POST',
                    data: {
                        author_id: authorId
                    },
                    success: function(response) {
                        $('#delete-author-modal').modal('hide');
                        Swal.close();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Author Deleted Successfully',
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
            // Handle click event on the Edit button
            $(document).on('click', '.update-author', function() {
                // Get author ID and number from the button's data attributes
                var authorId = $(this).data('eauthor-id');
                var authorNo = $(this).data('eauthor-no');

                // Set the author number in the modal input field
                $('#author-no-input').val(authorNo);

                $('#update-author-btn').on('click', function() {
                    // Get the updated author number from the input field
                    var updatedauthorNo = $('#author-no-input').val();
                    $('#update-author-modal').hide();
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
                    // Send AJAX request to update_author.php
                    $.ajax({
                        url: 'Edit_author.php',
                        type: 'POST',
                        data: {
                            author_id: authorId,
                            author_no: updatedauthorNo
                        },
                        success: function(response) {
                            Swal.close();
                            if (response == "author updated successfully") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Author Successfully Updated',
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
                                    text: 'Error Updating Author',
                                    background: '#232323',
                                    color: 'white',
                                })
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // Handle error response
                            console.log(textStatus, errorThrown);
                        }
                    });

                });
            });
        });
    </script>

    <script src="js/side.js"></script>
    <script>
        $(document).ready(function() {
            $(".au").addClass('active');
            $(".book-li").addClass('nav-link');
        }); // Get the menu parent element
    </script>
    <script src="DataTables/jquery-3.6.0.min.js"></script>
</body>

</html>