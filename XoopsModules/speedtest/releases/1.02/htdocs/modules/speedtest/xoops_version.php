<?php
$modversion['name'] = _MI_SPEEDTEST_NAME;
$modversion['version'] = 1.02;
$modversion['releasedate'] = "Wednesday: December 7, 2011";
$modversion['description'] = _MI_SPEEDTEST_DESCRIPTION;
$modversion['author'] = "Wishcraft, mdagn (spraci.com)";
$modversion['credits'] = "Simon Roberts (simon@chronolabs.coop)";
$modversion['help'] = "speedtest.html";
$modversion['license'] = "GNU 2.0";
$modversion['official'] = 0;
$modversion['status']  = "Stable";
$modversion['image'] = "images/speedtest_slogo.png";
$modversion['dirname'] = _MI_SPEEDTEST_DIRNAME;

$modversion['dirmoduleadmin'] = 'Frameworks/moduleclasses';
$modversion['icons16'] = 'Frameworks/moduleclasses/icons/16';
$modversion['icons32'] = 'Frameworks/moduleclasses/icons/32';

$modversion['release_info'] = "Stable 2011/12/07";
$modversion['release_file'] = XOOPS_URL."/modules/profile/docs/changelog.txt";
$modversion['release_date'] = "2011/12/07";

$modversion['hasMain'] = 1;

$modversion['author_realname'] = "Simon Roberts";
$modversion['author_website_url'] = "http://www.chronolabs.coop";
$modversion['author_website_name'] = "Chronolabs Cooperative";
$modversion['author_email'] = "simon@chronolabs.coop";
$modversion['demo_site_url'] = "";
$modversion['demo_site_name'] = "";
$modversion['support_site_url'] = "";
$modversion['support_site_name'] = "Fibredyne";
$modversion['submit_bug'] = "";
$modversion['submit_feature'] = "";
$modversion['usenet_group'] = "sci.chronolabs";
$modversion['maillist_announcements'] = "";
$modversion['maillist_bugs'] = "";
$modversion['maillist_features'] = "";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/dashboard.php";
$modversion['adminmenu'] = "admin/menu.php";

// Main things
$modversion['hasMain'] = 1;

$modversion['onUpdate'] = "include/onupdate.php";
//$modversion['onInstall'] = "include/install.php";
$modversion['onUninstall'] = "include/onuninstall.php";

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// Tables created by sql file (without prefix!)
$i=0;
$modversion['tables'][$i++] = "speedtest";

// Templates
$i=0;
$i++;
$modversion['templates'][$i]['file'] = 'speedtest_cpanel_results.html';
$modversion['templates'][$i]['description'] = 'Main Control Panel Results Browser';
$i++;
$modversion['templates'][$i]['file'] = 'speedtest_auto_size.html';
$modversion['templates'][$i]['description'] = 'Main auto size notice';
$i++;
$modversion['templates'][$i]['file'] = 'speedtest_download.html';
$modversion['templates'][$i]['description'] = 'Main Download test';
$i++;
$modversion['templates'][$i]['file'] = 'speedtest_footer.html';
$modversion['templates'][$i]['description'] = 'Main Customisable footer';
$i++;
$modversion['templates'][$i]['file'] = 'speedtest_header.html';
$modversion['templates'][$i]['description'] = 'Main Customisable Header';
$i++;
$modversion['templates'][$i]['file'] = 'speedtest_index.html';
$modversion['templates'][$i]['description'] = 'Main Index';
$i++;
$modversion['templates'][$i]['file'] = 'speedtest_result.html';
$modversion['templates'][$i]['description'] = 'Main Results Display';
$i++;
$modversion['templates'][$i]['file'] = 'speedtest_unallowed.html';
$modversion['templates'][$i]['description'] = 'Main Unallowed Notice';
$i++;
$modversion['templates'][$i]['file'] = 'speedtest_welcome.html';
$modversion['templates'][$i]['description'] = 'Main Customisable Welcome Note';

$i = 0;

$i++;
$modversion['config'][$i]['name'] = 'general_base_url';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_BASE_URL";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_BASE_URL_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = XOOPS_URL.'/modules/speedtest';
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'general_upload_url';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_UPLOAD_URL";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_UPLOAD_URL_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = XOOPS_URL.'/modules/speedtest/upload.php';
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'general_image_path';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_IMAGE_PATH";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_IMAGE_PATH_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = XOOPS_URL.'/modules/speedtest/images/';
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'general_logfile';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_LOGFILE";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_LOGFILe_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = XOOPS_ROOT_PATH.'/uploads/speedtest.log';
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'general_debug';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_DEBUG";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_DEBUG_DESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = FALSE;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'general_auto_size';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_AUTO_SIZE";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_AUTO_SIZE_DESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = TRUE;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'general_pretty_version';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_PRETTY_VERSION";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_PRETTY_VERSION_DESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = TRUE;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'general_page_title';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_PAGE_TITLE";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_PAGE_TITLE_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = _MI_SPEEDTEST_NAME;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'general_auto_start';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_AUTO_START";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_AUTO_START_DESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = FALSE;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'general_allow';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_ALLOW";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_ALLOW_DESC";
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '';
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'general_disallow';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_DISALLOW";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_DISALLOW_DESC";
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '';
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'upload_max_kbytes';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_UPLOAD_MAX_KBYTES";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_UPLOAD_MAX_KBYTES_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 5000;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'upload_skip_upload';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_UPLOAD_SKIP_UPLOAD";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_UPLOAD_SKIP_UPLOAD_DESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = FALSE;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'upload_default_kbytes';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_UPLOAD_DEFAULT_KBYTES";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_UPLOAD_DEFAULT_KBYTES_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 2000;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'upload_initial_kbytes';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_UPLOAD_INITIAL_KBYTES";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_UPLOAD_INITIAL_KBYTES_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 10;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'download_max_kbytes';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_DOWNLOAD_MAX_KBYTES";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_DOWNLOAD_MAX_KBYTES_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 4000;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'download_default_kbytes';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_DOWNLOAD_DEFAULT_KBYTES";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_DOWNLOAD_DEFAULT_KBYTES_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 4000;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'download_initial_kbytes';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_DOWNLOAD_INTIAL_KBYTES";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_DOWNLOAD_INTIAL_KBYTES_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 50;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'database_xoopsobj';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_DATABASE_XOOPSOBJ";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_DATABASE_XOOPSOBJ_DESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = TRUE;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'database_enable';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_DATABASE_ENABLED";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_DATABASE_ENABLED_DESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = FALSE;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'database_ip_matches';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_DATABASE_IP_MATCH";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_DATABASE_IP_MATCH_DESC";
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '';
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'comparisons_download_typical_dialup';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_TYPICAL_DIALUP";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_TYPICAL_DIALUP_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 28;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'comparisons_download_best_case_dialup';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_BEST_CASE_DIALUP";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_BEST_CASE_DIALUP_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 56;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'comparisons_download_standard_dsl';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_STANDARD_DSL";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_STANDARD_DSL_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 256;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'comparisons_download_t1';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_T1";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_T1_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1581;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'comparisons_download_cable';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_CABLE";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_CABLE_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 3072;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'comparisons_download_ethernet';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_ETHERNET";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_COMPARISONS_DOWNLOAD_ETHERNET_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 10240;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'comparisons_upload_typical_dialup';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_COMPARISONS_UPLOAD_TYPICAL_DIALUP";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_COMPARISONS_UPLOAD_TYPICAL_DIALUP_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 28;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'comparisons_upload_best_case_dialup';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_COMPARISONS_UPLOAD_BEST_CASE_DIALUP";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_COMPARISONS_UPLOAD_BEST_CASE_DIALUP_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 38;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'comparisons_upload_standard_dsl';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_COMPARISONS_UPLOAD_STANDARD_DSL";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_COMPARISONS_UPLOAD_STANDARD_DSL_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 256;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'comparisons_upload_t1';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_COMPARISONS_UPLOAD_T1";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_COMPARISONS_UPLOAD_T1_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1581;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'comparisons_upload_cable';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_COMPARISONS_UPLOAD_CABLE";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_COMPARISONS_UPLOAD_CABLE_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 384;
$modversion['config'][$i]['options'] = array();

$i++;
$modversion['config'][$i]['name'] = 'comparisons_upload_ethernet';
$modversion['config'][$i]['title'] = "_MI_SPEEDTEST_COMPARISONS_UPLOAD_ETHERNET";
$modversion['config'][$i]['description'] = "_MI_SPEEDTEST_COMPARISONS_UPLOAD_ETHERNET_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 10240;
$modversion['config'][$i]['options'] = array();
?>
