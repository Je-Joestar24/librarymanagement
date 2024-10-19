<!DOCTYPE html>
<html>

<head>
    <title>Attendance Form</title>
    <script src="/CICTE/DataTables/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="/CICTE/BOOTSTRAP/css/bootstrap.min.css">
    <link rel="stylesheet" href="/CICTE/Font/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background-color: #4e73df;
            color: #fff;
        }

        .card-header h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .form-label {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .form-control {
            font-size: 1.5rem;
            border-radius: 10px;
            padding: 0.5rem 1rem;
            border: none;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }

        .btn {
            font-size: 1.5rem;
            border-radius: 10px;
            padding: 0.5rem 1rem;
            border: none;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #4e73df;
            color: #fff;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
        }

        .btn-dark {
            background-color: #343a40;
            color: #fff;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-dark:hover {
            background-color: #1d2124;
        }

        .list-group {
            margin-top: 2rem;
        }

        .list-group-item {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
            transition: transform 0.2s ease-in-out;
        }

        .list-group-item:hover {
            transform: translateY(-5px);
        }

        .list-group-item h6 {
            font-weight: bold;
        }

        .list-group-item span {
            font-size: 1rem;
        }

        .btn-primary,
        .btn-dark {
            background-color: #6933ff;
            border-color: #6933ff;
            transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out;
        }

        .btn-primary:hover,
        .btn-dark:hover {
            background-color: #531ebd;
            border-color: #531ebd;
        }

        .fa {
            font-size: 1.2rem;
        }

        #attendanceMessage {
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>

    <script>
        $(document).ready(function() {
            $("#attendanceForm").on("submit", function(e) {
                e.preventDefault();
                var userId = $("#userId").val();
                $.ajax({
                    url: "get_list.php",
                    method: "POST",
                    data: {
                        userId: userId
                    },
                    success: function(response) {
                        if (response != "no record") {
                            $("#attendanceMessage").html("Welcome, " + response + "!");
                            $("#attendanceMessage").removeClass("text-danger");
                            $("#attendanceMessage").addClass("text-success");
                            location.reload();
                        } else {
                            $("#attendanceMessage").html("No record");
                            $("#attendanceMessage").removeClass("text-success");
                            $("#attendanceMessage").addClass("text-danger");
                        }
                        $("#userId").val("");
                    }
                });
            });
        });
    </script>
    <style>
        body {
            background-image: url('/WLC2/photos/image-removebg.png');
            background-color: green;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-position-x: left;
            background-size: 1000px;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card  shadow">
                    <div class="card-header">
                        <h1 class="text-center mb-4">Entry Record</h1>
                        <form id="attendanceForm">
                            <div class="mb-3 d-flex justify-content-center align-items-center">
                                <label for="userId" class="form-label me-3 fs-2">ID:</label>
                                <input type="text" id="userId" name="userId" class="form-control me-3" required>
                                <button type="submit" class="btn  btn-primary"><i class="fa fa-4 fa-check"></i></button>
                                <a href="user_signup.php" class=" ms-2 btn btn-dark"><i class="fa fa-4 fa-add"></i></a>
                            </div>
                        </form>
                        <div id="attendanceMessage" class="mt-4"></div>
                    </div>
                    <div class="card-body" style="height: 700px; overflow:auto;">
                        <h5 class=" bg-success py-2 ps-2 text-light text-center">Attendance</h5>
                        <div class="list-group">
                            <?php
                            include 'DBconnect.php';
                            $sql = "SELECT u.user_id, CONCAT(u.first_name, ' ', u.last_name) AS username, CONCAT(c.course_name, ' - ', u.year ) AS course_year, DATE_FORMAT(a.login_time, '%b %d, %Y %h:%i %p') AS login_time 
                                FROM users u
                                INNER JOIN user_course uc ON u.user_id = uc.user_id
                                INNER JOIN courses c ON uc.course_id = c.course_id
                                INNER JOIN attendance a ON u.user_id = a.user_id WHERE DATE(a.login_time) = CURDATE()
                                ORDER BY a.login_time ASC";
                            $result = mysqli_query($connect, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                $counter = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="  mt-1"><?php echo $counter . ". " . $row['username'] ?></h6>
                                            <div class="d-flex w-50 justify-content-between mt-1">
                                                <small><?php echo $row['course_year'] ?></small>
                                                <span class="mb-1"><?php echo "Login Time: " . $row['login_time'] ?></span>
                                            </div>
                                        </div>
                                    </a>
                            <?php
                                    $counter++;
                                }
                            } else {
                                echo "<p class='list-group-item'>No records found</p>";
                            }
                            mysqli_close($connect);
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>