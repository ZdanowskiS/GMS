<?php

$id=intval($_GET['id']);

if(isset($_POST['nodeedit']))
{
	$nodedata = $_POST['nodeedit'];

	if(!$nodedata['name'])
		$error['name']='Name is required!';

	if(!$error)
	{
		$GMS->updateNode($nodedata);
		header('Location: ?m=nodeinfo&id='.$nodedata['id']);
	}
}
else
	$nodedata=$GMS->getNode($id);

$smarty->assign('Name', 'Edit Node');

$smarty->assign('customerlist', $GMS->getCustomerNames());
$smarty->assign('modellist', $GMS->getModelNames());
$smarty->assign('genieacslist', $GMS->getGenieacsNames());

$smarty->assign('nodedata', $nodedata);
$smarty->assign('error', $error);
$smarty->display('nodeedit.html');

?>
