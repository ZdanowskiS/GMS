<?php

$id=intval($_GET['id']);

$GMS->delUser($id);

header('Location: ?m=userlist');
?>
