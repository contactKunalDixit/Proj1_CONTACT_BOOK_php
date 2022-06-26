<?php
ob_start();
session_start();
include_once "../includes/config.php";
include "../includes/db.php";



$errors = [];
$userId = (!empty($_SESSION["user"]) && !empty($_SESSION["user"]["id"])) ? $_SESSION["user"]["id"] : "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    //password validation
    if (empty($_POST["old_password"])) {
        $errors[] = "old Password is Required";
    } else {
        $old_password = test_input($_POST["old_password"]);
        $uppercase = preg_match('@[A-Z]@', $old_password);
        $lowercase = preg_match('@[a-z]@', $old_password);
        $number = preg_match('@[0-9]@', $old_password);
        $specialChars = preg_match('@[^\w]@', $old_password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($old_password) < 8) {
            $errors[] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        };
    }
    //password validation
    if (empty($_POST["new_password"])) {
        $errors[] = "New Password is Required";
    } else {
        $new_password = test_input($_POST["new_password"]);
        $uppercase = preg_match('@[A-Z]@', $new_password);
        $lowercase = preg_match('@[a-z]@', $new_password);
        $number = preg_match('@[0-9]@', $new_password);
        $specialChars = preg_match('@[^\w]@', $new_password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($new_password) < 8) {
            $errors[] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        };
    }
    //password validation
    if (empty($_POST["confirm_password"])) {
        $errors[] = "Confirm Password is Required";
    } else {
        $confirm_password = test_input($_POST["confirm_password"]);
        $uppercase = preg_match('@[A-Z]@', $confirm_password);
        $lowercase = preg_match('@[a-z]@', $confirm_password);
        $number = preg_match('@[0-9]@', $confirm_password);
        $specialChars = preg_match('@[^\w]@', $confirm_password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($confirm_password) < 8) {
            $errors[] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        };
    }



    //Confirm Password validation 

    if ($_POST["new_password"] != $_POST["confirm_password"]) {
        $errors[] = "Passwords cannot be empty, and has to match";
    } else {

        if (!empty($old_password)) {
            $conn = db_connect();

            $elemSql = "SELECT * FROM `users` where `id` = '{$userId}'";
            $sqlResult = mysqli_query($conn, $elemSql);
            $elemRow = mysqli_num_rows($sqlResult);
            if ($elemRow > 0) {
                $userInfo = mysqli_fetch_assoc($sqlResult);
                if (!empty($userInfo)) {
                    $passwordInDB = $userInfo["password"];
                    if (password_verify($old_password, $passwordInDB)) {

                        // Encrypting the user's NEWpassword
                        $passwordHash = password_hash($new_password, PASSWORD_DEFAULT);

                        $sql = "UPDATE `users` SET password = '{$passwordHash}' WHERE `id` = {$userId}";


                        $conn = db_connect();
                        if (mysqli_query($conn, $sql)) {
                            db_close($conn);
                            $message = "Your password has been updated";
                            $_SESSION["success"] = $message;
                            header("location:" . SITE_URL . "change_password.php");
                            exit();
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    } else {
                        $errors[] = "Check your 'old' Password!";
                        $_SESSION['errors'] = $errors;
                        header("location:" . SITE_URL . "change_password.php");
                        exit();
                    }
                }
            }
            db_close($conn);
        }
    }
    // GETTING THE VALUES ACCEPTED ONLY IF THERE HAS BEEN NO ERRORS

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors; //Setting a session variable
        header("location:" . SITE_URL . "change_password.php");
        //Redirects to the Sign_up page;
        exit();
    }
}