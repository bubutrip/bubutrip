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
<script src="<?=imgurl?>/event/2015Anniversary/resources/js/modernizr.js"></script>
<script src="<?=imgurl?>/event/2015Anniversary/resources/js/jquery.fancybox.pack.js"></script>
<script src="<?=imgurl?>/event/2015Anniversary/resources/js/app.js"></script>

<link rel="stylesheet" type="text/css" href="<?=imgurl?>/event/2015Anniversary/resources/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?=imgurl?>/event/2015Anniversary/resources/css/jquery.fancybox.css">
<link rel="stylesheet" type="text/css" href="<?=imgurl?>/event/2015Anniversary/resources/css/m.style.css">

<script src="<?=imgurl?>/event/2015Anniversary/resources/js/m.main.js"></script>

</head>
</head>
<body>
<div id="wrapper">
	<!--<div id="logo"><a href="http://www.bubutrip.com.tw/" target="_blank"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/m/logo.png"></a></div>-->
	<h2><img src="<?=imgurl?>/event/2015Anniversary/resources/images/m/invite_title.jpg"></h2>
	<div class="sns-login">
      <ul>
        <li><a href="/event/2015Anniversary/fblogin.php" class="sns-fb"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/m/login_fb_btn.jpg">使用 Facebook 登入</a></li>
        <li><a href="/event/2015Anniversary/googlelogin.php" class="sns-gp"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/m/login_google_btn.jpg">使用 Google+ 登入</a></li>
      </ul>
    </div><!-- .sns-login -->
    
    <form name="login-form" id="login-form" action="/login/sign-in/" method="post">
      <ul class="fields">
    		<li class="field username">
    			<input type="email" name="email" placeholder="Email 信箱" class="inp-email">
    		</li>
    		<li class="field password">
    			<input type="password" name="passwd" placeholder="密碼" class="inp-passwd">
    		</li>
      </ul>
      <div class="btns">
    		<button class="submit">登入</button>
      </div>
  		<div class="btns-alt">
  			<a class="register" href="register.php?com_key=<?=$_GET['com_key']?>">註冊新會員</a>
  		</div>
	  </form><!-- #login-form -->
	<div id="copyright">
		<img src="<?=imgurl?>/event/2015Anniversary/resources/images/m/invite_pic.jpg">
		<span>©2015 BuBuTrip. All rights reserved.</span>
    <br clear="both"/>
	</div>
</div>

<div class="success confirmbox" id="dlg-generic">
	<img src="<?=imgurl?>/event/2015Anniversary/resources/images/m/success_bg.jpg">
  <a href="#" class="checkCloseBtn"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/m/close.png"></a>
  <a href="#" class="bn-action hide">我知道了</a>
</div>

<script>
$(function(){

  $('form').on('submit',function(e){ e.preventDefault(); });  

  $('#login-form .submit').on('click',function(e){
    e.preventDefault();
    var frm=document.forms['login-form'], email=frm.email.value, pwlen=frm.passwd.value.length;
    if( email.length<10 || email.indexOf('@')<0 || pwlen<4 )
    { alert("請輸入帳號(Email)與密碼"); return; }
    
    var loading=$(this).data('loading'), now=App._now();
    if( typeof loading!='undefined' && loading>(now-3) ){ return; }
    
    $(this).fadeTo(200,.25).data('loading',App._now());
    $.post(frm.action,$('#login-form').serialize(),function(res){
      $('#login-form .bn-action.submit').fadeTo(0,1);
      if( res.success==0 ){ alert(res.msg); }
      if( res.success==1 ){
        
        if(!!res.next && res.next!=""){
          window.location.href=res.next; return;
        }
        window.location.href = '/event/2015Anniversary/';
      }
    },'json');
  });
  
  
  $('.sns-fb, .sns-gp').on('click',function(e){
    var provider='fb';
    if( $(this).hasClass('sns-gp') ) provider='gp';
    App._track('users','btn-'+provider);
  });

  $('#dlg-generic .bn-action, #dlg-generic .checkCloseBtn').on('click',function(e){ $.fancybox.close(); });
  if( window.location.hash && window.location.hash=='#verified' )
  {
    $.fancybox.open('#dlg-generic',{
                        closeBtn: false,
                        scrolling:false,
                        autoSize: true,
                        width: 854,
                        height: 525
                    });
  }

});
</script>
</body>
</html>
