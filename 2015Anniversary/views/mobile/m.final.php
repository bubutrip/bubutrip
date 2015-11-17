<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">		
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">		
<meta name="google-site-verification" content="" />		
<meta name="description" content="BuBuTrip 1歲了，感謝粉絲們的支持！11.12-11.30會員揪好友全台知名親子飯店任你住！">
<meta name="keywords" content="BuBuTrip、親子自駕旅遊網、BuBuTrip、親子住宿體驗券、宜蘭‧蘭城晶英酒店、清境‧黃慶果園民宿、台南‧Cozzi 和逸商旅 " />
<meta name="url" content="http://www.bubutrip.com.tw/" />	
<meta property="og:locale" content="zh_TW" />		
<meta property="og:site_name" content="BuBuTrip週年慶" />		
<meta property="og:title" content="BuBuTrip週年慶" />			
<meta property="og:url" content="http://www.bubutrip.com.tw/" />
<meta property="og:type" content="Website" />	
<meta property="og:description" content="BuBuTrip 1歲了，感謝粉絲們的支持！11.12-11.30會員揪好友全台知名親子飯店任你住！" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<title>BuBuTrip週年慶</title>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lt IE 9]><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script><![endif]-->
<link rel="shortcut icon" href="<?=imgurl?>/event/2015Anniversary/resources/images/favicon.ico">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<script src="<?=imgurl?>/event/2015Anniversary/resources/js/jquery.fancybox.pack.js"></script>

<link rel="stylesheet" type="text/css" href="<?=imgurl?>/event/2015Anniversary/resources/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?=imgurl?>/event/2015Anniversary/resources/css/jquery.fancybox.css">
<link rel="stylesheet" type="text/css" href="<?=imgurl?>/event/2015Anniversary/resources/css/m.style.css">

<script src="<?=imgurl?>/event/2015Anniversary/resources/js/m.main.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $.fancybox.open('#fbLikeBox',{
                    closeBtn: false,
                    scrolling:false,
                    autoSize: false,
                    width: 534,
                    height: 500,
                    padding:0,
                    margin:0
    });
        
    $('.fbLikeCloseBtn, .fbLikeDoneBtn').on('click',function(e){ $.fancybox.close(); });
});
</script>
<style type="text/css">
.fancybox-skin {
	position: relative;
	background: transparent;
	color: #444;
	text-shadow: none;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
}
.fancybox-opened .fancybox-skin {
	-webkit-box-shadow:none;
	-moz-box-shadow:none;
	box-shadow:none;
}
.fb-page{width: 80% !important;}
</style>

</head>
<body>
<div id="wrapper">
	<div id="logo"><a href="http://www.bubutrip.com.tw/" target="_blank"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/logo.png"></a></div>
	<div id="share">
		<a href="activity.php" target="_blank" class="finalActivityBtn"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/m/final_register_btn.jpg"></a>
		<div class="finalScore"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/m/score.jpg"><span><?=$userdata['count']?></span></div>
		<div class="finalTxt"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/m/final_txt1.jpg"></div>
		<div class="finalNav">
			<a href="https://www.facebook.com/sharer/sharer.php?u=http://www.bubutrip.com.tw/event/2015Anniversary/fbsharer1.php?keyid=<?=$userdata['definfo']['id']?>" class="finalLBtn"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/m/final_fb_btn.jpg"></a>
			<?
				$lineurl = 
				"http://line.naver.jp/R/msg/text/?".
				urlencode( "BuBuTrip週年慶→點此招待碼，我的萬元住宿券就靠你！" ).
				"%0D%0A".
				urlencode( "http://www.bubutrip.com.tw/event/2015Anniversary/login.php?com_key=".$userdata['othinfo']['usr_makekey'] );
			?>
			<a href="<?=$lineurl?>" class="finalRBtn"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/m/final_line_btn.jpg"></a>
		</div>
		<div class="finalDown"><a href="#app"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/m/final_down3.jpg"></a></div>		
	</div>

	<div id="app">
		<div class="finalUp"><a href="#share"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/m/final_up_btn.jpg"></a></div>
		<div class="finalTxt" style="padding-top:3%"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/m/final_txt3.jpg"></div>
		<div class="finalNav">
			<a href="https://play.google.com/store/apps/details?id=com.hotaimotor.bubutrip" class="finalLBtn"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/m/final_google_btn.jpg"></a>
			<a href="https://appsto.re/tw/dllU8.i" class="finalRBtn"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/m/final_apple_btn.jpg"></a>
		</div>
	</div>

	<div id="copyright" style="background:#fff;">
		<span>©2015 BuBuTrip. All rights reserved.</span>
    <br clear="both"/>
	</div>
	<div id="fbLikeBox">
		<img src="<?=imgurl?>/event/2015Anniversary/resources/images/like_bg.gif" class="fbLikeBg">
		<a href="#" class="fbLikeCloseBtn"></a>
		<a href="#" class="fbLikeDoneBtn hide">我已按過讚</a>
		<div class="fbBox">
			<div class="fb-page" data-href="https://www.facebook.com/bubutrip2tw/" data-width="300" data-small-header="true" data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/bubutrip2tw/"><a href="https://www.facebook.com/bubutrip2tw/">BuBu Trip</a></blockquote></div></div>
		</div>
	</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.5&appId=1565880873639017";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</div>
</body>
</html>
