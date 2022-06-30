<?php

$id=intval($_GET['id']);

$GMS->delAction($id);

header('Location: ?m=actionlist');
?>
