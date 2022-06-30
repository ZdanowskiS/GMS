<?php

$id=intval($_GET['id']);
$task=$GMS->getTask($id);

if($task)
{
    $GMS->delTask($id);
    header('Location: ?m=actioninfo&id='.$task['actionid']);
}
else
    header('Location: ?m=actionlist');
?>
