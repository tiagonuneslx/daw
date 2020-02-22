<?php

require('db.php');
require('/usr/share/php/smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');

$db = dbConnect($hostname, $db_name, $db_user, $db_pass);

try {
    $smarty->display('templates/login_template.tpl');
} catch (Exception $e) {
    print($e->getTraceAsString());
}

$db->close();