<?php
 require_once "includes/configsesh.inc.php";
require_once "includes/register_view.inc.php";
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
            <li class="login-btn"><a href="index.php">Login</a></li>    
        </ul>
       </nav>
    </header> -->
    <div class="container">
        <div class="login-card">
        
            <h1>REGISTER NOW</h1>
            <form action="includes/register.inc.php" method="post" enctype="multipart/form-data"> 
              <input type="text" name="username" placeholder="Username" required>
              <input type="text" name="email" placeholder="Email" required>
              <input type="password" name="password" placeholder="Password" required>
              <select name="roles" id="role" placeholder="Choose your role" required>
                <option value="Admin">Administrator</option>
                <option value="User">User</option>
              </select>
              <input type="file" name="profilepic" placeholder="Upload your profile pic">
                <button class="loginbtn" type="submit" name="login-btn">Sign Up</button>
            </form>
        <?php
            error_avail();
        ?>
        </div>
      
    </div>
</body>
</html>
