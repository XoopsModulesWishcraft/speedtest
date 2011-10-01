<?php
###############################################################################
## Fancy Speed Test - Easily measure your upload and download speeds
## Home Page:   http://www.brandonchecketts.com/speedtest/
## Author:      Brandon Checketts
## File:        results.php
## Version:     1.1
## Date:        2006-02-06
## Purpose:     Display the speed test results in a meaningful way
##              Save results to the database if enabled
###############################################################################

require("common.php");
ReadConfig("speedtest.cfg");


## Save the results of this speedtest to the database, if enabled
if($config->{'database'}->{'enable'}) {
    $ip_matches = $config->{'database'}->{'ip_matches'};
    if( (! $ip_matches) || ($ip_matches && preg_match("/$ip_matches/",$_SERVER['REMOTE_ADDR'])) ) {
        Debug("Saving to database");
        if (!$config->{'database'}->{'xoopsobj'}) {
	        $table = $GLOBALS['xoopsDB']->prefix('speedtest');
	        $ip = $_SERVER['REMOTE_ADDR'];
	        $upspeed = addslashes($_GET['upspeed']);
	        $downspeed = addslashes($_GET['downspeed']);
	        $sql = "
	            INSERT INTO `$table`
	            SET
	                `ip_string` =  '$ip',
	                `ip` = INET_ATON('$ip'),
	                `timestamp` = NOW(),
	                `upspeed` = '$upspeed',
	                `downspeed` = '$downspeed'
	        ";
	        $GLOBALS['xoopsDB']->queryF($sql);
        } else {
	        $ip = $_SERVER['REMOTE_ADDR'];
	        $upspeed = $_GET['upspeed'];
	        $downspeed = $_GET['downspeed'];
        	$test_handler = xoops_getmodulehandler('speedtest', 'speedtest');
        	$test = $test_handler->create();
        	$test->setVar('ip_string'. $ip);
        	$test->setVar('ip'. ip2long($ip));
        	$test->setVar('timestamp'. date('Y-m-d H:i:s'));
        	$test->setVar('upspeed'. $upspeed);
        	$test->setVar('downspeed'. $downspeed);
        	$test_handler->insert($test, true);
        }
    }
}

$xoopsOption['template_main'] = 'speedtest_result.html';
include($GLOBALS['xoops']->path('/header.php'));
$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL.'/modules/speedtest/language/'.$GLOBALS['xoopsConfig']['language'].'/style.css', array('type'=>'text/css'));
$GLOBALS['xoopsTpl']->assign('php_self', $_SERVER['PHP_SELF']);
$GLOBALS['xoopsTpl']->assign('base_url', $config->{'general'}->{'base_url'});
if (strlen($config->{'general'}->{'page_title'})>0)
{
	$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', $config->{'general'}->{'page_title'});
}

$bar_width = 400;
$clean_down = CleanSpeed($_GET['downspeed']);
$download_biggest = $_GET['downspeed'];

$GLOBALS['xoopsTpl']->assign('clean_down', $clean_down);
$GLOBALS['xoopsTpl']->assign('image_path', $config->{'general'}->{'image_path'});
    
foreach($config->{'comparisons-download'} as $key=>$value) {
	if($value > $download_biggest) {
		$download_biggest = $value;
	}
}

foreach($config->{'comparisons-download'} as $key=>$value) {
	$this_bar_width = $bar_width / $download_biggest * $value;
	$GLOBALS['xoopsTpl']->append('comparisons_download', array('name'=>$key, 'clean_speed'=>CleanSpeed($value), 'bar_width'=>$this_bar_width, 'value' =>$value));
}

$this_bar_width = $bar_width / $download_biggest * $_GET['downspeed'];
$GLOBALS['xoopsTpl']->assign('download', array('name'=>_MN_SPEEDTEST_RESULT_NAME, 'clean_speed'=>$clean_down, 'bar_width'=>$this_bar_width, 'value' =>$_GET['downspeed']));

if(isset($_GET['upspeed'])) {
	$GLOBALS['xoopsTpl']->assign('uploadset', true);
	$clean_up = CleanSpeed($_GET['upspeed']);
	$upload_biggest = $_GET['upspeed'];
	$GLOBALS['xoopsTpl']->assign('clean_up', $clean_up);
    foreach($config->{'comparisons-upload'} as $key=>$value) {
    	if($value > $upload_biggest) {
        	$upload_biggest = $value;
		}
	}
	foreach($config->{'comparisons-upload'} as $key=>$value) {
		$this_bar_width = $bar_width / $upload_biggest * $value;
		$GLOBALS['xoopsTpl']->append('comparisons_upload', array('name'=>$key, 'clean_speed'=>CleanSpeed($value), 'bar_width'=>$this_bar_width, 'value' =>$value));
	}
	$this_bar_width = $bar_width / $upload_biggest * $_GET['upspeed'];
	$GLOBALS['xoopsTpl']->assign('upload', array('name'=>_MN_SPEEDTEST_RESULT_NAME, 'clean_speed'=>$clean_up, 'bar_width'=>$this_bar_width, 'value' =>$_GET['upspeed']));
} else {
	$GLOBALS['xoopsTpl']->assign('uploadset', false);
}

include($GLOBALS['xoops']->path('/footer.php'));
?>