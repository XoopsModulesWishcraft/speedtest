<?php
###############################################################################
## Fancy Speed Test - Easily measure your upload and download speeds
## Home Page:   http://www.brandonchecketts.com/speedtest/
## Author:      Brandon Checketts
## File:        download.php
## Version:     1.0
## Date:        2006-02-06
## Purpose:     Download the data, display graphs that move as the download
##              progresses.  Use JavaScript to get the dynamic content.
###############################################################################

require(dirname(__FILE__)."/include/common.php");
ReadConfig(dirname(__FILE__)."/speedtest.cfg");


## Make sure this user is allowed to use the test
$remote_addr = speedtest_getIP();
$disallow = $config->{'general'}->{'disallow'};
$allow = $config->{'general'}->{'allow'};
if( $allow && (! preg_match("/$allow/",$remote_addr)) ) {
    $xoopsOption['template_main'] = 'speedtest_unallowed.html';
	include($GLOBALS['xoops']->path('/header.php'));
	$GLOBALS['xoopsTpl']->assign('php_self', $_SERVER['PHP_SELF']);
	if (strlen($config->{'general'}->{'page_title'})>0)
	{
		$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', $config->{'general'}->{'page_title'});
	}
	include($GLOBALS['xoops']->path('/footer.php'));
    exit;
} elseif( $disallow && preg_match("/$disallow/", $remote_addr) ) {
    $xoopsOption['template_main'] = 'speedtest_unallowed.html';
	include($GLOBALS['xoops']->path('/header.php'));
	$GLOBALS['xoopsTpl']->assign('php_self', $_SERVER['PHP_SELF']);
	if (strlen($config->{'general'}->{'page_title'})>0)
	{
		$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', $config->{'general'}->{'page_title'});
	}
	include($GLOBALS['xoops']->path('/footer.php'));
    exit;
}



## Figure out how many bytes to download/upload depending on if we are using
## auto_size or not.  If using auto_size, then determine sizes based
## on initial results
$config_auto_size = $config->{'general'}->{'auto_size'};
if($config_auto_size) {
    ## We're using the auto_size functionality
    if( isset($_GET['auto_size']) && $_GET['auto_size']) {
        ## Intial test is done.  Set down/upload sizes to the same as
        ## our initial measured speeds.   That way the test should take
        ## about 8 seconds for each test (up/down) making it about a 
        ## 16 second test
        $down_kbytes = $_GET['downspeed'];
        $up_kbytes = $_GET['upspeed'];
    } else {
        ## Initial test using auto_size
        $down_kbytes = $config->{'download'}->{'initial_kbytes'};
        $up_kbytes = $config->{'upload'}->{'initial_kbytes'};
   } 
} else {
    ## auto_size is off.  Just to the default sizes
    $down_kbytes = $config->{'download'}->{'default_kbytes'};
    $up_kbytes = $config->{'upload'}->{'default_kbytes'};
}


## Make sure sizes are below our configured limits
if($down_kbytes > $config->{'download'}->{'max_kbytes'}) {
    $down_kbytes = $config->{'download'}->{'max_kbytes'};
}
if($up_kbytes > $config->{'upload'}->{'max_kbytes'}) {
    $up_kbytes = $config->{'upload'}->{'max_kbytes'};
}

if($config->{'upload'}->{'skip_upload'}) {
    $up_kbytes = 0;
}

## Calculate number of loops for up/down, etc
$each_chunk = 50;
$progress_bar_width="400";
$reloads = $down_kbytes / $each_chunk;
$increment = $progress_bar_width / $reloads;
$download_progress_bar_increment = $increment;

$reloads = $up_kbytes / $each_chunk;
$increment = $progress_bar_width / $reloads;
$upload_progress_bar_increment = $increment / 5;


$pretty_version = $config->{'general'}->{'pretty_version'};

if( ($config_auto_size) && (! isset($_GET['auto_size'])) ) {  
    ## auto_size is performing the initial, small test
    $xoopsOption['template_main'] = 'speedtest_auto_size.html';
    include($GLOBALS['xoops']->path('/header.php'));
	$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL.'/modules/speedtest/language/'.$GLOBALS['xoopsConfig']['language'].'/style.css', array('type'=>'text/css'));
	$GLOBALS['xoopsTpl']->assign('php_self', $_SERVER['PHP_SELF']);
	$GLOBALS['xoopsTpl']->assign('xoConfig', $xoConfig);
	if (strlen($config->{'general'}->{'page_title'})>0)
	{
		$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', $config->{'general'}->{'page_title'});
	}
    ob_flush(); 
} else {
	$xoopsOption['template_main'] = 'speedtest_download.html';
	include($GLOBALS['xoops']->path('/header.php'));
	$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL.'/modules/speedtest/language/'.$GLOBALS['xoopsConfig']['language'].'/style.css', array('type'=>'text/css'));
	$GLOBALS['xoopsTpl']->assign('php_self', $_SERVER['PHP_SELF']);
	$GLOBALS['xoopsTpl']->assign('xoConfig', $xoConfig);
	if (strlen($config->{'general'}->{'page_title'})>0)
	{
		$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', $config->{'general'}->{'page_title'});
	}
	$GLOBALS['xoopsTpl']->assign('progress_bar_width', $progress_bar_width);
	$GLOBALS['xoopsTpl']->assign('up_kbytes', $up_kbytes);
	$GLOBALS['xoopsTpl']->assign('down_kbytes', $down_kbytes);
	$GLOBALS['xoopsTpl']->assign('upload_url', $config->{'general'}->{'upload_url'});
	
}

$GLOBALS['xoTheme']->addScript('', array('language'=>'javascript'), "function StartUpload() {
    uploadDiv = document.getElementById('upload_message');
    if(uploadDiv) {
        uploadDiv.style.visibility='visible';
        uploadDiv.style.display='block';
".(($pretty_version)?'
        setInterval("IncrementUploadBar()",200);
':'')."
    }
}

download_bar_current_width=0;

function IncrementDownloadBar() {
    download_barElement = document.getElementById('download_bar');
    if(download_barElement) {
        download_bar_current_width += ".$download_progress_bar_increment."
        if(download_bar_current_width <= ". $progress_bar_width . ") {
            download_barElement.style.width = download_bar_current_width +\"px\";
        }
    }
}

upload_bar_current_width=0;
function IncrementUploadBar() {
    upload_barElement = document.getElementById('upload_bar');
    if(upload_barElement) {
        upload_bar_current_width += ". $upload_progress_bar_increment.";
        if(upload_bar_current_width < ".$progress_bar_width.") {
            upload_barElement.style.width = upload_bar_current_width +\"px\";
        }
    }
}

function CompleteDownloadBar() {
    download_barElement = document.getElementById('download_bar');
    if(download_barElement) {
        download_barElement.style.width = \"100%\";
    }
}");
	

include($GLOBALS['xoops']->path('/footer.php')); 

?>
<script language="javascript">
<!--
dataElement = document.getElementById('upload_data');

<?php /* Start the timer */ ?>
time      = new Date();
starttime = time.getTime();

<?php

if($pretty_version) {
	print "
//-->
</script>
";
}

	## Read some stuff from our payload file
	$data_file = dirname(__FILE__)."/js/payload.js";
	$fd = fopen ($data_file, "r");
	$data = fread ($fd, $each_chunk * 1024);
	
	## Download $extra_down_kbytes first as junk
	$extra_down_kbytes = $down_kbytes - $up_kbytes;
	$total_kbytes = 0;
	while($total_kbytes <= $extra_down_kbytes) {
		if($pretty_version) {
			print "
<script language=\"javascript\">
<!--
dataElement.value=\"$data\";
IncrementDownloadBar();
//-->
</script>
";
        } else {
            print "dataElement.value=\"$data\";\n";
        }
        $total_kbytes += $each_chunk;
    }
    if(!$pretty_version) {
        print "dataElement.value=\"$data\";";
        print "CompleteDownloadBar();\n";
    } else {
        print "
<script language=\"javascript\">
<!--
//-->
</script>
        ";
    }

    ## Now, download the remaining bytes ($up_kbytes)  and save it into a
    ## form variable that we will post back to test the upload speed
    while($total_kbytes <= $down_kbytes) {
        if($pretty_version) {
        print "
<script language=\"javascript\">
<!--
dataElement.value = dataElement.value + \"$data\";
IncrementDownloadBar();
//-->
</script>
";
        } else {
            print "dataElement.value = dataElement.value + \"$data\";\n";
        }
        $total_kbytes += $each_chunk;
    }

    if(!$pretty_version) {
        #print "\";";
    } else {
        print "
<script language=\"javascript\">
<!--
";
    }
?>
    CompleteDownloadBar();

	time          = new Date();
	endtime       = time.getTime();
	if (endtime == starttime)
		{downloadtime = 0
	} else {
	    downloadtime = (endtime - starttime)/1000;
	}
    <?php if(! $config->{'upload'}->{'skip_upload'}){ ?> StartUpload(); <?php } ?>

	down_size = <?php echo $total_kbytes; ?>;
	downspeed     = down_size/downloadtime;
	downspeed          = (Math.round((downspeed*8)*10*1.024))/10;

    formElement = document.getElementById('upload_test_form');

<?php 
if($config_auto_size && (! isset($_GET['auto_size'])) ) {
    $params_auto_size = "&auto_size=1";
} else {
    $params_auto_size = "";
}
if($config->{'upload'}->{'skip_upload'} && (! $params_auto_size)) {
    $next_url = $config->{'general'}->{'base_url'}."results.php";
} else {
    $next_url = $config->{'general'}->{'upload_url'};
}

?>
    formElement.action = '<?php echo $next_url; ?>?downspeed=' + downspeed + '&downtime=' + downloadtime + '&downsize=' + down_size + '<?php echo $params_auto_size; ?>';

    document.forms["upload_test"].submit();

// -->
</script>