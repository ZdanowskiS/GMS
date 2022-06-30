<?php

$smarty->assign('Name', 'User List');
$smarty->assign('userlist', $GMS->getUserList());
$smarty->display('userlist.html');

?>
