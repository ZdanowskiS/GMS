<?php

$smarty->assign('Name', 'Node List');

$smarty->assign('nodelist', $GMS->getNodeList());
$smarty->display('nodelist.html');

?>
