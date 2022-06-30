<?php

$id=intval($_GET['id']);

$GMS->delCustomer($id);

header('Location: ?m=customerlist');
?>
