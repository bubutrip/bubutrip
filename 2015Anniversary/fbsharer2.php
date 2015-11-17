<?php
	#載入預設系統
	include_once("libraries/load.php");
	#執行應用程式

	$keyid = ( !empty($_GET['keyid']) )?$_GET['keyid']:0;
	if( !empty( $_GET['keyid'] ) ){
		$userdata['definfo'] = dbconn::get_oneusr( $_GET['keyid'] );
		$userdata['othinfo'] = dbconn::get_usruid( $_GET['keyid'] );
		$count = dbconn::count_comkey( $userdata['othinfo']['usr_makekey'] );
		$userdata['count'] = $count['countn'];
	}else{
		$userdata['othinfo']['usr_makekey'] = '';
	}
	/*
		<!--meta property="og:image" content="http://www.bubutrip.com.tw/event/2015Anniversary/resources/images/fb_share.jpg"></meta-->	
		<!--meta property="og:image" content="http://theme.jake.tw/fb_share.jpg"></meta-->	
	*/
?>
<html lang="en">
	<head>
		<meta charset="utf-8">		

		<meta property="og:locale" content="zh_TW" />		
		<meta property="og:type" content="website" />
		<meta property="og:site_name" content="BuBuTrip週年慶，我的住宿券要靠你!" />		
		<meta property="og:title" content="BuBuTrip週年慶，我的住宿券要靠你!" />			
		<meta property="og:url" content="http://www.bubutrip.com.tw/event/2015Anniversary/fbsharer2.php">
		<meta property="og:description" content="新朋友註冊成功後，除了能替好友累積中獎機會，還可抽7-11佰元禮券。同時也會產生專屬招待碼，抽親子住宿券喔！" />
	</head>
	<body></body>
</html>