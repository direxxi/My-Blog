<?php
 require_once "includes/configsesh.inc.php";
require_once "includes/login_view.inc.php";
$rememberedUser = $_COOKIE['remember_user'];   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="logins.css">
</head>
<body>
    <!-- <header>
        <h2 class="logo">BLOGORINO</h2>
       <nav>
           <ul>
            <li class="navi"><a href="#">Home</a></li>
            <li class="navi"><a href="#">About</a></li>
            <li class="navi"><a href="#">Services</a></li>
            <li class="navi"><a href="#">Contact</a></li>
        </ul>
       </nav>
    </header> -->
    <div class="container">
        <div class="login-card">
            <h1>LOGIN</h1>
            <form action="includes/login.inc.php" method="post">
            <input type="text" name="username" value="<?= htmlspecialchars($rememberedUser); ?>" placeholder="Username">
                <input type="password" name="password" placeholder="Password" required>
                <input name="remember" class="remember" type="checkbox"> <label for="remember me">Remember me</label> 
                <a class="forgot" href="#">Forgot Password?</a>
                <button class="loginbtn" type="submit" name="login-btn">Login</button>
                <p class="account">Don't have an account? <a class="register" href="register.php">Register Now</a></p>
                <?php
                error_avail();
                ?>
        </div>
    </div>
</body>
</html> 



