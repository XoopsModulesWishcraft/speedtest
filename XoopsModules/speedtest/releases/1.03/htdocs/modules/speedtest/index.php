<?php
###############################################################################
## Fancy Speed Test - Easily measure your upload and download speeds
## Home Page:   http://www.brandonchecketts.com/speedtest/
## Author:      Brandon Checketts
## File:        index.php
## Version:     1.1
## Date:        2006-02-06
## Purpose:     Display a welcome page, or redirect straight to the 
##              download test if auto_start is enabled
###############################################################################

require(dirname(__FILE__)."/include/common.php");
OutputConfig(dirname(__FILE__)."/speedtest.template.cfg", dirname(__FILE__)."/speedtest.cfg");
ReadConfig(dirname(__FILE__)."/speedtest.cfg");

## Redirect immediately to download.php if auto_start = 1
if($config->{'general'}->{'auto_start'}) {
    Header("Location: ".$config->{'general'}->{'base_url'}."/download.php");
    exit;
}

$xoopsOption['template_main'] = 'speedtest_index.html';
include($GLOBALS['xoops']->path('/header.php'));
$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL.'/modules/speedtest/language/'.$GLOBALS['xoopsConfig']['language'].'/style.css', array('type'=>'text/css'));
$GLOBALS['xoopsTpl']->assign('php_self', $_SERVER['PHP_SELF']);
$GLOBALS['xoopsTpl']->assign('base_url', $config->{'general'}->{'base_url'});
if (strlen($config->{'general'}->{'page_title'})>0)
{
	$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', $config->{'general'}->{'page_title'});
}
include($GLOBALS['xoops']->path('/footer.php'));
?>