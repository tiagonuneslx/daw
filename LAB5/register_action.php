<?php

require('db.php');
$db = dbConnect($hostname, $db_name, $db_user, $db_pass);

$name = $_POST['user_name'];
$email = $_POST['user_email'];
$pass = $_POST['user_pass'];
$pass_confirm = $_POST['user_pass_confirm'];
$hash_pass = substr(md5($_POST[$pass]), 0, 32);

if(!$name || !$email || !$pass) {
    registerFailed("Some fields are blank!", $name, $email);
}
else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    registerFailed("The email is not valid!", $name, $email);
}
else if($pass !== $pass_confirm) {
    registerFailed("The passwords are different!", $name, $email);
}
else if ($db->query("SELECT COUNT(*) FROM users WHERE email = '$email'") > 0) {
    registerFailed("Email already exists!", $name, $email);
}
else if ($db->query("INSERT INTO users (name, email, created_at, updated_at, password_digest) VALUES ('$name','$email',NOW(),NOW(),'$hash_pass')")) {
    header("Location: register_success.html");
}
else {
    registerFailed("Something went wrong. Please, try again later.", $name, $email);
}

function registerFailed($message, $name, $email) {
    header("Location:register.php?message=".urlencode($message)
        ."&user_name=".urlencode($name)."&user_email=".urlencode($email));
}