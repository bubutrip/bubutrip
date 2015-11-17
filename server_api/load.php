<?php

	session_start();

	if (isset($_SERVER["HTTP_HOST"])){
		$current_host=$_SERVER["HTTP_HOST"];	
	}else{
		$current_host="www.bubutrip.com.tw";
	}

	switch ($current_host) {
		case 'serverapi.jake.tw':
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
		require PATH_LIB_MAILER.'/PHPMailerAutoload.php';
		include_once("../dbconn.php");
	}

	include_once("common.php");
	include_once("mcrypt.php");
	include_once("api.php");