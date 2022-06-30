<?php

$id=intval($_GET['id']);

$GMS->delModel($id);

header('Location: ?m=modellist');
?>
