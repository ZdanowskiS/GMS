<?php

$login=$_POST['login'];
if($login)
{
	if($GMS->verifyPassword($login['login'],$login['passwd']))
	{
		$user=$psql->GetRow('SELECT id, passwd FROM users WHERE login LIKE ?',
							array($login['login']));

		$SID=$GMS->addSession($user['id']);

		setcookie('SID', $SID);
		header('Location: ?m=customerlist');
	}
}

$smarty->display('login.html');
?>
