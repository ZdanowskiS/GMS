<?php

$id=intval($_GET['id']);

if(isset($_POST['modeledit']))
{
	$modeldata = $_POST['modeledit'];

	if(!$modeldata['name'])
		$error['name']='Name is required!';
    elseif(($model=$GMS->getModelByName($modeldata['name']))!=$modeldata['id'] && $model)
		$error['name']='Name exists!';

	if(!$error)
	{
		$GMS->updateModel($modeldata);
		header('Location: ?m=modelinfo&id='.$modeldata['id']);
	}

}
else
	$modeldata=$GMS->getModel($id);

$smarty->assign('Name', 'New Model');

$smarty->assign('modeldata', $modeldata);
$smarty->assign('error', $error);
$smarty->display('modeledit.html');

?>
