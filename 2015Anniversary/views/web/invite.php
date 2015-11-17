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
    <title>BuBuTrip週年慶</title>
    <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script type="text/javascript">var console = { log: function() {} };</script><![endif]-->
    <!--[if lt IE 9]><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script><![endif]-->
    <link rel="shortcut icon" href="<?=imgurl?>/event/2015Anniversary/resources/images/favicon.ico">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script>
    !window.jQuery && document.write('<script src="<?=imgurl?>/event/2015Anniversary/resources/js/jquery-1.8.1.min.js"><\/script>')
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
    <script src="<?=imgurl?>/event/2015Anniversary/resources/js/modernizr.js"></script>
    <script src="<?=imgurl?>/event/2015Anniversary/resources/js/utils.js"></script>
    <script src="<?=imgurl?>/event/2015Anniversary/resources/js/jquery.fancybox.pack.js"></script>
    <script src="<?=imgurl?>/event/2015Anniversary/resources/js/jquery.placeholder.js"></script>
    <script src="<?=imgurl?>/event/2015Anniversary/resources/js/app.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=imgurl?>/event/2015Anniversary/resources/css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?=imgurl?>/event/2015Anniversary/resources/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=imgurl?>/event/2015Anniversary/resources/css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="<?=imgurl?>/event/2015Anniversary/resources/css/jqtransform_login.css" />
    <script src="<?=imgurl?>/event/2015Anniversary/resources/js/main.js"></script>
    <script type="text/javascript" src="<?=imgurl?>/event/2015Anniversary/resources/js/jquery.jqtransform_login.js"></script>
    <script language="javascript">
    $(function() {
        $('#login-form, #forgot-form').jqTransform({
            imgPath: '<?=imgurl?>/event/2015Anniversary/resources/images/img/login'
        });
    });
    </script>
</head>

<body>
    <!--<div id="logo"><a href="http://www.bubutrip.com.tw/" target="_blank"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/logo.png"></a></div>-->
    <div id="copyright">©2015 BuBuTrip. All rights reserved.</div>
    <div id="contents" class="login">
        <h2><img src="<?=imgurl?>/event/2015Anniversary/resources/images/invite_title.gif"></h2>
        <div class="inviteTxt"><img src="<?=imgurl?>/event/2015Anniversary/resources/images/invite_txt.gif"></div>  
        <div class="account">    
            <form name="login-form" id="login-form" action="/event/server_api/serviceapi.php?model=WebApi&function=web_login" method="post">
                <div class="field username rowElem">
                    <input type="text" name="email" placeholder="帳號 (Email)" style="width:100%">
                </div>
                <div class="field password rowElem">
                    <input type="password" name="passwd" placeholder="會員密碼" style="width:100%">
                </div>
                <div class="submit hide formBtn">登入</div>
                
                <div class="descr">
                    <a class="getpsw" href="#forgot-form">忘記密碼</a>
                    <a class="register" href="register.php?com_key=<?=$_GET['com_key']?>">註冊會員</a>
                </div>
            </form>
            <form name="forgot-form" id="forgot-form" action="/login/forgot/" method="post" style="display:none">
                <div class="field username rowElem">
                    <input type="text" name="email" placeholder="帳號 (Email)" style="width:100%">
                </div>
                <div class="field username rowElem">
                    <input type="text" name="unrobot" placeholder="4 + 8 = ?" style="width:100%">
                </div>
                <div class="submit hide formBtn">寄送新密碼</div>
                
                <div class="descr">
                    <a class="back" href="#login-form">登入畫面</a>
                    <a class="register" href="register.php?com_key=<?=$_GET['com_key']?>">註冊會員</a>
                </div>
            </form>      
        </div><!--/.account-->
    
        <div class="connect">
            <div class="fb hide formBtn" data-url="/event/2015Anniversary/fblogin.php">使用 Facebook 登入</div>
            <div class="google hide formBtn" data-url="/event/2015Anniversary/googlelogin.php">使用 Google+ 登入</div>
        </div>
    </div>

    <div class="success confirmbox" id="dlg-generic">
        <a href="#" class="checkCloseBtn"></a>
        <a href="#" class="bn-action hide">我知道了</a>
    </div>

    <script>
    /* Placeholder polyfill for IE9-
     * @see https://github.com/mathiasbynens/jquery-placeholder
     */
    var is_mobile=false;
    $(function(){

        $('input[placeholder], textarea[placeholder]').placeholder();


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
          $('#login-form .submit').fadeTo(0,1);
          if( res.success==0 ){ alert(res.msg); }
          if( res.success==1 ){
            
            if(!!res.next && res.next!=""){
              window.location.href=res.next; return;
            }
            window.location.href='/event/2015Anniversary/';
          }
        },'json');
      });
      
      
      $('.connect ').on('click','.fb,.google',function(e){
        
        var provider='fb';
        if( $(this).hasClass('google') ) provider='gp';
        App._track('users','btn-'+provider);
        
        if(is_mobile){
          location.href=$(this).data('url');
          return;
        }
        var w=500,h=500
           ,popLeft=Math.round((screen.availWidth-w)/2)
           ,popTop=Math.round((screen.availHeight-w)/2)
           ,features='width='+w+',height='+h+',resizable=yes,status=no,menubar=no,left='+popLeft+',top='+popTop+',dependent=yes'
           ,popWin = window.open($(this).data('url'),'bubulogin',features);
        popWin.focus();  
      });
      
      if( window.location.hash && window.location.hash=='#verified' )
      {
        $('#dlg-generic .modal-title').html('已成功驗證您的帳號，<br>請輸入帳號密碼進行登入');
        $.fancybox.open('#dlg-generic',{
                        closeBtn: false,
                        scrolling:false,
                        autoSize: false,
                        width: 624,
                        height: 243
                    });
      }
      
      $('#dlg-generic .bn-action, #dlg-generic .checkCloseBtn').on('click',function(e){ $.fancybox.close(); });
      
      // forgot passwd
      $('#login-form .getpsw').on('click',function(e){
        e.preventDefault();
        $('#login-form').css({display:'none'});
        $('#forgot-form').css({display:'block'});
      });
      
      $('#forgot-form .back').on('click',function(e){
        e.preventDefault();
        $('#login-form').css({display:'block'});
        $('#forgot-form').css({display:'none'});
      });
      
      $('#forgot-form .submit').on('click',function(e){
        var frm=document.forms['forgot-form'], email=frm.email.value;
        if( email.length<10 || email.indexOf('@')<0 ){
          alert("請輸入帳號 (Email)"); return;
        }
        $(this).fadeTo(200,.25).data('loading',App._now());
        $.post(frm.action,$('#forgot-form').serialize(),function(res){
          $('#forgot-form .submit').fadeTo(0,1);
          if( res.success==1 ){
            $('#dlg-generic .modal-title').html('已成功寄送新的密碼至您的Email');
            $.fancybox.open('#dlg-generic');
            frm.reset();
          }else{
            alert(res.msg);
          }
        },'json');
      });
      
      
    });
    </script>
</body>

</html>
