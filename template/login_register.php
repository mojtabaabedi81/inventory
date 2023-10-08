<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../assets/Style.css">

</head>
<script>
    window.console = window.console || function(t) {};
</script>
<body>
<div class="login-box">
    <div class="lb-header">
        <a href="#" class="active" id="login-box-link">Login</a>
        <a href="#" id="signup-box-link">Sign Up</a>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script id="rendered-js">
        $(".email-signup").hide();
        $("#signup-box-link").click(function () {
            $(".email-login").fadeOut(100);
            $(".email-signup").delay(100).fadeIn(100);
            $("#login-box-link").removeClass("active");
            $("#signup-box-link").addClass("active");
        });
        $("#login-box-link").click(function () {
            $(".email-login").delay(100).fadeIn(100);;
            $(".email-signup").fadeOut(100);
            $("#login-box-link").addClass("active");
            $("#signup-box-link").removeClass("active");
        });
    </script>
    <div class="social-login">
        <a href="#">
            <i class="fa fa-facebook fa-lg"></i>
            Login in with facebook
        </a>
        <a href="#">
            <i class="fa fa-google-plus fa-lg"></i>
            log in with Google
        </a>
    </div>
    <form class="email-login">
        <div class="u-form-group">
            <input type="email" placeholder="Email"/>
        </div>
        <div class="u-form-group">
            <input type="password" placeholder="Password"/>
        </div>
        <div class="u-form-group">
            <button>Log in</button>
        </div>
        <div class="u-form-group">
            <a href="#" class="forgot-password">Forgot password?</a>
        </div>
    </form>
    <form class="email-signup">
        <div class="u-form-group">
            <input type="email" placeholder="Email"/>
        </div>
        <div class="u-form-group">
            <input type="password" placeholder="Password"/>
        </div>
        <div class="u-form-group">
            <input type="password" placeholder="Confirm Password"/>
        </div>
        <div class="u-form-group">
            <button>Sign Up</button>
        </div>
    </form>
</div>
</body>
</html>