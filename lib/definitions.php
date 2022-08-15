<?php


define('DATA_NAME_GET', 1);
define('DATA_NAME_REFRESH', 2);
define('DATA_NAME_SET', 3);
define('DATA_NAME_ADD', 4);
define('DATA_NAME_DELETE', 5);
define('DATA_NAME_REBOOT', 6);
define('DATA_NAME_FACTORY', 7);
define('DATA_NAME_DOWNLOAD', 8);
define('DATA_NAME_ADDTAG', 9);

$DATANAME = array(
	DATA_NAME_GET => 'getParameterValues',
	DATA_NAME_REFRESH => 'refreshObject',
	DATA_NAME_SET => 'setParameterValues',
	DATA_NAME_ADD => 'addObject',
	DATA_NAME_DELETE => 'deleteObject',
	DATA_NAME_REBOOT => 'reboot',
	DATA_NAME_FACTORY => 'factoryReset',
	DATA_NAME_DOWNLOAD => 'download',
	DATA_NAME_ADDTAG => 'addTag',
);

define('DATA_TYPE_STRING', 1);

$DATATYPE = array(
	DATA_TYPE_STRING => 'xsd:string'
);

$smarty->assign('_DATANAME', $DATANAME);
$smarty->assign('_DATATYPE', $DATATYPE);
?>
