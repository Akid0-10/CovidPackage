<?php

    //Include the database connection
    include "config.php";

    //Set and assign the value of username variable
    $username = $_GET['username'];

    //SQL statement to delete the stated user from database
    $sql = "DELETE user, login FROM user INNER JOIN login ON login.username = user.username WHERE user.username = '$username'";
    $stmt = "DELETE FROM application_form WHERE username = '$username'";

    //Run the query based on SQL statement above
    mysqli_query($conn, $sql);
    mysqli_query($conn, $stmt);

    //Stay on register-list.php
    header("location: register-list.php");
?>