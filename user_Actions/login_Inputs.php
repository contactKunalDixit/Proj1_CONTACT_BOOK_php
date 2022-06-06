<?php
ob_start();
session_start();
include_once "../includes/config.php";
include "../includes/db.php";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Email validation
    if (empty($_POST["email"])) {
        $errors[] = "Need user's Email to login";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
    }
    //Password Validation

    if (empty($_POST["password"])) {
        $errors[] = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $errors[] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        };
    }
    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        header("location:" . SITE_URL . "login.php");
        exit();
    }

    // If no errors

    if (!empty($email) && !empty($password)) {
        // echo $email . $password;

        $conn = db_connect();
        $sanitizeEmail = mysqli_real_escape_string($conn, $email);
        $sql = "SELECT * FROM `users` where `email` = '{$sanitizeEmail}'";
        $sqlResult = mysqli_query($conn, $sql);
        $emailRow = mysqli_num_rows($sqlResult);
        if ($emailRow > 0) { //if email found
            $userInfo = mysqli_fetch_assoc($sqlResult);
            if (!empty($userInfo)) {
                $passwordInDB = $userInfo["password"];
                if (password_verify($password, $passwordInDB)) {
                    unset($userInfo["password"]);
                    //This has been unset because we dont want to carry password in through SESSIONs variables. 
                    //Rest of the userInfo can be stored in the SESSION variable so as to be uised throughouit the sessions on other pages too
                    $_SESSION["user"] = $userInfo;
                    header("location:" . SITE_URL . "index.php");
                    exit();
                } else {
                    $errors[] = "Incorrect Password!";
                    $_SESSION['errors'] = $errors;
                    header("location:" . SITE_URL . "login.php");
                    exit();
                }
            }
        } else {
            $errors[] = "Incorrect Email. Consider registering by Signing up! ";
            $_SESSION['errors'] = $errors;
            header("location:" . SITE_URL . "login.php");
            exit();
        }
    }
}
