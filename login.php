<!DOCTYPE html>
<html>
    <head>
        <title>Login - covidPackage</title>
        <link rel="stylesheet" type="text/css" href="style.css">

        <script language="JavaScript">

            function loginBut(){

                //Take value from the loginForm and store it as username and password
                var username=document.loginForm.username.value;
                var password=document.loginForm.password.value;

                if(username=="Admin")
                    types="Admin"
                else
                    types="User"

                if(username==""||password==""){
                    alert("Please fill out all the fields!!!");
                }
            }
        </script>

    </head>

    <body>

        <!-- The div class is created as a box for login form -->
        <div class="box">
            <img src="https://icons.iconarchive.com/icons/papirus-team/papirus-status/512/avatar-default-icon.png" alt="avatarIcon" class="avatar">
            <h1>LOGIN</h1>

            <!-- This is loginForm where it accepts users input for username and password -->
            <form  name="loginForm" id="loginForm" method="post" action="login-process.php">
            <!-- <?php
                if (isset($_GET['error'])){
                    ?> <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php
                }
            ?> -->
            <p>Username</p>
            <input type="text" name="username" id="username" placeholder="Enter Username" required>
            <p>Password</p>
            <input type="password" name="password" id="password" placeholder="Enter Password" required>
            <input type="submit" name="login" id="login" value="Login"><br>
            <!-- <a href="forgot-password.php" >Forgot password?</a><br> -->
            <a href="register.php" class="register">Don't have an account? Register here.</a>
            <p><?php echo $_SESSION["status"]; ?></p>
            </form>
        </div>



    </body>
</html>