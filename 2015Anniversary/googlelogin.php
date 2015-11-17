<?php
	#載入預設系統
	include_once("libraries/load.php");

    $state = md5(uniqid());
    $_SESSION['state'] = $state;
    session_write_close();

        $qdata = array(
          'redirect_uri'  => 'http://www.bubutrip.com.tw'.'/event/server_api/serviceapi.php?model=WebApi&function=google_callback',
          #'redirect_uri'  => WEB_ROOT.'/login/google-callback',
          'scope'         => 'email https://www.googleapis.com/auth/plus.login',
          'state'         => $state,
          'response_type' => 'code',
          'client_id'     => GP_CLIENT_ID,
          'access_type'   => 'offline',
        );
        $url = 'https://accounts.google.com/o/oauth2/auth';

    $url.= '?'.http_build_query($qdata,'','&');
    show_Debug( $qdata );
    show_Debug( $_SESSION );
    header("Location: $url",true,302);
    exit;
