<?
	#載入預設系統
	include_once("libraries/load.php");
	#執行應用程式

	if( empty( $_SESSION['user'] ) ){
		go_showmsg("您尚未登入！","/event/2015Anniversary/login.php");
		exit();
	}

	$userdata['definfo'] = dbconn::get_oneusr( $_SESSION['user']['id'] );
	$userdata['othinfo'] = dbconn::get_usruid( $_SESSION['user']['id'] );
	$userdata['count'] = dbconn::count_member_xu( $_SESSION['user']['id'] );

	#載入View
	if( $_SESSION['checkmobile'] == 1 ){
		$view = 'views/mobile/m.final.php';
	}else{
		$view = 'views/web/final.php';
	}
	include_once($view);	