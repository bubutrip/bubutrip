<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require '../../inc/config.php';
require PATH_INC.'/class_user.php';
require '../dbconn.php';

#var_dump(FB_APPID); //fb app id
#var_dump(FB_SECRET); //fb app secret

dbconn::checkmobile();

$user_id = User::getId(); //使用者編號

$memberloginkey = false;
$is_new_user = ( isset( $_SESSION['is_new_user'] ) )?$_SESSION['is_new_user']:0;
if( !empty($user_id) ){
	$memberloginkey = true;
	$userdata = dbconn::getUserById( $user_id );
	$userfbdata = dbconn::getFBUserById( $user_id );
	dbconn::insertMem( $user_id , $is_new_user );
	$oldtripname = dbconn::checktripname( $user_id );
}else{
	//強制設定登入後導回頁面
	$_SESSION['login:next:tag'] = 'event';
	$_SESSION['login:next'] = "/event/BuBuTripName/?final=1#secondPage";
}

/*
$user_pic = User::getPic(); //使用者圖片
$user_name = User::getName(); //使用者名稱
var_dump($user_id);
var_dump($user_pic);
var_dump($user_name);
*/

$imgkey = false;
$word = false;
$postdata = array();
if( !empty( $_SESSION['ni:name'] ) and !empty( $_SESSION['ni:mean'] ) ){
	$postdata = array(
		'user_id' => $user_id,
		'mascotName' => $_SESSION['ni:name'],
		'mean' => $_SESSION['ni:mean'],
	);
}
if( !empty($_GET['final']) and ( !empty( $_POST ) or !empty( $postdata ) ) ){

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

	dbconn::update_tripname( $user_id );


	$strlen = mb_strlen( $postdata['mascotName'] , "utf-8");
	if( $strlen > 0 and $strlen <= 5 ){
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
	}


}
?>
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
<meta property="og:url" content="http://www.bubutrip.com.tw/event/BuBuTripName/" />
<meta property="og:type" content="Website" /><meta property="og:image" content="/event/defimg/share.jpg"></meta>
<meta property="og:description" content="親子自駕旅遊網BuBuTrip吉祥物誕生了~一起來幫可愛的小飛鼠取名字吧！價值$30,000元旅遊券，將送給最具創意的你！<?/*親子自駕旅遊網BuBuTrip吉祥物誕生了~一起來幫可愛的小飛鼠取名字吧！價值$30,000元旅遊券，將送給最具創意的你！*/?>"/>
<title>BuBuTrip吉祥物創意命名拿好禮</title>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script type="text/javascript">var console = { log: function() {} };</script><![endif]-->
<!--[if lt IE 9]><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script><![endif]-->
<link rel="shortcut icon" href="images/favicon.ico">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script>!window.jQuery && document.write('<script src="js/jquery-1.8.1.min.js"><\/script>')</script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/jquery.fullPage.css" />
<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="../defcss/main.css">

<script src="js/jquery.backstretch.min.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/jquery.fullPage.min.js"></script>
<script src="js/jquery.mousewheel.js"></script>
<script src="js/jquery.mCustomScrollbar.js"></script>
<script src="js/main.js"></script>
<script src="../defjs/main.js"></script>
<script type="text/javascript">
	alert("命名活動已結束，BuBuTrip小飛鼠新名字是「布卡」！");
	<? if( $showonealert ){ ?>
	alert("您的帳號已經參加過了喔！");
	<? } ?>
	<? if( $imgkey ){ ?>
	$(document).ready(function(){
		setTimeout(function(){ showfblike(); }, 1000);
	})	
	<? } ?>
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
				<!--div class="fb-like fb_iframe_widget" data-href="https://www.facebook.com/bubutrip2tw" data-width="130px" data-layout="button" data-action="like" data-show-faces="false" data-share="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=1418863331666158&amp;container_width=0&amp;href=https%3A%2F%2Fwww.facebook.com%2Fbubutrip2tw&amp;layout=button&amp;locale=en_US&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;width=100"><span style="vertical-align: bottom; width: 49px; height: 20px;"><iframe name="f1535368fc" width="100px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:like Facebook Social Plugin" src="http://www.facebook.com/v2.3/plugins/like.php?action=like&amp;app_id=1418863331666158&amp;channel=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter%2FX9pYjJn4xhW.js%3Fversion%3D41%23cb%3Df36fee6cc%26domain%3Dhoyuan-event.com.tw%26origin%3Dhttp%253A%252F%252Fhoyuan-event.com.tw%252Ff19eb4ed64%26relation%3Dparent.parent&amp;container_width=0&amp;href=https%3A%2F%2Fwww.facebook.com%2Fbubutrip2tw&amp;layout=button&amp;locale=en_US&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;width=100" style="border: none; visibility: visible; width: 49px; height: 20px;" class=""></iframe></span></div-->
				<div class="fb-page" data-href="https://www.facebook.com/bubutrip2tw" data-width="200" data-small-header="true" data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/bubutrip2tw"><a href="https://www.facebook.com/bubutrip2tw">BuBu Trip</a></blockquote></div></div>
			</div>
			<br>
		</div>
	</div>
	<input type="hidden" id="is_new_user" value="<?=$is_new_user?>">
	<input type="hidden" id="memberloginkey" name="memberloginkey" value="<?=$memberloginkey?>">
	<div id="logo"><a href="http://www.bubutrip.com.tw/" target="_blank"><img src="images/logo.png"></a></div>
	<div id="copyright">Copyright © 2015 all rights reserved.</div>	
	<div id="fullpage">
		<div class="section " id="section0">
			<ul id="scrollBox">
				<li data-menuanchor="firstPage" class="active"></li>
				<li data-menuanchor="secondPage" class="scrollBtn"><a href="#secondPage"><img src="images/scroll_btn.png" alt="參加命名抽好康請往下捲"></a></li>
			</ul>
			<div class="index">
				
				<div class="inBox1">
					<div>
						<h2><img src="images/index_introduction.jpg" alt="自我介紹"></h2>
						<p>來自彩虹森林的小飛鼠，<br/>
						對萬物充滿好奇，最喜歡探索<br/>
						世界，用旅行填滿生活。<br/>
						揹著小包包勇敢地展開冒險，<br/>
						裡頭裝滿最愛的果實，可以隨時補充能量，保持玩樂的體力。<br/>
						蓬鬆的尾巴代表著他的情緒，通常都是繽紛快樂的彩虹色，<br/>
						但不開心的時候，就會轉變為憂鬱的藍色喔～</p>
						<p>落腳在BuBuTrip的小飛鼠，<br/>
						最愛用愉悅的心情探索BuBuTrip裡的好玩景點，<br/>
						但現在的他有個小煩惱：「為什麼大家都有名字呢？<br/>
						我也想要有個好聽的名字.....」大家快來幫幫他吧～</p>
					</div>
					<img src="images/index_box1.png">
				</div>				
				<div class="inBox2">
					<div>
						<p><span class="purpleTxt">命名我最會獎：</span><br/>
						命名若經採用，即送價值<span class="highlightTxt">$30,000元旅遊券</span>，<br/>
						為自己找個時間出遊，放鬆一「夏」吧！</p>
						<img src="images/index_line.jpg">
						<p class="inBox2ST"><span class="greenTxt">我最幸運獎：</span>凡參與命名活動，即可獲得抽獎機會。共抽出<span class="highlightTxt">100位</span>幸運得主，送價值$160元的<span class="highlightTxt">插畫作家afu</span>日本製森林系<span class="highlightTxt">紙膠帶</span>乙份。</p>
					</div>
					<img src="images/index_box2.png">
				</div>
				<div class="inSquirrel"><img src="images/index_squirrel.png"></div>
				<div class="inTitle"><img src="images/index_title.png"></div>
				<div data-menuanchor="3rdPage" class="inActivity btn"><a href="#3rdPage"><img src="images/index_activity_icon.png" alt="活動辦法"></a></div>
				<div class="inPrize btn"><a href="prize_list.html" target="_blank"><img src="images/index_prize_icon.png" alt="得獎名單"></a></div>
			</div>
		</div>
		<div class="section" id="section1">
		    <div id="nameForm" class="contents <?=( $imgkey )?'disnone':''?>">
		    	<div class="conBox1">
		    		<img src="images/contents_box1.png">
		    		<h2><img src="images/contents_title1.png"></h2>
		    		<form action="/event/BuBuTripName/?final=1#secondPage" method="post" id="setnameform">
		    			<input type="hidden" id="" name="setmod" value="setmascotname">
		    			<input class="tra" type="text" name="mascotName" maxlength="5" title="命名名稱(限5字內)" value="<?=( empty($oldtripname) and !empty( $_SESSION['ni:name'] ) )?$_SESSION['ni:name']:''?>"><br/>
		    			<textarea class="ta" name="mean" maxlength="50" title="命名意涵(限50字內)"><?=( empty($oldtripname) and !empty( $_SESSION['ni:mean'] ) )?$_SESSION['ni:mean']:''?></textarea>
		    		</form>
		    		<a class="sendBtn btn"><img src="images/btn1.jpg"></a>
		    		<ol><span>注意事項：</span>
		    			<li>以5個字為限，名稱需和<span class="highlightTxt">BuBuTrip</span>品牌形象有關。(中文為主，得輔以英文字母)。</li>
		    			<li>命名作品應富有創意及意涵，不得使用違反善良風俗及不雅文字，方便使用國、台語發音，易記並予人深刻印象。</li>
		    			<li>須寫出命名之意涵說明。(說明文字以50字為限)。</li>
		    			<li>命名作品一律於活動網頁上線上投稿，不得以電子郵件或郵寄方式傳送。</li>
		    			<li>若同一命名有多人投稿時，則選擇第一時間投稿者優先錄取。</li>
		    		</ol>
		    	</div>
		    	<div class="conSquirrel1">
		    		<img src="images/contents_squirrel1.png">
		    		<div class="tail"><img src="images/tail.png"></div>
		    	</div>
		    </div>
		    <div id="final" class="contents <?=( !$imgkey )?'disnone':''?>">
		    	<div class="conBox2">
		    		<img src="images/contents_box2.png">
		    		<div>
			    		<h2 class="highlightTxt">恭喜您命名成功！</h2>
			    		<p>BuBuTrip吉祥物說不定就會命名為<?=$word?>喔~<br/>快來下載超人氣插畫家afu手繪桌布並分享給朋友吧！</p>
		    		</div>
		    		<a href="/event/BuBuTripName/makeimg/BuBuTrip_Wallpaper.jpg" target="_blank" onclick="" class="reviewBtn btn"><img src="images/review_btn.png"></a>
		    		<a href="/event/BuBuTripName/download.php?f=BuBuTrip_Wallpaper.jpg" target="_blank" onclick="" class="downloadBtn btn"><img src="images/download_btn.jpg"></a>
		    		<a id="gofbsharer" href="https://www.facebook.com/sharer/sharer.php?u=http://www.bubutrip.com.tw/event/BuBuTripName/" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,height=600,width=600');return false;" class="fbBtn btn"><img src="images/fb_btn.jpg"></a>		    		
		    	</div>
		    	<div class="conSquirrel1"><img src="images/contents_squirrel1.png"></div>
		    	<div class="nameBg">
		    		<div><?=$word?></div>
		    		<img src="images/name_bg.png">
		    	</div>
		    	<a href="/event/BuBuTripTicket/" target="_blank" class="goticketBtn">
		    		<img src="images/goticket.png">
		    		<div class="touchMe"><img src="images/goname_btn_ov.png" class="touchMeOv"><img src="images/goname_btn.png"></div>
		    	</a>
		    </div>
		</div>
		<div class="section" id="section2">
			<div id="activity" class="contents">
				<div class="activityBox"><img src="images/activity_box.png"></div>
				<div class="activityTxt">
					<div data-menuanchor="secondPage" class="goname btn"><a href="#secondPage"><img src="images/m_to_name_tn.png" alt="我要命名"></a></div>				
					<div class="scroll-pane">
						<h2><img src="images/activity_title.png" alt="「BuBuTrip吉祥物創意命名拿好禮」活動注意事項"></h2>
						<h3 class="actColorB"><i><img src="images/activity_scroll_btn.png"></i>&lt;活動說明&gt;</h3>
						<div class="actFL">
							<div><p>BuBuTrip親子自駕旅遊網(http://www.bubutrip.com.tw/)，讓所有辛苦的爸媽在忙碌的生活之餘，也可以達成「7分鐘規劃親子小旅行」的小確幸。<br/>為了讓BuBuTrip的形象更為具體，BuBuTrip邀請知名插畫家afu設計了可愛飛鼠造型的吉祥物，並邀請有想法的網友們前來參加「BuBuTrip吉祥物創意命名拿好禮」活動，讓我們一同腦力激盪，幫可愛的小飛鼠找個可愛的好名字吧！只要夠有創意，就有大獎等著你！</p></div>
							<div class="actImg"><img src="images/activity_squirrel.png"></div>
							<br clear="left"/>
						</div>
						<h3 class="actColorO"><i><img src="images/activity_scroll_btn.png"></i>&lt;活動時間&gt;</h3>
						<p>104年7月28曰至104年8月18曰</p>
						<h3 class="actColorY"><i><img src="images/activity_scroll_btn.png"></i>&lt;活動方式&gt;</h3>
						<ol>
							<li>依照「BuBuTrip吉祥物創意命名拿好禮」活動網站(以下簡稱本活動網站)指示，登入BuBuTrip會員或註冊成為新會員，並寫下您對BuBuTrip 吉祥物創意命名及命名意涵(限50字內)。
								<ul>
									<li>每個會員帳號僅得參加乙次，若發現重複參加者，以一次為計。</li>
									<li>不同參加者重複命名若獲獎，以先提交名稱者為準。</li>
								</ul>
							</li>
							<li>命名完成後，將本活動分享到Facebook個人專頁，即可獲得抽獎資格。</li>
							<li>活動網站提供afu設計之可愛吉祥物桌布，可視需求下載。</li>
						</ol>
						<h3 class="actColorB"><i><img src="images/activity_scroll_btn.png"></i>&lt;命名評選方式&gt;</h3>
						<ol>
							<li>由主辦單位遴選適當評選委員100%評比。</li>
							<li>評比配重：
								<ul>
									<li>創意性35％(命名名稱是否具有創意，能讓吉祥物脫穎而出)。</li>
									<li>關聯性35%(與BuBuTrip品牌的關聯度；命名是否能讓人聯想到品牌)</li>
									<li>完整性30%(命名名稱及命名意涵是否合乎規定；命名意涵是否敘述完整)</li>
								</ul>
							</li>
							<li>總分最高分的作品將作為 BuBuTrip吉祥物命名名稱之參考依據。</li>
						</ol>
						<h3 class="actColorO"><i><img src="images/activity_scroll_btn.png"></i>&lt;活動獎項&gt;</h3>
						<ol>
							<li>「命名我最會獎」：由評選分數最高者獲獎，作品將做為BuBuTrip吉祥物正式名稱之參考依據。獎項內容為價值$30,000元旅遊券，為自己找個時間出遊，放鬆一「夏」吧！(旅遊券使用範圍：東南旅行社旅遊商品兌換)</li>
							<li>「我最幸運獎」：將從所有成功參與命名活動者中，抽出100名，贈送插畫作家afu-日本製森林文青系紙膠帶乙份（價值新台幣160元）。</li>
						</ol>
						<h3 class="actColorO"><i><img src="images/activity_scroll_btn.png"></i>&lt;得獎名單公告&gt;</h3>
						<p>得獎名單於104年8月24日公布於活動網頁，主辦單位將自104年9月1日起陸續以E-Mail通知得獎者，請得獎者密切注意註冊BuBuTrip會員所填寫的E-Mail信箱。得獎者應於104年9月15日前依主辦單位指示回覆寄送資料，逾期視同放棄得獎資格，名額不再遞補。</p>
						<h3 class="actColorO"><i><img src="images/activity_scroll_btn.png"></i>&lt;活動獎項寄送時間&gt;</h3>
						<p>主辦單位將於104年9月15日確認寄送名單，陸續將贈品寄出。</p>
						<h3 class="actColorB"><i><img src="images/activity_scroll_btn.png"></i>&lt;活動主辦單位&gt;</h3>
						<p>本活動由和泰汽車股份有限公司主辦(以下簡稱主辦單位)，若對於本活動有任何問題（包含個人資料保護事項），請透過E-Mail方式（service@bubutrip.com.tw）或撥打活動專線(02)2501-0217與主辦單位聯繫。</p>
						<h3 class="actColorK"><i><img src="images/activity_scroll_btn.png"></i>&lt;注意事項&gt;</h3>
						<ol>
							<li>本次活動僅限於設籍於台灣、金門、澎湖、馬祖地區者參加，惟主辦單位(含其關係企業)之員工不能參與本活動，主辦單位不處理寄送獎品至海外地區之事宜。</li>
							<li>參加本活動之所有資料均由主辦單位保有，作為參加者領取獎品依據等活動相關事宜之用。主辦單位將善盡保密之責，絕不外洩，敬請安心填寫。</li>
							<li>本活動注意事項載明於活動網頁中，參加者參與本活動同時，即同意接受本活動注意事項之規範。如有違反本活動注意事項之行為（如：攻擊網站活動及惡意註冊等違反公平平原則之行為），主辦單位得取消其參加或得獎資格，並對於任何破壞本活動之行為保留法律追訴權。</li>
							<li>參加者保證所有填寫或提出之資料均為正確，且未冒用或盜用任何第三人之資料。如因填寫或提出之資料有錯誤致主辦單位無法通知其得獎訊息時，或所提出資料雖正確，主辦單位仍無法聯繫上得獎者時，主辦單位不負任何責任，且視為得獎者放棄得獎資格，名額不再遞補，亦不另行補發獎項。如有致損害於主辦單位或其他任何第三人，參加者應負一切民刑事責任。</li>
							<li>如有任何因電腦、網路、電話、技術、郵件等不可歸責於主辦單位之事由，致無法通知得獎人，得獎人因而未能於回覆期限前回覆致喪失得獎資格，或寄送獎品有延遲、損毀或遺失等情況，主辦單位不負任何法律責任，參加者亦不得因此異議。</li>
							<li>本活動因故無法進行時，主辦單位有權決定取消、終止、修改或暫停本活動。主辦單位保有審核參加資格之權利。</li>
							<li>主辦單位保有審核參加資格之權利。</li>
							<li>參加本活動者同意主辦單位基於活動目的，得公布其得獎名稱或部分資料於網站。</li>
							<li>得獎者同意主辦單位對所有因使用或領取獎項之後果無須負責。主辦單位寄出獎項後，如獎項遺失或被竊，主辦單位不再發給任何證明或補償。</li>
							<li>主辦單位保留更換其他等值獎項之權利。</li>
							<li>本活動之所有獎品以實物為準，獎項部分不得折抵現金；主辦單位保留更換獎品之權利。依財政部國稅局規定，得獎金額或獎項若為新台幣1,000(含)-19,999元，得獎人須申報當年所得，活動廠商將於年底寄發扣繳憑單予獲獎人。得獎金額或獎項若超過新台幣20,000元，依法應扣繳10%之稅金(非中湖民國境內居住之個人，依法扣繳20%稅金)，得獎者須完稅後方得領獎，並由主辦單位代為申報並寄送扣繳憑單，若得獎者未能依法繳納稅金，及視為喪失資格；其他未盡事宜，悉依中華民國稅法相關規定辦理。以上稅法規定若不願意配合，則視為自動棄權，不具得獎資格。</li>
							<li>其他未盡事宜，悉依主辦單位相關規定。</li>
							<li>若因本活動發生訴訟時，以臺灣臺北地方法院為第一審管轄法院。</li>
						</ol>
					</div>
				</div>
			</div>			
		</div>
	</div>
</body>
</html>
