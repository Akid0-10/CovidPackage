<?php

    // Include the database connection
    include "config.php";

    // If submit button is clicked
    if(isset($_POST['submit'])){

        // Set the variables and get values from the form
        $username = $_POST['username'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $instruction = $_POST['inst'];
        $covid = $_FILES['image']['username'];
        $status = "in process";

        //SQL statement to select the data for the stated user
        $stmt = "SELECT * FROM application_form WHERE username = '$username'";

        //Running the data query and set it to result variable
        $result = $conn->query($stmt);

        //When the number of row is more than 0 = the user existed in the application_form table
        if($result->num_rows > 0){

            //Display a message to tell the user that he already make an application
            header("location: application_form.php");
            echo "You have already apply for the package";
        }

        else{

            // SQL statement to insert values into application_form table
            $sql = "INSERT INTO application_form (username, name, address, instruction, covid_status, status) VALUES ('$username', '$name' ,'$address', '$instruction', '$covid', '$status')";
            
            // Performing the sql query
            $query = mysqli_query($conn, $sql);

            // Display error message if the values couldn't be inserted into the table
            if($query == FALSE){
                echo "Failed to insert!!!";   
            }

            //When the data is successfully inserted into the table
            else{

                move_uploaded_file($_FILES['image']['tmp_name'], 'image/$covid');
                // Head into application_status page
                header("location: application_status.php");    
            }
        }
        
    }
?>