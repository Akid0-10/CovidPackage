<?php

    //Include the database connection
    include "config.php";

    //Declare and assign the variables values
    $username = $_GET['username'];
    $request = $_GET['request'];

    //When the request value is 'approve'
    if($request == "approve"){

        //SQL statement to update the application_form table status value to 'approved' for the stated username
        $sql = "UPDATE application_form SET status = 'approved' WHERE username = '$username'";

        //Running the query for the SQL statement above
        mysqli_query($conn, $sql);

        //Head into request-hub.php = stay at the same page
        header("location: request-hub.php");
    }

    //When the request value is other than 'approve' eg('reject')
    else{

        //SQL statement to update the application_form table status value to 'rejected' for the stated username
        $sql = "UPDATE application_form SET STATUS = 'rejected' WHERE username = '$username'";

        //Run the query for the SQL statement above
        mysqli_query($conn, $sql);

        //Head into request-hub.php = stay at the same page
        header("location: request-hub.php");
    }
?>