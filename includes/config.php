<?php
/**
 * config_inc.php stores site-wide configuration settings, functions & file references
 * 
 * Stores configuration data like support email address, SUPPORT_EMAIL
 * and functions like my_error_handler() which over-rides the default error handler of PHP.
 *
 * There are references to include files common_inc.php, which stores utility functions 
 * and credentials_inc.php which stores database credentials 
 *
 * Comments below here all needd to be updated
 * @package nmCommon
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 2.3 2015/07/06 
 * @link http://www.newmanix.com/ 
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @see common_inc.php
 * @see credentials_inc.php
 * @see custom_inc.php  
 * @todo none
 */
# START SETTINGS (show or hide page errors, turn on/off error logging)---------------------------------------------
$sub_folder = 'food';//If app installed in subfolder, place here.  name of folder, no leading or trailing forward or backslash
define('SECURE',true); # true forces secure connection, https, for all site pages
date_default_timezone_set('America/Los_Angeles'); #sets default date/timezone for this website
setlocale(LC_MONETARY,"en_US.UTF-8"); // utf-8 standard; sets the number cast to correct currency format 

# END SETTINGS (show or hide page errors, turn on/off error logging)-----------------------------------------------  
 
# START SETTINGS (php.ini overrides & other enviroment settings)---------------------------------------------------------
ob_start();  #buffers our page to be prevent header errors. Call before INC files or ANY html!

//force secure website
if (SECURE && $_SERVER['SERVER_PORT'] != 443) {#redirect to force HTTPS
	header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}else{//add protocol to virtual path
    $protocol = SECURE ? 'https://' : 'http://';
}
# END SETTINGS (php.ini overrides & other enviroment settings)------------------------------------------------------------ 

# START CONSTANTS & PATHS (universal file paths & values)-----------------------------------------------------------------
/* automatic path settings - use the following 4 path settings for placing all code in one application folder */ 
define('THIS_PAGE', basename($_SERVER['PHP_SELF'])); # Current page name, stripped of folder info - (saves resources)
# END CONSTANTS & PATHS (universal file paths & values)--------------------------------------------------------------------
?>