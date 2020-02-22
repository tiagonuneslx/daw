<?php

require('db.php');
$db = dbConnect($hostname, $db_name, $db_user, $db_pass);

$name = $_POST['user_name'];
$email = $_POST['user_email'];
$pass = $_POST['user_pass'];
$pass_confirm = $_POST['user_pass_confirm'];
$hash_pass = substr(md5($pass), 0, 32);

if(!$name || !$email || !$pass || !$pass_confirm) {
    registerFailed(1, $name, $email);
}
else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    registerFailed(2, $name, $email);
}
else if($pass !== $pass_confirm) {
    registerFailed(3, $name, $email);
}
else if ($db->query("SELECT id FROM users WHERE email = '$email'")->num_rows > 0) {
    registerFailed(4, $name, $email);
}
else if ($db->query("INSERT INTO users (name, email, created_at, updated_at, password_digest) VALUES ('$name','$email',NOW(),NOW(),'$hash_pass')")) {
    $user = $db->query("SELECT id, name FROM users WHERE email = '$email'")->fetch_assoc();
    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    header("Location: register_success.html");
}
else {
    registerFailed(5, $name, $email);
}

function registerFailed($message, $name, $email) {
    header("Location:register.php?message=".urlencode($message)
        ."&user_name=".urlencode($name)."&user_email=".urlencode($email));
}

$db->close();