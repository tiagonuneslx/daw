<?php

require('db.php');
require('/usr/share/php/smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');

$db = dbConnect($hostname, $db_name, $db_user, $db_pass);

$smarty->assign('user_email', $_GET['user_email']);

if (isset($_COOKIE['error']) && $_COOKIE['error']) {
    $smarty->assign('message', "Wrong email or password!");
    setcookie("error", "", time() - 3600);
}

try {
    $smarty->display('templates/login_template.tpl');
} catch (Exception $e) {
    print($e->getTraceAsString());
}

$db->close();