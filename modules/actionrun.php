<?php
$actionid=intval($_GET['actionid']);
$nodeid=intval($_GET['nodeid']);

$result=$GMS->runAction($nodeid, $actionid);

$smarty->assign('result', $result);
$smarty->display('actionrun.html');
#header('Location: ?m=nodeinfo&id='.$nodeid);
?>
