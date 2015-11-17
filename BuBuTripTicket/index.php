<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require '../../inc/config.php';
require PATH_INC.'/class_user.php';
require '../dbconn.php';
require '../PHPMailer/PHPMailerAutoload.php';

if( !empty( $_GET['offerme2_click'] ) ){
	$_SESSION['offerme2_click'] = $_GET['offerme2_click'];
}
if( isset( $_SESSION['offerme2_click'] ) ){
	$mem_ticketclick = $_SESSION['offerme2_click'];
}else{
	$mem_ticketclick = '';
}

dbconn::checkmobile();

#var_dump(FB_APPID); //fb app id
#var_dump(FB_SECRET); //fb app secret

$user_id = User::getId(); //使用者編號
$user_name = User::getName();

$hi_ticket_str = false;
$ticket_str = false;
$memberloginkey = false;
$is_new_user = ( isset( $_SESSION['is_new_user'] ) )?$_SESSION['is_new_user']:0;
if( !empty($user_id) ){
	$memberloginkey = true;
	/*
	$userdata = dbconn::getUserById( $user_id );
	$userfbdata = dbconn::getFBUserById( $user_id );
	dbconn::insertMem( $user_id , $is_new_user );

	$toemail = ( !empty( $userdata['email'] ) )?$userdata['email']:'';
	$toemail = ( !empty( $userfbdata['sns_email'] ) )?$userfbdata['sns_email']:'';

	dbconn::update_getticket( $user_id );
	$hi_ticket_str = dbconn::make_ticket( 0 , $user_id , $is_new_user );
	if( !empty( $_GET['ticket'] ) ){
		$ticket_str = dbconn::make_ticket( 4 , $user_id , $is_new_user , $mem_ticketclick );
		if( !empty( $ticket_str ) ){ $hi_ticket_str = $ticket_str; }

		if( !empty( $ticket_str ) ){

			$emailstatus = dbconn::query_email_send_status( $ticket_str );
			if( empty( $emailstatus ) ){
				$emailstatus['mem_emailsend'] = 0;
			}

			if( !empty( $toemail ) and $emailstatus['mem_emailsend'] == 0 ){
				//發送Email
				$mail = new PHPMailer();
				$mail->IsSMTP();

				$mail->SMTPAuth = true;//使用Gmail的SMTP需要驗證，所以這裡要設true
				$mail->SMTPSecure = "ssl";

				//Gmail的SMTP是使用465port
				$mail->Host = "smtp.gmail.com";
				$mail->Port = 465;
				$mail->Username = 'bubutrip2015@gmail.com';//帳號
				$mail->Password ='28844754';//密碼

				#$mail->Username = 'jakeinlife@gmail.com';//帳號
				#$mail->Password ='038wiwZq';//密碼

				$mail->From = 'bubutrip2015@gmail.com';//寄件者
				$mail->FromName = 'BuBuTrip';//寄件者姓名

				$mail->AddAddress($toemail);//收件者


				$mail->CharSet = "utf-8";
				$mail->Encoding = "base64";
				$mail->IsHTML(true);
				$mail->WordWrap = 50;

				$mail->Subject = "恭喜您獲得臺北市立動物園免費門票！";//主旨
				$mail->Body = '<html><body id="event_email">親愛的 '.$user_name.'，您好：<br><link rel="stylesheet" type="text/css" href="http://www.bubutrip.com.tw/event/defcss/email.css"><br>恭喜您獲得臺北市立動物園<b><u style="color:#cc0000">9月13日(週日)</u></b>的​免費門票，兌換流程及注意事項如下:​<br><br>1.兌換時間：<b><u style="color:#cc0000">民國104年9月13(日) ​09:00-15:30</u></b><br>2.兌換地點：臺​北市立動物園門口廣場(請依現場指示牌前往指定地點兌換)。<br>3.兌換方式：出示此【​索票憑證】，可將索票憑證影印下來或直接經由行動裝置(手機、平板等)出示索票憑證，由現場工作人員核對流水後及註冊信箱，並發給動物園入園門票及吉祥物見面會摸彩券乙張。​<br><br>活動當日13:30-16:00​在<b><u style="color:#cc0000">動物園大門廣場</u></b>也有好吃好玩的【BuBuTrip吉祥物見面會】，我們將帶來好玩的互動遊戲，有奇哥雲朵羊紗布大包巾、扇子、明信片、霜淇淋、麥當勞薯條多項好禮送給你！現場還能抽Dyson無線吸塵器及捷安特Push Bike喔！(提醒您：活動抽獎時，得獎人務必本人在現場，才能把獎品帶回家唷！) <br><br>非常期待與您同樂，我們9月13日見囉！<br><br><div style="width:540px;height:666px;position: relative;"><table id="event_table_ticket" align="center" width="540" height="666" background="http://www.bubutrip.com.tw/event/defimg/email.jpg" style="display:block;min-width:540px;"><td style="width:540px;padding-top: 139px;text-align: center;font-size: 30px;" valign="top">'.$ticket_str.'</td></table></div><br><br>--<br>BuBuTrip 親子自駕旅遊第一站<br><br>讓你輕鬆方便規畫行程<br><br>雲端儲存加車內導航無縫接軌<br><br>享受快樂完美的親子小旅行！<br><br><a href="http://www.bubutrip.com.tw">http://www.bubutrip.com.tw</a><br><br>官方臉書粉絲團<br><br><a href="http://www.facebook.com/bubutrip2tw">http://www.facebook.com/bubutrip2tw</a></body></html>';
				$mail->AltBody = "Your browser does not support HTML";

				#$mail->SMTPDebug = 2; // 1: message, 2: full result

				if(!$mail->Send()){
					echo "寄信發生錯誤：" . $mail->ErrorInfo;
					exit();
					//如果有錯誤會印出原因
				}

				dbconn::update_sentemail( $ticket_str );
				echo "<!--使用者電子郵件帳號:".$toemail."-->";

				//串回API
				$api_url = 'http://pub.offerme2.com/callback?key=a6ace437-33b2-2d72-97f2-33081978490d&clickid='.$mem_ticketclick.'&status=valid';
				echo '<!-- '.$api_url.' -->';
		        #初始化變數設定
		        $ans = '';
		        $http_response_header = array();

		        $opts = array(
		                'http'=>array(
		                        'method'=>"GET",
		                        'header'=>"Accept-language: en\r\n" .
		                        "Cookie: foo=bar\r\n" .
		                        "User-Agent: Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.102011-10-16 20:23:10\r\n"
		                )
		        );
		        #設定截取資訊
		        $context = stream_context_create($opts);
		        #取得網站截取結果
		        $contents = file_get_contents( $api_url , false, $context );

			}else{
				echo "<!--查無使用者電子郵件-->";
			}
		}


	}

	#exit();
	*/
}else{
	//強制設定登入後導回頁面
	$_SESSION['login:next:tag'] = 'event';
	$_SESSION['login:next'] = "/event/BuBuTripTicket/?ticket=1";
}

?>
<html lang="en">
<head>
<meta charset="utf-8">		
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">		
<meta name="google-site-verification" content="" />		
<meta name="description" content="親子自駕旅遊網BuBuTrip吉祥物誕生了！9/13(日)在台北市立動物園將隆重與大家相見~我們將帶來好玩的互動遊戲，有奇哥雲朵羊紗布大包巾(價值$850元/2入)、扇子、明信片、霜淇淋、麥當勞薯條多項好禮送給你！更棒的是，活動現場會送出Dyson戴森無線吸塵器(價值$27,900元)一台！另外，還會抽出兩部小朋友界最夯的捷安特滑步車(價值$3,280)，心動了就千萬別錯過，等你喔~">
<meta name="keywords" content="BuBuTrip、親子自駕旅遊網、吉祥物、Dyson戴森無線吸塵器、捷安特滑步車、野餐墊、扇子、名信片、冰淇淋、爆米花、台北市立動物園" />
<meta name="url" content="http://www.bubutrip.com.tw/" />	
<meta property="og:locale" content="zh_TW" />		
<meta property="og:site_name" content="【BuBuTrip招募新會員】無料暢遊動物園，再抽Dyson和捷安特！" />		
<meta property="og:title" content="【BuBuTrip招募新會員】無料暢遊動物園，再抽Dyson和捷安特！" />			
<meta property="og:url" content="http://www.bubutrip.com.tw/event/BuBuTripTicket/" />
<meta property="og:type" content="Website" />
<meta property="og:image" content="http://www.bubutrip.com.tw/event/defimg/share2.jpg"></meta>	
<meta property="og:description" content="落腳在BuBuTrip的可愛小飛鼠，熱情邀請你參加派對！現場除了和小飛鼠歡樂互動、遊戲體驗拿禮物，更加碼抽出人氣大好物「Dyson吸塵器」和親子界最夯的「捷安特Push Bike」唷！" />
<title>現在加入BuBuTrip會員送動物園門票</title>
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
<script src="js/jquery.mousewheel.js"></script>
<script src="js/jquery.mCustomScrollbar.js"></script>
<script src="js/jquery.fullPage.min.js"></script>
<script src="js/main.js"></script>
<script src="../defjs/main.js"></script>

<script type="text/javascript">
	<? if( empty( $_GET['ticket']) ){ ?>
		alert("本活動已結束囉！");
	<? } ?>
	<? if( !empty( $_GET['ticket'] ) and empty( $ticket_str ) ){ ?>
	alert("歡迎加入BuBuTrip會員，但活動已結束，沒有贈票喔！");
	//alert("您已獲得抽獎資格，8月19日將於本活動網站公佈得獎主，請密切注意註冊信箱。");
	<? } ?>
	<? if( !empty( $_GET['ticket'] ) and !empty( $ticket_str ) ){ ?>
	$(document).ready(function(){
		alert("歡迎加入BuBuTrip會員，但活動已結束，沒有贈票喔！");
		//setTimeout(function(){ showfblike(); }, 1000);
	})
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
				<div class="ticketfbsharer closebtn">X</div>
				<div id="fbox2">快拿到票啦！幫粉絲團按個讚</div>
				<div class="fb-page" data-href="https://www.facebook.com/bubutrip2tw" data-width="200" data-small-header="true" data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/bubutrip2tw"><a href="https://www.facebook.com/bubutrip2tw">BuBu Trip</a></blockquote></div></div>
			</div>
			<br>
		</div>
	</div>
	<input type="hidden" id="is_new_user" value="<?=$is_new_user?>">
	<input type="hidden" id="memberloginkey" name="memberloginkey" value="<?=$memberloginkey?>">
	<input type="hidden" id="ticket_str" name="ticket_str" value="<?=$hi_ticket_str?>">

	<? if( empty( $_GET['ticket'] ) ){ ?>
	<div id="popupview">
		<div class="bigimgrng">
			<a href="#" class="closebtn"></a>
			<img src="images/popup.jpg" style="width: 600px;">
		</div>
	</div>
	<? } ?>

	<div id="logo"><a href="http://www.bubutrip.com.tw/" target="_blank"><img src="images/logo.png"></a></div>
	<div id="copyright">Copyright © 2015 all rights reserved.</div>
	<div id="bgPiank"><img src="images/bg_piank.png"></div>
	<div class="voucherBox <?=( empty( $ticket_str ) )?'disnone':''?>">
		<a href="#" class="voucherClose"></a>
		<div>
			<h2 class="bigTxt">BuBuTrip 吉祥物見面會贈票活動<br/>索票憑證</h2>
			<div class="voucherNoBox">
				<div>憑證序號：</div>
				<div class="voucherTxtBox"><?=$hi_ticket_str?></div>
				<br clear="left"/>
			</div>
			<div class="voucherNote">
				<span>兌換流程與注意事項：<br/>吉祥物見面會當日，憑此「索票憑證」即可兌換入園門票。(索票憑證也會同步mail至您的註冊信箱。)</span>
				<ol>
					<li style="color:#e85513;">兌換時間：民國104年9月13(日)，9:00-15:30</li>
					<li>兌換地點：臺北市立動物園門口廣場(請依現場指示牌前往指定地點兌換)。</li>
					<li>兌換方式：出示此「索票憑證」。可將索票憑證影印下來或直接經由行動裝置(手機、平板等)出示索票憑證，由現場工作人員核對流水號及註冊信箱，並發給動物園入園門票。</li>
					<li>其他：<br/>
						<i></i>每張索票憑證可兌換動物園全票乙張。<br/>
						<i></i>每位成年人(18歲以上)另可獲得吉祥物<br/>見面會摸彩券乙張。<br>
						<i></i>原訂活動日期，因颱風來襲，改至<br>9/13(日)舉行。<br>
					</li>
				</ol>
			</div>
		</div>
	</div>
	<div id="fullpage">
		<div class="section " id="section0">
			<ul id="scrollBox">
				<li data-menuanchor="firstPage" class="active top"><a href="#firstPage"><img src="images/top_btn.png" alt="回首頁"></a></li>
				<li data-menuanchor="secondPage" class="next"><a href="#secondPage"><img src="images/scroll_btn.png" alt="獎品拿不玩 快往下看看!"></a></li>
			</ul>
			<div class="index connect">				
				<div class="inBox1">
					<div>
						<h2><img src="images/index_meeting.png" alt="吉祥物見面會"></h2>
						<p><br/>親子自駕旅遊網BuBuTrip吉祥物誕生了！<br/>
						<span class="whiteTxt bigTxt">9/13(日)</span>在<span class="whiteTxt">臺北市立動物園</span>將隆重與大家相見~</p>
						<p>我們將帶來好玩的互動遊戲，有<span class="whiteTxt">奇哥雲朵羊紗布大包巾(價值$850元/2入)、扇子、明信片、霜淇淋、麥當勞薯條</span>多項好禮送給你！</p>
						<p>更棒的是，現場還會抽出媽媽最愛的<br/><span class="whiteTxt bigTxt">Dyson戴森無線吸塵器(價值$27,900元)一台！</span><br/>和小朋友界超夯的<span class="whiteTxt bigTxt">捷安特滑步車(價值$3,280元)</span>，<br/>心動就快來動物園找我們玩吧～</p>
					</div>
				</div>
				<div class="inBox2">
					<div><img src="images/index_box.png"></div>
					<div class="inTitle">
						<div class="inTitleLogo"><img src="images/title_logo.png"></div>
						<img src="images/index_title.jpg">
					</div>
					<p class="brownText">入園日期<br/>9/13(日)活動當天9:00-15:30</p>					
				</div>
				<div class="inSquirrel"><img src="images/squirrel.png"></div>				
				<a data-menuanchor="3rdPage" href="#3rdPage" class="inActivity"><img src="images/index_activity_icon.png" alt="活動辦法"></a>
				<a href="prize_list.html" target="_blank" class="inPrize"><img src="images/index_prize_icon.png" alt="得獎名單"></a>
				<a data-url="/login/facebook" class="registerBtn fb"><img src="images/register_btn.png"></a>				
			</div>
		</div>
		<div class="section" id="section1">		    
		    <div id="priza" class="contents">
		    	<a href="/event/BuBuTripName/" target="_blank" class="goNameBtn">
		    		<div class="squirrelDialog brownText">
		    			<img src="images/contents_box.png">
		    			<p>你問我的名字叫啥？哈哈<br/>快到這邊幫我取個名字吧！</p>
		    		</div>
		    		<div class="inSquirrel2"><img src="images/squirrel.png"></div>
		    		<div class="touchMe"><img src="images/goname_btn_ov.png" class="touchMeOv"><img src="images/goname_btn.png"></div>
		    	</a>
		    	<div class="conBox1 whiteTxt">
		    		<div>
			    		<h2><img src="images/index_meeting.png" alt="吉祥物見面會"></h2>
			    		<h3>時間：9/13(日)下午1:30開始<br/>地點：臺北市立動物園，大門廣場</h3>
			    		<p><br/>現場憑門票即可抽<br/>
			    		<span class="bigTxt">Dyson戴森無線吸塵器(價值$27,900元)</span><br/><br/>
			    		<span class="bigTxt">捷安特滑步車(價值$3,280元)，</span><br/><br/></p>
			    		<p>暑假還沒去過動物園玩嗎？<br/>趁此機會快來找我玩！</p>
		    		</div>
		    		<div class="prize1"><img src="images/prize1.png"></div>
		    		<div class="prize2"><img src="images/prize2.png"></div>
		    	</div>
		    	<div class="conBox2">
		    		<div class="map"><img src="images/map.png"></div>
		    		<div class="conBoxT">
			    		<p>來自彩虹森林的小飛鼠，<br/>對萬物充滿好奇，<br/>最喜歡探索世界，<br/>用旅行填滿生活。<br/>揹著小包包勇敢地展開冒險，<br/>裡頭裝滿最愛的果實，<br/>可以隨時補充能量，<br/>保持玩樂的體力。<br/>蓬鬆的尾巴代表著他的情緒，<br/>通常都是繽紛快樂的彩虹色，<br/>但不開心的時候，<br/>就會轉變為憂鬱的藍色喔～</p>
		    		</div>
		    	</div>		    	
		    </div>
		</div>
		<div class="section" id="section2">
			<div id="activity" class="contents">
				<div class="activityBox"><img src="images/activity_box.png"></div>
				<div class="activityTxt">
					<div data-menuanchor="firstPage" class="goname btn"><a href="#firstPage"><img src="images/m_ticket_btn.png" alt="拿免費門票"></a></div>
					<div class="scroll-pane">
						<h2><img src="images/activity_title.png" alt="「BuBuTrip 吉祥物見面會贈票活動」注意事項"></h2>
						<h3 class="actColorB"><i><img src="images/activity_scroll_btn.png"></i>&lt;活動說明&gt;</h3>
						<div class="actFL">
							<div><p>BuBuTrip親子自駕旅遊網(http://www.bubutrip.com.tw/)的吉祥物終於誕生囉！為此，BuBuTrip特別在這個暑假，在大小朋友最愛的臺北市立動物園，舉辦吉祥物見面會活動，更棒的是，只要透過「BuBuTrip吉祥物見面會贈票活動網站(以下簡稱「本活動網站」)，註冊為新會員或登入會員，就可以獲得免費動物園門票，BuBuTrip邀請各位爸比媽咪帶著家裡寶貝一起來參加歡樂無比的遊園會！</p></div>
							<div class="actImg"><img src="images/activity_squirrel.png"></div>
							<br clear="left"/>
						</div>
						<h3 class="actColorO"><i><img src="images/activity_scroll_btn.png"></i>&lt;贈票活動時間&gt;</h3>
						<p>104年7月28曰至104年8月19曰</p>
						<h3 class="actColorY"><i><img src="images/activity_scroll_btn.png"></i>&lt;活動方式&gt;</h3>
						<p>動物園門票索取事宜，分為新加入會員(從本活動網站註冊之會員)及既有會員：</p>
						<ol>
							<li>104年7月28曰號後新加入之會員：
								<ul>
									<li>從本活動網站完成註冊程序，並將本活動分享至Facebook個人專頁後，前2,000名可獲得「臺北市立動物園免費入園券乙張」。</li>
									<li>若您為前2,000名新會員，系統會自動將「索票憑證」寄到您的E-Mail信箱，請您密切注意註冊BuBuTrip會員所填寫的E-Mail信箱。（若以Facebook註冊登入者，請至註冊Facebook時所使用的信箱查看；也就是您登入Facebook的帳號)</li>
									<li>若已經註冊成功，十分鐘後仍未收到索票憑證，請先至垃圾信箱查看。若確認仍未收到憑證，請透過E-Mail方式（service@bubutrip.com.tw）或撥打活動專線(02)2501-0217與主辦單位聯繫。</li>
								</ul>
							</li>
							<li>104年7月28曰號前註冊之會員：
								<ul>
									<li>由本活動網站登入BuBuTrip會員，即可獲得免費動物園票抽獎資格，BuBuTrip將抽出100名幸運得主。</li>
									<li>得獎名單於104年8月19日公布於活動網頁，主辦單位將在當日以E-Mail將「索票憑證」寄給得獎者，請得獎者密切注意註冊BuBuTrip會員所填寫的E-Mail信箱（若以Facebook註冊登入者，請至註冊Facebook時所使用的信箱查看；也就是您登入Facebook的帳號)</li>
								</ul>
							</li>
						</ol>
						<h3 class="actColorB"><i><img src="images/activity_scroll_btn.png"></i>&lt;兌換實體入園門票方式&gt;</h3>
						<p>吉祥物見面會當日，憑「索票憑證」即可兌換入園門票。</p>
						<ol>
							<li>兌換時間：民國104年9月13(日)，9:00-15:30</li>
							<li>兌換地點：臺北市立動物園門口廣場 (請依現場指示牌前往指定地點兌換)。</li>
							<li>兌換方式：出示「索票憑證」。可將索票憑證影印下來或直接經由行動裝置(手機、平板等)出示索票憑證，由現場工作人員核對流水號及註冊信箱，並發給動物園入園門票。</li>
							<li>其他：
								<ul>
									<li>每個索票憑證可兌換動物園全票乙張。</li>
									<li>每位成年人(18歲以上)另可獲得吉祥物見面會摸彩券乙張。</li>
									<li>原訂活動日期，因颱風來襲，改至9/13(日)舉行。</li>
								</ul>
							</li>
						</ol>						
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
