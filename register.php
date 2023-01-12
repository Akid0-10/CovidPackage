<!DOCTYPE html>
<html>

<head>
    <!-- Page's title -->
    <title>Register - covidPackage</title>
    <!-- Linked the page to it's CSS -->
    <link rel="stylesheet" href="style.css">

    <script language="JavaScript">

        // JavaScripts function when user click register button
        function registerBut() {

            // Set the variables and take values from the form
            var username = document.registerForm.username.value;
            var name = document.registerForm.name.value;
            var age = document.registerForm.age.value;
            var phone = document.registerForm.phone.value;
            var password = document.registerForm.password.value;

            // If the field in the form is not completely filled by the user
            if (username == "" || name == "" || age == "" || phone == "" || password == "") {
                // Inform the user to fill in all the fields
                alert("Please fill all fields!")
            }

            else {
                // Inform the user that they cannot set 'admin' as their username
                if (username == "admin") {
                    alert("You cannot set admin as username")
                }

                // Inform user that age and phone number must be numeric when they filled in others characters
                if (isNaN(age) && isNaN(phone)) {
                    alert("Age and phone number must be in numeric.")
                }

                else if (isNaN(age)) {
                    alert("Age must be numeric.")
                }

                else if (isNaN(phone)) {
                    alert("Phone number must be numeric.")
                }

                // Inform the user that password length must be more than 6 characters
                if (password.length < 6) {
                    alert("Password must be more than six characters.");
                }
            }



        }
    </script>
</head>

<body>

    <!-- A box to display the form for register -->
    <div class="box">
        <img src="https://icons.iconarchive.com/icons/papirus-team/papirus-status/512/avatar-default-icon.png"
            alt="avatarIcon" class="avatar">
        <h1>REGISTER</h1>
        <form method="post" action="register-process.php" name="registerForm">
            <p>Username</p>
            <input type="text" name="username" id="username" placeholder="Enter email address" required />
            <p>Name</p>
            <input type="text" name="name" id="name" placeholder="Enter full name" required />
            <p>Age</p>
            <input type="text" name="age" id="age" placeholder="Enter age" required />
            <p>Phone Number</p>
            <input type="text" name="phone" id="phone" placeholder="Enter phone number" required />
            <p>Password</p>
            <input type="password" name="password" id="password" placeholder="Enter password" required />

            <!-- Register button use onclick features which use a JavaScripts to performs it's function -->
            <input type="submit" name="register" id="register" value="Register" onclick="registerBut()"><br>
            <a href="login.php">Already have an account? Login here.</a>
            <p class="error"><?php $_SESSION["status"]; ?></p>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        // Change the box height to 520px using jquery animation
        $("div.box").height("520px");
    </script>
</body>

</html>