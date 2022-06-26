<?php
ob_start();
session_start();
include_once "common/header.php";
include_once "includes/db.php";
include_once "includes/config.php";

// <!-- Delete can happen in 2 ways. either soft delete or permanent delete
// soft delete: The data will remain in the datbase but we'll use UPDATE  to change the column 'status' value to say 1 and show all the values which have the value as 1
// Hard Delete: Using DELETE sql query to delete the result from the database as permanently 
// -->

$error_msg = '';

if (empty($_SESSION["user"])) {
    header("location:" . SITE_URL . "login.php");
    exit();
} else {
    $userId = $_SESSION["user"]["id"];
}
if (!empty($_GET["id"]) && is_numeric($_GET["id"])) {
    $contactId = $_GET["id"];

    $conn = db_connect();
    $contact_Id = mysqli_real_escape_string($conn, $contactId);
    $sqlDelQuery = "DELETE FROM `contacts` WHERE `id` = '{$contact_Id}' AND `owner_id`='{$userId}'";
    if (mysqli_query($conn, $sqlDelQuery)) {
        $message = "Record has been deleted succesfully";
    } else {
        $message = "Error deleting the record" . mysqli_error($conn);
    }
    db_close($conn);
    header("location:" . SITE_URL);
    $_SESSION["success"] = $message;
} else {
    $message = "Invalid Contact id.";
    exit();
}