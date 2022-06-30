<?php

$id=intval($_GET['id']);

if(!$GMS->existsNodeId($id))
    header('Location: ?m=nodelist');

$nodeinfo=$GMS->getNode($id);

$smarty->assign('Name', 'Node Info');

$nodeconfig=$GMS->getNodeConfigList($id);

$smarty->assign('nodeinfo', $nodeinfo);
$smarty->assign('nodeconfig', $nodeconfig);
$smarty->assign('tasklist', $GMS->getModelTaskNames($nodeinfo['modelid']));
$smarty->assign('actionlist', $GMS->getModelActions($nodeinfo['modelid']));

$smarty->display('nodeinfo.html');
?>
