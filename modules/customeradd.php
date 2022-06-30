<?php

$customerdata=$_POST['customeradd'];

if($customerdata)
{
	if(!$customerdata['name'])
		$error['name']='Name is required!';

	if(!$customerdata['lastname'])
		$error['lastname']='Last name is required!';

	if(!$error)
	{
		$id=$GMS->addCustomer($customerdata);
		header('Location: ?m=customerinfo&id='.$id);
	}
}

$smarty->assign('Name', 'New Customer');

$smarty->assign('customerdata', $customerdata);
$smarty->assign('error', $error);
$smarty->display('customeradd.html');
