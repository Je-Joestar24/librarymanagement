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
    <title>User Accounts</title>

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
                        <h2 class="mb-5 d-grid row card-title px-4">Users Table</h2>
                        <form id="userForm" class="align-items-center d-flex w-100 justify-content-between gap-2" method="POST">
                            <div class="col-1">
                                <label for="userId" class="visually-hidden">user id</label>
                                <input type="text" class="form-control border-0" id="userId" name="userId" placeholder="User ID" required>
                            </div>
                            <div class="col-auto">
                                <label for="firstName" class="visually-hidden">First Name</label>
                                <input type="text" class="form-control border-0" id="firstName" name="firstName" placeholder="First Name" required>
                            </div>
                            <div class="col-auto">
                                <label for="lastName" class="visually-hidden">Last Name</label>
                                <input type="text" class="form-control border-0" id="lastName" name="lastName" placeholder="Last Name" required>
                            </div>
                            <div class="col-auto">
                                <label for="email" class="visually-hidden">Email</label>
                                <input type="email" class="form-control border-0" id="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="col-1">
                                <label for="lastName" class="visually-hidden">User Name</label>
                                <input type="text" class="form-control border-0" id="username" name="username" placeholder="Username" required>
                            </div>
                            <div class="col-1">
                                <label for="lastName" class="visually-hidden">Password</label>
                                <input type="text" class="form-control border-0" id="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="col-1">
                                <label for="year" class="visually-hidden">Year</label>
                                <input type="number" class="form-control border-0" id="year" name="year" placeholder="Year" required>
                            </div>
                            <div class="col-1">
                                <label for="copies" class="visually-hidden">Number of Copies</label>
                                <select class="form-select" id="course" name="course" required>
                                    <option value="" selected disabled>Course</option>
                                    <?php
                                    include 'DBconnect.php';
                                    $sql1 = "SELECT * FROM courses";
                                    $result1 = mysqli_query($connect, $sql1);
                                    while ($row = mysqli_fetch_assoc($result1)) {
                                        echo "<option value='" . $row['course_id'] . "'>" . $row['course_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success"><i class="fa fa-3 fa-add"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body bg-transparent">
                        <!-- Add the table HTML -->
                        <table class="table table-striped table-hover mt-3 bg-white" id="UserTable">
                            <thead class="table-success">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>User Name</th>
                                    <th>Password</th>
                                    <th>Course Year</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT users.first_name, users.last_name,  users.user_id, CONCAT(users.first_name, ' ', users.last_name) AS user__name, users.password, users.username, users.email, users.year, courses.course_name, courses.course_id FROM users
                                    JOIN user_course ON users.user_id = user_course.user_id
                                    JOIN courses ON user_course.course_id = courses.course_id";
                                $result = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>"><?php echo $row['user_id'] ?></td>
                                        <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>"><?php echo $row['user__name'] ?></td>
                                        <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>"><?php echo $row['email'] ?></td>
                                        <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>"><?php echo $row['username'] ?></td>
                                        <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>"><?php echo $row['password'] ?></td>
                                        <td class="clickable-row" data-bs-toggle="modal" data-bs-target="#userInfoModal" data-user-name="<?php echo $row['first_name'] . ' ' . $row['last_name'] ?>" data-course-year="<?php echo $row['course_name'] . ' - ' . $row['year'] ?>" data-email="<?php echo $row['email'] ?>"><?php echo $row['course_name'] . " - " . $row['year']  ?></td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-sm btn-dark me-2 edit-user-btn" data-bs-toggle="offcanvas" data-bs-target="#edit-user-offcanvas" data-user-id="<?php echo $row['user_id']; ?>" data-user-firstname="<?php echo $row['first_name']; ?>" data-user-lastname="<?php echo $row['last_name']; ?>" data-email="<?php echo $row['email'] ?>" data-course-id="<?php echo $row['course_id'] ?>" data-year="<?php echo $row['year'] ?>" data-user-ename="<?php echo $row['username'] ?>" data-pass="<?php echo $row['password'] ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm delete-user" data-user-id="<?php echo $row['user_id'] ?>" data-bs-toggle="modal" data-bs-target="#delete-user-modal">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </main>
        </div>
    </section>

    <div class="modal fade dark-mode text-white" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #333;">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <!-- Delete user modal -->
    <div class="modal fade" id="delete-user-modal" tabindex="-1" aria-labelledby="delete-user-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white" id="delete-user-modal-label">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center mb-0">Are you sure you want to delete this user?</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger btn-sm confirm-delete" id="confirm-delete-btn" data-user-id="<?php echo $row['user_id'] ?>">Yes</button>
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
                        <p id="gmail"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="offcanvas offcanvas-end border-0 text-white" id="edit-user-offcanvas" tabindex="-1" aria-labelledby="edit-borrow-modal-label">
        <div class="offcanvas-header" style="background-color: #333;">
            <h3 class="offcanvas-title text-white" id="edit-borrow-modal-label">Update User Info</h3>
            <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body py-5" style="background-color: #333;">
            <form id="editUserForm">
                <input type="hidden" id="edit-user-id" value="">
                <div class="mb-3">
                    <label for="edit-firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control border-0" id="edit-firstname" style="background-color: #555; color: #fff;" required>
                </div>
                <div class="mb-3">
                    <label for="edit-lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control border-0" id="edit-lastname" style="background-color: #555; color: #fff;" required>
                </div>
                <div class="mb-3">
                    <label for="edit-email" class="form-label">Email</label>
                    <input type="email" class="form-control border-0" id="edit-email" style="background-color: #555; color: #fff;" required>
                </div>
                <div class="mb-3">
                    <label for="#edit-Username" class="form-label">Username</label>
                    <input type="text" class="form-control border-0" id="edit-username" style="background-color: #555; color: #fff;" required>
                </div>
                <div class="mb-3">
                    <label for="edit-pass" class="form-label">Password</label>
                    <input type="text" class="form-control border-0" id="edit-pass" style="background-color: #555; color: #fff;" required>
                </div>
                <div class="mb-3">
                    <label for="edit-course" class="form-label">Course</label>
                    <select class="form-select border-0" id="edit-course" style="background-color: #555; color: #fff;" required>
                        <!-- Options for courses will be populated dynamically using Ajax -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="edit-year" class="form-label">Year</label>
                    <input type="number" class="form-control border-0" id="edit-year" style="background-color: #555; color: #fff;" required>
                </div>
                <div class="offcanvas-bottom text-center">
                    <button type="submit" class="btn btn-dark my-3">Update User</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Initialize the DataTables plugin -->

    <script src="DataTables/jquery-3.6.0.min.js"></script>
    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
                arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
        $('.nav-link').on('click', function() {
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
        });
        $('a[data-url]').on('click', function(e) {
            e.preventDefault(); // prevent the link from reloading the page
            var url = $(this).data('url'); // get the URL from the data-url attribute
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
                success: function(data) {
                    // display the table data in a container element
                    $('#main-content').html(data);
                },
                error: function(xhr, status, error) {
                    // handle any errors that occur during the AJAX request
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.delete-user').click(function() {
                var userId = $(this).data('user-id');
                $('#delete-user-modal').modal('show');

                // Send userId to the modal
                $('#delete-user-modal').data('user-id', userId);
            });

            // Handle confirm delete button click event
            $('#confirm-delete-btn').click(function() {
                // Get userId from the modal
                var userId = $('#delete-user-modal').data('user-id');
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
                    url: 'Delete_user.php',
                    type: 'POST',
                    data: {
                        user_id: userId
                    },
                    success: function(response) {
                        $('#delete-user-modal').hide();
                        Swal.close();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'User Successfully Deleted',
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
                            text: 'An error occurred while Deleting the User.',
                            background: '#232323',
                            color: 'white',
                        })
                    }
                });

                // Hide the modal
                $('#delete-user-modal').modal('hide');
            });
            $("#userForm").submit(function(e) {
                e.preventDefault();
                var form_data = $(this).serialize();
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
                    url: "USERS/addNew_u.php",
                    method: "POST",
                    data: form_data,
                    success: function(data) {
                        Swal.close(); // Close the loading alert
                        /* 
                            if (data == 'duplicate') {
                            alert("User ID or Email already exists!");
                            } else  
                        */
                        if (data == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'User Successfully Added',
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
                                text: 'User Already Exists',
                                background: '#232323',
                                color: 'white',
                            })
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("Error: " + errorThrown);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while adding the User.',
                            background: '#232323',
                            color: 'white',
                        })
                    }
                });
            });
            $('#UserTable').DataTable({
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
            $(document).on('click', '.clickable-row', function() {
                var userName = $(this).data('user-name');
                var courseYear = $(this).data('course-year');
                var email = $(this).data('email');

                // Set the modal content with the retrieved data
                $('#userName').text(userName);
                $('#courseYear').text(courseYear);
                $('#gmail').text(email);

                // Show the modal
                $('#userInfoModal').modal('show');
            });
            // Triggered when the Edit button is clicked
            $(document).on("click", ".edit-user-btn", function() {
                // Get user data from the button's data attributes
                var userId = $(this).data("user-id");
                var firstName = $(this).data("user-firstname");
                var lastName = $(this).data("user-lastname");
                var email = $(this).data("email");
                var pass = $(this).data("pass");
                var username = $(this).data("user-ename");
                var courseId = $(this).data("course-id");
                var year = $(this).data("year");

                //alert(pass);
                // Set user data in the modal
                $("#edit-user-id").val(userId);
                $("#edit-firstname").val(firstName);
                $("#edit-lastname").val(lastName);
                $("#edit-username").val(username);
                $("#edit-pass").val(pass);
                $("#edit-email").val(email);
                $("#edit-year").val(year);


                // Populate course options with the selected course already selected
                populateCourseOptions(courseId);
            });

            // Populate course options with the selected course already selected
            function populateCourseOptions(selectedCourseId) {
                $.ajax({
                    url: "fetch_courses.php",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            // Clear existing options
                            $("#edit-course").empty();

                            // Populate course options
                            $.each(response.data, function(index, course) {
                                var option = $("<option>")
                                    .val(course.course_id)
                                    .text(course.course_name);

                                if (selectedCourseId == course.course_id) {
                                    option.attr("selected", "selected");
                                }

                                $("#edit-course").append(option);
                            });
                        }
                    },
                    error: function() {
                        console.log("Error occurred while fetching courses.");
                    }
                });
            }

            // Triggered when the Update User form is submitted
            $("#editUserForm").submit(function(e) {
                e.preventDefault();

                var userId = $("#edit-user-id").val();
                var firstName = $("#edit-firstname").val();
                var lastName = $("#edit-lastname").val();
                var email = $("#edit-email").val();
                var courseId = $("#edit-course").val();
                var year = $("#edit-year").val();
                var username = $("#edit-username").val();
                var pass = $("#edit-pass").val();

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
                // Send data to Edit_user.php using Ajax
                $.ajax({
                    url: "Edit_user.php",
                    type: "POST",
                    data: {
                        user_id: userId,
                        first_name: firstName,
                        last_name: lastName,
                        email: email,
                        username: username,
                        pass: pass,
                        course_id: courseId,
                        year: year
                    },
                    success: function(response) {
                        $('#edit-user-offcanvas').hide();
                        Swal.close();
                        if (response != 'error') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'User Successfully Updated',
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
                                text: 'Failed while updating User',
                                background: '#232323',
                                color: 'white',
                            })
                        }
                    },
                    error: function() {
                        console.log("Error occurred while updating user.");
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while updating the User.',
                            background: '#232323',
                            color: 'white',
                        })
                    }
                });
            });

        });
    </script>

    <script src="js/side.js"></script>

    <script>
        $(document).ready(function() {
            $(".us").addClass('active');
        });
    </script>
</body>

</html>