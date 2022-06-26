<?php
ob_start();
session_start();
include_once "../includes/config.php";
include "../includes/db.php";

$errors = [];

if (($_SERVER["REQUEST_METHOD"] == "POST") && !empty($_SESSION["user"])) {
    // firstName Validation
    if (empty($_POST["fname"])) {
        $errors[] = "Name is required";
    } else {
        $firstName = test_input($_POST["fname"]);

        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
            $errors[] = "Only letters and white space allowed";
        }
    }

    // Last Name Validation
    $lastName = test_input($_POST["lname"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
        $errors[] = "Only letters and white space allowed";
    }

    // Email Validation
    if (empty($_POST["email"])) {
        $errors[] = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
    }


    $userId = (!empty($_SESSION["user"]) && !empty($_SESSION["user"]["id"])) ? $_SESSION["user"]["id"] : 0;




    // GETTING THE VALUES ACCEPTED ONLY IF THERE HAS BEEN NO ERRORS

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors; //Setting a session variable
        header("location:" . SITE_URL . "edit_profile.php"); //Redirects to the edit_profile page;
        exit();
    }


    if (!empty($userId)) {
        $sql = "UPDATE `users` SET first_name = '{$firstName}', last_name = '{$lastName}', email = '{$email}' WHERE `id` = {$userId}";
        $message = "Your data has been updated";

        $conn = db_connect();

        if (mysqli_query($conn, $sql)) {
            db_close($conn);

            $_SESSION["success"] = $message;
            header("location:" . SITE_URL . "profile.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        db_close($conn);
    }
}