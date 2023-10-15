<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/Style.css">
    <style>
        /* Add your CSS styling here */
        .email-signup {
            display: none; /* Hide the Sign Up form by default */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="login-box-link" href="#">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="signup-box-link" href="#">Sign Up</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="social-login">
                        <a href="#" class="btn btn-primary btn-block">
                            <i class="fa fa-facebook fa-lg"></i> Login with Facebook
                        </a>
                        <a href="#" class="btn btn-danger btn-block">
                            <i class="fa fa-google-plus fa-lg"></i> Login with Google
                        </a>
                    </div>
                    <form action="#" method="post" name="login" class="email-login">
                        <div class="form-group">
                            <input type="hidden" name="loginRequest" value="1">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block">Login</button>
                        </div>

                        <div class="form-group text-center">
                            <a href="#" class="forgot-password">Forgot password?</a>
                        </div>
                    </form>
                    <form action="#" method="post" name="signup" class="email-signup">
                        <input type="hidden" name="loginRequest" value="1">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Confirm Password">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success btn-block">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript to toggle between Login and Sign Up forms
    document.getElementById("signup-box-link").addEventListener("click", function () {
        document.querySelector(".email-login").style.display = "none";
        document.querySelector(".email-signup").style.display = "block";
        document.querySelector("#login-box-link").classList.remove("active");
        this.classList.add("active");
    });

    document.getElementById("login-box-link").addEventListener("click", function () {
        document.querySelector(".email-signup").style.display = "none";
        document.querySelector(".email-login").style.display = "block";
        document.querySelector("#signup-box-link").classList.remove("active");
        this.classList.add("active");
    });
</script>
</body>
</html>
