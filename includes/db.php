<?php

function db_connect()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "Contact_Book";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $db_name);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        return $conn;
    }
}

function db_close($conn)
{
    mysqli_close($conn);
}
