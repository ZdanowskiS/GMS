<?php

$id=intval($_GET['id']);

$GMS->delNode($id);

header('Location: ?m=nodelist');
?>
