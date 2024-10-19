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
                    <p class="fw-bold pb-2 px-1">Please login to your account</p>
                </div>
                <div class="card-body mt-4">
                    <form id="login-form" method="post">
                        <div class="form-group">
                            <label for="user" class="py-2">User Name/Email Address:</label>
                            <input type="text" class="form-control border-black border-1 bg-body-secondary" id="user" placeholder="username/email" name="user" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="py-2">Password:</label>
                            <input type="password" class="form-control border-black border-1 bg-body-secondary" placeholder="password" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn bg-success px-4 btn-success border-0 rounded-3 hover btn-lg mt-4 border-success">Login</button>
                    </form>
                </div>
                <div class="card-footer py-2 text-center">
                    <a href="signup.php" class="link-primary">Create an account</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('#login-form').submit(function(event) {
                event.preventDefault(); //prevent default form submission

                var user = $('#user').val();
                var password = $('#password').val();

                $.ajax({
                    url: 'Process_Login.php',
                    method: 'POST',
                    data: {
                        user: user,
                        password: password
                    },
                    success: function(response) {
                        if (response == 'success') {
                            window.location = 'books.php';
                        } else {
                            alert(response);
                        }
                    },
                    error: function(response) {
                        alert("Error!");
                    }
                });
            });
        });
    </script>

</body>