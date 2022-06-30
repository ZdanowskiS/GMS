<?php

$id=intval($_GET['id']);

if(isset($_POST['actionedit']))
{
	$actionedit = $_POST['actionedit'];

	if(!$actionedit['name'])
		$error['name']='Name is required!';

	if(!$error)
	{
		$GMS->updateAction($actionedit);
		header('Location: ?m=actioninfo&id='.$actionedit['id']);
	}
	$actiondata=$actionedit;
}
else
	$actiondata=$GMS->getAction($id);

$smarty->assign('Name', 'Edit Action');

$smarty->assign('actiondata', $actiondata);
$smarty->assign('modellist', $GMS->getModelNames());

$smarty->assign('error', $error);
$smarty->display('actionedit.html');

?>
