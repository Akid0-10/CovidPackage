<?php

    //Include the database connection
    include "config.php";

    //Set and assign value to the variables
    $username = $_GET['username'];
    $types = $_GET['type'];
    $dateOut = date("Y-m-d");
    $dateArrived = date("Y-m-d");

    //When types is 'ship'
    if($types == "ship"){

        //SQL statements to insert data into package table and update status in application_form table
        $sql = "INSERT INTO package (username, dateOut) VALUES ('$username', '$dateOut')";
        $stmt = "UPDATE application_form SET status = 'shipped out' WHERE username = '$username'";

        //Run the queries for the SQL statements above
        mysqli_query($conn, $sql);
        mysqli_query($conn, $stmt);

        //Head into package status admin page to stay on the same page
        header("location: package-status-admin.php");
    }

    //When the types is 'delivered'
    else if($types == "delivered"){

        //SQL statements to update dateArrived and status in the package table and application_form table
        $sql = "UPDATE package SET dateArrived = '$dateArrived' WHERE username = '$username'";
        $stmt = "UPDATE application_form SET status = 'arrived' WHERE username = '$username'";

        //Run the queries for the SQL statements above
        mysqli_query($conn, $sql);
        mysqli_query($conn, $stmt);

        //Head into package status admin to stay on the same page
        header("location: package-status-admin.php");
    }

?>