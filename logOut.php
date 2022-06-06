<?php
ob_start();
session_start();
require_once "includes/config.php";

if (isset($_SESSION["user"])) {
    unset($_SESSION["user"]); // The user name being displayed before has been removed because the SESSION variable has been UNSET.
    session_destroy();
    header("location:" . SITE_URL . "login.php");
}
