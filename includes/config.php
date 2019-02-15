<?php
/**
 * config_inc.php stores site-wide configuration settings & file references
 * 
 * @author Esteban Silva comsat61@gmail.com
 * @author Jeneva Scherr j3j3sherr@yahoo.com
 * @author Thom Harrrington thomas.harrington@seattlecentral.edu
 * @author Yonatan Gebreyesus yonatangebreyesus@gmail.com
 * @version 1.0 2019-02-14
 * @license https://www.apache.org/licenses/LICENSE-2.0 
 * @todo none
 *
 */

/*
 * START SETTINGS CONSTANTS & PATHS 
 */

$sub_folder = 'food';// If app installed in subfolder, place here.  name of folder, no leading or trailing forward or backslash
define('SECURE',true); // true forces secure connection, https, for all site pages
define('THIS_PAGE', basename($_SERVER['PHP_SELF'])); # Current page name, stripped of folder
date_default_timezone_set('America/Los_Angeles'); #sets default date/timezone for this website
setlocale(LC_MONETARY,"en_US.UTF-8"); // utf-8 standard; sets the number cast to correct currency format 
ob_start(); // buffers our page to be prevent header errors. Call before INC files or ANY html!

/*
 * force secure website
 */ 

if (SECURE && $_SERVER['SERVER_PORT'] != 443) {#redirect to force HTTPS
	header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}else{//add protocol to virtual path
    $protocol = SECURE ? 'https://' : 'http://';
}

/*
 * END SETTINGS CONSTANTS & PATHS 
 */

?>