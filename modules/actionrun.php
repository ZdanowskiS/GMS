<?php
$actionid=intval($_GET['actionid']);
$nodeid=intval($_GET['nodeid']);

$GMS->runAction($nodeid, $actionid);

header('Location: ?m=nodeinfo&id='.$nodeid);
?>
