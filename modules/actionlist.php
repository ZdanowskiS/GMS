<?php

$smarty->assign('Name', 'Action List');
$smarty->assign('actionlist', $GMS->getActionList());
$smarty->display('actionlist.html');

?>
