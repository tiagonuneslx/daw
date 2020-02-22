<?php

require('db.php');
require('/usr/share/php/smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');

$db = dbConnect($hostname, $db_name, $db_user, $db_pass);

$smarty->assign('user_name', $_GET['user_name']);
$smarty->assign('user_email', $_GET['user_email']);
$smarty->assign('message', urldecode($_GET['message']));

try {
    $smarty->display('templates/register_template.tpl');
} catch (Exception $e) {
    print($e->getTraceAsString());
}

$db->close();