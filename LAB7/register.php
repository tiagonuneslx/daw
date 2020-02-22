<?php

require('/usr/share/php/smarty/libs/Smarty.class.php');
$smarty = new Smarty();
$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');

$message = array(
    1 => "Some fields are blank!",
    2 => "The email is not valid!",
    3 => "The passwords are different!",
    4 => "Email already exists!",
    5 => "Something went wrong. Please, try again later."
);

$smarty->assign('user_name', urldecode($_GET['user_name']));
$smarty->assign('user_email', urldecode($_GET['user_email']));
$smarty->assign('message', $message[$_GET['message']]);

try {
    $smarty->display('templates/register_template.tpl');
} catch (Exception $e) {
    print($e->getTraceAsString());
}

$db->close();