<?php

require('db.php');
$db = dbConnect($hostname, $db_name, $db_user, $db_pass);

$email = $_POST['user_email'];
$pass = $_POST['user_pass'];
$hash_pass = substr(md5($pass), 0, 32);

$result = $db->query("SELECT id, name, password_digest pass FROM users WHERE email = '$email' LIMIT 1");
if ($result->num_rows == 0) {
    loginFailed($email);
} else {
    $user = $result->fetch_assoc();
    if ($user['pass'] !== $hash_pass) {
        loginFailed($email);
    } else {
        session_start();
        if($_POST['auto_login']) {
            $hash_time = substr(md5(time()),0,32);
            setcookie('access_token', $hash_time, time() + (3600 * 24 * 30));
            $db->query("UPDATE users SET remember_digest = '$hash_time' WHERE id = '".$user['id']."'");
        }
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        setcookie("error", "", time() - 3600);
        header("Location:index.php");
    }
}

$db->close();

function loginFailed($email)
{
    setcookie('error', true);
    header("Location:login.php?user_email=" . urlencode($email));
}