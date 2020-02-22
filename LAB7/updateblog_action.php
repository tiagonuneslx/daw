<?php

require('db.php');
require('/usr/share/php/smarty/libs/Smarty.class.php');
$smarty = new Smarty();
$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');
$db = dbConnect($hostname, $db_name, $db_user, $db_pass);

$blog_id = $_GET['micropost_id'];
$blog = $_POST['blog'];

session_start();

if(!isset($_SESSION['user_id'])) {
    $smarty->assign('message', "ERROR: Not allowed".$blog_id);
}
else if($db->query("SELECT user_id FROM microposts WHERE id = '$blog_id'")->fetch_assoc()['user_id'] !== $_SESSION['user_id']) {
    $smarty->assign('message', "ERROR: Not allowed");
}
else if($db->query("UPDATE microposts SET content = '$blog', updated_at = NOW() WHERE id = $blog_id")) {
    $smarty->assign('message', "SUCCESS: Post updated");
}
else {
    $smarty->assign('message', "ERROR: $db->error");
}

try {
    $smarty->display('templates/message_template.tpl');
} catch (Exception $e) {
    print($e->getTraceAsString());
}

$db->close();