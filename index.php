<?php

function parseURI()
{
    $uri=ltrim($_SERVER['REQUEST_URI'],'/');
    $tmp=explode('/',$uri);

    $result['type']=$tmp[0];

    if(array_key_exists(1,$tmp))
        $result['uri']=preg_replace('/[^a-z]/', '',$tmp[1]);
    else
        $result['uri']='';

    if(array_key_exists(2,$tmp))
        $result['id']=$tmp[2];
    else
        $result['id']='';

    return $result;
}

$CONFIG_FILE ='config.ini';
define('CONFIG_FILE', $CONFIG_FILE);

$CONFIG = (array) parse_ini_file(CONFIG_FILE, true);

$route=parseURI();

if(file_exists('smarty/libs/Smarty.class.php'))
{
	require 'smarty/libs/Smarty.class.php';
	$smarty = new Smarty;

	require_once "./lib/definitions.php";
	require_once "./lib/GMSGenieACS.class.php";
	require_once "./lib/GMSPostgres.class.php";
	require_once "./lib/GMS.class.php";

	$API=new GMSGenieACS();

	$psql=new GMSPostgres();

	$GMS=new GMS($psql,$API);


	if(!$GMS->isUserAdded())
	{
		$module='useradd';
	}
	elseif($GMS->isLoged())
	{
    	if(!array_key_exists('m', $_GET) || $_GET['m']=='login')
        	$module='customerlist';
    	else
        	$module=$_GET['m'];

		$smarty->assign('title', 'GMS');
	}
	else
		$module='login';

	$file='modules/'. $module . '.php';
	if (file_exists($file)) {
		include $file;
	}
	else {
		echo "Page not found.";
		exit;
	}
}
else
	echo 'Install Smarty.';
	
?>
