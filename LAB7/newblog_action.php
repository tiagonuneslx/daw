<?php

require('db.php');
$db = dbConnect($hostname, $db_name, $db_user, $db_pass);

$user_id = $_SESSION['user_id'];
$blog = $_POST['blog'];

$smarty = new Smarty();

$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');


if($db->query("INSERT INTO microposts (content, user_id,created_at, updated_at) VALUES($blog, $user_id, NOW(), NOW())")) {
    $smarty->assign('message', "SUCCESS: New post submitted");
}
else {
    $smarty->assign('message', "Error $db->error");
}

try {
    $smarty->display('templates/message_template.tpl');
} catch (Exception $e) {
    print($e->getTraceAsString());
}

$db->close();