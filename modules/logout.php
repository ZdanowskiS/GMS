<?php

$SID=$_COOKIE['SID'];
$GMS->logout($SID);
header('Location: ?m=login');
?>
