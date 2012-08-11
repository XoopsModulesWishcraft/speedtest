<?php

	// XOOPS Version
	// header
	define('_MI_SPEEDTEST_NAME','Fancy Speed Test');
	define('_MI_SPEEDTEST_DESCRIPTION','Based on Brandon Checketts Fancy Speed Test - http://www.brandonchecketts.com/open-source-speedtest');
	define('_MI_SPEEDTEST_DIRNAME','speedtest');
	
	// Guest User
	define('_MI_USER_GUEST','Guest');
		
	//Preferences
	define('_MI_SPEEDTEST_BASE_URL','The web-accessible directory where the program is installed');
	define('_MI_SPEEDTEST_BASE_URL_DESC','');
	define('_MI_SPEEDTEST_UPLOAD_URL','The full path to the upload.cgi');
	define('_MI_SPEEDTEST_UPLOAD_URL_DESC','This may not be under the base_url because it needs to be somewhere that perl scripts can run (ie: cgi-bin)');
	define('_MI_SPEEDTEST_IMAGE_PATH','Set the directory where images are saved (end with the closing /)');
	define('_MI_SPEEDTEST_IMAGE_PATH_DESC','');
	define('_MI_SPEEDTEST_LOGFILE','Log file to write events to');
	define('_MI_SPEEDTEST_LOGFILE_DESC','Make sure your web server can write to this file. (Leave blank for no logging!)');
	define('_MI_SPEEDTEST_DEBUG','Set debug to Yes to write detailed notes to the log file');
	define('_MI_SPEEDTEST_DEBUG_DESC','');
	define('_MI_SPEEDTEST_AUTO_SIZE','When auto_size is enabled, it will do a quick test (of file sizes specified by initial_kbytes)');
	define('_MI_SPEEDTEST_AUTO_SIZE_DESC','The initial test will help it to decide an appropriate file size to download for the real test.');
	define('_MI_SPEEDTEST_PRETTY_VERSION','pretty_version enables some javascript to make the graph progress as it\'s being downloaded');
	define('_MI_SPEEDTEST_PRETTY_VERSION_DESC','Its possible that on slow machines this may skew the results, so you can set this to No to disable');
	define('_MI_SPEEDTEST_PAGE_TITLE','Page Title displayed on your pages');
	define('_MI_SPEEDTEST_PAGE_TITLE_DESC','');
	define('_MI_SPEEDTEST_AUTO_START','auto_start will go directly from the index page to the download meter');
	define('_MI_SPEEDTEST_AUTO_START_DESC','Set to No if you want to display a welcome message of some sort. Write your content to speedtest_welcome.html');
	define('_MI_SPEEDTEST_ALLOW','A Regular expression applied to the visitors IP address to specifically allow certian hosts');
	define('_MI_SPEEDTEST_ALLOW_DESC','');
	define('_MI_SPEEDTEST_DISALLOW','A Regular expression applied to the visitors IP address to deny certian hosts from using the speed test');
	define('_MI_SPEEDTEST_DISALLOW_DESC','The contents of "speedtest_unallowed.html" will be displayed if the visitor is not allowed to use the test');
	define('_MI_SPEEDTEST_UPLOAD_MAX_KBYTES','Maximum number of bytes for upload test');
	define('_MI_SPEEDTEST_UPLOAD_MAX_KBYTES_DESC','');
	define('_MI_SPEEDTEST_UPLOAD_SKIP_UPLOAD','Disable the upload test (for example if you cant run a CGI');
	define('_MI_SPEEDTEST_UPLOAD_SKIP_UPLOAD_DESC','');
	define('_MI_SPEEDTEST_UPLOAD_DEFAULT_KBYTES','Number of bytes to upload if not using auto_size');
	define('_MI_SPEEDTEST_UPLOAD_DEFAULT_KBYTES_DESC','');
	define('_MI_SPEEDTEST_UPLOAD_INITIAL_KBYTES','Initial number of kbytes to upload if using auto_size');
	define('_MI_SPEEDTEST_UPLOAD_INITIAL_KBYTES_DESC','');
	define('_MI_SPEEDTEST_DOWNLOAD_MAX_KBYTES','Maximum number of kbytes for download test');
	define('_MI_SPEEDTEST_DOWNLOAD_MAX_KBYTES_DESC','');
	define('_MI_SPEEDTEST_DOWNLOAD_DEFAULT_KBYTES','Number of kbytes to download if not using auto_size');
	define('_MI_SPEEDTEST_DOWNLOAD_DEFAULT_KBYTES_DESC','');
	define('_MI_SPEEDTEST_DOWNLOAD_INTIAL_KBYTES','Initial number of kbytes to download if using auto_size');
	define('_MI_SPEEDTEST_DOWNLOAD_INTIAL_KBYTES_DESC','');
	define('_MI_SPEEDTEST_DATABASE_ENABLED','Set to Yes to enable saving settings to a database');
	define('_MI_SPEEDTEST_DATABASE_ENABLED_DESC','');
	define('_MI_SPEEDTEST_DATABASE_XOOPSOBJ','Set to Yes to enable saving settings to a database with testing class.');
	define('_MI_SPEEDTEST_DATABASE_XOOPSOBJ_DESC','');
	define('_MI_SPEEDTEST_DATABASE_IP_MATCH','Regular expression to match to save results to the database');
	define('_MI_SPEEDTEST_DATABASE_IP_MATCH_DESC','');
	define('_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_TYPICAL_DIALUP','Download Comparison Rate for Typical Dialup');
	define('_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_TYPICAL_DIALUP_DESC','Rates that you want displayed on the comparison\'s page (all values in kbps)');
	define('_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_BEST_CASE_DIALUP','Download Comparison Rate for Best-case Dialup');
	define('_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_BEST_CASE_DIALUP_DESC','Rates that you want displayed on the comparison\'s page (all values in kbps)');
	define('_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_STANDARD_DSL','Download Comparison Rate for Standard DSL');
	define('_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_STANDARD_DSL_DESC','Rates that you want displayed on the comparison\'s page (all values in kbps)');
	define('_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_T1','Download Comparison Rate for T1');
	define('_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_T1_DESC','Rates that you want displayed on the comparison\'s page (all values in kbps)');
	define('_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_CABLE','Download Comparison Rate for Cable');
	define('_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_CABLE_DESC','Rates that you want displayed on the comparison\'s page (all values in kbps)');
	define('_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_ETHERNET','Download Comparison Rate for Ethernet');
	define('_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_ETHERNET_DESC','Rates that you want displayed on the comparison\'s page (all values in kbps)');
	define('_MI_SPEEDTEST_COMPARISONS_UPLOAD_TYPICAL_DIALUP','Upload Comparison Rate for Typical Dialup');
	define('_MI_SPEEDTEST_COMPARISONS_UPLOAD_TYPICAL_DIALUP_DESC','Rates that you want displayed on the comparison\'s page (all values in kbps)');
	define('_MI_SPEEDTEST_COMPARISONS_UPLOAD_BEST_CASE_DIALUP','Upload Comparison Rate for Best-case Dialup');
	define('_MI_SPEEDTEST_COMPARISONS_UPLOAD_BEST_CASE_DIALUP_DESC','Rates that you want displayed on the comparison\'s page (all values in kbps)');
	define('_MI_SPEEDTEST_COMPARISONS_UPLOAD_STANDARD_DSL','Upload Comparison Rate for Standard DSL');
	define('_MI_SPEEDTEST_COMPARISONS_UPLOAD_STANDARD_DSL_DESC','Rates that you want displayed on the comparison\'s page (all values in kbps)');
	define('_MI_SPEEDTEST_COMPARISONS_UPLOAD_T1','Upload Comparison Rate for T1');
	define('_MI_SPEEDTEST_COMPARISONS_UPLOAD_T1_DESC','Rates that you want displayed on the comparison\'s page (all values in kbps)');
	define('_MI_SPEEDTEST_COMPARISONS_UPLOAD_CABLE','Upload Comparison Rate for Cable');
	define('_MI_SPEEDTEST_COMPARISONS_UPLOAD_CABLE_DESC','Rates that you want displayed on the comparison\'s page (all values in kbps)');
	define('_MI_SPEEDTEST_COMPARISONS_UPLOAD_ETHERNET','Upload Comparison Rate for Ethernet');
	define('_MI_SPEEDTEST_COMPARISONS_UPLOAD_ETHERNET_DESC','Rates that you want displayed on the comparison\'s page (all values in kbps)');
	
	// Version 1.02
	// Admin Menu
	$module_handler = xoops_gethandler('module');
	$GLOBALS['speedtestModule'] = $module_handler->getByDirname('speedtest');
	if (is_object($GLOBALS['speedtestModule'])) {
		define('_MI_SPEEDTEST_TITLE_ADMENU1','Dashboard');
		define('_MI_SPEEDTEST_ICON_ADMENU1','../../'.$GLOBALS['speedtestModule']->getInfo('icons32').'/home.png');
		define('_MI_SPEEDTEST_LINK_ADMENU1','admin/dashboard.php');
		define('_MI_SPEEDTEST_TITLE_ADMENU2','Results');
		define('_MI_SPEEDTEST_ICON_ADMENU2','../../'.$GLOBALS['speedtestModule']->getInfo('icons32').'/speedtest.results.png');
		define('_MI_SPEEDTEST_LINK_ADMENU2','admin/index.php');
		define('_MI_SPEEDTEST_TITLE_ADMENU3','About');
		define('_MI_SPEEDTEST_ICON_ADMENU3','../../'.$GLOBALS['speedtestModule']->getInfo('icons32').'/about.png');
		define('_MI_SPEEDTEST_LINK_ADMENU3','admin/about.php');
		
	}
?>