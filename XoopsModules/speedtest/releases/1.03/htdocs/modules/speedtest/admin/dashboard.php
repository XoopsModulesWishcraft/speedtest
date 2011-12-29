<?php

	include ('header.php');
	xoops_loadLanguage('admin', 'speedtest');
	
	xoops_cp_header();		
	speedtest_adminMenu(basename(__FILE__), 1);
	$indexAdmin = new ModuleAdmin();
	
    $speed_handler = xoops_getmodulehandler('speedtest', 'speedtest');
    
 	$indexAdmin = new ModuleAdmin();	
    $indexAdmin->addInfoBox(_AM_SPEEDTEST_ADMIN_COUNTS);
    $indexAdmin->addInfoBoxLine(_AM_SPEEDTEST_ADMIN_COUNTS, "<label>"._AM_SPEEDTEST_ADMIN_THEREARE_TESTS."</label>", $speed_handler->getCount(), 'Green');
    $indexAdmin->addInfoBoxLine(_AM_SPEEDTEST_ADMIN_COUNTS, "<label>"._AM_SPEEDTEST_ADMIN_MAXIMUM_DOWNSPEED."</label>", $speed_handler->getMaximum('downspeed'), 'Blue');
    $indexAdmin->addInfoBoxLine(_AM_SPEEDTEST_ADMIN_COUNTS, "<label>"._AM_SPEEDTEST_ADMIN_MINIMUM_DOWNSPEED."</label>", $speed_handler->getMinimum('downspeed'), 'Red');
    $indexAdmin->addInfoBoxLine(_AM_SPEEDTEST_ADMIN_COUNTS, "<label>"._AM_SPEEDTEST_ADMIN_AVERAGE_DOWNSPEED."</label>", $speed_handler->getAverage('downspeed'), 'Orange');
    $indexAdmin->addInfoBoxLine(_AM_SPEEDTEST_ADMIN_COUNTS, "<label>"._AM_SPEEDTEST_ADMIN_MAXIMUM_UPSPEED."</label>", $speed_handler->getMaximum('upspeed'), 'Blue');
    $indexAdmin->addInfoBoxLine(_AM_SPEEDTEST_ADMIN_COUNTS, "<label>"._AM_SPEEDTEST_ADMIN_MINIMUM_UPSPEED."</label>", $speed_handler->getMinimum('upspeed'), 'Red');
    $indexAdmin->addInfoBoxLine(_AM_SPEEDTEST_ADMIN_COUNTS, "<label>"._AM_SPEEDTEST_ADMIN_AVERAGE_UPSPEED."</label>", $speed_handler->getAverage('upspeed'), 'Orange');
    
    echo $indexAdmin->renderIndex();
	speedtest_footer_adminMenu();
	xoops_cp_footer();	

?>