<?php
if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

function xoops_module_update_speedtest($module, $oldversion) {
	unlink(dirname(dirname(__FILE__)).'/speedtest.cfg');
	return true;
}
?>