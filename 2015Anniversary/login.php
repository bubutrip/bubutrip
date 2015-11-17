<?
	#載入預設系統
	include_once("libraries/load.php");
	#執行應用程式

	if( !empty( $_GET['com_key'] ) ){
		$_SESSION['com_key'] = $_GET['com_key'];
	}

	if( !empty( $_SESSION['user'] ) ){
		go_showmsg("您已經登入！","/event/2015Anniversary/");
		exit();
	}




	#載入View
	if( !empty( $_GET['com_key'] ) ){
		if( $_SESSION['checkmobile'] == 1 ){
			$view = 'views/mobile/m.invite.php';
		}else{
			$view = 'views/web/invite.php';
		}
	}else{
		if( $_SESSION['checkmobile'] == 1 ){
			$view = 'views/mobile/m.login.php';
		}else{
			$view = 'views/web/login.php';
		}
	}
	include_once($view);