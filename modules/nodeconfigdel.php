<?php

$id=intval($_GET['id']);

$config=$GMS->getNodeConfig($id);

$GMS->delNodeConfig($id);

header('Location: ?m=nodeinfo&id='.$config['nodeid']);
?>
