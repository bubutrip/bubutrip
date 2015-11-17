<?php
	#載入預設系統
	include_once("libraries/load.php");

    $state = md5(uniqid());
    $_SESSION['state'] = $state;
    session_write_close();

        $qdata = array(
          'redirect_uri'  => 'http://www.bubutrip.com.tw'.'/event/server_api/serviceapi.php?model=WebApi&function=facebook_callback',
          #'redirect_uri'  => WEB_ROOT.'/login/facebook-callback',          
          'scope'         => 'public_profile,email',
          'state'         => $state,
          'response_type' => 'code',
          'client_id'     => FB_APPID,
          'display'       => 'popup',
        );
        $url = 'https://www.facebook.com/dialog/oauth';

    $url.= '?'.http_build_query($qdata,'','&');
    show_Debug( $qdata );
    show_Debug( $_SESSION );
    header("Location: $url",true,302);
    exit;
