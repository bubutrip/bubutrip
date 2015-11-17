<?
require_once("mysql_class/ErrorManager.class.php");
require_once("mysql_class/MySQL.class.php");

class Dbconn {

	static $defconfig = array(
		'HOST' => DB_HOST,
		'DATABASE' => DB_DATABASE,
		'USER' => DB_USER,
		'PASSWORD' => DB_PASS,
	);

	static $config = array(
		'HOST' => DB_HOST,
		'DATABASE' => 'forevent',
		'USER' => 'forevent',
		'PASSWORD' => 'forevent_toyota',
	);

	public static function checkmobile(){

		/*
		#dbconn::showDebug( $_SESSION );
		if( !empty( $_SESSION['dev'] ) ){
			#dbconn::showDebug( $_SESSION['dev'] );
			if( !empty( $_SESSION['dev']['isMobile'] ) ){
				dbconn::go_showmsg("","m.index.php");
			}
		}
		*/

		$useragent=$_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|android|ipad|playbook|silk|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
			dbconn::go_showmsg("","m.index.php");
		}

	}

	public static function checkmobile2(){

		$useragent=$_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|android|ipad|playbook|silk|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
			$_SESSION['checkmobile'] = 1;
		}else{
			$_SESSION['checkmobile'] = 0;
		}

	}

	public static function showDebug( $array ){
		echo 'Debug Information:';
		echo '<pre>';
		print_r( $array );
		echo '</pre>';
	}

	public static function go_showmsg($msg, $url='')
	{
		if (trim($msg) != "")
		{
			header("content-type: text/html; charset=utf-8");
			echo "<script>";
			echo "alert('".$msg."');";
			if ($url == '')
				echo "history.back(-1);";
			else
				echo "location.href = '".$url."';";
			echo "</script>";
			exit;
		}elseif(trim($url) != ""){
			header("content-type: text/html; charset=utf-8");
			echo "<script>";
			if ($url == '')
				echo "history.back(-1);";
			else
				echo "location.href = '".$url."';";
			echo "</script>";
			exit;
		}
	}

	public static function checktripname( $user_id=0 ){

		$sql = "select * from `tk_tripname` where mem_uid = '".$user_id."';";
		$result = dbconn::db_getRow( $sql );

		if( !empty( $result ) ){
			return $result;
		}else{
			return false;
		}

	}

	public static function inserttripname( $user_id=0 ,  $mascotName="" ,  $mean="" , $imgurl="" ){

		$sql = "select * from `tk_tripname` where mem_uid = '".$user_id."' and mem_tripname = '".$mascotName."';";
		$result = dbconn::db_getRow( $sql );

		if( empty( $result ) ){
			$sql = "INSERT INTO `tk_tripname`(`mem_uid`, `mem_tripname`, `mem_namemean`, `mem_imgfile`, `created_at`, `updated_at`) VALUES ('".$user_id."','".$mascotName."','".$mean."','".$imgurl."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";
			$result = dbconn::db_query( $sql );
		}

	}

	public static function query_all_mem(){
		$sql = "SELECT * FROM `tk_tripmember`";
		$result = dbconn::db_GetAll( $sql );

		$m=0;
		foreach ($result as $user) {
			#$result[$m]['user_info'] = dbconn::getUserById( $user['mem_uid'] );
			$result[$m]['sns_info'] = dbconn::getFBUserById( $user['mem_uid'] );
			$result[$m]['ticket_info'] = dbconn::make_ticket( 0 , $user['mem_uid'] , 0 );
			$m++;
		}

		return $result;
	}

	public static function query_all_tripname(){
		$sql = "SELECT tk_tripname.* , tk_tripmember.mem_newuser FROM `tk_tripname` Join `tk_tripmember` on tk_tripname.mem_uid = tk_tripmember.mem_uid";
		$result = dbconn::db_GetAll( $sql );

		$m=0;
		foreach ($result as $user) {
			#$result[$m]['user_info'] = dbconn::getUserById( $user['mem_uid'] );
			$result[$m]['sns_info'] = dbconn::getFBUserById( $user['mem_uid'] );
			$result[$m]['ticket_info'] = dbconn::make_ticket( 0 , $user['mem_uid'] , 0 );
			$m++;
		}

		return $result;
	}

	public static function getmemusr( $useracc='' ){

		$sql = "SELECT * FROM `tk_tripuser` WHERE `User_acc` = '".$useracc."'";
		$result = dbconn::db_getRow( $sql );
		return $result;
	}

	public static function insertMem( $user_id=0 , $newusr=0 )
	{
		$sql = "SELECT * FROM `tk_tripmember` WHERE mem_uid = $user_id";
		$result = dbconn::db_getRow( $sql );
		if( empty( $result ) ){
			$sql = "INSERT INTO `tk_tripmember`(`mem_uid`, `mem_newuser`, `created_at`, `updated_at`) VALUES ('".$user_id."','".$newusr."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";
			$result = dbconn::db_query( $sql );
		}
	}

	public static function getUserById( $user_id=0 )
	{
		#echo "getUserById.........................<br>";
		$user_id = intval("$user_id");
		$sql = "SELECT * FROM `".TBL_USER."` WHERE id = $user_id";
		#echo $sql.'<br>';
		$result = dbconn::defdb_getRow( $sql );
		return $result;
	}// end User::getUserById

	public static function getFBUserById( $user_id=0 )
	{
		#echo "getFBUserById.........................<br>";
		$user_id = intval("$user_id");
		$sql = "SELECT * FROM `".TBL_USER_SNS."` WHERE user_id = $user_id";
		#echo $sql.'<br>';
		$result = dbconn::defdb_getRow( $sql );
		return $result;
	}// end User::getUserById

	//
	public static function make_ticket( $strlen=3 , $uid=0 , $newusr=0 , $mem_ticketclick='' ){

		//判斷是不是會員
		if( $uid > 0 ){

			//查有沒有取過票
			$query = "select * from tk_tripticket where mem_uid = '".$uid."';";
			$query_ans = dbconn::db_getRow( $query );
			if( !empty( $query_ans ) ){
				return $query_ans['mem_tripticket'];
			}

			//判斷是不是還在取票資格內
			$query = "select * from tk_tripticket where mem_uid = '".$uid."';";
			$query_ans = dbconn::db_query( $query );
			if( $query_ans->num_rows > 2000 ){
				return false;
			}

			//判斷是不是新會員
			if( $newusr == 0 ){
				return false;
			}

			if( $strlen > 0 ){
				//製作票號
				$m=0;
				$key = false;
				while ( !$key or $m <= 100 ) {
				    $str = '';
				    for($i=1;$i<=$strlen;$i++){
				        $n = 3;
				        switch($n){
				            case 1;
				                $str = $str . chr(rand(65,90)); #大寫英文
				                break;
				            case 2;
				                $str = $str . chr(rand(97,122)); #小寫英文
				                break;
				            case 3;
				                $str = $str . chr(rand(48,57)); #數字
				                break;
				        }
				    }

				    $query = "select * from tk_tripticket where mem_tripticket = '".$str."';";
				    $query_ans = dbconn::db_query( $query );

				    if(  $query_ans->num_rows == 0 ){
					    $key = ture;
				    }

				    $m++;
				}

				$query = "INSERT INTO `tk_tripticket`(`mem_uid`, `mem_tripticket`, `mem_ticketclick` , `created_at`, `updated_at`) VALUES ('".$uid."','".$str."','".$mem_ticketclick."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";
				dbconn::db_query( $query );

			    return $str;
			}else{
				return false;
			}

		}else{
			return false;
		}

	}

	public static function query_email_send_status( $ticket='' ){

		$query = "SELECT * FROM `tk_tripticket` WHERE `mem_tripticket` = '".$ticket."'";
		$result = dbconn::db_getRow( $query );
		return $result;
	}

	public static function update_getticket( $user_id=0 ){
		$query = "UPDATE `tk_tripmember` set `mem_ticket`=1 WHERE `mem_uid` = '".$user_id."'";
		dbconn::db_query( $query );
	}

	public static function update_tripname( $user_id=0 ){
		$query = "UPDATE `tk_tripmember` set `mem_tripname`=1 WHERE `mem_uid` = '".$user_id."'";
		dbconn::db_query( $query );
	}

	public static function update_sentemail( $ticket='' ){

		$query = "UPDATE `tk_tripticket` set `mem_emailsend`=1 WHERE `mem_tripticket` = '".$ticket."'";
		dbconn::db_query( $query );

	}

	//
	public static function make_img_name( $uid=0 ){

	    for($i=1;$i<=4;$i++){
	        $n = rand(1,2);
	        switch($n){
	            case 1;
	                $str = $str . chr(rand(65,90)); #大寫英文
	                break;
	            case 2;
	                $str = $str . chr(rand(97,122)); #小寫英文
	                break;
	            case 3;
	                $str = $str . chr(rand(48,57)); #數字
	                break;
	        }
	    }

	    return $uid.'-'.$str;

	}

	public static function query_user( $uid=0 ){
		
		if( empty( $_SESSION['admin:uid'] ) ){
			return 0;
		}

		if( !is_numeric( $uid ) ){
			return 3;
		}

		$query = "select * from `tk_tripuser` where id = '".$_SESSION['admin:uid']."';";
		$result = dbconn::defdb_getRow( $query );
	}

	public static function check_user_pwd( $acc='' , $pwd='' ){

	}

	public static function db_getRow( $query ){
		$DB = new DB(self::$config['HOST'],self::$config['USER'],self::$config['PASSWORD'],self::$config['DATABASE']);
		$result = $DB->getRow($query);
	    return $result;
	}

	public static function db_defquery( $query ){
		$DB = new DB(self::$defconfig['HOST'],self::$defconfig['USER'],self::$defconfig['PASSWORD'],self::$defconfig['DATABASE']);
		$result = $DB->query($query);
	    return $result;
	}

	public static function db_defgetRow( $query ){
		$DB = new DB(self::$defconfig['HOST'],self::$defconfig['USER'],self::$defconfig['PASSWORD'],self::$defconfig['DATABASE']);
		$result = $DB->getRow($query);
	    return $result;
	}

	public static function db_query( $query ){
		$DB = new DB(self::$config['HOST'],self::$config['USER'],self::$config['PASSWORD'],self::$config['DATABASE']);
		$result = $DB->query($query);
	    return $result;
	}

	public static function db_getRowNum( $query ){
		$DB = new DB(self::$config['HOST'],self::$config['USER'],self::$config['PASSWORD'],self::$config['DATABASE']);
		$result = $DB->numRows($query);
	    return $result;
	}

	public static function defdb_query( $query ){
		$DB = new DB(self::$defconfig['HOST'],self::$defconfig['USER'],self::$defconfig['PASSWORD'],self::$defconfig['DATABASE']);
		$result = $DB->query($query);
	    return $result;
	}

	public static function defdb_getRow( $query ){
		$DB = new DB(self::$defconfig['HOST'],self::$defconfig['USER'],self::$defconfig['PASSWORD'],self::$defconfig['DATABASE']);
		$result = $DB->getRow($query);
	    return $result;
	}

	public static function db_GetAll( $query ){
		$DB = new DB(self::$config['HOST'],self::$config['USER'],self::$config['PASSWORD'],self::$config['DATABASE']);
		$result = $DB->GetAll($query);
	    return $result;
	}

	public static function utf8_unicode($name){  
		if(PATH_SEPARATOR==':'){
		//linux
	        $name = iconv('UTF-8', 'UCS-2BE', $name);
		}else{
		//windows
	        $name = iconv('UTF-8', 'UCS-2', $name);
		}                    


        $len  = strlen($name);  
        $str  = '';  
        for ($i = 0; $i < $len - 1; $i = $i + 2){  
            $c  = $name[$i];  
            $c2 = $name[$i + 1];  
            if (ord($c) > 0){   //两个字节的文字  
                $str .= '\u'.base_convert(ord($c), 10, 16).str_pad(base_convert(ord($c2), 10, 16), 2, 0, STR_PAD_LEFT);  
                //$str .= base_convert(ord($c), 10, 16).str_pad(base_convert(ord($c2), 10, 16), 2, 0, STR_PAD_LEFT);  
            } else {  
                $str .= '\u'.str_pad(base_convert(ord($c2), 10, 16), 4, 0, STR_PAD_LEFT);  
                //$str .= str_pad(base_convert(ord($c2), 10, 16), 4, 0, STR_PAD_LEFT);  
            }  
        }  
        $str = strtoupper($str);//转换为大写  
        return $str;  
    }  

    public static function unicode_decode($name){  
        $name = strtolower($name);  
        // 转换编码，将Unicode编码转换成可以浏览的utf-8编码  
        $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';  
        preg_match_all($pattern, $name, $matches);  
        if (!empty($matches))
        {  
            $name = '';  
            for ($j = 0; $j < count($matches[0]); $j++)  
            {  
                $str = $matches[0][$j];  
                if (strpos($str, '\\u') === 0)  
                { 
                    $code = base_convert(substr($str, 2, 2), 16, 10);  
                    $code2 = base_convert(substr($str, 4), 16, 10);  
                    $c = chr($code).chr($code2);
					if(PATH_SEPARATOR==':'){
					//linux
	                    $c = iconv('UCS-2BE', 'UTF-8', $c);  
					}else{
					//windows
	                    $c = iconv('UCS-2', 'UTF-8', $c);  
					}                    
                    $name .= $c;  
                }  
                else  
                {  
                    $name .= $str;  
                }  
            }  
        }  
        return $name;  
    }  

    public static function query_allmemneweve(){
		$sql = "SELECT * FROM `tk_buburegusr`";
		$result = dbconn::db_GetAll( $sql );

		$m=0;
		foreach ($result as $row) {
			$result[$m]['sns_info']=dbconn::getFBUserById( $row['usr_uid'] );
			$result[$m]['definfo']=dbconn::get_oneusr($row['usr_uid']);

			$sql2 = "SELECT * FROM `tk_bubu_deviceids` WHERE `dev_uid` = '".$result[$m]['definfo']['id']."';";
			$result[$m]['deviceids'] = dbconn::db_GetAll( $sql2 );

			$result[$m]['countn'] = dbconn::count_member_xu( $row['usr_uid'] );
			#$count = dbconn::count_comkey( $result[$m]['usr_makekey'] );
			#$result[$m]['countn'] = $count + ( count( $result[$m]['deviceids'] ) * 50 ) ;

			$m++;
		}
		return $result;
    }

    public static function count_member_xu( $uid=0 ){

    	//查詢會員資料
    	$user = dbconn::get_usruid( $uid );

    	//取得成功邀請的人數
		$count = dbconn::count_comkey( $user['usr_makekey'] );

		//取得會員APP啟用資料
		$sql2 = "SELECT * FROM `tk_bubu_deviceids` WHERE `dev_uid` = '".$uid."';";
		$deviceids = dbconn::db_GetAll( $sql2 );

		//計算會員實得栗子數
		$countn = $count + ( count( $deviceids ) * 50 ) ;

		return $countn;
    }


    public static function get_oneusr( $uid='' ){
		$query = "SELECT * FROM `bbt_user` WHERE `id` = '".$uid."'";
		$user = dbconn::db_defgetRow( $query );
		return $user;
    }

    public static function count_comkey( $makekey='' ){
    	
    	//取得分享次數
    	$query = "SELECT count(*) as countn FROM `tk_buburegusr` WHERE `usr_comkey` = '".$makekey."' and ( `usr_new` = '1' or `created_at` <= '2015-11-16 16:00:00' );";
    	$count = dbconn::db_getRow( $query );
    	$countn = $count['countn'];

    	return $countn;
    }

    public static function get_usrkey( $key='' ){
		$query = "SELECT * FROM `tk_buburegusr` WHERE `usr_makekey` = '".$key."'";
		$user = dbconn::db_getRow( $query );
		return $user;
    }

    public static function get_usruid( $uid='' ){
		$query = "SELECT * FROM `tk_buburegusr` WHERE `usr_uid` = '".$uid."'";
		$user = dbconn::db_getRow( $query );
		return $user;
    }

    public static function insert_new_member( $email='' , $comkey='' , $usr_new=0 ){

    	if( !empty( $email ) ){

			$query = "SELECT * FROM `bbt_user` WHERE `email` = '".$email."'";
			$user = dbconn::db_defgetRow( $query );
	    	if( !empty( $user['id'] ) ){

	    		if( $user['state'] == 'active' ){    			
		    		$makekey = dbconn::make_newkey();
					$sql = 

						"INSERT INTO `tk_buburegusr`(
							`usr_uid`, `usr_new`, `usr_makekey`, `usr_comkey`, `created_at`, `updated_at`
						) VALUES (
							'".$user['id']."','".$usr_new."','".$makekey."','".$comkey."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'
						)";
					$result = dbconn::db_query( $sql );
				}
	    	}
    	}

    }

    public static function insert_new_comkey( $uid=0 , $comkey='' ){

		$query = "SELECT * FROM `tk_comkeylog` WHERE `log_uid` = '".$uid."'";
		$comdata = dbconn::db_getRow( $query );

		$query = "SELECT * FROM `tk_comkeylog` WHERE `log_uid` = '".$uid."'";
		$comdata = dbconn::db_getRow( $query );
		if( !empty( $comdata ) ){
			$comkey = $comdata['log_comkey'];
		}

		if( empty($comdata) ){

	    	if( !empty( $uid ) and !empty( $comkey ) ){
	   	    	$sql = 
		    		"INSERT INTO `tk_comkeylog`( `log_uid`, `log_comkey`, `created_at`, `updated_at`) VALUES ('".$uid."','".$comkey."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";
		    	$result = dbconn::db_query( $sql );
	    	}

	    	return 1;

		}else{

			return 0;

		}


    }

    public static function insert_login_makekey( $uid=0 , $comkey='' , $usr_new=0 ){

		$query = "SELECT * FROM `tk_buburegusr` WHERE `usr_uid` = '".$uid."'";
		$user = dbconn::db_getRow( $query );

		$query = "SELECT * FROM `tk_comkeylog` WHERE `log_uid` = '".$uid."'";
		$comdata = dbconn::db_getRow( $query );
		if( !empty( $comdata ) ){
			$comkey = $comdata['log_comkey'];
		}

		if( empty( $user ) ){
			$query = "SELECT * FROM `bbt_user` WHERE `id` = '".$uid."'";
			$user = dbconn::db_defgetRow( $query );
	    	if( !empty( $user['id'] ) ){
	    		if( $user['state'] == 'active' ){    			
		    		$makekey = dbconn::make_newkey();
					$sql = 
						"INSERT INTO `tk_buburegusr`(
							`usr_uid`, `usr_new`, `usr_makekey`, `usr_comkey`, `created_at`, `updated_at`
						) VALUES (
							'".$user['id']."','".$usr_new."','".$makekey."','".$comkey."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'
						)";
					$result = dbconn::db_query( $sql );
	    		}
	    	}
		}
    }

    public static function insert_user_driveinfo( $data=array() ){

    	//查詢會員是否有來過活動網站
		$query = "SELECT * FROM `tk_buburegusr` WHERE `usr_uid` = '".$data['user_id']."'";
		$user = dbconn::db_getRow( $query );

		//產生介紹碼
   		$makekey = dbconn::make_newkey();

   		//判斷是否有相同的裝置ID
		$query = "SELECT * FROM `tk_bubu_deviceids` WHERE `dev_deviceid` = '".$data['device_id']."'";
		$drivedata = dbconn::db_getRow( $query );

		#show_Debug( $data );
		#show_Debug( $query );
		#show_Debug( $drivedata );
		#exit();

		if( empty( $drivedata ) ){
			if( empty( $user ) ){
				//沒來過,灌入新的資料
				$sql = 
					"INSERT INTO `tk_buburegusr`(
						`usr_uid`, `usr_new`, `usr_makekey`, `usr_comkey`, `usr_appstatus` , `created_at`, `updated_at`
					) VALUES (
						'".$data['user_id']."','0','".$makekey."','','1','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."'
					)";
				$result = dbconn::db_query( $sql );

				$sql2 =
					"INSERT INTO `tk_bubu_deviceids`( `dev_uid`, `dev_deviceid`, `created_at`, `updated_at`) VALUES ('".$data['user_id']."','".$data['device_id']."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";
				$result = dbconn::db_query( $sql2 );
			}else{
				//有來過,更新資料
				$sql = 
					"UPDATE `tk_buburegusr` SET `usr_appstatus`='1',`updated_at`='".date('Y-m-d H:i:s')."' WHERE `usr_uid` = '".$data['user_id']."'";
				$result = dbconn::db_query( $sql );

				$sql2 =
					"INSERT INTO `tk_bubu_deviceids`( `dev_uid`, `dev_deviceid`, `created_at`, `updated_at`) VALUES ('".$data['user_id']."','".$data['device_id']."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";
				$result = dbconn::db_query( $sql2 );
			}
			return 1;
		}else{
			return 0;
		}
    }

    public static function postlog( $postobj='' ){

    	$sql = "INSERT INTO `tk_bubupostlog`(`post`, `created_at`, `updated_at`) VALUES ('".$postobj."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";
		$result = dbconn::db_query( $sql );

    }

    public static function insertusrcomkey( $email='' ){

    }

    public static function make_newkey(){

    	$status=0;
    	$key = '';

    	while( $status == 0 ){

			$str = '';
			for($i=1;$i<=15;$i++){
				$n = rand(1,3);
				switch($n){
					case 1;
						$str = $str . chr(rand(65,90)); #大寫英文
						break;
					case 2;
						$str = $str . chr(rand(97,122)); #小寫英文
						break;
					case 3;
						$str = $str . chr(rand(48,57)); #數字
						break;
				}
			}

			$keydata = '';
			$keydata = dbconn::get_usrkey( $str );
			if( empty( $keydata ) ){
				$status = 1;
			}

    	}
    	return $str;
    }
}