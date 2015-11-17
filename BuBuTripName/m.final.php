<?php
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
}

$imgkey = false;
$word = false;
$postdata = array();
$is_new_user = ( isset( $_SESSION['is_new_user'] ) )?$_SESSION['is_new_user']:0;
if( !empty( $_SESSION['ni:name'] ) and !empty( $_SESSION['ni:mean'] ) ){
	$postdata = array(
		'user_id' => $user_id,
		'mascotName' => $_SESSION['ni:name'],
		'mean' => $_SESSION['ni:mean'],
	);
}
if( !empty( $_POST ) or !empty( $postdata ) ){

	if( !$memberloginkey ){
		$_SESSION['ni:name'] = $_POST['mascotName'];
		$_SESSION['ni:mean'] = $_POST['mean'];
		header("content-type: text/html; charset=utf-8");
		echo "處理中，請稍候...";
		echo "<script>";
		echo "alert('您尚未登入，正在導引您到FB登入...');";
		echo "location.href='/login/facebook'";
		echo "</script>";
		exit();
	}

	if( !empty( $_POST ) ){
		$postdata = array(
			'user_id' => $user_id,
			'mascotName' => $_POST['mascotName'],
			'mean' => $_POST['mean'],
		);
	}

	if( empty( $postdata['mascotName'] ) ){
		dbconn::go_showmsg("您沒有完整輸入表單喔！","");
	}

	if( mb_strlen( $postdata['mascotName'] , "utf-8") > 5 ){
		dbconn::go_showmsg("吉祥物名稱最多5個字喔！","");
	}

	dbconn::update_tripname( $user_id );

	$showonealert = 0;
	$oldtripname = dbconn::checktripname( $user_id );
	if( !empty( $oldtripname ) ){
		$showonealert = 1;
	    $word           = $oldtripname['mem_tripname'];
		$imgurl			= $oldtripname['mem_imgfile'];
		$imgkey			= true;
	}else{
	    $word           = $postdata['mascotName'];

	    /*
	    $word_strlen	= mb_strlen( $word, "utf-8");
	    $font_size      = 25;

		$width          = (33*$word_strlen);
	    $height         = 40;

	    $im             = imagecreatetruecolor($width, $height);
	    $back_color		= imagecolorallocate($im,255,255,255);
	    				  imagecolortransparent($im,$back_color);
	    				  imagefill($im,0,0,$back_color);
	    $text_color     = imagecolorallocate($im, 0, 0, 0);
	    $font_width     = ( $font_size ) * $word_strlen;
	    $font_height    = ( $font_size );
	    $x              = 2;#( $width - $font_width ) / 2 ;
	    $y              = 31;#( $height - $font_height ) / 2 ;
		imagettftext($im, $font_size, 0, $x, $y, $text_color, "font/unifont-8.0.01.ttf",  $word );

		$imgname = dbconn::make_img_name( $user_id );
		$imgurl = "makeimg/".$imgname.".png";
		imagepng($im,$imgurl);
		imagedestroy($im);

		*/
		$imgurl = "makeimg/def.jpg";
		$imgkey = true;

		dbconn::inserttripname( $user_id , $postdata['mascotName'] , $postdata['mean'] , $imgurl );
	}

}else{
	header("content-type: text/html; charset=utf-8");
	echo "<script>";
	echo "alert('未輸入任何資料，請重新確認！');";
	echo "history.back(-1);";
	echo "</script>";
	exit();
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

<script type="text/javascript">
	<? if( $showonealert ){ ?>
	alert("您的帳號已經參加過了喔！");
	<? } ?>
	//alert("試試看將網址貼在臉書近況，會有彩虹森林裡的好朋友帶來的小驚喜喔!");
	$(document).ready(function(){
		setTimeout(function(){ showfblike(); }, 1000);
	})
</script>
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
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.4";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div id="mask" class="disnone">
		<div id="fbox" align="center">
			<div class="prelative">
				<div class="gotripname closebtn showfbsharer">X</div>
				<div id="fbox2">命名就快完成拉！幫粉絲團按讚</div>
				<div class="fb-page" data-href="https://www.facebook.com/bubutrip2tw" data-width="200" data-small-header="true" data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/bubutrip2tw"><a href="https://www.facebook.com/bubutrip2tw">BuBu Trip</a></blockquote></div></div>
			</div>
			<br>
		</div>
	</div>
	<input type="hidden" id="is_new_user" value="<?=$is_new_user?>">
	<div id="logo"><a href="http://www.bubutrip.com.tw/" target="_blank"><img src="images/logo.png"></a></div>	
	<div class="finalTxtBox">		
		<div class="finalTxt">
			<h2>恭喜您命名成功！</h2>
			<p>BuBuTrip吉祥物說不定就會命名為<span><?=$word?></span>喔~<br/>快來下載超人氣插畫家afu手繪桌布並分享給朋友吧！</p>
		</div>
		<a href="/event/BuBuTripName/makeimg/BuBuTrip_Wallpaper.jpg" target="_blank" class="reviewBtn"><img src="images/review_btn.png"></a>
		<a href="/event/BuBuTripName/download.php?f=BuBuTrip_Wallpaper.jpg" target="_blank" class="downloadBtn"><img src="images/download_btn.jpg"></a>
		<a class="fbBtn btn showfbsharer1"><img src="images/fb_btn.jpg"></a>	
		<img src="images/m_final_box.png">
	</div>
	<div>
		<div class="nameBg">
			<div><?=$word?></div>
			<a href="/event/BuBuTripTicket/m.index.php" target="_blank" class="">
				<img src="images/m_final_squirrel.png">
			</a>
		</div>
		<a href="/event/BuBuTripTicket/m.index.php" target="_blank" class="goticketBtn"><img src="images/m_goticket.png"></a>
	</div>
	<nav>
		<a href="m.activity.php" class="activityNavBtn3"><img src="images/m_activity_btn.png" alt="活動辦法"></a>
		<br clear="both" />
	</nav>
	<div id="copyright">Copyright © 2015 all rights reserved.</div>	
</div>
</body>
</html>
