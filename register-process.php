<?php

// Include the database connection
include "config.php";

// When the button register is click
if (isset($_POST['register'])) {

    // Set the variables
    $username = $_POST["username"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $phone = $_POST["phone"];
    $pass = $_POST["password"];

    // SQL statement to insert the user data into user table in the database
    $sql = "INSERT INTO user (username, name, phone_number, age) VALUES ('$username', '$name', '$phone', '$age')";

    //Perform the query of sql
    $query = mysqli_query($conn, $sql);

    // The query returns true
    if ($query == TRUE) {

        // Insert user login information into login table
        $sql_log = "INSERT INTO login (username, password) VALUES ('$username', '$pass')";

        //Run the query based on SQL statement in $sql_log
        mysqli_query($conn, $sql_log);
    }

    // Head into login php
    header("location: login.php");

}
?>