<?php

$id=intval($_GET['id']);

if(isset($_POST['taskedit']))
{
	$taskedit = $_POST['taskedit'];

	if(!$taskedit['name'])
		$error['name']='Name is required!';

	if(!$error)
	{
		$GMS->updateTask($taskedit);
		header('Location: ?m=taskinfo&id='.$taskedit['id']);
	}
	$taskdata=$taskedit;
}
else
	$taskdata=$GMS->getTask($id);

$smarty->assign('Name', 'Edit Action');

$smarty->assign('actiondata', $actiondata);
$smarty->assign('modellist', $GMS->getModelNames());

$smarty->assign('error', $error);
$smarty->display('taskedit.html');

?>
