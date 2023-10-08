<!DOCTYPE html>
<html lang="en">
<head>
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
<div class="login-box">
    <div class="lb-header">
        <a href="#" class="active" id="login-box-link">Login</a>
        <a href="#" id="signup-box-link">Sign Up</a>
    </div>
    <div class="social-login">
        <a href="#">
            <i class="fa fa-facebook fa-lg"></i>
            Login with Facebook
        </a>
        <a href="#">
            <i class="fa fa-google-plus fa-lg"></i>
            Login with Google
        </a>
    </div>
    <form action="/model/user_model.php" class="email-login">
        <div class="u-form-group">
            <input type="email" placeholder="Email">
        </div>
        <div class="u-form-group">
            <input type="password" placeholder="Password">
        </div>
        <div class="u-form-group">
            <button>Login</button>
        </div>
        <div class="u-form-group">
            <a href="#" class="forgot-password">Forgot password?</a>
        </div>
    </form>
    <form action="model/user_model.php" class="email-signup">
        <div class="u-form-group">
            <input type="email" placeholder="Email">
        </div>
        <div class="u-form-group">
            <input type="password" placeholder="Password">
        </div>
        <div class="u-form-group">
            <input type="password" placeholder="Confirm Password">
        </div>
        <div class="u-form-group">
            <button>Sign Up</button>
        </div>
    </form>
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
