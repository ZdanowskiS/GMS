<?php

$smarty->assign('Name', 'GenieACS List');
$smarty->assign('genieacslist', $GMS->getGenieacsList());
$smarty->display('genieacslist.html');

?>
