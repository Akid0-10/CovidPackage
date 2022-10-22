<!DOCTYPE html>
<html>
    <head>
        <!-- Page's Title -->
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
                    <li><a href="package_status.php">Package Status</a> </li>
                    <li><a href="application_form.php">Application Form</a> </li>
                    <li><a class="active" href="application_status.php">Application Status</a> </li>
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
                            // Include the database connection
                            include "config.php";

                            // Start session to use it afterward
                            session_start();

                            // Set username variable and initialize it to user's session value
                            $username = $_SESSION['user'];

                            //SQL statement to select status from application_form table based on the username provided
                            $sql = "SELECT * FROM application_form WHERE username='$username'";

                            // Data query based on the SQL statement
                            $result = $conn->query($sql);

                            // Fetch the row data
                            $row = $result->fetch_assoc();

                            // If the number of rows more than 0 = data existed
                            if($result->num_rows > 0){

                                // If the row 'status' column value is 'in process'
                                if($row['status'] == "in process"){

                                    echo "Your application has been submitted.<br>Kindly wait for admin approval.";
                                }

                                //When the status value is 'approved'
                                else if($row['status'] != "rejected") {
                                    
                                    echo "Congratulation!!!<br>Your application has been approved.<br><br>";
                                    echo "<br>Username: ".$row['username']."<br>Name: ".$row['name']."<br>Address: ".$row['address']."<br>Instructions: ".$row['instruction']."<br>Status: ".$row['status']."<br>";

                                    ?>
                                        <a href="delivery-process.php?username=<?$username?>">Package Arrived</a>
                                    <?
                                }
                                
                            }


                            //When the number of rows found is zero - data could not be selected
                            else{
                                
                                echo "You haven't requested the package yet.<br>Please apply first at application form.<br>Thank you.";
                            }

                        ?>
                    </div>
                </div>
            </article>
        </section>

    </body>
</html>