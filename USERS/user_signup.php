<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/CICTE/Font/css/all.css">
    <link rel="stylesheet" href="/CICTE/BOOTSTRAP/css/bootstrap.min.css">
    <link rel="stylesheet" href="/CICTE/BOOTSTRAP/css/bootstrap.min.css">
    <script src="/CICTE/datatables/jquery.min.js"></script> <!--JS BOOTSTRAP-->
    <script src="/CICTE/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="/CICTE/bootstrap/js/bootstrap.bundle.js" integrity="sha512-57tVpZI+eKh7wsCZtSKob5+Vzi8/w5Kkj7Vc49JxZ+7H8wWw++g7zw4J4BC9H/rACMZRMmZ+o2gqq6xGPR6+hA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--JS CDN-->
    <script src="/CICTE/datatables/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="/CICTE/Font/css/all.min.css">
    
    <style>
    body {
            background-image: url('/CICTE/photos/image-removebg.png');
            background-color: green;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-position-x: left;
            background-size: 1000px;
        }
        .login-container {
            border-radius: 10px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #4e4e4e;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: #0069d9;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 10px 15px;
        }
        .form-select:focus {
            box-shadow: none;
            border-color: #4e4e4e;
        }
        .form-label {
            font-weight: bold;
            color: #4e4e4e;
            margin-bottom: 5px;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: none;
            text-align: center;
            font-weight: bold;
            font-size: 1.5rem;
        }
        .card-body {
            padding: 2rem;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-color: #ced4da;
        }
        .input-group-text i {
            color: #4e4e4e;
        }
        .btn i {
            margin-right: 5px;
        }
        .bg-black {
            background-color: #000000;
            color: #ffffff;
            padding: 10px;
            border-radius: 10px;
        }
        .bg-black:hover {
            background-color: #1a1a1a;
        }
    </style>
</head>

<body style="background-color: green;">
    <!-- HTML form -->


    <div class="container-fluid ">
        <div class="row justify-content-center align-items-center" style="height:100vh;">
            <div class="col-md-4 mx-auto">
                <div class="login-container bg-light shadow" style="border-radius: 10px;">
                    <a href="Index.php" class="p position-relative top-0 start-0"><i class="fa fa-5 fa-arrow-left mt-4 mx-4"></i></a>
                    <h2 class="text-center card-header p-3">Sign up for new users:</h2>
                    <div class="card-body ">
                        <form id="userForm" class="form-control bg-transparent border-0 d-grid card-columns">
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user fa-hashtag"></i></span>
                                    <input type="text" class="form-control" id="userId" name="userId" placeholder="User ID" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-3 fa-user"></i></span>
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="User Name" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="number" class="form-control" id="year" name="year" placeholder="Year" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-book"></i></span>
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
                </div>
            </div>
        </div>
        <!-- AJAX code -->
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

</html>