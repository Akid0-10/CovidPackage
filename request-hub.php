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
    <!-- Linked the page with it's CSS -->
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
                <li><a class="active" href="request-hub.php">Request Hub</a> </li>
                <li><a href="package-status-admin.php">Package Status</a> </li>
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
                    <h3>List of application submitted: </h3>
                    <hr>
                    <?php
                    //Include the database connection
                    include "config.php";

                    //Select all data from the application_form table
                    $sql = "SELECT * FROM application_form";
                    //Perform the data query
                    $result = $conn->query($sql);

                    // If the number of rows found more than 0
                    if ($result->num_rows > 0) {

                        // While the row data could be fetched
                        while ($row = $result->fetch_assoc()) {

                            if ($row['status'] == "in process") {

                                // Print out the data
                                echo "<br>Username: " . $row['username'] . "<br>Name: " . $row['name'] . "<br>Address: " . $row['address'] . "<br>Instructions: " . $row['instruction'] . "<br>Covid Status: " . base64_encode($row['covid_status']) . "<br>";

                                ?><br>

                                <!-- Approve or reject the users' application -->
                                <a href="process-request.php?username=<?php echo $row['username']; ?>&request=approve">Approve</a>
                                <a href="process-request.php?username=<?php echo $row['username']; ?>&request=reject">Reject</a>

                                <br><br>
                                <?php
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