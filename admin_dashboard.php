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
    <!-- Linked the page to it's CSS -->
    <link rel="stylesheet" type="text/css" href="dashboard.css">

</head>

<body>

    <!-- Navigation side of the page -->
    <aside>
        <nav>
            <h1>covidPackage</h1>
            <h2 id="type"></h2>
            <ul>
                <li><a class="active" href="admin_dashboard.php">Home</a></li>
                <li><a href="request-hub.php">Request Hub</a> </li>
                <li><a href="package-status-admin.php">Package Status</a> </li>
                <li><a href="register-list.php">Registers List</a> </li>
            </ul>
            <a class="logout" href="logout.php">Log Out</a>
        </nav>
    </aside>

    <!-- Content side of the page -->
    <section>
        <article>
            <!-- Display the username within the welcome message by using the PHP session -->
            <p class="welcome">Welcome, <?php session_start();
            echo $_SESSION['user']; ?> to your dashboard.</p>

            <div class="container">
                <div>
                    <?php
                    // Include database connection
                    include "config.php";

                    // Set and initialize count variable to 0
                    $count = 0;
                    $countAll = 0;

                    // SQL statement to select status from application_form table
                    $sql = "SELECT status FROM application_form";

                    $sql1 = "SELECT id FROM user";

                    // Data query based on SQL statement
                    $result = $conn->query($sql);
                    $result1 = $conn->query($sql1);

                    //Count number of rows exist
                    $countAll = mysqli_num_rows($result1);


                    // If number of row found more than 0 = data existed
                    if ($result->num_rows > 0) {

                        // While the row data could be fetched from the table
                        while ($row = $result->fetch_assoc()) {

                            // If the row status column equal to 'in process'
                            if ($row['status'] == "in process") {

                                // Count + 1 for every loop
                                $count += 1;
                            }
                        }

                        //Display the message to admin about the current number of request for package
                        echo "Currently, you have " . $count . " request that needs to be looked upon.<br>";

                        echo "<br>You have " . $countAll . " users who have registered in the system.";

                    }

                    ?>
                </div>
            </div>
        </article>
    </section>
</body>

</html>