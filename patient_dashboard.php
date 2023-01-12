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
    <title>covidPackage</title>
    <!-- Linked the pages with it's CSS -->
    <link rel="stylesheet" type="text/css" href="dashboard.css">


</head>

<body>

    <!-- The navigation side of the page -->
    <aside>
        <nav>
            <h1>covidPackage</h1>
            <h2 id="type"></h2>
            <ul>
                <li><a class="active" href="patient_dashboard.php">Home</a></li>
                <li><a href="package_status.php">Package Status</a> </li>
                <li><a href="application_form.php">Application Form</a> </li>
                <li><a href="application_status.php">Application Status</a> </li>
            </ul>
            <a class="logout" href="logout.php">Log Out</a>


        </nav>
    </aside>

    <!-- The content side of the page -->
    <section>
        <article>

            <!-- Display welcome message by using the username value taken from the session at login -->
            <p>Welcome <?php session_start();
            echo $_SESSION['user'] ?></p>
            <div class="container">

                <!-- Display the user's information -->
                <div id="profile" class="profile">

                    <!-- Display the user's username as the profile's heading -->
                    <?php echo $_SESSION['user']; ?>'s Profile
                    <hr>
                    <?php

                    //Include the database connection
                    include "config.php";

                    //When the user value in SESSION is not empty
                    if (!empty($_SESSION['user'])) {

                        //Set user variable and assign the value of SESSION's user
                        $user = $_SESSION['user'];

                        //SQL statement to select all from user table for the specific user
                        $sql = "SELECT * FROM user WHERE username = '$user'";

                        //Data query based on the SQL statement above
                        $result = $conn->query($sql);

                        //Fetch the row data
                        $row = $result->fetch_assoc();

                        //When the number of rows found more than zero - the data existed
                        if ($result->num_rows > 0) {

                            //Display all the user information
                            echo "ID: " . $row["id"] . "<br>Username: " . $row["username"] . "<br>Name: " . $row["name"] . "<br>Phone Number: " . $row["phone_Number"] . "<br>Age: " . $row["age"];
                        }

                    }

                    //When the user data could not be found in the database due to query error
                    else {

                        echo "Data couldn't be fetched from the database due to some error!!!";
                    }
                    ?>
                    <br><br>
                    <!-- Button to let user to manage/edit their information -->
                    <!-- <a href="update-user-profile.php?username=<?php echo $user; ?>">Manage Profile</a><br><br> -->

                </div>

                <!-- Display their package application status -->
                <div>
                    <?php
                    // Include the database connection
                    include "config.php";

                    // If the user's session value is not empty
                    if (!empty($_SESSION['user'])) {

                        //Set and initialize variable username the value of user store in session
                        $username = $_SESSION['user'];

                        //SQL statement to select status column from application_form table based on the variable username
                        $sql = "SELECT status FROM application_form WHERE username = '$username'";

                        //Run the query to the result variable
                        $result = $conn->query($sql);

                        //Get the row data
                        $row = $result->fetch_assoc();

                        //When the number of rows is more than 0 - the particular data existed
                        if ($result->num_rows > 0) {

                            //When the status value is 'in process'
                            if ($row['status'] == "in process") {

                                echo "Your application has been submitted and well received.<br>Status: In progress";
                            }

                            //When the status value is 'approved'
                            else if ($row['status'] == "approved") {

                                echo "Your application has been submitted and well received.<br>Status: Approved";
                            }

                            //When the status value is other than two above
                            else {

                                echo "Your application has been submitted and well received.<br>Status: Approved";
                            }
                        }

                        //When the number of row is equal to zero = data not exist
                        else {

                            echo "There is no records found for your application.<br>You may not requested for it yet.<br>You can head into application form to apply for it now.";
                        }

                    }
                    ?>
                </div>
                <div>
                    <?php

                    //Include the database connection
                    include "config.php";

                    //When the user value in session is not empty
                    if (!empty($_SESSION['user'])) {

                        //Set and initialize variable username the value of user store in session
                        $username = $_SESSION['user'];

                        //SQL statement to select status from application_form table for the respective user
                        $sql = "SELECT status FROM application_form WHERE username = '$username' ";

                        //Data query based on the SQL statement above
                        $result = $conn->query($sql);

                        //When the number of rows found more than 0
                        if ($result->num_rows > 0) {

                            //Fetch the row data
                            $row = $result->fetch_assoc();

                            //When the status value 'approved'
                            if ($row['status'] == "approved") {

                                echo "Your package is being prepared to be deliver.";
                            }

                            //When the status value is 'in process'
                            else if ($row['status'] == "in process") {

                                echo "There is no package information available for " . $username . " .<br>Make sure you have apply for the package and it has been approved by the admin.";
                            } else if ($row['status'] == "shipped out") {

                                echo "Your package has been shipped out. It might take couple of days to arrive.<br>Please be patient. Thank you.";
                            } else {

                                echo "Your package has been successfully delivered.<br>Thank you for using our service.";
                            }

                        }

                        //When the user is not exist in the application_form table
                        else {

                            echo "No data available due to no application found.";
                        }
                    }
                    ?>
                </div>
            </div>
        </article>
    </section>
</body>

</html>