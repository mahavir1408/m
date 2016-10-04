<?php
// NOTE: all cache times are in minutes.
$host = $_SERVER['HTTP_HOST'];	
switch($host)
{
  case 'local.m1.com':
    define('ENV_NAME','local');
    define('ERROR_LEVEL',E_ALL);
    define('SITENAME','localize.com');
    define('SITEURL','http://local.localize.com/');
    define('BASEURL','http://local.localize.com/');	
    define('HTDOCS_PATH','C:\\wamp\\www\\localize');	
    define('INCLUDE_PATH',HTDOCS_PATH.';'.HTDOCS_PATH.'\\system;'.HTDOCS_PATH.'\\includes;');
    define('SYSTEM_FOLDER', HTDOCS_PATH.'\\system');
    define('APPLICATION_PATH',HTDOCS_PATH.'\\application');
    define('IMAGES_PATH',HTDOCS_PATH.'\\assets\\images');
    define('IMAGES_BASE_URL',SITEURL.'assets/images');
    //define('MAILPATH','C:\\wamp\\sendmail\\sendmail');            				
    define('PROFILER',FALSE);
    break;
  case 'local.m.com':
    define('ENV_NAME','local');
    define('ERROR_LEVEL',E_ALL);
    define('SITENAME','m.com');
    define('SITEURL','http://local.m.com/');
    define('BASEURL','http://local.m.com/');	
    define('HTDOCS_PATH','/Users/mahavirmunot/Sites/m');	
    define('INCLUDE_PATH',HTDOCS_PATH.';'.HTDOCS_PATH.'/system;'.HTDOCS_PATH.'/includes;');
    define('SYSTEM_FOLDER', HTDOCS_PATH.'/system');
    define('APPLICATION_PATH',HTDOCS_PATH.'/application');
    define('IMAGES_PATH',HTDOCS_PATH.'/assets/images');
    define('IMAGES_BASE_URL',SITEURL.'assets/images');
    //define('MAILPATH','C:\\wamp\\sendmail\\sendmail');            				
    define('PROFILER',FALSE);
    break;
}	 
ini_set('include_path',INCLUDE_PATH);
include("db_settings.php");