<?php

$modeldata=$_POST['modeladd'];

if($modeldata)
{
	if(!$modeldata['name'])
		$error['name']='Name is required!';

	if(!$error)
	{
		$id=$GMS->addModel($modeldata);
		header('Location: ?m=modelinfo&id='.$id);
	}

}

$smarty->assign('Name', 'New Model');

$smarty->assign('modeldata', $modeldata);
$smarty->assign('error', $error);
$smarty->display('modeladd.html');

?>
