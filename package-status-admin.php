<?php
require_once "login-process.php";

if (!isset($_SESSION["user"])) {
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
                <li><a href="admin_dashboard.php">Home</a></li>
                <li><a href="request-hub.php">Request Hub</a> </li>
                <li><a class="active" href="package-status-admin.php">Package Status</a> </li>
                <li><a href="register-list.php">Registers List</a> </li>
            </ul>
            <a class="logout" href="logout.php">Log Out</a>
        </nav>
    </aside>

    <!-- Content side of the page -->
    <section>
        <article>
            <div class="container">
                <div>
                    <?php
                    //Include the databse connection
                    include "config.php";

                    //Set and initialize count variable to 0
                    $count = 0;

                    //SQL statement to select status field from application_form table
                    $sql = "SELECT status FROM application_form";

                    //Data query based on the SQL statement
                    $result = $conn->query($sql);

                    //If the number of rows is more than 0 = data existed
                    if ($result->num_rows > 0) {

                        //While the row data could be fetched
                        while ($row = $result->fetch_assoc()) {

                            //If the row status column value is equal to 'approved'
                            if ($row['status'] != "in process" && $row['status'] != "arrived") {

                                //Increment count variable by 1
                                $count += 1;
                            }
                        }

                        //Display the number of package currently ongoing to the admin
                        echo "<h3>You have " . $count . " package to be delivered right now:</h3><hr>";

                    }

                    //SQL statement to select all column from application_form table that has status column value 'approved'
                    $sql1 = "SELECT * FROM application_form WHERE status = 'approved' OR status = 'shipped out'";

                    //Data query
                    $res = $conn->query($sql1);

                    //Data is existed when number of rows found more than 0
                    if ($res->num_rows > 0) {

                        //When the row data could be fetched
                        while ($row = $res->fetch_assoc()) {

                            //Display the user application form
                            echo "<br>Username: " . $row['username'] . "<br>Name: " . $row['name'] . "<br>Address: " . $row['address'] . "<br>Instructions: " . $row['instruction'] . "<br>Status: " . $row['status'] . "<br>";

                            //Display button to ship out when status is 'approved'
                            if ($row['status'] == "approved") {

                                echo "<br><a href='delivery-process.php?username=" . $row['username'] . "&type=ship'>Ship Out</a><br><br>";
                            }

                            //Display button delivered when status is 'shipped out'
                            else if ($row['status'] == "shipped out") {

                                echo "<br><a href='delivery-process.php?username=" . $row['username'] . "&type=delivered'>Delivered</a><br><br>";
                            }

                        }
                    }
                    ?>
                </div>
            </div>
        </article>
    </section>
</body>

</html>