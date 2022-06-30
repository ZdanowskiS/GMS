<?php

$id=intval($_GET['id']);

if(isset($_POST['customeredit']))
{
	$customeredit = $_POST['customeredit'];

	if(!$customeredit['name'])
		$error['name']='Name is required!';

	if(!$error)
	{
		$GMS->updateCustomer($customeredit);
		header('Location: ?m=customerinfo&id='.$customeredit['id']);
	}

}
else
	$customerdata=$GMS->getCustomer($id);


$smarty->assign('Name', 'Edit Customr');

$smarty->assign('customerdata', $customerdata);
$smarty->assign('error', $error);
$smarty->display('customeredit.html');

?>
