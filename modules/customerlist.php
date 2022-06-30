<?php

$smarty->assign('Name', 'Customer List');
$smarty->assign('customerlist', $GMS->getCustomerList());
$smarty->display('customerlist.html');

?>
