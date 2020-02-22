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
        setcookie("error", "", time() - 3600);
        setcookie('user_id', $user['id']);
        setcookie('user_name', $user['name']);
        header("Location:index.php");
    }
}

$db->close();

function loginFailed($email)
{
    setcookie('error', true);
    header("Location:login.php?user_email=" . urlencode($email));
}