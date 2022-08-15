<?php

$id=intval($_GET['id']);

if(isset($_POST['genieacsedit']))
{
	$genieacsdata = $_POST['genieacsedit'];

	if(!$genieacsdata['name'])
		$error['name']='Name is required!';
    elseif(($genie=$GMS->getGenieacsByName($genieacsdata['name']))!=$genieacsdata['id'] && $genie)
        $error['name']='This name exists!';

	if(!$genieacsdata['url'])
		$error['url']='URL is required!';
    elseif(($url=$GMS->getGenieacsByUrl($genieacsdata['url']))!=$genieacsdata['id'] && $url)
        $error['name']='This name exists!';

	if(!$genieacsdata['passwd'])
		$error['passwd']='Password is required!';

	if(!$error)
	{
		$GMS->updateGenieacs($genieacsdata);
		header('Location: ?m=genieacsinfo&id='.$genieacsdata['id']);
	}

}
else
	$genieacsdata=$GMS->getGenieacs($id);

$smarty->assign('Name', 'Edit GenieACS');

$smarty->assign('genieacsdata', $genieacsdata);
$smarty->assign('error', $error);

$smarty->display('genieacsedit.html');

?>
