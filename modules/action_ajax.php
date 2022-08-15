<?php

$action=$_GET['action'];

$modelid=intval($_GET['modelid']);
$actionid=intval($_GET['actionid']);


switch($action){
    case 'getname':
        if(!$actionid)
            return;

        if(!$modelid)
            $modelid=$psql->GetOne('SELECT modelid FROM actions WHERE id=?',array($actionid));

        $candidates=$psql->GetAll('SELECT DISTINCT t.name FROM tasks t JOIN actions a ON (t.actionid=a.id) 
                        WHERE a.modelid=? AND t.name LIKE \''.$_GET['text'].'%\'',
                        array($modelid));

    break;
    case 'getsetting':
        $array= $psql->GetAll('SELECT * FROM tasks WHERE name LIKE \''.$_GET['text'].'%\' LIMIT 1');

        echo json_encode($array[0]);exit;
    break;
    default:
        return null;

}

if(is_array($candidates))
{
    foreach($candidates as $k => $value)
    {
        print '<option value="'.$value['name'].'">'.$value['name'].'</option>';
    }
}
exit;
?>
