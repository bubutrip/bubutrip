<?
  error_reporting(E_ALL);
  ini_set('display_errors', 'On');
  require '../../inc/config.php';
  require 'defconfig.php';

  if( !empty( $_POST ) ){

    if( isset($_SESSION['eventadm:uid']) ){
      dbconn::go_showmsg('您已完成登入！','/event/admin');
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if( empty($username) or empty($password) ){
      dbconn::go_showmsg('帳號或密碼未輸入');
    }

    $member = dbconn::getmemusr( $username );

    if( empty( $member ) ){
      dbconn::go_showmsg('帳號不存在');
      exit();
    }

    if( $member['User_status'] != 'T' ){
      dbconn::go_showmsg('帳號未啟用！');
      exit();
    }

    if( md5(md5($password).$member['User_salt']) != $member['User_passwd'] ){
      dbconn::go_showmsg('帳號與密碼不匹配！');
      exit();
    }

    $_SESSION['eventadm:uid'] = $member['id'];
    $_SESSION['eventadm:acc'] = $member['User_acc'];

    dbconn::go_showmsg('','/event/admin');

  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <title>BuBuTrip 活動管理後臺</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Raleway:300,200,100" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet" type="text/css">
    <link href="assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/lib/font-awesome/css/font-awesome.min.css">
    <!--if lt IE 9script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    -->
    <link rel="stylesheet" type="text/css" href="assets/lib/jquery.nanoscroller/css/nanoscroller.css">
    <link href="assets/css/style.css" rel="stylesheet">
  </head>
  <body class="texture">
    <div id="cl-wrapper" class="login-container">
      <div class="middle-login">
        <div class="block-flat">
          <div class="header">
            <h3 class="text-center">BuBuTrip</h3>
          </div>
          <div>
            <form style="margin-bottom: 0px !important;" action="/event/admin/login.php" method="post" class="form-horizontal">
              <div class="content">
                <h4 class="title">登入管理帳號</h4>
                <div class="form-group">
                  <div class="col-sm-12">
                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input id="username" name="username" type="text" placeholder="請輸入您的帳號" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      <input id="password" name="password" type="password" placeholder="請輸入您的密碼" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <div class="foot">
                <button data-dismiss="modal" type="submit" class="btn btn-primary">登入</button>
              </div>
            </form>
          </div>
        </div>
        <div class="text-center out-links"><a href="#">© 2015 BuBuTrip</a></div>
      </div>
    </div>
    <script type="text/javascript" src="assets/lib/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/lib/jquery.nanoscroller/javascripts/jquery.nanoscroller.js"></script>
    <script type="text/javascript" src="assets/js/cleanzone.js"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/voice-recognition.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
      });
      
    </script>
  </body>
</html>