<?php

	session_start();

	if (isset($_SERVER["HTTP_HOST"])){
		$current_host=$_SERVER["HTTP_HOST"];	
	}else{
		$current_host="www.bubutrip.com.tw";
	}

	switch ($current_host) {
		case 'devbubu.jake.tw':
			define('DBHOST','192.168.1.12');
			define('ENVIRONMENT', 'development');
			break;
		case 'www.bubutrip.com.tw':
			define('DBHOST','localhost');
			define('ENVIRONMENT', 'production');
			break;
	}

	switch (ENVIRONMENT)
	{
		case 'development':
			error_reporting(-1);
			ini_set('display_errors', 1);
			error_reporting(E_ALL);
			error_reporting(E_ALL);
			ini_set('display_errors', 'On');
			define('Online',false);
		break;

		case 'testing':
		case 'production':
			ini_set('display_errors', 0);
			if (version_compare(PHP_VERSION, '5.3', '>='))
			{
				error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
			}
			else
			{
				error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
			}
			error_reporting(0);
			define('Online',true);
			error_reporting(0);
		break;

		default:
			header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
			echo 'The application environment is not set correctly.';
			exit(1); // EXIT_ERROR
	}

	if( Online ){
		include_once("../event_config_by_jake.php");
		require '../../inc/config.php';
		require PATH_INC.'/class_user.php';
		include_once("../dbconn.php");
		define('imgurl', 'http://az823916.vo.msecnd.net');
	}else{
		define( 'WEB_PROTOCOL', ( $_SERVER['SERVER_PORT'] == '443' || ( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO']=='https' ) ? 'https://' : 'http://') );
		define( 'URL_BASE',       	'' );
		define( 'WEB_ROOT',         WEB_PROTOCOL.$_SERVER['SERVER_NAME'].URL_BASE );
		define( 'FB_APPID',         '853302524700193' );
		define( 'FB_SECRET',        '4282553f36fb28178e30d51a79ea7007' );
	}

	include_once("libraries/config.php");
	include_once("libraries/common.php");
	include_once("libraries/database.php");
	include_once("libraries/api.php");
	include_once("libraries/My_phpmailer.php");

	dbconn::checkmobile2();
	//$_SESSION['checkmobile'] = 0;