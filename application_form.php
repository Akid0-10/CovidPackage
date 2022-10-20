<!DOCTYPE html>
<html>
    <head>
        <!-- Page title -->
        <title>covidPackage</title>
        <!-- Linked the pages with its css -->
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
                    <li><a class="active" href="application_form.php">Application Form</a> </li>
                    <li><a href="application_status.php">Application Status</a> </li>
                </ul>
                <a class="logout" href="index.html">Log Out</a>
            </nav>
        </aside>

        <!-- The content side of the page -->
        <section>
            <article>
                <!-- Div to display the pages content -->
                <div class="container">
                    <div id="application">
                        <!-- Form to take user input for their request -->
                        <form action="process-application.php" method="post" enctype= "multipart/form-data">
                            <table>
                                <th colspan="2">Please Fill In The Form Below</th>
                                <tr>
                                    <td>Username: </td>
                                    <td>
                                        <!-- Set the username values based on session into input type text and set it as readonly -->
                                        <?php
                                        session_start();

                                        echo '<input type="text" name="username" id="username" size="35" value="'.$_SESSION['user'].'"readonly>';
                                    ?></td>
                                </tr>
                                <tr>
                                    <td>Name: </td>
                                    
                                    <td>
                                    <?php
                                        // Include the database connection
                                        include "config.php";

                                        // If session's user not empty
                                        if(!empty($_SESSION['user'])){

                                            // Set user values from session's user
                                            $user = $_SESSION['user'];

                                            // SQL statement to select name from user table based on the username
                                            $sql = "SELECT name FROM user WHERE username = '$user'";
                                            //Perform the data query
                                            $result = $conn->query($sql);
                                            //Fetch the row data
                                            $row = $result->fetch_assoc();

                                            // If the number of row found more than 0 - means the data existed
                                            if($result->num_rows > 0){
                                                echo '<input type="text" name="name" id="name" size="35" value="'.$row["name"].'" readonly>';
                                            }

                                            // Display error message when the data couldn't be fetched
                                            else{
                                                echo "Error! Name could not be found.";
                                            }
                                        }
                                    ?></td>
                                </tr>

                                <!-- User's input for their delivery adddress -->
                                <tr>
                                    <td>Address: </td>
                                    <td><textarea name="address" id="address" cols="30" rows="7"></textarea></td>
                                </tr>
                            
                                <!-- User's input for the instruction to the courier -->
                                <tr>
                                    <td>Instruction to courier: </td>
                                    <td><textarea name="inst" id="inst" cols="30" rows="5" ></textarea></td>
                                </tr>

                                <!-- User's will upload their files as proof for their covid status -->
                                <tr>
                                    <td>Covid Status: </td>
                                    <td><input type="file" name="image" id="image"></td>
                                </tr>

                                <!-- Button to submit the form or reset it -->
                                <td colspan="2">
                                    <input type="submit" value="Submit" name="submit">
                                    <input type="reset" value="Reset" name="reset">
                                </td>
                            </table>
                        </form>
                    </div>
                </div>
            </article>
        </section>

    </body>
</html>