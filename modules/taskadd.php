<?php

$taskdata=$_POST['taskadd'];

if($taskdata)
{
	if(!$taskdata['name'])
		$error['name']='Name is required!';

	if(!$error)
	{
		$id=$GMS->addTask($taskdata);
		if($_GET['actionid'])
			header('Location: ?m=actioninfo&id='.$_GET['actionid']);
		else
			header('Location: ?m=taskinfo&id='.$id);

	}
}
#else
#	$actiondata['modelid']=$_GET['modelid'];

$smarty->assign('Name', 'New Task');

$smarty->assign('taskdata', $taskdata);
#$smarty->assign('modellist', $GMS->getModelNames());

$smarty->assign('error', $error);
$smarty->display('taskadd.html');

?>
