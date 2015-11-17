<?
	#載入預設系統
	include_once("libraries/load.php");
	#執行應用程式

	#載入View
	if( $_SESSION['checkmobile'] == 1 ){
		$view = 'views/mobile/m.activity.php';
	}else{
		$view = 'views/web/activity.php';
	}
	include_once($view);	