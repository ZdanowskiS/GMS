<?php

$configdata=$_POST['configadd'];

if($configdata)
{
	if(!$configdata['name'])
		$error['name']='Name is required!';

	if(!$configdata['nodeid'])
		$error['nodeid']='Node is required!';

	if($GMS->existsNodeConfig($configdata['nodeid'], $configdata['name']))
	{
		$error['name']='This configuration already exists';
	}

	if(!$error)
	{
		$id=$GMS->addNodeConfig($configdata);
		if($configdata['nodeid'])
			header('Location: ?m=nodeinfo&id='.$configdata['nodeid']);
	}

	
}
#else
#	$actiondata['modelid']=$_GET['modelid'];

$smarty->assign('Name', 'New node config');

$smarty->assign('configdata', $configdata);
$smarty->assign('nodelist', $GMS->getNodeNames($_GET['nodeid']));
#$smarty->assign('modellist', $GMS->getModelNames());

$smarty->assign('error', $error);
$smarty->display('nodeconfigadd.html');

?>
