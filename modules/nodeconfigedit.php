<?php

$id=intval($_GET['id']);


if(isset($_POST['configedit']))
{
	$configedit = $_POST['configedit'];

	if(!$configedit['name'])
		$error['name']='Name is required!';


	if($configedit['datefrom'] == '')
		$configedit['datefrom'] = 0;
	elseif(preg_match('/^[0-9]{4}\/[0-9]{2}\/[0-9]{2}$/', $configdata['datefrom']))
	{
		list($y, $m, $d) = explode('/', $configdata['datefrom']);
		if(checkdate($m, $d, $y))
			$configedit['datefrom'] = mktime(00, 00, 00, $m, $d, $y);
		else
			$error['datefrom'] = 'Incorrect date!';
	}
	else
		$error['datefrom'] = 'Incorrect date!';

	if($configedit['dateto'] == '')
		$configedit['dateto']= 0;
	elseif(preg_match('/^[0-9]{4}\/[0-9]{2}\/[0-9]{2}$/', $configdata['dateto']))
	{
		list($y, $m, $d) = explode('/', $configdata['dateto']);
		if(checkdate($m, $d, $y))
			$configedit['dateto'] = mktime(00, 00, 00, $m, $d, $y);
		else
			$error['datefrom'] = 'Incorrect date!';
	}
	else
		$error['datefrom'] = 'Incorrect date!';

	if(!$error)
	{
		$GMS->updateNodeConfig($configedit);
		header('Location: ?m=nodeinfo&id='.$configedit['nodeid']);
	}
	$configdata=$configedit;
}
else
	$configdata=$GMS->getNodeConfig($id);

$smarty->assign('Name', 'Edit Node Config');

$nodeconfig=$GMS->getNodeConfigList($configdata['nodeid']);

$smarty->assign('configdata', $configdata);
$smarty->assign('nodeconfig', $nodeconfig);

$smarty->assign('error', $error);
$smarty->display('nodeconfigedit.html');

?>
