<?php 
	define('APP_NAME', 'sandlow');
    define('APP_DEBUG',true);
    $url = $_SERVER['SCRIPT_NAME'];
    define('WEB_PATH',substr($url,0,strrpos($url , '/')));
    define('CURRENT_URL',$_SERVER['PHP_SELF']);
    require( "./ThinkPHP/ThinkPHP.php");
?>
