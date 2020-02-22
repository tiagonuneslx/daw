<?php

require('db.php');
require('/usr/share/php/smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');

$db = dbConnect($hostname, $db_name, $db_user, $db_pass);

session_start();
if (isset($_SESSION['user_name'])) {
    $smarty->assign('user_id', $_SESSION['user_id']);
    $smarty->assign('user_name', $_SESSION['user_name']);
} else {
    if($access_token = $_COOKIE['access_token']) {
        if($user = $db->query("SELECT id, name FROM users WHERE remember_digest = '$access_token'")->fetch_assoc()) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $smarty->assign('user_id', $_SESSION['user_id']);
            $smarty->assign('user_name', $_SESSION['user_name']);
        }
    }
}

if ($result = $db->query("SELECT m.*, u.name user_name FROM microposts m INNER JOIN users u ON m.user_id = u.id ORDER BY m.updated_at DESC")) {
    $posts = array();
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
    $smarty->assign('posts', $posts);
    $result->close();
    $db->next_result();
}

try {
    $smarty->display('templates/index_template.tpl');
} catch (Exception $e) {
    print($e->getTraceAsString());
}

$db->close();