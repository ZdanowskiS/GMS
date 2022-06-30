<?php
$userdata=$_POST['useradd'];

if($userdata)
{
	if(!$userdata['login'])
		$error['login']='Name is required!';

	if(!$error)
	{
		$id=$GMS->addUser($userdata);
		header('Location: ?m=userinfo&id='.$id);
	}
}

$smarty->assign('Name', 'New User');

$smarty->assign('userdata', $userdata);
$smarty->assign('error', $error);
$smarty->display('useradd.html');

?>
