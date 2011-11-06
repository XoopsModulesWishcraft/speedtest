<?php
	
	include('header.php');
		
	xoops_loadLanguage('admin', 'speedtest');
	
	xoops_cp_header();
	
	$op = isset($_REQUEST['op'])?$_REQUEST['op']:"campaign";
	$fct = isset($_REQUEST['fct'])?$_REQUEST['fct']:"list";
	$limit = !empty($_REQUEST['limit'])?intval($_REQUEST['limit']):30;
	$start = !empty($_REQUEST['start'])?intval($_REQUEST['start']):0;
	$order = !empty($_REQUEST['order'])?$_REQUEST['order']:'DESC';
	$sort = !empty($_REQUEST['sort'])?''.$_REQUEST['sort'].'':'timestamp';
	$filter = !empty($_REQUEST['filter'])?''.$_REQUEST['filter'].'':'1,1';
	
	switch($op) {
		default:
		case "results":	
			switch ($fct)
			{
				default:
				case "results":				
					speedtest_adminMenu(1);
					
					include_once $GLOBALS['xoops']->path( "/class/pagenav.php" );
					include_once $GLOBALS['xoops']->path( "/class/template.php" );
					$GLOBALS['sptestTpl'] = new XoopsTpl();
					
					$speedtest_handler =& xoops_getmodulehandler('speedtest', 'speedtest');

					$criteria = $speedtest_handler->getFilterCriteria($filter);
					$ttl = $speedtest_handler->getCount($criteria);
					$sort = !empty($_REQUEST['sort'])?''.$_REQUEST['sort'].'':'timestamp';
					
					$pagenav = new XoopsPageNav($ttl, $limit, $start, 'start', 'limit='.$limit.'&sort='.$sort.'&order='.$order.'&op='.$op.'&fct='.$fct.'&filter='.$filter.'&fct='.$fct.'&filter='.$filter);
					$GLOBALS['sptestTpl']->assign('pagenav', $pagenav->renderNav());
			
					foreach (array('timestamp','ip','ip_string','id','uid','downspeed','upspeed') as $id => $key) {
						$GLOBALS['sptestTpl']->assign(strtolower(str_replace('-','_',$key).'_th'), '<a href="'.$_SERVER['PHP_SELF'].'?start='.$start.'&limit='.$limit.'&sort='.str_replace('_','-',$key).'&order='.((str_replace('_','-',$key)==$sort)?($order=='DESC'?'ASC':'DESC'):$order).'&op='.$op.'&filter='.$filter.'">'.(defined('_AM_SPEEDTEST_TH_'.strtoupper(str_replace('-','_',$key)))?constant('_AM_SPEEDTEST_TH_'.strtoupper(str_replace('-','_',$key))):'_AM_SPEEDTEST_TH_'.strtoupper(str_replace('-','_',$key))).'</a>');
						$GLOBALS['sptestTpl']->assign('filter_'.strtolower(str_replace('-','_',$key)).'_th', $speedtest_handler->getFilterForm($filter, $key, $sort, $op, $fct));
					}
					
					$GLOBALS['sptestTpl']->assign('limit', $limit);
					$GLOBALS['sptestTpl']->assign('start', $start);
					$GLOBALS['sptestTpl']->assign('order', $order);
					$GLOBALS['sptestTpl']->assign('sort', $sort);
					$GLOBALS['sptestTpl']->assign('filter', $filter);
					$GLOBALS['sptestTpl']->assign('xoConfig', $GLOBALS['xoopsModuleConfig']);
										
					$criteria->setStart($start);
					$criteria->setLimit($limit);
					$criteria->setSort('`'.$sort.'`');
					$criteria->setOrder($order);
						
					$speedtests = $speedtest_handler->getObjects($criteria, true);
					foreach($speedtests as $cid => $speedtest) {
						$GLOBALS['sptestTpl']->append('speedtests', $speedtest->toArray());
					}
					$GLOBALS['sptestTpl']->assign('php_self', $_SERVER['PHP_SELF']);
					$GLOBALS['sptestTpl']->display('db:speedtest_cpanel_results.html');
					break;		
					
			}
	}
	
	speedtest_footer_adminMenu();
	xoops_cp_footer();
?>