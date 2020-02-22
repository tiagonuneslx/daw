<?php

require('db.php');
require('/usr/share/php/smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');

$db = dbConnect($hostname, $db_name, $db_user, $db_pass);

if ($result = $db->query("SELECT * FROM microposts")) {
    $posts = array();
    while ($row = $result->fetch_assoc()) {
        array_push($posts,$row);
    }
    $smarty->assign('posts', $posts);
    $result->close();
    $db->next_result();
}

if ($result = $db->query("SELECT * FROM users")) {
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[$row["id"]] = $row;
    }
    $smarty->assign('users', $users);
    $result->close();
    $db->next_result();
}

try {
    $smarty->display('templates/index_template.tpl');
} catch (Exception $e) {
    print($e->getTraceAsString());
}

$db->close();