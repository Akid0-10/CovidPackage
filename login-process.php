<?php

    //Include the database connection
    include "config.php";

    //Start a session to use it
    session_start();

    //When the button login is set/clicked
    if(isset($_POST["login"])){
        
        //Set and assign value to the variables
        $username = $_POST["username"];
        $password = $_POST["password"];

        //SQL statement to select all data from login table for the selected user
        $sql = "SELECT * FROM login WHERE username = '$username'";

        //Data query based on the SQL statement above
        $result = $conn->query($sql);

        //Fetch the row data
        $row = $result->fetch_assoc();

        //When the number of rows found is more than 0
        if($result->num_rows > 0){

            //When the username and password matched with the ones in the login table
            if($username==$row["username"]&&$password==$row["password"]){

                //Assign the session's user value of username
                $_SESSION["user"] = $_POST['username'];

                //Head to patient dashboard if the username is not an admin
                if($username!="admin"){
                    
                    header("Location: patient_dashboard.php");
                }

                //Head into admin dashboard if the user is an admin
                else{

                    header("location: admin_dashboard.php");
                }
            }

            //When the password do no match with the one in the login table
            else{

                echo "Wrong password";
            }
        }

        //When the username could not be found in the login table
        else{

            echo "There no such user find in the system";
        }
    }


?>