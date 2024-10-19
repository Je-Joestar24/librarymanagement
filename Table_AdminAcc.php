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
    <title>ADMIN ACCOUNTS</title>

    <link rel="stylesheet" href="BOOTSTRAP/css/bootstrap.min.css">
    <link rel="stylesheet" href="Font/css/all.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="js/bootstrap.min.js"></script>
    <script src="JS/popper.min.js"></script>
    <link rel="stylesheet" href="Design/datatables.css">

    <script src="DataTables/jquery.min.js"></script>

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
                <div class="card vh-90 border-0 bg-transparent text-white">
                    <div class="card-header">
                        <h4 class="card-title my-3">Admins Table</h4>
                        <li><a href="#" data-url="Table_returned.php" class="btn btn-success"><i class="fa fa-4 fa-plus"></i></a></li>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped table-hover text-center mt-3 bg-white" id="AdminsTable">
                                    <thead class="table-success">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'DBconnect.php';
                                        $result = mysqli_query($connect, "SELECT * FROM librarians");
                                        while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['librarian_id'] ?></td>
                                                <td><?php echo $row['last_name'] . ', ' . $row['first_name'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td style="width: 180px;">
                                                    <a href="edit_librarian.php?id=<?php echo $row['librarian_id'] ?>" class="btn btn-outline-dark me-2">Edit</a>
                                                    <button type="button" class="btn btn-outline-danger delete-librarian" data-librarian-id="<?php echo $row['librarian_id'] ?>" data-bs-toggle="modal" data-bs-target="#delete-librarian-modal">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </main>
        </div>
    </section>


    <!-- Delete librarian modal -->
    <div class="modal fade" id="delete-librarian-modal" tabindex="-1" aria-labelledby="delete-librarian-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white" id="delete-librarian-modal-label">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center mb-0">Are you sure you want to delete this librarian?</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger btn-sm confirm-delete" id="confirm-delete-btn" data-librarian-id="<?php echo $row['librarian_id'] ?>">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Initialize the DataTables plugin -->
    <script>
        $(document).ready(function() {
            $('#AdminsTable').DataTable({
                "searching": true,
                "lengthChange": false,
                "pageLength": 10,
                "language": {
                    "search": "Search:",
                    "zeroRecords": "No matching records found",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "Showing 0 to 0 of 0 entries",
                    "infoFiltered": "(filtered from _MAX_ total entries)"
                }
            });

            $('.delete-librarian').click(function() {
                var librarianId = $(this).data('librarian-id');
                //alert(librarianId);
                $('#delete-librarian-modal').modal('show');

                // Send librarianId to the modal
                $('#delete-librarian-modal').data('librarian-id', librarianId);
            });

            // Handle confirm delete button click event
            $('#confirm-delete-btn').click(function() {
                // Get librarianId from the modal
                var librarianId = $('#delete-librarian-modal').data('librarian-id');

                // Send AJAX request to delete_librarian.php with librarianId
                $.ajax({
                    url: 'Delete_librarian.php',
                    type: 'POST',
                    data: {
                        librarian_id: librarianId
                    },
                    success: function(response) {
                        // Reload the page after deleting the librarian
                        //alert(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });

                // Hide the modal
                $('#delete-librarian-modal').modal('hide');
            });
        });
    </script>

    <script src="js/side.js"></script>
    <script>
        $(document).ready(function() {
            $(".adm").addClass('active');
        }); // Get the menu parent element
    </script>
    <script src="DataTables/jquery-3.6.0.min.js"></script>
</body>

</html>