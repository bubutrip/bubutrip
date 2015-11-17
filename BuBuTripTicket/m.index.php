<?
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require '../../inc/config.php';
require PATH_INC.'/class_user.php';
require '../dbconn.php';

if( !empty( $_GET['offerme2_click'] ) ){
	$_SESSION['offerme2_click'] = $_GET['offerme2_click'];
}

$user_id = User::getId(); //使用者編號
$memberloginkey = false;
$is_new_user = ( isset( $_SESSION['is_new_user'] ) )?$_SESSION['is_new_user']:0;
if( !empty($user_id) ){
	$memberloginkey = true;
	$memberloginkey = true;

	$userdata = dbconn::getUserById( $user_id );
	$userfbdata = dbconn::getFBUserById( $user_id );
	dbconn::insertMem( $user_id , $is_new_user );
	$hi_ticket_str = dbconn::make_ticket( 0 , $user_id , $is_new_user );
}else{
	//強制設定登入後導回頁面
	$_SESSION['login:next:tag'] = 'event';
	$_SESSION['login:next'] = "/event/BuBuTripTicket/m.register.php?ticket=1";
}
?>
<html lang="en">
<head>
<meta charset="utf-8">		
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">		
<meta name="google-site-verification" content="" />		
<meta name="description" content="親子自駕旅遊網BuBuTrip吉祥物誕生了！9/13(日)在台北市立動物園將隆重與大家相見~我們將帶來好玩的互動遊戲，有野餐墊、扇子、名信片、冰淇淋、爆米花多項好禮送給你！更棒的是，活動現場會送出Dyson戴森無線吸塵器(價值$27,900元)一台！另外，還會抽出兩部小朋友界最夯的捷安特滑步車(價值$3,280)，心動了就千萬別錯過，等你喔~">
<meta name="keywords" content="BuBuTrip、親子自駕旅遊網、吉祥物、Dyson戴森無線吸塵器、捷安特滑步車、野餐墊、扇子、名信片、冰淇淋、爆米花、台北市立動物園" />
<meta name="url" content="http://www.bubutrip.com.tw/" />	
<meta property="og:locale" content="zh_TW" />		
<meta property="og:site_name" content="【BuBuTrip招募新會員】無料暢遊動物園，再抽Dyson和捷安特！" />		
<meta property="og:title" content="【BuBuTrip招募新會員】無料暢遊動物園，再抽Dyson和捷安特！" />			
<meta property="og:url" content="http://www.bubutrip.com.tw/" />
<meta property="og:type" content="Website" /><meta property="og:image" content="/event/defimg/share2.jpg"></meta>	
<meta property="og:description" content="落腳在BuBuTrip的可愛小飛鼠，熱情邀請你參加派對！現場除了和小飛鼠歡樂互動、遊戲體驗拿禮物，更加碼抽出人氣大好物「Dyson吸塵器」和親子界最夯的「捷安特Push Bike」唷！" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<title>現在加入BuBuTrip會員送動物園門票</title>
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

<script type="text/javascript">
	<? if( empty( $_GET['ticket']) ){ ?>
		alert("本活動已結束囉！");
	<? } ?>
	<? if( !empty( $_GET['ticket'] ) ){ ?>
	alert("歡迎加入BuBuTrip會員，但活動已結束，沒有贈票喔！");
	//$(document).ready(function(){
	//	setTimeout(function(){ showfblike(); }, 1000);
	//})
	<? } ?>
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52357786-10', 'auto');
  ga('send', 'pageview');

</script>

</head>
<?#$popupview = $_SESSION['popupview'] ?>
<body data-popup="<?#=$popupview?>">
<?#if( empty($popupview) ){ ?>
<? if( empty( $_GET['ticket'] ) ){ ?>
<div id="popupview">
	<div class="imgrng">
		<a href="#" class="closebtn"></a>
		<img src="images/m_popup.jpg">
	</div>
</div>
<? } ?>
<?#$_SESSION['popupview'] = 'keyopen'; ?>
<?# } ?>
<div id="wrapper">
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.4";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<? /*
	<div id="mask" class="disnone">
		<div id="fbox" align="center">
			<div class="prelative">
				<div class="ticketfbsharer closebtn">X</div>
				<div id="fbox2">快拿到票啦！幫粉絲團按個讚</div>
				<div class="fb-page" data-href="https://www.facebook.com/bubutrip2tw" data-width="200" data-small-header="true" data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/bubutrip2tw"><a href="https://www.facebook.com/bubutrip2tw">BuBu Trip</a></blockquote></div></div>
			</div>
			<br>
		</div>
	</div>
	*/ ?>
	<input type="hidden" id="is_new_user" value="<?=$is_new_user?>">	
	<input type="hidden" id="memberloginkey" name="memberloginkey" value="<?=$memberloginkey?>">
	<input type="hidden" id="ticket_str" name="ticket_str" value="<?=$hi_ticket_str?>">	
	<div id="logo"><a href="http://www.bubutrip.com.tw/" target="_blank"><img src="images/logo.png"></a></div>	
	<div class="contentsBox1">
		<a href="m.who.php" class="indexWhoBtn"><img src="images/m_index_who_btn.png"></a>
		<a href="m.activity.php" class="activityBtn"><img src="images/index_activity_icon.png"></a>
		<a href="m.prize_list.html" class="prizeListBtn"><img src="images/index_prize_icon.png"></a>
		<div class="indexTxt connect">
			<a data-url="/login/facebook" class="registerBtn fb"><img src="images/m_register_btn.png"></a>
			<p class="brownText">入園日期<br/>9/13(日)活動當天9:00-15:30</p>		
		</div>
		<img src="images/m_index_box.png">
	</div>
	<nav>
		<a href="m.meeting.php" class="floatR"><img src="images/m_meeting_btn.png" alt="見面會好康"></a>
		<!--a href="m.register.php" class="floatR"><img src="images/m_ticket_btn.png" alt="拿免費門票"></a-->
		<br clear="both" />
	</nav>
	<div id="copyright">Copyright © 2015 all rights reserved.</div>
</div>
</body>
</html>
