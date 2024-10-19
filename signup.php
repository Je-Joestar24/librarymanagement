<!DOCTYPE html>
<html>

<head>
    <title>Sign up</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="BOOTSTRAP/css/bootstrap.min.css">
    <script src="datatables/jquery.min.js"></script> <!--JS BOOTSTRAP-->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="bootstrap/js/bootstrap.bundle.js" integrity="sha512-57tVpZI+eKh7wsCZtSKob5+Vzi8/w5Kkj7Vc49JxZ+7H8wWw++g7zw4J4BC9H/rACMZRMmZ+o2gqq6xGPR6+hA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--JS CDN-->
    <script src="datatables/jquery-3.6.0.min.js"></script>
    <style>
        body {

            background-repeat: no-repeat;
            background-color: whitesmoke;
            background-attachment: fixed;
            background-size: cover;
            background-image: url('photos/bg-green2.jpg');
            background-size: cover;
            position: relative;

            background-position: bottom;
        }

        .login-container {
            background-size: cover;
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
            color: white;
            font-size: larger;
            opacity: .8;
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
            background-image: url('photos/Body_background.jpg');
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
            <div class="login-container border-dark border-2 float-end bg-dark"> <!-- add float-end class -->
                <div class="card-body mt-4">
                    <form action="signup.php" method="post">
                        <div class="signup_container">
                            <h1>
                                ADMIN REGISTRATION
                            </h1>
                            <p>Sign up now</p>
                            <hr class="mb-3">
                            <label for="firstname"><b>CONTROL NUMBER/ID:</b></label>
                            <input class="form-control" type="text" name="SC_ID" id="SC_ID" placeholder="0000" required>
                            <label for="firstname"><b>FIRST NAME:</b></label>
                            <input class="form-control" type="text" name="firstname" id="firstname" placeholder="First Name" required>
                            <label for="lastname"><b>LAST NAME:</b></label>
                            <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Last Name" required>
                            <label for="username"><b>USER NAME:</b></label>
                            <input class="form-control" type="text" name="username" id="username" placeholder="User Name" required>
                            <label for="email"><b>EMAIL:</b></label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="user@example.com" required>
                            <label for="contact"><b>MOBILE NUMBER:</b></label>
                            <input class="form-control" type="text" name="contact" id="contact" placeholder="09XXXXXXXXX" required>
                            <label for="pass"><b>PASSWORD:</b></label>
                            <input class="form-control" type="password" name="pass" id="pass" placeholder="PASSWORD" required>
                            <!--<label for="cpass"><b>CONFIRM PASSWORD:</b></label>
                    <input class="form-control" type="password" name="cpass" id="passC" placeholder="CONFIRM PASSWORD">-->
                            <button type="submit" class="btn btn-primary my-3" id="signup">Sign Up</button>
                    </form>
                </div>
                <div class="card-footer py-2 text-center">
                    <p>Already have an account? <a href="login.php">Log In</a></p>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            $('#signup').click(function(e) {
                e.preventDefault();
                var valid = this.form.checkValidity();
                if (valid) {
                    var idAdd = $('#SC_ID').val();
                    var lnameAdd = $('#lastname').val();
                    var fnameAdd = $('#firstname').val();
                    var emailAdd = $('#email').val();
                    var conAdd = $('#contact').val();
                    var passAdd = $('#pass').val();
                    var userAdd = $('#username').val();

                    $.ajax({
                        url: "Process_signup.php",
                        type: 'post',
                        data: {
                            idSend: idAdd,
                            lnameSend: lnameAdd,
                            fnameSend: fnameAdd,
                            emailSend: emailAdd,
                            conSend: conAdd,
                            passSend: passAdd,
                            userSend: userAdd
                        },
                        success: function(data) {
                            console.log(data)
                            if (data == "success") {
                                swal.fire({
                                    'title': 'Success',
                                    'text': 'Signup successfully',
                                    'icon': 'success'
                                })
                            } else {
                                swal.fire({
                                    'title': 'Error!',
                                    'text': 'Username/email/contact number already exists',
                                    'icon': 'error'
                                })
                            }
                        },
                        error: function(data) {
                            swal.fire({
                                'title': 'Error!',
                                'text': 'Some error occured',
                                'icon': 'error'
                            })
                        }
                    })


                }
            })
        })
    </script>
</body>

</html>