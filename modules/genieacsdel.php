<?php

$id=intval($_GET['id']);

$GMS->delGenieacs($id);

header('Location: ?m=genieacslist');
?>
