<?php

$actiondata=$_POST['actionadd'];

if($actiondata)
{
	if(!$actiondata['name'])
		$error['name']='Name is required!';

    if($GMS->existsModelActionName($actiondata['modelid'], $actiondata['name']))
        $error['name']='Action exists!';

	if(!$error)
	{
		$id=$GMS->addAction($actiondata);
		header('Location: ?m=actioninfo&id='.$id);
	}
}
else
	$actiondata['modelid']=$_GET['modelid'];

$smarty->assign('Name', 'New Action');

$smarty->assign('actiondata', $actiondata);
$smarty->assign('modellist', $GMS->getModelNames());

$smarty->assign('error', $error);
$smarty->display('actionadd.html');

?>
