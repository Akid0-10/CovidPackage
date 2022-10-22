<!DOCTYPE html>
<html>
    <head>
        <!-- Page's title -->
        <title>covidPackage</title>
        <!-- Linked the page with it's CSS -->
        <link rel="stylesheet" href="dashboard.css">
    </head>

    <body>
        
        <!-- The navigation side of the page -->
        <aside>
            <nav>
                <h1>covidPackage</h1>
                <h2 id="type"></h2>
                <ul>
                    <li><a href="patient_dashboard.php">Home</a></li>
                    <li><a class="active" href="package_status.php">Package Status</a> </li>
                    <li><a href="application_form.php">Application Form</a> </li>
                    <li><a href="application_status.php">Application Status</a> </li>
                </ul>
                <a class="logout" href="index.html">Log Out</a>
            </nav>
        </aside>

        <!-- The content side of the page -->
        <section>
            <article>
                <div class="container">
                    <div>
                        <?php
                            include "config.php";

                            // A session must be started before it can be used
                            session_start();

                            // When the session's user is not empty
                            if(!empty($_SESSION['user'])){

                                //Assign username variable the value of user session
                                $username = $_SESSION['user'];

                                // SQL statement to select status for desired user from application_form table 
                                $sql = "SELECT status FROM application_form WHERE username = '$username'";

                                //Perform the data query
                                $result = $conn->query($sql);

                                //Get the row data
                                $row = $result->fetch_assoc();

                                //When the number of rows is more than 0 - data existed
                                if($result->num_rows > 0){

                                    //When the status value is 'approved'
                                    if($row['status'] == "approved"){
                                        
                                        echo "Your application has been approved.<br>Kindly wait for it to be shipped out.<br>Thank you!";
                                    }

                                    //When the status value is 'in process'
                                    else if($row['status'] == "in process"){

                                        echo "Kindly wait for your application to be approved for the package to be sent.";
                                    }

                                    //When the status value is 'shipped out'
                                    else if($row['status'] == "shipped out"){

                                        echo "Your package has been shipped out.<br>Kindly wait it to arrived.";

                                    }

                                    //When the status value is other than above e.g('arrived')
                                    else{

                                        echo "Your package has been successfully delivered.<br>Thank you for using our service. Hope you get well soon.<br>";

                                        //SQL statement to select data in package table
                                        $stmt = "SELECT * FROM package WHERE username = '$username'";

                                        //Run the query and fetch the row data
                                        $row = mysqli_query($conn, $stmt)->fetch_assoc();

                                        //Display the row data
                                        echo "<br>ID: ".$row['id']."<br>Username: ".$row['username']."<br>Shipped out: ".$row['dateOut']."<br>Arrived: ".$row['dateArrived']."<br>";
                                    }
                                }

                                //When the user do not exist in application_form table
                                else{

                                    echo "There is no application found for username named ".$username."<br>Please apply for package first. Thank you.";

                                }
                            }
                        ?>
                    </div>
                </div>
            </article>
        </section>

    </body>
</html>