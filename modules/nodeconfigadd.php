<?php

$configdata=$_POST['configadd'];

if($configdata)
{
	if(!$configdata['name'])
		$error['name']='Name is required!';

	if(!$configdata['nodeid'])
		$error['nodeid']='Node is required!';

	if($GMS->existsNodeConfig($configdata['nodeid'], $configdata['name']))
		$error['name']='This configuration already exists';

	if($configdata['datefrom'] == '')
		$configdata['datefrom'] = 0;
	elseif(preg_match('/^[0-9]{4}\/[0-9]{2}\/[0-9]{2}$/', $configdata['datefrom']))
	{
		list($y, $m, $d) = explode('/', $configdata['datefrom']);
		if(checkdate($m, $d, $y))
			$configdata['datefrom'] = mktime(00, 00, 00, $m, $d, $y);
		else
			$error['datefrom'] = 'Incorrect date!';
	}
	else
		$error['datefrom'] = 'Incorrect date!';

	if($configdata['dateto'] == '')
		$configdata['dateto']= 0;
	elseif(preg_match('/^[0-9]{4}\/[0-9]{2}\/[0-9]{2}$/', $configdata['dateto']))
	{
		list($y, $m, $d) = explode('/', $configdata['dateto']);
		if(checkdate($m, $d, $y))
			$configdata['dateto'] = mktime(00, 00, 00, $m, $d, $y);
		else
			$error['datefrom'] = 'Incorrect date!';
	}
	else
		$error['datefrom'] = 'Incorrect date!';

	if(!$error)
	{
		$id=$GMS->addNodeConfig($configdata);
		if($configdata['nodeid'])
			header('Location: ?m=nodeinfo&id='.$configdata['nodeid']);
	}	
}

$smarty->assign('Name', 'New node config');

$smarty->assign('configdata', $configdata);

$node=$GMS->getNode($_GET['nodeid']);

$smarty->assign('nodelist', $GMS->getNodeNames($node['id']));
$smarty->assign('tasklist', $GMS->getModelTaskNames($node['modelid']));

$smarty->assign('error', $error);
$smarty->display('nodeconfigadd.html');

?>
