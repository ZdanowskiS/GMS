<?php

if(isset($_POST['genieacsadd']))
{
    $genieacsdata=$_POST['genieacsadd'];

	if(!$genieacsdata['name'])
		$error['name']='Name is required!';

	if(!$genieacsdata['url'])
		$error['url']='URL is required!';

	if(!$genieacsdata['passwd'])
		$error['url']='Password is required!';

	if(!$error)
	{
		$id=$GMS->addGenieacs($genieacsdata);

		header('Location: ?m=genieacsinfo&id='.$id);
	}

}

$smarty->assign('Name', 'New GenieACS');

$smarty->assign('genieacsdata', $genieacsdata);
$smarty->assign('error', $error);
$smarty->display('genieacsadd.html');

?>
