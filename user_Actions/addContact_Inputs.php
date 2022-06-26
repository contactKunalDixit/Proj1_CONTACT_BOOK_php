<?php
ob_start();
session_start();

include_once "../includes/config.php";
include_once "../includes/db.php";

$errors = [];
if (($_SERVER["REQUEST_METHOD"] == "POST") && !empty($_SESSION["user"])) {

    // firstName Validation
    if (empty($_POST["fname"])) {
        $errors[] = "Name cannot be empty";
    } else {
        $firstName = test_input($_POST["fname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
            $errors[] = "Only letters and white space allowed in the 'Name' Section.";
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
    // Phone Validation - 10 digit phone
    if (empty($_POST["phone"])) {
        $errors[] = "Phone number is required";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!empty($phone) && !is_numeric($phone) && (strlen($phone) < 8 || strlen($phone) > 10)) {
            $errors[] = "Invalid Phone Number";
        }
    }
    // Address Validation

    $address = test_input($_POST["address"]);


    $contactid = !empty($_POST["contactid"]) ? $_POST["contactid"] : "";
    // This comes alongwith other $_POST values
    // Will be used in sql query in the 'where' conditions
    // contactid has been picked/ referenced from 'addContact.php'



    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        header("location:" . SITE_URL . "addContact.php");
        exit();
    };

    // Uploading a file:

    $photoFile = !empty($_FILES["photo"]) ? $_FILES["photo"] : [];  //if file exists then assigning:else initializing a new array;
    $photoName = "";
    if (!empty($photoFile["name"])) {
        $fileTempPath = $photoFile["tmp_name"];
        $filename = $photoFile["name"];
        $fileNameCmp = explode(".", $filename);
        $fileExtn = strtolower((end($fileNameCmp)));
        $fileNewname = md5(time() . $filename) . "." . $fileExtn; // to AVOID duplication of file names; This is done to give each target file an identity before the path gets noted in the DB. Observe md5 used for hash conversion. Almost a similar proceedure for hashing password before saving it in DB.
        // ! The ACTUAL file is always kept in the local directory. it is only the path address to that file alongwith the file name, that gets stored in the DB.

        $photoName = $fileNewname;

        // allowed Extens:
        $allowed_extns = ["jpg", "jpeg", "gif", "png"];
        if (in_array($fileExtn, $allowed_extns)) {

            $uploadFileDir = getcwd() . "/uploads/photos/";
            //Creates a relationship between this file and the target file.


            $destiFilePath = $uploadFileDir . $photoName;

            if (!move_uploaded_file($fileTempPath, $destiFilePath)) {
                $errors[] = "File could not be uploaded. ";
            }
        } else {
            $errors[] = "Invalid File extension";
        }
    }

    //Assigning an owner_ID; owner_id is the ID of the user logged in:
    $ownerID = (!empty($_SESSION["user"])
        && !empty($_SESSION["user"]["id"])
    ) ? $_SESSION["user"]["id"] : 0;

    if (!empty($contactid)) {
        // update existing record
        $sql = "UPDATE `contacts` SET first_name = '{$firstName}', 
        last_name = '{$lastName}', 
        email = '{$email}',
        phone = '{$phone}',
        address = '{$address}' WHERE `id`={$contactid} AND owner_id = {$ownerID}
        ";
        // -- owner_id should not be updated as it'll owner will always remain the same
        $message = "Contact has been UPDATED successfully";
    } else {

        // Add new record
        $sql = "INSERT INTO `contacts` (first_name, last_name, email,phone,
    address
        ,
        photo,
        owner_id
        ) VALUES (
        '{$firstName}','{$lastName}','{$email}','{$phone}'
        ,'{$address}'
        ,
        '{$photoName}',
        '{$ownerID}'
        )";
        $message = "New Contact has been Added successfully";
    }



    $conn = db_connect();
    if (mysqli_query($conn, $sql)) {
        $_SESSION["success"] = $message;
        header("location:" . SITE_URL);
        exit();
    } else {
        echo "Error: " . "<br>" . mysqli_error($conn);
    }
    db_close($conn);
}