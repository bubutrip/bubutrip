<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require '../../inc/config.php';
require PATH_INC.'/class_user.php';
require '../dbconn.php';
require '../PHPMailer/PHPMailerAutoload.php';

if( isset( $_SESSION['offerme2_click'] ) ){
	$mem_ticketclick = $_SESSION['offerme2_click'];
}else{
	$mem_ticketclick = '';
}


$user_id = User::getId(); //使用者編號
$user_name = User::getName();

$is_new_user = ( isset( $_SESSION['is_new_user'] ) )?$_SESSION['is_new_user']:0;

if( !empty($user_id) ){

	$memberloginkey = true;
	/*
	$userdata = dbconn::getUserById( $user_id );
	$userfbdata = dbconn::getFBUserById( $user_id );
	dbconn::insertMem( $user_id , $is_new_user );

	$toemail = ( !empty( $userdata['email'] ) )?$userdata['email']:'';
	$toemail = ( !empty( $userfbdata['sns_email'] ) )?$userfbdata['sns_email']:'';

	$ticket_str = dbconn::make_ticket( 4 , $user_id , $is_new_user , $mem_ticketclick );
	dbconn::update_getticket( $user_id );

	if( empty( $ticket_str ) ){
		dbconn::go_showmsg("您已獲得抽獎資格，8月19日將於本活動網站公佈得獎主，請密切注意註冊信箱。","/event/BuBuTripTicket/m.index.php?ticket=1");
		exit();
	}

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
		$mail->Body = '<html><body id="event_email">親愛的 '.$user_name.'，您好：<br><link rel="stylesheet" type="text/css" href="http://www.bubutrip.com.tw/event/defcss/email.css"><br>恭喜您獲得臺北市立動物園<b><u style="color:#cc0000">8月23日(週日)</u></b>的​免費門票，兌換流程及注意事項如下:​<br><br>1.兌換時間：<b><u style="color:#cc0000">民國104年8月23(日) ​09:00-15:30</u></b><br>2.兌換地點：臺​北市立動物園門口廣場(請依現場指示牌前往指定地點兌換)。<br>3.兌換方式：出示此【​索票憑證】，可將索票憑證影印下來或直接經由行動裝置(手機、平板等)出示索票憑證，由現場工作人員核對流水後及註冊信箱，並發給動物園入園門票及吉祥物見面會摸彩券乙張。​<br><br>活動當日13:30-16:00​在<b><u style="color:#cc0000">動物園大門廣場</u></b>也有好吃好玩的【BuBuTrip吉祥物見面會】，我們將帶來好玩的互動遊戲，有奇哥雲朵羊紗布大包巾、扇子、明信片、霜淇淋、麥當勞薯條多項好禮送給你！現場還能抽Dyson無線吸塵器及捷安特Push Bike喔！(提醒您：活動抽獎時，得獎人務必本人在現場，才能把獎品帶回家唷！) <br><br>非常期待與您同樂，我們8月23日見囉！<br><br><div style="width:540px;height:666px;position: relative;"><table id="event_table_ticket" align="center" width="540" height="666" background="http://www.bubutrip.com.tw/event/defimg/email.jpg" style="display:block;min-width:540px;"><td style="width:540px;padding-top: 139px;text-align: center;font-size: 30px;" valign="top">'.$ticket_str.'</td></table></div><br><br>--<br>BuBuTrip 親子自駕旅遊第一站<br><br>讓你輕鬆方便規畫行程<br><br>雲端儲存加車內導航無縫接軌<br><br>享受快樂完美的親子小旅行！<br><br><a href="http://www.bubutrip.com.tw">http://www.bubutrip.com.tw</a><br><br>官方臉書粉絲團<br><br><a href="http://www.facebook.com/bubutrip2tw">http://www.facebook.com/bubutrip2tw</a></body></html>';
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

	*/

}else{
	header("content-type: text/html; charset=utf-8");
	echo "<script>";
	echo "location.href='/event/BuBuTripTicket/m.index.php'";
	echo "</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">		
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">		
<meta name="google-site-verification" content="" />		
<meta name="description" content="命名我最會獎：命名若經採用，即送價值$30,000元旅遊券，為自己找個時間出遊，放鬆一「夏」吧！我最幸運獎：凡參與命名活動，即可獲得抽獎機會。共抽出100位幸運得主，送價值$160元的插畫作家afu日本製森林系紙膠帶乙份。">
<meta name="keywords" content="BuBuTrip、親子自駕旅遊網、吉祥物、命名我最會獎、$30,000元、旅遊券、放鬆一「夏」、我最幸運獎、命名活動、抽獎、100位幸運得主、$160元、插畫作家afu、日本製森林系紙膠帶、彩虹森林、小飛鼠、Dyson戴森無線吸塵器、捷安特滑步車" />
<meta name="url" content="http://www.bubutrip.com.tw/" />	
<meta property="og:locale" content="zh_TW" />		
<meta property="og:site_name" content="【BuBuTrip招募新會員】無料暢遊動物園，再抽Dyson和捷安特！" />		
<meta property="og:title" content="【BuBuTrip招募新會員】無料暢遊動物園，再抽Dyson和捷安特！" />			
<meta property="og:url" content="http://www.bubutrip.com.tw/" />
<meta property="og:type" content="Website" /><meta property="og:image" content="/event/defimg/share2.jpg"></meta>	
<meta property="og:description" content="落腳在BuBuTrip的可愛小飛鼠，熱情邀請你參加派對！現場除了和小飛鼠歡樂互動、遊戲體驗拿禮物，更加碼抽出人氣大好物「Dyson吸塵器」和親子界最夯的「捷安特Push Bike」唷！" />
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
	$(document).ready(function(){
		alert("歡迎加入BuBuTrip會員，但活動已結束，沒有贈票喔！");
		window.location = 'm.index.php';
		//setTimeout(function(){ showfblike(); }, 1000);
	})
</script>
<? exit() ?>
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
				<div class="ticketfbsharer closebtn">X</div>
				<div id="fbox2">快拿到票啦！幫粉絲團按個讚</div>
				<div class="fb-page" data-href="https://www.facebook.com/bubutrip2tw" data-width="200" data-small-header="true" data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/bubutrip2tw"><a href="https://www.facebook.com/bubutrip2tw">BuBu Trip</a></blockquote></div></div>
			</div>
			<br>
		</div>
	</div>
	<input type="hidden" id="is_new_user" value="<?=$is_new_user?>">
	<div id="logo"><a href="http://www.bubutrip.com.tw/" target="_blank"><img src="images/logo.png"></a></div>	
	<div class="voucherBox">
		<div class="voucherTxt">
			<h2 class="bigTxt">BuBuTrip 吉祥物見面會贈票活動<br/>索票憑證</h2>
			<div class="voucherNoBox">
				<div>憑證序號：</div>
				<div class="voucherTxtBox">
					<span><?=$ticket_str?></span>
					<img src="images/voucher_tbox.jpg">
				</div>
				<br clear="left"/>
			</div>
			<div class="voucherNote">
				<span>兌換流程與注意事項：<br/>吉祥物見面會當日，憑此「索票憑證」即可兌換入園門票。(索票憑證也會同步mail至您的註冊信箱。)</span>
				<ol>
					<li style="color:#e85513;">兌換時間：民國104年8月23(日)，9:00-15:30</li>
					<li>兌換地點：臺北市立動物園門口廣場(請依現場指示牌前往指定地點兌換)。</li>
					<li>兌換方式：出示此「索票憑證」。可將索票憑證影印下來或直接經由行動裝置(手機、平板等)出示索票憑證，由現場工作人員核對流水號及註冊信箱，並發給動物園入園門票。</li>
					<li>其他：<br/>
						<i><img src="images/voucher_dizc.jpg"></i>每張索票憑證可兌換動物園全票乙張。<br/>
						<i><img src="images/voucher_dizc.jpg"></i>每位成年人(18歲以上)另可獲得吉祥物<br/>見面會摸彩券乙張。<br>
						<i><img src="images/voucher_dizc.jpg"></i>原訂活動日期，因颱風來襲，改至9/13(日)舉行。<br/>
					</li>
				</ol>
			</div>
		</div>		
		<img src="images/m_voucher_bg.png">
	</div>
	<nav style="margin-top:5%;">
		<a href="m.meeting.php" class="floatL" style="margin-left:5%;"><img src="images/m_meeting_btn.png" alt="見面會好康"></a>
		<a href="m.activity.php" class="floatR" style="width: 42%;"><img src="images/m_activity_btn.png" alt="活動辦法"></a>
		<br clear="both" />
	</nav>
	<div id="copyright">Copyright © 2015 all rights reserved.</div>	
</div>
</body>
</html>
