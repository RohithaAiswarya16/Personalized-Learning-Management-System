<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login or Sign Up</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- <a href="index.html" class="close-btn"><i class="fa-solid fa-circle-xmark"></i></a> -->
    <div class="landing-container">
        <h1>PersonaLearn</h1>
    </div>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="register.php" method="post">
                <?php if(isset($_GET['error']) && $_GET['error'] === 'signup_fail'){ ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <h1>Create Account</h1>
                <input type="text" name="name" placeholder="Name" />
                <input type="email" name="email" placeholder="Email" />
                <input type="password" name="password" placeholder="Password" />
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="login.php" method="post">
                <?php if(isset($_GET['error']) && $_GET['error'] === 'login_fail'){ ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <h1>Sign in</h1>
                <input type="email" name="email" placeholder="Email" />
                <input type="password" name="password" placeholder="Password" />
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
</body>
</html>
