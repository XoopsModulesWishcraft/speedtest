<?php
/*
 #!/usr/bin/php 
 if running this as cgi put the shebang line as the first line (before the php open tag) and make sure it points to php on your system 
*/

###############################################################################
## Fancy Speed Test - Easily measure your upload and download speeds
## Home Page:   http://www.brandonchecketts.com/speedtest/
## Author:      Brandon Checketts
## File:        upload.cgi
## Version:     1.1
## Date:        2006-02-06
## Purpose:     Time the upload progress, forward to results.php (or back to
##              download.php if using auto_size)
###############################################################################



ini_set('allow_url_fopen', true);
ini_set('allow_url_includ', true);
ini_set('always_populate_post_data', true);

## Make sure we read in the config file
$config = ReadConfig(dirname(__FILE__)."/speedtest.cfg");
if(sizeof($config) < 1) DieNicely($config,"Unable to read configuration settings");
//print_r($config);
//exit;
## This is what PHP can't do .......
//my $content_length = $ENV{'CONTENT_LENGTH'} ? $ENV{'CONTENT_LENGTH'} : 1;
// if php running under mod_php doesn't return this correctly in $_SERVER you might need to run this as a cgi! (if you do make sure there is a shebang line at the start)

$contentlength = getenv('CONTENT_LENGTH');
if (!$contentlength && isset($_SERVER['CONTENT_LENGTH'])) $contentlength = $_SERVER['CONTENT_LENGTH'];

## Start the timer
Debug($config,"Starting to read");
Debug($config,"len is $contentlength");
$t0 = microtime(true);
//$t0 = [gettimeofday];

ob_start();

print $t0 . '|';
## Read all of the STDIN (HTTP POST data)
$bytes_read = 0;

$fp = fopen('php://input', 'r');
while($line = fgets($fp, 4096)) { 
	$bytes_read = $bytes_read + strlen($line); 
}
       
## Stop the timer
$t1 = microtime(true);
Debug($config,"Done reading");
Debug($config,"Start Time: ".$t0);
Debug($config,"End Time: ".$t1); 


## Calculate the speed
$elapsed = sprintf("%.2f",tv_interval ( $t0, $t1 ));

$upload_speed = '';
if($elapsed != 0) {
    $upload_speed = sprintf("%.2f",$bytes_read / $elapsed * 8 / 1024);
} else {
    $upload_speed="undefined";
}
$uploadsize = $bytes_read / 1024;

Debug($config,"\$upload_size is $uploadsize");
Debug($config,"\$bytes_read is $bytes_read");
Debug($config,"\$elapsed is $elapsed");
Debug($config,"\$upload_speed is $upload_speed");


## If we're using auto_size, then forward back to download.php with the
## speed values from out initial test.  
## Otherwise forward to result.php to display the results

$url = '';

if (isset($_SERVER['QUERY_STRING'])) { $querystring = $_SERVER['QUERY_STRING']; }
else { $querystring = getenv('QUERY_STRING'); }

if(strstr($querystring,'auto_size=1')) {
    $url = $config['general']['base_url'] . "download.php?".$querystring."&uptime=$elapsed&upsize=$uploadsize&upspeed=$upload_speed";
} else {
    $url = $config['general']['base_url'] . "results.php?".$querystring."&uploadtime=$elapsed&uploadsize=$uploadsize&upspeed=$upload_speed";
}

writeLog($config,"Redirecting to $url");
if (isset($_SERVER)) {
header("Location: $url");
} else {
 echo "Location: $url\n\n";
}
ob_flush();



## My standard Log() function
function writeLog($config,$message) {
    $logfile = $config['general']['logfile'];
    if(!$logfile) return;

// ($sec,$min,$hour, my $year, my $jdate)=(localtime())[0,1,2,5,7];

    $time = time();
    $sec = date('s',$time);
    $min = date('i',$time);
    $hour = date('h',$time);
    $year = date('Y',$time);
    $jdate = date('z',$time);
    if($sec < 10) {
        $sec="0$sec";
    }
    if($min < 10) {
        $min="0$min";
    }
    if($hour < 10) {
        $hour="0$hour";
    }

    if($jdate < 100) {
        if($jdate < 10) {
            $jdate="0$jdate";
        }
        $jdate="0$jdate";
    }

    if($jdate == "365" || ($jdate == "364" && ($year % 4 == 0))) {
        $jdate++;
    }
    if (!$fh = fopen($logfile,'a')) {
        DieNicely($config,"Couldn't open $logfile");
    }
    $str = "$year $jdate $hour:$min:$sec $message\n";
    fwrite($fh,$str,strlen($str));
    fclose($fh);
}

## Display a nice error message if we have to die
function DieNicely($config,$message) {
    header("Content-type: text/html");
    echo "<h1>A critical error occurred: $message</h1>\n";
    writeLog($config,"Dying: $message");
    exit(1);
}

## Debug to the log file if the config file says to
function Debug($config,$parms) {
    if(isset($config['general']['debug']) && $config['general']['debug']) {
        writeLog($config,$parms);
    }
}

function tv_interval($t0,$t1) {

    return $t1 - $t0;
}

## Read in the configuration file into our $config variable
function ReadConfig($config_file) {
// line by line translation from perl
    $config = array();
    $data = array();
    if (!$data = file($config_file)) {
        DieNicely("Unable to read configuration file: $config_file\n\n");
    }
    $section = '';
    foreach ($data AS $line) {
        $line = preg_replace('/\n$/','',$line); //  php doesn't have chomp() - so strippng trailing newlines with regex
//        s/\r//g;        ## Remove DOS EOL Symbols - pcre regex \n should match these too
        $line = preg_replace('/\n$/','',$line); //  php doesn't have chomp() - so strippng trailing newlines with regex
        $line = preg_replace('/\#.*/','',$line); // s/\#.*//g;      ## Remove comments
        if (!$line) continue;

        if (substr($line,0,1) == "[") {
            $section = $line;
            $section = str_replace('[','',$section); // s/\[//g;
            $section = str_replace(']','',$section); // $section =~ s/\]//g;
            continue; // next
        }
        if (!strstr($line,'=')) continue;
        
        if ($section) {
            list ($item,$value) = explode('=',$line);
            ## Remove un-necessary spaces
            $item = preg_replace('/ +$/','',$item); // remove trailing spaces
            $value = preg_replace('/^ +/','',$value); //  remove leading spaces
            $config[$section][$item] = $value;
        }
    }
    return $config;
}

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

