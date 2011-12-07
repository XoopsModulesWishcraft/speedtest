<?php
###############################################################################
## Fancy Speed Test - Easily measure your upload and download speeds
## Home Page:   http://www.brandonchecketts.com/speedtest/
## Author:      Brandon Checketts
## File:        common.php
## Version:     1.1
## Date:        2006-02-06
## Purpose:     Common functions for this application
###############################################################################

require(dirname(dirname(dirname(dirname(__FILE__))))."/mainfile.php");

## Read through the config file and assign items to the global $config variable
function ReadConfig($config_file) {
    global $config;
    $lines = file($config_file);
    foreach ($lines as $line_num => $line) {
        $line = rtrim(preg_replace("/#.*/","",$line));
        if(preg_match("/\[.*\]/", $line, $parts)) {
            $section = $parts[0];
            $section = preg_replace("/[\[\]]/","",$section);
        } elseif (preg_match("/=/",$line)) {
            list($var,$value) = split('=',$line);
            $var = preg_replace('/ $/','',$var);
            $value = preg_replace('/^ +/','',$value);
       		$config->{$section}->{$var} = $value;		
        }
    }
}

function OutputConfig($config_file_template, $config_file) {
	
	$module_handler = xoops_gethandler('module');
	$config_handler = xoops_gethandler('config');
	$mod = $module_handler->getByDirname('speedtest');
	$modConfig = $config_handler->getConfigList($mod->getVar('mid'));  

	if (file_exists($config_file)) {
		unlink($config_file);
	}
	
	$out=fopen($config_file,"w");
    $lines = file($config_file_template);
    foreach ($lines as $line_num => $line) {
        if(preg_match("/\[.*\]/", $line, $parts)) {
            $section = $parts[0];
            $section = preg_replace("/[\[\]]/","",$section);
            fwrite($out,$line);
        } elseif (preg_match("/=/",$line)) {
            list($var,$value) = split('=',$line);
            $var = preg_replace('/ $/','',$var);
            $value = preg_replace('/^ +/','',$value);
            switch (trim($value)) {
            	case '{INTERNAL}':
            		fwrite($out,str_replace('{INTERNAL}', $modConfig[substr(str_replace(array(' ', '-'), '_', strtolower($section)).'_'.str_replace(array(' ', '-'), '_', strtolower($var)),0,25)], $line));
            		break;
            	default:
            		fwrite($out,$line);		
            		break;
            }
        } else {
        	fwrite($out,$line);
        }
    }
    fclose($out);
}

## Write to log if debugging is on
function Debug($message) {
    global $config;
    if($config->{'general'}->{'debug'}) {
        BCLog($message);
    }
}

## Write to the log file
function BCLog($message) {
    global $config;
    $logfile = $config->{'general'}->{'logfile'};
    if(! $logfile) {
        return;
    }
    $timestamp = date("Y z H:i:s");

    $LOG=fopen($logfile,"a");
    $string="$timestamp $message\n";
    fwrite($LOG,$string);
    fclose($LOG);
}

function CleanSpeed($kbps) {
    if($kbps > 1024)   {
        $cleanspeed = round($kbps / 1024,2) . " Mbps";
    } else {
        $cleanspeed = round($kbps,2). " kbps";
    }
    return $cleanspeed;
}

if (!function_exists('speedtest_getFilterElement')) {
	function speedtest_getFilterElement($filter, $field, $sort='created', $op = '', $fct = '') {
		$components = speedtest_getFilterURLComponents($filter, $field, $sort);
		$ele = false;
		include_once('formobjects.speedtest.php');
		switch ($field) {
		    case 'ip':
		    case 'ip_string':
		    case 'downspeed':
		    case 'upspeed':
		    	$ele = new XoopsFormElementTray('');
				$ele->addElement(new XoopsFormText('', 'filter_'.$field.'', 11, 40, $components['value']));
				$button = new XoopsFormButton('', 'button_'.$field.'', '[+]');
		    	$button->setExtra('onclick="window.open(\''.$_SERVER['PHP_SELF'].'?'.$components['extra'].'&filter='.$components['filter'].(!empty($components['filter'])?'|':'').$field.',\'+$(\'#filter_'.$field.'\').val()'.(!empty($components['operator'])?'+\','.$components['operator'].'\'':'').',\'_self\')"');
		    	$ele->addElement($button);
		    	break;
		}
		return $ele;
	}
}

if (!function_exists('speedtest_getFilterURLComponents')) {
	function speedtest_getFilterURLComponents($filter, $field, $sort='created') {
		$parts = explode('|', $filter);
		$ret = array();
		$value = '';
		$ele_value = '';
		$operator = '';
    	foreach($parts as $part) {
    		$var = explode(',', $part);
    		if (count($var)>1) {
	    		if ($var[0]==$field) {
	    			$ele_value = $var[1];
	    			if (isset($var[2]))
	    				$operator = $var[2];
	    		} elseif ($var[0]!=1) {
	    			$ret[] = implode(',', $var);
	    		}
    		}
    	}
    	$pagenav = array();
    	$pagenav['op'] = isset($_REQUEST['op'])?$_REQUEST['op']:"speedtest";
		$pagenav['fct'] = isset($_REQUEST['fct'])?$_REQUEST['fct']:"list";
		$pagenav['limit'] = !empty($_REQUEST['limit'])?intval($_REQUEST['limit']):30;
		$pagenav['start'] = 0;
		$pagenav['order'] = !empty($_REQUEST['order'])?$_REQUEST['order']:'DESC';
		$pagenav['sort'] = !empty($_REQUEST['sort'])?''.$_REQUEST['sort'].'':$sort;
    	$retb = array();
		foreach($pagenav as $key=>$value) {
			$retb[] = "$key=$value";
		}
		return array('value'=>$ele_value, 'field'=>$field, 'operator'=>$operator, 'filter'=>implode('|', $ret), 'extra'=>implode('&', $retb));
	}
}

if (!function_exists("speedtest_adminMenu")) {
  function speedtest_adminMenu ($page, $currentoption = 0)  {
		$module_handler = xoops_gethandler('module');
		$xoModule = $module_handler->getByDirname('speedtest');

	  /* Nice buttons styles */
	    echo "
    	<style type='text/css'>
		#form {float:left; width:100%; background: #e7e7e7 url('" . XOOPS_URL . "/modules/".$xoModule->getVar('dirname')."/images/bg.gif') repeat-x left bottom; font-size:93%; line-height:normal; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;}
		    	#buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0; }
    	#buttonbar { float:left; width:100%; background: #e7e7e7 url('" . XOOPS_URL . "/modules/".$xoModule->getVar('dirname')."/images/bg.gif') repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 0px; border-bottom: 1px solid black; }
    	#buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }
		  #buttonbar li { display:inline; margin:0; padding:0; }
		  #buttonbar a { float:left; background:url('" . XOOPS_URL . "/modules/".$xoModule->getVar('dirname')."/images/left_both.gif') no-repeat left top; margin:0; padding:0 0 0 9px;  text-decoration:none; }
		  #buttonbar a span { float:left; display:block; background:url('" . XOOPS_URL . "/modules/".$xoModule->getVar('dirname')."/images/right_both.gif') no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }
		  /* Commented Backslash Hack hides rule from IE5-Mac \*/
		  #buttonbar a span {float:none;}
		  /* End IE5-Mac hack */
		  #buttonbar a:hover span { color:#333; }
		  #buttonbar #current a { background-position:0 -150px; border-width:0; }
		  #buttonbar #current a span { background-position:100% -150px; padding-bottom:5px; color:#333; }
		  #buttonbar a:hover { background-position:0% -150px; }
		  #buttonbar a:hover span { background-position:100% -150px; }
		  </style>";
	
	   // global $xoopsDB, $xoModule, $xoopsConfig, $xoModuleConfig;
	
	   $myts = &MyTextSanitizer::getInstance();
	
	   $tblColors = Array();
		// $adminmenu=array();
	   if (file_exists(XOOPS_ROOT_PATH . '/modules/'.$xoModule->getVar('dirname').'/language/' . $GLOBALS['xoopsConfig']['language'] . '/modinfo.php')) {
		   include_once XOOPS_ROOT_PATH . '/modules/'.$xoModule->getVar('dirname').'/language/' . $GLOBALS['xoopsConfig']['language'] . '/modinfo.php';
	   } else {
		   include_once XOOPS_ROOT_PATH . '/modules/'.$xoModule->getVar('dirname').'/language/english/modinfo.php';
	   }
       
	   include XOOPS_ROOT_PATH . '/modules/'.$xoModule->getVar('dirname').'/admin/menu.php';
	   global $adminmenu;
	   echo "<table width=\"100%\" border='0'><tr><td>";
	   echo "<div id='buttontop'>";
	   echo "<table style=\"width: 100%; padding: 0; \" cellspacing=\"0\"><tr>";
	   echo "<td style=\"width: 45%; font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;\"><a class=\"nobutton\" href=\"".XOOPS_URL."/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=" . $xoModule->getVar('mid') . "\">" . _PREFERENCES . "</a></td>";
	   echo "<td style='font-size: 10px; text-align: right; color: #2F5376; padding: 0 6px; line-height: 18px;'><b>" . $myts->displayTarea($xoModule->name()) ."</td>";
	   echo "</tr></table>";
	   echo "</div>";
	   echo "<div id='buttonbar'>";
	   echo "<ul>";
		 foreach ($adminmenu as $key => $value) {
		   $tblColors[$key] = '';
		   $tblColors[$currentoption] = 'current';
	     echo "<li id='" . $tblColors[$key] . "'><a href=\"" . XOOPS_URL . "/modules/".$xoModule->getVar('dirname')."/".$value['link']."\"><span>" . $value['title'] . "</span></a></li>";
		 }
		 
	   echo "</ul></div>";
	   echo "</td></tr>";
	   echo "<tr><td><div id='navigation' style=\"clear:both;height:48px;\">";
		$indexAdmin = new ModuleAdmin();
		echo $indexAdmin->addNavigation($page);
		echo "</div></td></tr>";
	   echo "<tr'><td><div id='form'>";
    
  }
  
  function speedtest_footer_adminMenu()
  {
  		echo "<div align=\"center\"><a href=\"http://www.xoops.org\" target=\"_blank\"><img src=" . XOOPS_URL . '/' . $GLOBALS['speedtestModule']->getInfo('icons32') . '/xoopsmicrobutton.gif'.' '." alt='XOOPS' title='XOOPS'></a></div>";
		echo "<div class='center smallsmall italic pad5'><strong>" . $GLOBALS['speedtestModule']->getVar("name") . "</strong> is maintained by the <a class='tooltip' rel='external' href='http://www.xoops.org/' title='Visit XOOPS Community'>XOOPS Community</a> and <a class='tooltip' rel='external' href='http://www.chronolabs.coop/' title='Visit Chronolabs Co-op'>Chronolabs Co-op</a></div>";
		echo "</div></td></tr>";
  		echo "</table>";
  }
}

?>
