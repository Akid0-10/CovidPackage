<!DOCTYPE html>
<html>
<head>
    <!-- Page's Title -->
    <title>Login - covidPackage</title>
    <!-- Linked the page with it's CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <!-- Box for the forgot password content form -->
    <div class="box">
        <img src="https://icons.iconarchive.com/icons/papirus-team/papirus-status/512/avatar-default-icon.png" alt="avatarIcon" class="avatar">
        <h1>RESET</h1>

        <!-- Form asking the username to reset the password -->
        <form  name="resetForm" id="resetForm" method="post" action="" onsubmit="reset()">

            <p>Enter your username</p>
            <input type="text" name="username" id="username" placeholder="Enter username">
            <input type="submit" name="continue" id="continue" value="Continue"><br>
        </form>
    </div>

    <!-- Access the JQuery code -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>

            // Change the height of the box to 140px
            $("div.box").height("140px");
          
            function reset(){
                document.resetForm.
            }
        </script>
    
</body>
</html>