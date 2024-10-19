<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CICTE/BOOTSTRAP/css/bootstrap.min.css">
    <link rel="stylesheet" href="/CICTE/BOOTSTRAP/css/bootstrap.min.css">
    <script src="/CICTE/datatables/jquery.min.js"></script> <!--JS BOOTSTRAP-->
    <script src="/CICTE/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="/CICTE/bootstrap/js/bootstrap.bundle.js" integrity="sha512-57tVpZI+eKh7wsCZtSKob5+Vzi8/w5Kkj7Vc49JxZ+7H8wWw++g7zw4J4BC9H/rACMZRMmZ+o2gqq6xGPR6+hA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--JS CDN-->
    <script src="/CICTE/datatables/jquery-3.6.0.min.js"></script>
    <style>
        body {

            background-repeat: no-repeat;
            background-color: whitesmoke;
            background-attachment: fixed;
            background-size: cover;
            background-image: url('photos/bg-4.jpg');
            background-size: cover;

            position: relative;

            background-position: bottom;
        }

        .login-container {
            background-size: cover;
            background-color: whitesmoke;
            border-radius: 5%;
            padding: 50px;
            position: relative;
            max-width: 600px;
            margin-left: auto;
            /* add this line */
            margin-right: 50px;
            /* add this line */
            background-position: bottom;
            margin: 0 auto;
            color: black;
            font-size: larger;
        }

        .w-bold {
            color: #2ecc71;
        }

        .signup {
            font-size: 14px;
        }

        .link-light:hover {
            text-decoration: none;
            color: #2ecc71;
        }

        .logo-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('photos/bg-green2.jpg');
        }


        .logo {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row justify-content-center align-items-center" style="height:100vh;">
            <div class="col-md-6 p-0">
                <div class="logo-container">
                    <img src="photos/image-removebg.png" alt="School Logo" class="logo">
                </div>
            </div>
            <div class="login-container border-dark border-2 float-end"> <!-- add float-end class -->
                <div class="card-header">
                    <h1 class="w-bold pt-4">Welcome to CICTE Library</h1>
                    <p class="fw-bold pb-2 px-1">Please sign up</p>
                </div>
                <div class="card-body mt-4">
                    <form id="userForm" class="form-control bg-transparent border-0 d-grid card-columns">
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="userId" name="userId" placeholder="User ID" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="User Name" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="number" class="form-control" id="year" name="year" placeholder="Year" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <select class="form-select" id="course" name="course" required>
                                    <option value="" selected disabled>Select a course</option>
                                    <?php
                                    include 'DBconnect.php';
                                    $sql = "SELECT * FROM courses";
                                    $result = mysqli_query($connect, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['course_id'] . "'>" . $row['course_name'] . "</option>";
                                    }
                                    mysqli_close($connect);
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i> Submit
                        </button>
                    </form>
                </div>
                <div class="card-footer py-2 text-center">
                    <a href="login.php" class="link-primary">Login here</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#userForm").submit(function(e) {
                e.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "addNew_u.php",
                    method: "POST",
                    data: form_data,
                    success: function(data) {
                        if (data == 'duplicate') {
                            alert("User ID or Email already exists!");
                        } else if (data == 'success') {
                            alert("User added successfully!");
                            $("#userForm")[0].reset();
                        } else {
                            alert("Error: " + data);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("Error: " + errorThrown);
                    }
                });
            });
        });
    </script>

</body>