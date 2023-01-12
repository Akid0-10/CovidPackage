<?php
require_once "login-process.php";

if(!isset($_SESSION["user"])) {
    header("Location: index.html");
    die();
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Page's title -->
    <title>covidPackage(Admin)</title>
    <!-- Link the page with it's CSS -->
    <link rel="stylesheet" type="text/css" href="dashboard.css">

</head>

<body>

    <!-- The navigation side of the page -->
    <aside>
        <nav>
            <h1>covidPackage</h1>
            <h2 id="type"></h2>
            <ul>
                <li><a href="admin_dashboard.php">Home</a></li>
                <li><a href="request-hub.php">Request Hub</a> </li>
                <li><a href="package-status-admin.php">Package Status</a> </li>
                <li><a class="active" href="register-list.php">Registers List</a> </li>
            </ul>
            <a class="logout" href="logout.php">Log Out</a>
        </nav>
    </aside>

    <!-- The content side of the page -->
    <section>
        <article>
            <div class="container">
                <div>
                    <h3>List of registered users:</h3>
                    <hr>
                    <!-- This function is to display all the user registered -->
                    <?php
                    // Include the database connection
                    include "config.php";

                    // Select all data from user table
                    $sql = "SELECT * FROM user";
                    $result = $conn->query($sql);

                    // If number of rows found more than 0 - data existed
                    if ($result->num_rows > 0) {

                        // While the row data could be fetch
                        while ($row = $result->fetch_assoc()) {

                            // Print out the data and add delete function to remove user from database
                            echo "ID: " . $row["id"] . "<br>Username: " . $row["username"] . "<br>Name: " . $row["name"] . "<br>Phone Number: " . $row["phone_Number"] . "<br>Age: " . $row["age"] . "<br><br><a 
                                    href='delete-user.php?username=" . $row['username'] . "'>Delete</a><br><br>";

                        }
                    }
                    ?>

                    <!-- Button to let user manage/edit their profile information -->
                    <!-- <input type="button" value="Manage users" id="manage-user" onclick="hide()"> -->
                </div>
            </div>
        </article>
    </section>

    <!-- <script>

        function hide(){

            document.getElementById('manage-user').style.visibility = 'hidden';
        }
    </script> -->
</body>

</html>