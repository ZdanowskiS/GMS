<?php

$id=intval($_GET['id']);

$smarty->assign('Name', 'Action Info');

$smarty->assign('tasklist', $GMS->getActionTasks($id));
$smarty->assign('actioninfo', $GMS->getAction($id));

$smarty->display('actioninfo.html');
?>
