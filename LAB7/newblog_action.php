<?php

require('db.php');
require('/usr/share/php/smarty/libs/Smarty.class.php');
$smarty = new Smarty();
$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');
$db = dbConnect($hostname, $db_name, $db_user, $db_pass);

$blog = $_POST['blog'];

session_start();
if(!isset($_SESSION['user_id'])) {
    $smarty->assign('message', "ERROR: Login first");
}
else {
    $user_id = $_SESSION['user_id'];
    if ($db->query("INSERT INTO microposts (content, user_id, created_at, updated_at) VALUES('$blog', $user_id, NOW(), NOW())")) {
        $smarty->assign('message', "SUCCESS: New post submitted");
    } else {
        $smarty->assign('message', "ERROR: $db->error");
    }
}

try {
    $smarty->display('templates/message_template.tpl');
} catch (Exception $e) {
    print($e->getTraceAsString());
}

$db->close();