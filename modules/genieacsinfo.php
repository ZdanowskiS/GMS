<?php

$id=intval($_GET['id']);

$smarty->assign('Name', 'GenieACS Info');

$smarty->assign('genieacsinfo', $GMS->getGenieacs($id));

$smarty->display('genieacsinfo.html');
?>
