<?php

$id=intval($_GET['id']);

$smarty->assign('Name', 'Customer Info');

$smarty->assign('customerinfo', $GMS->getCustomer($id));
$smarty->assign('nodelist', $GMS->getCustomerNodeList($id));
$smarty->display('customerinfo.html');
?>
