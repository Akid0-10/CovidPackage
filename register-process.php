<?php

// Include the database connection
include "config.php";

session_start();
$_SESSION["status"] = "";

// When the button register is click
if (isset($_POST['register'])) {

    // Set the variables
    $username = $_POST["username"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $phone = $_POST["phone"];
    $pass = $_POST["password"];

    $id = rand(11111, 99999);
    $user_id = "T" . $id;

    $get_user = "SELECT * FROM user";
    $res_user = mysqli_query($conn, $get_user);
    $i = 0;
    $total = mysqli_num_rows($res_user);

    while ($i <= $total) {
        $user_id = "T" . $id;
        $check_id = "SELECT * FROM user WHERE id = '$user_id'";
        $res_id = mysqli_query($conn, $check_id);

        if (mysqli_num_rows($res_id) > 0) {
            $id = rand(11111, 99999);
        } else {
            break;
        }
    }


    $check_username = "SELECT * FROM user WHERE username = '$username'";

    if (mysqli_query($conn, $check_username)) {
        $_SESSION["status"] = "Username already exist";
    } else {
        // SQL statement to insert the user data into user table in the database
        $sql = "INSERT INTO user VALUES ('$user_id', '$username', '$name', '$phone', '$age')";

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
        $_SESSION["status"] = "Failed to register";
        header("location: login.php");
    }

}
?>