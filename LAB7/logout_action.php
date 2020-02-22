<?php

require('/usr/share/php/smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');

$smarty->assign('message', "See you back soon!");

try {
    $smarty->display('templates/message_template.tpl');
} catch (Exception $e) {
    print($e->getTraceAsString());
}

setcookie('user_id', "", time() - 3600);
setcookie('user_name', "", time() - 3600);
