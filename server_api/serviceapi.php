<?php

	include_once("load.php");

	$model = $_GET['model'];

	if( empty( $model ) ){
		$errinfo = array(
			'status' => 1,
			'msg' => '調用模組錯誤！',
		);
		print_r(json_encode($errinfo));
		exit();
	}

	#使用遠端調用API
	if( $model == 'WebApi' ){

		$function = $_GET['function'];
		$returndata = array();
		switch ( $function ) {

			#註冊會員
			case 'reg_user':
			    $returndata = Api::doRegister($_POST);
			    $com_key='';
				if( !empty( $_SESSION['com_key'] ) ){
					$com_key = $_SESSION['com_key'];
				}
				if( !empty( $_POST['com_key'] ) ){
					$com_key = $_POST['com_key'];
				}
			    if( $returndata['success'] == 1 ){
			    	dbconn::insert_new_comkey( $returndata['user_id'] , $com_key );
			    }
				break;

			#網站登入
			case 'web_login':
				//登入
			    $returndata = User::doLogin($_POST);
			    $com_key='';
				if( !empty( $_SESSION['com_key'] ) ){
					$com_key = $_SESSION['com_key'];
				}
				if( !empty( $_POST['com_key'] ) ){
					$com_key = $_POST['com_key'];
				}
			    if( $returndata['success'] == 1 ){
			    	dbconn::insert_new_comkey( $returndata['user_id'] , $com_key );
					dbconn::insert_login_makekey( $returndata['user_id'] , $com_key , 0 );
			    }
				break;

			#Google登入
			case 'google_callback':
				$results = Api::doSnsLogin(SNS_GPLUS,$_GET);
			    $_SESSION['is_new_user'] = isset($results['is_new_user']) ? $results['is_new_user'] : 0;
			    $com_key='';
				if( !empty( $_SESSION['com_key'] ) ){
					$com_key = $_SESSION['com_key'];
				}
			    if( $results['success'] == 1 ){
			    	dbconn::insert_new_comkey( $_SESSION['user']['id'] , $com_key );
					dbconn::insert_login_makekey( $_SESSION['user']['id'] , $com_key , $_SESSION['is_new_user'] );
			    }

				if( $results['success']==0 )
				{
					$next_url = '/event/2015Anniversary/login.php';
					header("content-type: text/html; charset=utf-8");
					echo '<script>alert("登入失敗，請確認帳號密碼是否正確");if(window.opener==null){location.href="'.$next_url.'"}else{window.opener.location.href="'.$next_url.'";self.close()}</script>';
					exit();
				}else{
					User::om2callback();
			    	if( !empty( $_SESSION['com_key'] ) ){
			    		$next_url = '/event/2015Anniversary/';
			    	}else{
			    		$next_url = '/event/2015Anniversary/final.php';	
			    	}
			    	$alert_text = '登入成功！';
			    	if( !empty( $_SESSION['com_key'] ) ){
				    	$alert_text = '你已經加入過會員囉～沒辦法幫朋友累積栗子，快來分享你的招待碼，為自己累積栗子吧！';
				    	if( $_SESSION['is_new_user'] == 1 ){
				    		$alert_text = '你已經加入過會員囉～沒辦法幫朋友累積栗子，快來分享你的招待碼，為自己累積栗子吧！';
				    	}			    	
			    	}
					header("content-type: text/html; charset=utf-8");
					echo '<script>alert("'.$alert_text.'");if(window.opener==null){location.href="'.$next_url.'"}else{window.opener.location.href="'.$next_url.'";self.close()}</script>';
				    exit();
				}
				echo "錯誤?";
				exit();
				break;

			#臉書登入
			case 'facebook_callback':

			    $results = Api::doSnsLogin(SNS_FACEBOOK,$_GET);
			    $_SESSION['is_new_user'] = isset($results['is_new_user']) ? $results['is_new_user'] : 0;
			    $com_key='';
				if( !empty( $_SESSION['com_key'] ) ){
					$com_key = $_SESSION['com_key'];
				}
			    if( $results['success'] == 1 ){
			    	dbconn::insert_new_comkey( $_SESSION['user']['id'] , $com_key );
					dbconn::insert_login_makekey( $_SESSION['user']['id'] , $com_key , $_SESSION['is_new_user'] );
			    }
			    
				if( $results['success']==0 )
				{
					$next_url = '/event/2015Anniversary/login.php';
					header("content-type: text/html; charset=utf-8");
					echo '<script>alert("登入失敗，請確認帳號密碼是否正確");if(window.opener==null){location.href="'.$next_url.'"}else{window.opener.location.href="'.$next_url.'";self.close()}</script>';
					exit();
				}else{
					User::om2callback();
			    	if( !empty( $_SESSION['com_key'] ) ){
			    		$next_url = '/event/2015Anniversary/';
			    	}else{
			    		$next_url = '/event/2015Anniversary/final.php';	
			    	}
			    	$alert_text = '登入成功！';
			    	if( !empty( $_SESSION['com_key'] ) ){
				    	$alert_text = '你已經加入過會員囉～沒辦法幫朋友累積栗子，快來分享你的招待碼，為自己累積栗子吧！';
				    	if( $_SESSION['is_new_user'] == 1 ){
				    		$alert_text = '你已經加入過會員囉～沒辦法幫朋友累積栗子，快來分享你的招待碼，為自己累積栗子吧！';
				    	}			    	
			    	}
					header("content-type: text/html; charset=utf-8");
					echo '<script>alert("'.$alert_text.'");if(window.opener==null){location.href="'.$next_url.'"}else{window.opener.location.href="'.$next_url.'";self.close()}</script>';
				    exit();
				}
				echo "錯誤?";
				exit();

				break;

			#驗證密碼
			case 'verify':
			    if( User::doVerify($_GET) )
			    {
			      if( is_mobile_device() )
			      { # js alert then redirect to /m/login/
			        header("Content-Type: text/html; charset=UTF-8");
			        die('<script>alert("已成功驗證您的帳號，請輸入帳號密碼進行登入");location.href="/event/2015Anniversary/login.php";</script>');
			      }
			      header("Location: /event/2015Anniversary/login.php#verified");
			    }
			    else
			    {
			      header("Location: /event/2015Anniversary/");
			    }
			    exit();
				break;

			#忘記密碼
			case 'forgot':
			    $returndata = User::doForgotPass($_POST);
				break;
		}
		header('Content-Type: application/json; charset=utf-8');		
		print_r(json_encode($returndata));
		exit();
	}

	#使用APP調用API
	if( $model == 'AppApi' ){

		header('Content-Type: application/json; charset=utf-8');

		$eventobj = ( !empty( $_POST['event'] ) )?$_POST['event']:'';

		if( empty( $eventobj ) ){
			$errinfo = array(
				'status' => 1,
				'msg' => 'no data.',
				'alert' => '貼心提醒：APP請更新至最新版或再重新嘗試一次',
			);
			print_r(json_encode($errinfo));
			exit();
		}else{

			#紀錄POST
			dbconn::postlog( $eventobj );

			#解密
			$key = 'FD91861EE35E838D';
			$mode = MCRYPT_MODE_ECB;
			$mcrypt = new Mcrypt();
			$mcrypt->setkey($key);
			$mcrypt->setMode($mode);

			if( !isJson( $eventobj ) ){
				$errinfo = array(
					'status' => 2,
					'msg' => 'data err.',
					'alert' => '貼心提醒：APP請更新至最新版或再重新嘗試一次',
				);
				print_r(json_encode($errinfo));
				exit();					
			}

			$eventarray = json_decode( $eventobj );

			if( !empty( $eventarray->user_id ) ){
				$infoarray['user_id'] = $mcrypt->testdecrypt($key, $eventarray->user_id );
			}

			if( !empty( $eventarray->device_id ) ){
				$infoarray['device_id'] = $mcrypt->testdecrypt($key, $eventarray->device_id );
			}

			if( empty( $infoarray['user_id'] ) or empty( $infoarray['device_id'] ) ){
				$errinfo = array(
					'status' => 3,
					'msg' => 'parse err.',
					'alert' => '資料有誤,請重新嘗試一次',
				);
				print_r(json_encode($errinfo));
				exit();
			}

			$updateevent = dbconn::insert_user_driveinfo( $infoarray );

			if( $updateevent == 1 ){
				$errinfo = array(
					'status' => 0,
					'msg' => 'http://www.bubutrip.com.tw/event/2015Anniversary/get_score_done.php',
					'alert' => '領取成功！',
				);
				print_r(json_encode($errinfo));
				exit();
			}else{
				$errinfo = array(
					'status' => 4,
					'msg' => 'data exist.',
					'alert' => '您已經領過栗子囉',
				);
				print_r(json_encode($errinfo));
				exit();					
			}
		}

	}
