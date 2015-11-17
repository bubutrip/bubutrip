<?
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require '../../inc/config.php';
require PATH_INC.'/class_user.php';
require '../dbconn.php';

$user_id = User::getId(); //使用者編號

$memberloginkey = false;
if( !empty($user_id) ){
	$memberloginkey = true;
	$userdata = dbconn::getUserById( $user_id );
	$userfbdata = dbconn::getFBUserById( $user_id );
	$is_new_user = ( isset( $_SESSION['is_new_user'] ) )?$_SESSION['is_new_user']:0;
	dbconn::insertMem( $user_id , $is_new_user );
	$oldtripname = dbconn::checktripname( $user_id );
}else{
	//強制設定登入後導回頁面
	$_SESSION['login:next:tag'] = 'event';
	$_SESSION['login:next'] = "/event/BuBuTripName/m.final.php";
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

</script>

</head>
<body>
<div id="wrapper">
	<div id="logo"><a href="http://www.bubutrip.com.tw/" target="_blank"><img src="images/logo.png"></a></div>	
	<div class="nameTxtBox">		
		<div class="nameTxt">
			<form action="m.final.php" method="post" id="setnameform">
    			<input type="hidden" id="" name="setmod" value="setmascotname">
    			<input class="tra" type="text" name="mascotName" maxlength="5" title="命名名稱(限5字內)" value="<?=( empty($oldtripname) and !empty( $_SESSION['ni:name'] ) )?$_SESSION['ni:name']:''?>"><br/>
    			<textarea class="ta" name="mean" maxlength="50" title="命名意涵(限50字內)"><?=( empty($oldtripname) and !empty( $_SESSION['ni:mean'] ) )?$_SESSION['ni:mean']:''?></textarea>
			</form>
			<a class="sendBtn"><img src="images/btn1.jpg"></a>
			<ol><span>注意事項：</span>
		    	<li>以5個字為限，名稱需和<span class="highlightTxt">BuBuTrip</span>品牌形象有關。(中文為主，得輔以英文字母)。</li>
		    	<li>命名作品應富有創意及意涵，不得使用違反善良風俗及不雅文字，方便使用國、台語發音，易記並予人深刻印象。</li>
		    	<li>須寫出命名之意涵說明。(說明文字以50字為限)。</li>
		    	<li>命名作品一律於活動網頁上線上投稿，不得以電子郵件或郵寄方式傳送。</li>
		    	<li>若同一命名有多人投稿時，則選擇第一時間投稿者優先錄取。</li>
			</ol>
		</div>
		<img src="images/m_name_box.png">
	</div>
	<nav>
		<a href="m.activity.php" class="activityNavBtn2"><img src="images/m_activity_btn.png" alt="活動辦法"></a>
		<a href="m.who.php" class="whoBtn2"><img src="images/m_who_btn2.png" alt="吉祥物是誰?"></a>
		<br clear="both" />
	</nav>
	<div id="copyright">Copyright © 2015 all rights reserved.</div>	
</div>
</body>
</html>
