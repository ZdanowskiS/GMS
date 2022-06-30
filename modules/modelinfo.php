<?php

$id=intval($_GET['id']);

$smarty->assign('Name', 'Model Info');

$smarty->assign('modelinfo', $GMS->getModel($id));
$smarty->assign('actionlist', $GMS->getModelActions($id));
$smarty->display('modelinfo.html');
?>
