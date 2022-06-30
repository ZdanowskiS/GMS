<?php

$id=intval($_GET['id']);

$smarty->assign('Name', 'User Info');

$smarty->assign('userinfo', $GMS->getUser($id));
$smarty->assign('actionlist', $GMS->getModelActions($id));
$smarty->display('userinfo.html');
?>
