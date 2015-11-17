<?php

class Api
{

  public static function doRegister( $data )
  {
    global $_CFG;
    $results = array('success'=>0,'msg'=>'註冊失敗 - 資料格式錯誤');
    
    $is_json = ( isset($data['json']) && $data['json']=='1' ) ? true:false;
    
    # check fields
    if( !isset($data,$data['email'],$data['passwd'],$data['passwd2'],$data['name']) )
    { return $results; }
    $email = filter_var($data['email'],FILTER_VALIDATE_EMAIL) ? strtolower($data['email']) : null;
    
    if( !Validator::checkString($data['name'],1,32) )
    { $results['msg'] = '請填寫姓名'; return $results; }
    if( !Validator::checkString($data['passwd'],4,50) )
    { $results['msg'] = '請填寫密碼 (至少4碼)'; return $results; }
    
    $DB = getMasterDB();
    if( is_null($email) || $DB->getVal("SELECT COUNT(*) FROM `".TBL_USER."` WHERE email='{$email}'")>0 )
    {
      $results['msg'] = '無法用此 Email 註冊';
      return $results;
    }
    
    if( $data['passwd']!=$data['passwd2'] )
    { $results['msg'] = '請確認密碼是否一致'; return $results; }
    
    $area_no = isset($data['area_no'],$_CFG["area_options"][$data['area_no']]) ? intval($data['area_no']) : 0;
    $passwd = md5($data['passwd']);
    $ts = time();
    $travel_area_bit = $age_group_bit = 0;
    if( is_array($data['travel_area_bit']) )
    {
      foreach($data['travel_area_bit'] as $_bit )
      { $travel_area_bit+=intval($_bit); }
    }
    if( is_array($data['age_group_bit']) )
    {
      foreach($data['age_group_bit'] as $_bit )
      { $age_group_bit+=intval($_bit); }
    }
    
    # mobile
    $mobile = null;
    $mobile_raw = isset($data['mobile']) ? preg_replace('![^0-9]!','',$data['mobile']) : null;
    if( is_null($mobile_raw) && isset($data['mobile']) && !empty($data['mobile']) )
    { $results['msg'] = '手機號碼格式錯誤'; return $results; }
    if( !is_null($mobile_raw) && preg_match(RE_MOBILE,$mobile_raw)==1 )
    { $mobile = $mobile_raw; }
    
    # generate secret for verification
    $secret = md5( "$email:$area_no:".rand(1000,9999) );
    
    try
    {
      $sql = "INSERT INTO `".TBL_USER."` SET".
             " email='$email'".
             ",name='".$DB->escape($data['name'])."'".
             ( !is_null($mobile) ? ",mobile='".$DB->escape($mobile)."'":"" ).
             ",area_no=$area_no".
             ",travel_area_bit=$travel_area_bit".
             ",age_group_bit=$age_group_bit".
             ",passwd='$passwd'".
             ",secret='$secret'".
             ",state='pending'".
             ",created=$ts".
             ",updated=$ts".
             ",challenged=$ts".
             ( isset($_SESSION['offerme2_click']) && !empty($_SESSION['offerme2_click']) ? ",om2_clickid='".$DB->escape($_SESSION['offerme2_click'])."'":"" );
      unset($_SESSION['offerme2_click']);
      $DB->query($sql);
      
      if( $DB->affectedRows()>0 )
      {
        $user_id = $DB->insertId();
        
        # verification email
        $verify_url = WEB_ROOT.'/event/server_api/serviceapi.php?model=WebApi&function=verify&i='.$user_id.'&s='.$secret;

        ob_start();
        include PATH_TPL.'/login-verify-email.txt.php';
        $txt_content = ob_get_clean();
        
        ob_start();
        include PATH_TPL.'/login-verify-email.html.php';
        $html_content = ob_get_clean();
        
        /* #deprecated html-mime-mail
        $mail = new htmlMimeMail();
        $mail->setHTMLEncoding('base64');
        $mail->setHTMLCharset('UTF-8');
        $mail->setHeadCharset('UTF-8');
        $mail->setHtml($html_content, $txt_content);
        $mail->setFrom('"'.MAIL_FROM_NAME.'" <'.MAIL_FROM.'>');
        $mail->setSubject('BuBuTrip 驗證會員帳號');
        $res = $mail->send(array($email));
        */
        
        /*
        $mail = new PHPMailer;
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->SMTPDebug = 0;// 0 for production
        $mail->Host = SMTP_HOST;
        $mail->Port = SMTP_PORT;
        $mail->SMTPSecure = SMTP_SECURE;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASS;
        $mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);
        $mail->addAddress($email);
        $mail->Subject = 'BuBuTrip 驗證會員帳號';
        $mail->msgHTML( $html_content );
        $mail->AltBody = $txt_content;
        $res = $mail->send();
        */
        
        $data = array(
          'host' => SMTP_HOST,
          'port' => SMTP_PORT,
          'secure' => SMTP_SECURE,
          'from' => MAIL_FROM,
          'from_name' => MAIL_FROM_NAME,
          'user' => SMTP_USER,
          'pass' => SMTP_PASS,
          'to_arr'=>array($email),
          'subject'=>"BuBuTrip 驗證會員帳號",
          'html'=>$html_content,
          'text'=>$txt_content,
        );
        $q = msg_get_queue( GENERIC_GMAIL_MSG_QUEUE_ID );
        msg_send( $q, 1, $data, true, false );
        
        
        $results = array('success'=>1,'user_id'=>$user_id);
        return $results;
      }
      else
      { 
        $results['msg'] = '資料庫忙線中，請稍候再試一次';
        return $results;
      }
    }
    catch(DBException $e)
    {
      $results['msg'] = '資料庫忙線中，請稍候再試一次';
      return $results;
    }
  }// end User::doRegister

  
  # array()
  public static function doSnsLogin( $sns_no, $data )
  {
    #echo 'test01<br>';
    $results = array('success'=>0);
    $is_json = ( isset($data['json']) && $data['json']=='1' ) ? true:false;
    #echo 'test02<br>';
    if( isset($data['json'],$data['device_udid'],$data['access_token']) )
    { # from mobile app
      #echo 'test05<br>';
      $access_token = $data['access_token'];
      $token_expiry = time()+(3600*30);
    }
    else
    {
      #echo 'test06<br>';
      $token_data = Api::getSnsUserToken( $sns_no, $data );
      if( $tokens===false || $token_data['success']!=1 )
      {
        $results['error'] = __LINE__;
        return $results;
      }
      $access_token = $token_data['data']['access_token'];
      $token_expiry = $token_data['data']['token_expiry'];
    }
    #echo 'test03<br>';
    #echo 'access_token : '.$access_token.'<br>';
    $user_data = User::getSnsUserData( $sns_no, $access_token );
    if( $user_data['success']==0 || is_null($user_data['data']['id']) )
    {
      $results['error'] = __LINE__;
      return $results;
    }
    #echo 'test04<br>';
    $ts = time();
    $sns_uid = $user_data['data']['id'];
    $name = $user_data['data']['name'];
    $sns_email = isset($user_data['data']['email']) ? $user_data['data']['email'] : null;
    $pic_url = $user_data['data']['pic_url'];
    
    try
    {
      $DB = getMasterDB();
      $sql = "SELECT * FROM `".TBL_USER_SNS."` WHERE sns_no=$sns_no AND sns_uid='$sns_uid'";
      $user_sns = $DB->getRow($sql);
      
      if( !$user_sns )
      { # user_sns does not exist
        $sql = "INSERT INTO `".TBL_USER."` SET".
               " name='".$DB->escape($name)."'".
               ( !is_null($pic_url) ? ",pic_url='".$DB->escape($pic_url)."'":"" ).
               ",state='active'".
               ",count_logins=1".
               ",created=$ts".
               ",updated=$ts".
               ( isset($_SESSION['offerme2_click']) && !empty($_SESSION['offerme2_click']) ? ",om2_clickid='".$DB->escape($_SESSION['offerme2_click'])."'":"" );
        unset($_SESSION['offerme2_click']);
        $DB->query($sql);
        $user_id = $DB->insertId();
        
        # insert into user_sns
        $sql = "INSERT INTO `".TBL_USER_SNS."` SET ".
               " user_id=$user_id".
               ",sns_no=$sns_no".
               ",sns_uid='$sns_uid'".
               ",sns_token='".$DB->escape($access_token)."'".
               ( !is_null($sns_email) ? ",sns_email='".$DB->escape($sns_email)."'":"" ).
               ",created=$ts".
               ",updated=$ts".
               ",expired=$token_expiry";
        $DB->query($sql);
        
        # setup user in session
        $_SESSION['user'] = array(
          'id'=>$user_id,
          'sns_uid'=>$sns_uid,
          'role_no'=>USER_ROLE_PUBLIC,//會員 by default
          'name'=>$name,
          'pic_url'=>$pic_url,
        );
        
        # user is new
        $results['is_new_user'] = 1;
        
        $new_token = null;
        if( $is_json )
        { # generate token for app
          $new_token = "{$user_id}|".substr(md5($ts.uniqid()),rand(0,12),16);
          $results['bbtoken'] = $new_token;
          //$DB->query("UPDATE `".TBL_USER."` SET token='".$DB->escape($new_token)."' WHERE id='$user_id'");
        }
        
      }
      else
      { # user_sns exists, do login
        $user_id = $user_sns['user_id'];
        $user = $DB->getRow("SELECT * FROM `".TBL_USER."` WHERE id=$user_id");
        $_SESSION['user'] = array(
          'id'=>$user_id,
          'sns_uid'=>$sns_uid,
          'name'=>$user['name'],
          'role_no'=>intval($user['role_no']),
          'pic_url'=>( !is_null($pic_url) ? $pic_url : $user['pic_url'] ),
        );
        if( !is_null($user['admin_id']) )
        {
          $_SESSION['user']['admin_id'] = $user['admin_id'];
          # load admin data (for class_auth compatibility)
          $sql = "SELECT id,email,name,role_no".
                 " FROM `".TBL_ADMIN."`".
                 " WHERE state='active'".
                 " AND id=".intval($user['admin_id']);
          $admin_data = $DB->GetRow($sql);
          if( false!==$admin_data )
          { $_SESSION[SES_ROOT]['admin'] = $admin_data; }
        }
        # update user_sns table
        $sql = "UPDATE `".TBL_USER_SNS."` SET".
               " sns_token='".$DB->escape($access_token)."'".
               ( !is_null($sns_email) ? ",sns_email='".$DB->escape($sns_email)."'":"" ).
               ",updated=$ts".
               ",expired='$token_expiry'".
               " WHERE id={$user_sns['id']}";
        $DB->query($sql);
        
        $new_token = null;
        if( $is_json )
        { # generate token for app
          $new_token = "{$user['id']}|".substr(md5($user['created'].uniqid()),rand(0,12),16);
          $results['bbtoken'] = $new_token;
        }
        
        # update user table
        $sql = "UPDATE `".TBL_USER."` SET".
               " updated=$ts".
               ",count_logins=(count_logins+1)".
               ( !is_null($pic_url) ? ",pic_url='".$DB->escape($pic_url)."'":"" ).
        //       ( !is_null($new_token) ? ",token='".$DB->escape($new_token)."'":"" ).
               " WHERE id=$user_id";
        $DB->query($sql);
        
      }
      unset($_SESSION['state']);
      $results['success'] = 1;
      
      $ts = time();
      # record udid
      if( $data['json']==1 && isset($data['device_udid']) && !empty($data['device_udid']) && !is_null($new_token) )
      {
        $sql = "INSERT INTO `".TBL_USER_DEVICE."`".
               " (user_id,udid,token,created,updated,ip)".
               " VALUES ('$user_id','".$DB->escape($data['device_udid'])."','".$DB->escape($new_token)."',$ts,$ts,'".$DB->escape(getIp())."')".
               " ON DUPLICATE KEY UPDATE updated=VALUES(updated), token=VALUES(token), count_logins=(count_logins+1), expired=NULL, ip=VALUES(ip)";
        $DB->query($sql);
      }
    }
    catch(DBException $e)
    {
      $results['error'] = __LINE__;
      return $results;
    }
    
    return $results;
  }// end User::doSnsLogin

  public static function getSnsUserToken( $sns_no, $data )
  {
    #echo 'test07<br>';
    $results = array('success'=>0);
    if( !isset($data['state'],$data['code']) || $_SESSION['state']!=$data['state'] )
    {
      return $results;
    }
    
    switch( $sns_no )
    {
      
      case SNS_FACEBOOK:
        #echo 'test08<br>';
        $redirect_uri = 'http://www.bubutrip.com.tw'.'/event/server_api/serviceapi.php?model=WebApi&function=facebook_callback';
        $url = 'https://graph.facebook.com/oauth/access_token?'.
               'client_id='.FB_APPID.
               '&redirect_uri='.urlencode($redirect_uri).
               '&client_secret='.FB_SECRET.
               '&code='.$_GET['code'];
        $raw = @file_get_contents($url);
        parse_str($raw, $res);
        $_SESSION['fb:access_token'] = $access_token = $res['access_token'];
        $_SESSION['fb:token_expiry'] = $token_expiry = time()+$res['expires'];
        #show_Debug( $url );
        #show_Debug( $_SESSION );
      break;
      
      
      case SNS_GPLUS:
        $redirect_uri = 'http://www.bubutrip.com.tw'.'/event/server_api/serviceapi.php?model=WebApi&function=google_callback';
        # exchange code for token
        $data = array(
          'code'          => $data['code'],
          'client_id'     => GP_CLIENT_ID,
          'client_secret' => GP_SECRET,
          'redirect_uri'  => $redirect_uri,
          'grant_type'    => 'authorization_code',
        );
        $postdata = http_build_query($data,'','&');
        $opts = array(
          'http'=>array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded'."\r\n".
                        'Content-Length: '.strlen($postdata)."\r\n",
            'content'=> $postdata,
          )
        );
        $context = stream_context_create($opts);
        $raw = file_get_contents('https://accounts.google.com/o/oauth2/token',false,$context);
        $res = json_decode($raw,true);
        $_SESSION['gp:access_token'] = $access_token = $res['access_token'];
        $_SESSION['gp:token_expiry'] = $token_expiry = time()+$res['expires_in'];
      break;
    }
    $results = array(
      'success'=>1,
      'data'=>array(
        'access_token'=>$access_token,
        'token_expiry'=>$token_expiry
      )
    );
    return $results; 
  }// end Api::getSnsUserToken

}