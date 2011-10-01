<?php
		
	require_once('../include/common.php');
	require_once('../include/formobjects.speedtest.php');
	
	include('../../../include/cp_header.php');

	$config_handler = xoops_gethandler('config');
	$module_handler = xoops_gethandler('module');
	$GLOBALS['xoopsModule'] = $module_handler->getByDirname('speedtest');
	$GLOBALS['xoopsModuleConfig'] = $config_handler->getConfigList($GLOBALS['xoopsModule']->getVar('mid'));
?>