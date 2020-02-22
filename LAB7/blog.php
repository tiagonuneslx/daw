<?php

require('db.php');
require('/usr/share/php/smarty/libs/Smarty.class.php');

$smarty = new Smarty();
$db = dbConnect($hostname, $db_name, $db_user, $db_pass);

$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');

if($micropost_id = $_GET['micropost_id']) {
    $blog = $db->query("SELECT content FROM microposts WHERE id = $micropost_id")->fetch_assoc()['content'];
    $smarty->assign('blog', $blog);
    $smarty->assign('action', "updateblog_action.php?micropost_id=$micropost_id");
}
else {
    $smarty->assign('action', "newblog_action.php");
}

try {
    $smarty->display('templates/blog_template.tpl');
} catch (Exception $e) {
    print($e->getTraceAsString());
}

$db->close();