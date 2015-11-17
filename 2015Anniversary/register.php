<?
	#載入預設系統
	include_once("libraries/load.php");
	#執行應用程式

	if( !empty( $_SESSION['user'] ) ){
		go_showmsg("您已經登入！","/event/2015Anniversary/");
		exit();
	}

	#載入View
	if( $_SESSION['checkmobile'] == 1 ){
		$view = 'views/mobile/m.register.php';
	}else{
		$view = 'views/web/register.php';
	}
	include_once($view);