<?php

$smarty->assign('Name', 'Model List');
$smarty->assign('modellist', $GMS->getModelList());
$smarty->display('modellist.html');

?>
