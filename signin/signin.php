<?php
	include "../connect.php";
	session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Safer Life Security System</title>
        <?php include "../styles.php"; ?>        
        <link rel="stylesheet" type="text/css" href="signin_style.css">
    </head>
    <body>
        <div class="container signin_container">		
            <div class="signin-title-container">
                <h1 id="signin_title">Sign In</h1>
                <div class="logo_container_signin">
                    <img src="../images/logo.png"/>
                </div>
            </div>
            <form action="signin_backend.php" method="post" class="signin_form">
                <div class="userdetails_field">
                    <div class="input_icon"><i class="fas fa-user" style="font-size: 20px; margin-right: 5px; color: #404040"></i></div>
                    <input style ="padding: 5px" type="text" placeholder="Username" name="signin_username" size="22" required>
                </div>
                <div class="userdetails_field">
                    <div class="input_icon"><i class="fas fa-unlock" style="font-size: 20px; margin-right: 5px; color: #404040"></i></div>
                    <input style ="padding: 5px" type="password" placeholder="Password" name="signin_password" size="22" required>
                </div>
                <button id="signin_button" type="submit" value="Sign In">Sign In</button>
            </form>
                <?php
                    if (isset($_SESSION["username_err"])) 
                    {
                ?>
                        <div class="container wrong_user">
                <?php
                            echo $_SESSION["username_err"].'</br>';
                            echo $_SESSION["password_err"];
                ?>
                        </div>
                <?php
                    }
                ?>	
        </div>
    </body>
    <footer>

    </footer>
</html>