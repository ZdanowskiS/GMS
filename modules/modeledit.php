<?php

$id=intval($_GET['id']);

if(isset($_POST['modeledit']))
{
	$modeledit = $_POST['modeledit'];

	if(!$modeledit['name'])
		$error['name']='Name is required!';

	if(!$error)
	{
		$GMS->updateModel($modeledit);
		header('Location: ?m=modelinfo&id='.$modeledit['id']);
	}

}
else
	$modeldata=$GMS->getModel($id);

$smarty->assign('Name', 'New Model');

$smarty->assign('modeldata', $modeldata);
$smarty->assign('error', $error);
$smarty->display('modeledit.html');

?>
