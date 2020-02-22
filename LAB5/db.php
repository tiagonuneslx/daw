<?php

$hostname = "10.10.23.183";
$db_name = "db_a61271";
$db_user = "a61271";
$db_pass = "0377d6";

function dbConnect($hostname, $db_name, $db_user, $db_pass)
{
    $db = new mysqli($hostname, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) {
        die("Connect failed:" . mysqli_connect_error() . "\n");
    }
    return $db;
}
