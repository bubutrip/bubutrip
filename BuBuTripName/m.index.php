<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require '../../inc/config.php';
require PATH_INC.'/class_user.php';
require '../dbconn.php';

#var_dump(FB_APPID); //fb app id
#var_dump(FB_SECRET); //fb app secret

$user_id = User::getId(); //使用者編號

$memberloginkey = false;
if( !empty($user_id) ){
	$memberloginkey = true;
	$userdata = dbconn::getUserById( $user_id );
	$userfbdata = dbconn::getFBUserById( $user_id );
	$is_new_user = ( isset( $_SESSION['is_new_user'] ) )?$_SESSION['is_new_user']:0;
	dbconn::insertMem( $user_id , $is_new_user );
}else{
	//強制設定登入後導回頁面
	$_SESSION['login:next:tag'] = 'event';
	$_SESSION['login:next'] = "/event/BuBuTripName/m.index.php";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">		
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">		
<meta name="google-site-verification" content="" />		
<meta name="description" content="親子自駕旅遊網BuBuTrip吉祥物誕生了~一起來幫可愛的小飛鼠取名字吧！價值$30,000元旅遊券，將送給最具創意的你！">
<meta name="keywords" content="BuBuTrip、親子自駕旅遊網、吉祥物、命名我最會獎、$30,000元、旅遊券、放鬆一「夏」、我最幸運獎、命名活動、抽獎、100位幸運得主、$160元、插畫作家afu、日本製森林系紙膠帶、彩虹森林、小飛鼠、Dyson戴森無線吸塵器、捷安特滑步車" />
<meta name="url" content="http://www.bubutrip.com.tw/" />	
<meta property="og:locale" content="zh_TW" />		
<meta property="og:site_name" content="BuBuTrip小飛鼠吉祥物 等你取好名！" />		
<meta property="og:title" content="BuBuTrip小飛鼠吉祥物 等你取好名！" />			
<meta property="og:url" content="http://www.bubutrip.com.tw/" />
<meta property="og:type" content="Website" /><meta property="og:image" content="/event/defimg/share.jpg"></meta>	
<meta property="og:description" content="親子自駕旅遊網BuBuTrip吉祥物誕生了~一起來幫可愛的小飛鼠取名字吧！價值$30,000元旅遊券，將送給最具創意的你！" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<title>BuBuTrip吉祥物創意命名拿好禮</title>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lt IE 9]><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script><![endif]-->
<link rel="shortcut icon" href="images/favicon.ico">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/m.style.css">
<link rel="stylesheet" type="text/css" href="../defcss/main.css">

<script src="js/jquery.backstretch.min.js"></script>
<script src="js/m.main.js"></script>
<script src="../defjs/m.main.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52357786-9', 'auto');
  ga('send', 'pageview');

  alert("命名活動已結束，BuBuTrip小飛鼠新名字是「布卡」！");
</script>

</head>
<body>
<div id="wrapper">
	<div id="logo"><a href="http://www.bubutrip.com.tw/" target="_blank"><img src="images/logo.png"></a></div>
	<div class="index_title"><img src="images/m_index_title.png" alt="BuBuTrip吉祥物創意命名拿好禮"></div>
	<div class="indexTxtBox">
		<a href="m.activity.php" class="activityBtn"><img src="images/index_activity_icon.png"></a>
		<a href="m.prize_list.html" class="prizeListBtn"><img src="images/index_prize_icon.png"></a>
		<div class="indexTxt">
			<p><span class="purpleTxt">命名我最會獎：</span><br/>命名若經採用，即送價值<sapn class="highlightTxt">$30,000元旅遊券</sapn>，為自己找個時間出遊，放鬆一「夏」吧！</p>
			<div class="line"><img src="images/index_line.jpg"></div>
			<p class="indexTS"><span class="greenTxt">我最幸運獎：</span>凡參與命名活動，即可獲得抽獎機會。共抽出<sapn class="highlightTxt">100位</sapn>幸運得主，送價值$160元的<sapn class="highlightTxt">插畫作家afu</sapn>日本製森林系<sapn class="highlightTxt">紙膠帶</sapn>乙份。</p>			
		</div>
		<img src="images/m_index_box.png">
	</div>
	<nav>
		<a href="m.who.php" class="whoBtn"><img src="images/m_who_btn.png" alt="吉祥物是誰?"></a>
		<a href="m.name.php" class="goNameBtn"><img src="images/m_to_name_tn.png" alt="我要命名"></a>
		<br clear="both" />
	</nav>
	<div id="copyright">Copyright © 2015 all rights reserved.</div>
</div>
</body>
</html>
