<?php

//  Defining a constant for URL switch

define("SITE_URL", "/Proj1_Contact_Book/");


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function print_arr($arr)
{
    echo "<pre>";
    print_r($arr);
    exit();
}
