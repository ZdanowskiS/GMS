<?php

if(isset($_POST['genieacsadd']))
{
    $genieacsdata=$_POST['genieacsadd'];

	if(!$genieacsdata['name'])
		$error['name']='Name is required!';
    else
        $genieacsdata['name']=trim($genieacsdata['name']);

    if($GMS->getGenieacsByName($genieacsdata['name']))
        $error['name']='This name exists!';

	if(!$genieacsdata['url'])
		$error['url']='URL is required!';
    else
        $error['url']=trim($error['url']);

    if($GMS->getGenieacsByUrl($genieacsdata['url']))
        $error['url']='This URL exists!';

	if(!$genieacsdata['passwd'])
		$error['passwd']='Password is required!';

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
