<?php

$nodedata=$_POST['nodeadd'];

if($nodedata)
{
	if(!$nodedata['name'])
		$error['name']='Name is required!';

	if(!$nodedata['customerid'])
		$error['customerid']='Customer is required!';

	if(!$nodedata['modelid'])
		$error['modelid']='Model is required!';

	if(!$nodedata['serial'])
		$error['serial']='Serial is required!';

	if(!$error)
	{
		$id=$GMS->addNode($nodedata);
		header('Location: ?m=nodeinfo&id='.$id);
	}
}
else
	$nodedata['customerid']=intval($_GET['customerid']);

$smarty->assign('Name', 'New Node');

$smarty->assign('customerlist', $GMS->getCustomerNames());
$smarty->assign('modellist', $GMS->getModelNames());
$smarty->assign('genieacslist', $GMS->getGenieacsNames());

$smarty->assign('nodedata', $nodedata);
$smarty->assign('error', $error);

$smarty->display('nodeadd.html');

?>
