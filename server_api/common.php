<?php
/*
 * 隨機產生7碼亂數密碼
*/
if (!function_exists('redirect_url'))
{

	function generatorPassword($password_len=7)
	{
		$password = '';

		// remove o,0,1,l
		$word = 'abcdefghijkmnpqrstuvwxyz!@#$%^&*()-=ABCDEFGHIJKLMNPQRSTUVWXYZ<>;{}[]23456789';
		$len = strlen($word);

		for ($i = 0; $i < $password_len; $i++) {
			$password .= $word[rand() % $len];
		}

		return $password;
	}
}
///////////////以下為Jonny原生/////////////////
////////////////////////////////////////////

// --------------------------------------------------------------------

/**判斷字串編碼，轉成 UTF-8**/
if (!function_exists('b2u'))
{
	function b2u($str)
	{
		$charset = mb_detect_encoding($str, array('BIG5', 'UTF-8'));
		return mb_convert_encoding($str, "UTF-8", $charset);
	}
}

// --------------------------------------------------------------------

/**判斷字串編碼，轉成 BIG5**/
if (!function_exists('u2b'))
{
	function u2b($str, $charset='BIG5')
	{
		mb_regex_encoding($charset);       //宣告 要進行 regex 的多位元編碼轉換格式 為 $charset
		mb_substitute_character('long');   //宣告 缺碼字改以U+16進位碼為標記取代
		$str = mb_convert_encoding($str, $charset, 'UTF-8');
		$str = preg_replace('/U\+([0-9A-F]{4})/e', '"&#".intval("\\1",16).";"', $str);   //將U+16進位碼標記轉換為UnicodeHTML碼
		
		return $str;
	}
}

// --------------------------------------------------------------------

/**顯示陣列**/
if (!function_exists('showarray'))
{
	function showarray($array)
	{
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}
}

// --------------------------------------------------------------------

/**錯誤跳轉**/
if (!function_exists('go_showmsg'))
{
	function go_showmsg($msg, $url='')
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
}

// --------------------------------------------------------------------

/**自訂字串編碼**/
if (!function_exists('str_encode'))
{
	function str_encode($str='')
	{
		$key = 'pwd=!account!';
		$encode = base64_encode($key).base64_encode(base64_encode($str)).base64_encode($key);
		$encode = str_replace('=', '__', $encode);
		//$encode = base64_encode($str);
		return $encode;
	}
}

// --------------------------------------------------------------------

/**自訂字串解碼**/
if (!function_exists('str_decode'))
{
	function str_decode($str='')
	{
		$key = 'pwd=!account!';
		$str = str_replace('__', '=', $str);
		$dekey = base64_encode($key);
		$decode = str_replace($dekey,null,$str);
		$decode = base64_decode(base64_decode($decode));
		//$decode = base64_decode($str);
		return $decode;
	}
}

// --------------------------------------------------------------------

/**URL導向**/
if (!function_exists('showurl'))
{
	function showurl($type=1, $id='', $name='' , $class='', $Ext='')
	{
		$path = geturl($type, $id, $Ext);
		if(strlen($class) > 0)
		{
			$url = '<a href="'.$path.'" class="'.$class.'">'.$name.'</a>';
		}
		else
		{
			$url = '<a href="'.$path.'">'.$name.'</a>';
		}
		return $url;
	}
}

// --------------------------------------------------------------------

/**字串隱碼幾個字元**/
if (!function_exists('str_hidden'))
{
	function str_hidden($value, $num)
	{
		$res = '';
		if ($value != '')
		{
			$res = substr_replace($value, '***', $num);
		}
		
		return $res;
	}
}

// --------------------------------------------------------------------

/**金錢格式**/
if (!function_exists('money_format_1'))
{
	function money_format_1($number=0, $type=1) {
		$res = 0;
		if ($number > 0)
		{
			$res = number_format($number, 0, '.' ,',');
		}
		if ($type == 1)
		{
			$res = '$'.$res;
		}
		
		return $res;
	}
}
// --------------------------------------------------------------------

/**顯示頁碼
 * $recs          總筆數
 * $pageid        當前頁
 * $url           連結的網址
 * $array_para   其它參數
 * $page_recs     每頁顯示筆數
**/
if (!function_exists('show_page_line'))
{
	function show_page_line($recs, $pageid=1, $url='', $array_para=array(), $page_recs=20) {
		$showpages = 10;  //每頁顯示頁碼數
		
		$url = ($url != '') ? $url : '';
		$para = '';
		if ($recs > 0 && $pageid > 0)
		{
			//組參數
			if (!empty($array_para))
			{
				for($i=0;$i<count($array_para);$i++)
				{
					if ($array_para[$i] !== '')  //排除空字串，不排除0
						$para .= $array_para[$i].'/';
				}
			}
			
			$pages = ceil($recs / $page_recs);   //總頁數
			$x = ceil($pageid / $showpages);
			$s_page = ($x-1) * $showpages + 1;   //顯示的開始頁碼
			$e_page = $x * $showpages;           //顯示的結束頁碼
			$e_page = ($e_page > $pages) ? $pages : $e_page;   //顯示的結束頁碼
			
			$prev_10 = ($pageid - 10 > 1) ? $pageid - 10 : 1;             //上十頁
			$next_10 = ($pageid + 10 < $pages) ? $pageid + 10 : $pages;   //下十頁
?>
		<div class="pagination pagination-small pagination-centered pagination_pos">
			<!--<div class="pagination_title">
				<span> 計 <strong class="for_num"> <?=$recs?> </strong> 筆資料 </span>
			</div>-->
			<ul>
				
		<?php if($x > 1) { ?>
				<li><a href="<?=$url?>/<?=$prev_10?>/<?=$para?>">上十頁</a></li>
		<?php } ?>
		
		<?php if($pageid > 1) { ?>
				<li><a href="<?=$url?>/<?=$pageid-1?>/<?=$para?>">上一頁</a></li>
		<?php } ?>
		
		<?php for($i=$s_page; $i<=$e_page; $i++) {
				$class = ($i == $pageid) ? 'class="active"' : '';
		?>
				<li <?=$class?>><a href="<?=$url?>/<?=$i?>/<?=$para?>"><?=$i?></a></li>
		<?php } ?>
		
		<?php if($pageid < $pages) { ?>
				<li><a href="<?=$url?>/<?=$pageid+1?>/<?=$para?>">下一頁</a></li>
		<?php } ?>
		
		<?php if($x < ceil($pages / $showpages)) { ?>
				<li><a href="<?=$url?>/<?=$next_10?>/<?=$para?>">下十頁</a></li>
		<?php } ?>
				
			</ul>
		</div>
<?
		}
	}
}

// --------------------------------------------------------------------

/**日期運算**/
if (!function_exists('add_date'))
{
	function add_date($givendate, $day=0, $mth=0, $yr=0) {
		
		$cd = strtotime($givendate);
		//$newdate = date('Y-m-d h:i:s', mktime(date('h',$cd), date('i',$cd), date('s',$cd), date('m',$cd)+$mth, date('d',$cd)+$day, date('Y',$cd)+$yr));
		$newdate = date('Y-m-d', mktime(date('h',$cd), date('i',$cd), date('s',$cd), date('m',$cd)+$mth, date('d',$cd)+$day, date('Y',$cd)+$yr));
		
		return $newdate;
	}
}

// --------------------------------------------------------------------

/**是否為日期格式**/
if (!function_exists('is_date'))
{
	function is_date($date) {
	
		$unixTime = strtotime($date);
	
		if (!$unixTime)   //strtotime轉換失敗，日期格式顯然不對
	    	return false;
		else
			return true;
	}
}
// --------------------------------------------------------------------

/**特殊符號轉換**/
if (!function_exists('symbol_conversion'))
{
	function symbol_conversion($str) {
	
		$symbol_array = array(".",",","'",'"'," ","\r","\n");
		$new_symbol_array = array("。","，","’","＂",null,null,null);
		$str = str_replace($symbol_array,$new_symbol_array,$str);
		return $str;
	}
}

// --------------------------------------------------------------------

/**顯示youtobe**/
if (!function_exists('show_youtobe'))
{
	function show_youtobe($vid="",$width=480,$height=370,$autoPlay=1,$fullScreen=1) {
	
	if($autoPlay == True)
	{
		$autoPlay = '&autoplay=0';	// 是否載入 YouTube 影片後自動播放；若不要自動播放則設成 0
	}
	
	if($fullScreen ==True)
	{
		$fullScreen = '&fs=1';		// 是否允許播放 YouTube 影片時能全螢幕播放
	}
	
	$yotobe_css = 'height:'.$height.'px;width:'.$width.'px;';
	
	$youtobe='
		<object style="'.$yotobe_css.'">
		<param id="movie" name="movie" value="http://www.youtube.com/v/'.$vid.$autoPlay.$fullScreen.'"></param>
		<param name="wmode" value="transparent"></param>
		';
	if($fullScreen =="&fs=1"){
	$youtobe .='<param name="allowfullscreen" value="true"></param>
		';
	}
		
	$youtobe .='<embed id="yotobe_movie" type="application/x-shockwave-flash" src="http://www.youtube.com/v/'.$vid.$autoPlay.$fullScreen.'"';
	if($fullScreen =="&fs=1"){
	$youtobe .='allowfullscreen="true"';
	}
	$youtobe .=	'wmode="transparent" style="'.$yotobe_css.'"></embed>
		</object>
	';
	
	return $youtobe;
	}
}

// --------------------------------------------------------------------

/**產生youtobe物件**/
if (!function_exists('get_youtobe'))
{
	function get_youtobe($db_data=array(),$tv_type) {
		
		$youtobe = "";
		$title = array();
		$url= array();
		$img = array();
		$summary = array();
		
		if(isset($db_data["id"])===False)
		{
			return $youtobe;
		}
		
		//判斷顯示圖片格數樣式
		if($tv_type["num"] ==2)
		{
			$img_box_css = 'height:185px;width:245px;float:left;';
			$show_img_css = 'height:180px;width:240px';
		}
		else if($tv_type["num"] ==3)
		{
			$img_box_css = 'height:125px;width:165px;float:left;padding:2px 0';
			$show_img_css = 'height:125px;width:160px';
		}
		
		//產生youtobe**/
		$youtobe = '
					<div id="yotobe_box" style="height:370px;overflow:hidden;">
					<div id="yotobe" style="height:370px;width:990px;">
						<div id="tv_box" style="height:370px;width:480px;float:left;">
							'.show_youtobe($db_data["vid"][0]).'
						</div>
						
						<div id="img_box" style="height:370px;width:495px;float:left;padding:0 5px">';
		//判斷顯示圖片格數	
		if($tv_type["num"] > 1)
		{
			for($i=0;$i<count($db_data["id"]);$i++){
				$youtobe .= '
							<div id="tv_img_box" style="'.$img_box_css.'">
								<a href="javascript:void(0)"><img src="'.$db_data["img"][$i].'" id="tvimg'.$i.'" alt="'.$db_data["title"][$i].'" title="'.$db_data["title"][$i].'" style="'.$show_img_css.'"></a>
							</div>';
				
				//判斷是否有關連商品
				if(isset($db_data["item_id"][$i]) == True && $db_data["item_id"][$i] > 0)
				{
					$title[$i] = $db_data["item_title"][$i];
					$url[$i] = $db_data["item_url"][$i];
					$img[$i] = $db_data["item_img"][$i];
					$summary[$i] = $db_data["item_summary"][$i];
				}
				else
				{
					$title[$i] = $db_data["title"][$i];
					$url[$i] = $db_data["url"][$i];
					$img[$i] = $db_data["img"][$i];
					$summary[$i] = $db_data["summary"][$i];
				}
			}
		}

		//顯示描述
		$youtobe .= '
						</div>
					</div>
					
					<div id="tv_msg" style="position:relative;width:480px;height:155px;background-image: url(/img/tv_black.png);text-decoration:none;line-height:1.6em;">
						<h2 id="tv_msg_h2" style="color:#ffffff;">'.$title[0].'</h2>
						<span>
							<a id="tv_msg_url" href="'.$url[0].'" target="_blank"><img id="tv_msg_img" style="width:100px;height:75px;" src="'.$img[0].'" align="left" border="0" hspace="10"><div id="tv_msg_summary">'.$summary[0].'</div></a>
						</span>
					</div>
				</div>
				
				<script type="text/javascript">
				';
		//jquery判斷是否顯示描述		
		if($tv_type["description"]== True)
		{
			$youtobe .= '
				$(document).ready(function(){
					$("#tv_box").add($("#tv_msg")).hover(function(){
						moveInfo(198);
					}, function(){
						moveInfo(-130);
					});
					
					function moveInfo(position) {
							$("#tv_msg").stop().animate({
								bottom:position
							}, 200);
						}
				';
		}

		//jquery判斷是否顯示小圖片
		if($tv_type["num"] > 1) 
		{
			for($i=0;$i<count($db_data["id"]);$i++){
				$youtobe .= '				
					$("#tvimg'.$i.'").click(function(){
						$.get("/tv/show_tv/'.$db_data["vid"][$i].'/",function(data){
						$("#tv_box").html(data);
						});
				';

					//jquery判斷替換描述
				$youtobe .= '
						$("#tv_msg_h2").html("'.$title[$i].'");
						$("#tv_msg_summary").html("'.symbol_conversion($summary[$i]).'");
						$("#tv_msg_url").attr("href", "'.$url[$i].'");
						$("#tv_msg_img").attr("src", "'.$img[$i].'");
					});
				';
			}
		}
		$youtobe .= '
				});
				</script>
		';
	
		return $youtobe;
	}
}

// --------------------------------------------------------------------

/**取代成meta字串**/
if (!function_exists('meta_string'))
{
	function meta_string($string='', $len=0)
	{
		$string = trim($string);
		$string = str_replace('"', '', $string);       //去掉雙引號
		$string = str_replace("'", '', $string);       //去掉單引號
		$string = str_replace('\n', '', $string);      //去掉Enter
		$string = str_replace('\r\n', '', $string);    //去掉Enter
		if ($len > 0)
		{
			$string = mb_substr($string, 0, $len);     //只取150個字元
		}
		
		return $string;
	}
}

if (!function_exists('show_debug'))
{
	function show_debug($object){
		echo 'Debug Information:';
		echo '<pre>';
		print_r($object);
		echo '</pre>';
	}
}

if (!function_exists('check_webstart'))
{
	function check_webstart($ip,$system){

		$sercharray = 0;
		$sercharray = array_search(  $ip, $system['site']['system_ips'] );

		if( $sercharray <= 0 ){

			if( empty( $system['user'] ) ){
				go_showmsg('','/login');
			}

			if( ENVIRONMENT == 'development' ){
				if( $system['user']['User_gid'] != 1 ){
					go_showmsg( "網站系統關閉中，僅供開發人員登入使用！","/login/logout/PUBURL" );
				}
			}
		}

	}
}

if (!function_exists('site_title'))
{
	function site_title($title,$site){
		#決定網頁標題
		if(!empty($title)){
			return $title . ' - ' . $site['system_shopname'];
		}else{
			return $site['system_shopname'];
		}
	}
}

if (!function_exists('check_view_access'))
{
	function check_view_access( $User_gid ){

		$readkey = false;
		if( !empty( $User_gid ) ){
			switch ( $User_gid ) {
				case 1:
					$readkey = true;
					break;
				case 2:
					$readkey = true;
					break;
				case 3:
					$readkey = true;
					break;
				default:
					$readkey = false;
					break;
			}
		}
		return $readkey;
	}
}

if (!function_exists('check_user_lavel'))
{
	function check_user_lavel( $User_gid ){

		$user_lavel = 99;
		if( !empty( $User_gid ) ){
			switch ( $User_gid ) {
				case 1:
					$user_lavel = 1;
					break;
				case 2:
					$user_lavel = 2;
					break;
				case 3:
					$user_lavel = 3;
					break;
				case 4:
					$user_lavel = 4;
					break;
				case 5:
					$user_lavel = 3;
					break;
				default:
					$user_lavel = 99;
					break;
			}
		}
		return $user_lavel;
	}
}

if (!function_exists('check_website_access'))
{
	function check_website_access( $data ){

		if( empty( $data['user'] ) ){
			go_showmsg('','/admlogin.html');
		}else{

			$readkey = check_view_access( $data['user']['User_gid'] );
			
			if( !$readkey ){
				go_showmsg("您的帳號無權限使用後臺系統喔！", "/member/logout" );
				exit();
			}
		}

	}
}

//強制使用SSL安全連線
if( !function_exists("opensslpage") ){
	function opensslpage( $mod = 'https' ){

		if( SLL ){
			if( ( empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] !== "on" ) ){
				$RealMod = 'http';
			}else{
				$RealMod = 'https';
			}

			if( $mod != $RealMod ){
				header('Location: '.$mod.'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] );
				exit;
			}
		}

	}
}

//製造亂碼
if( !function_exists("make_slat") ){
	function make_slat( $max=5 ){

		#產生slat干擾碼
		$str = '';
		for($i=1;$i<=$max;$i++){
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
		$slat = $str;

		return $slat;
	}
}

//返回週幾
if (!function_exists('return_week'))
{
	function return_week( $date ){

		$week = date("w" , strtotime( $date ));		
		switch ( $week ) {
			case 0:
				return '(週日)';
				break;
			case 1:
				return '(週一)';
				break;
			case 2:
				return '(週二)';
				break;
			case 3:
				return '(週三)';
				break;
			case 4:
				return '(週四)';
				break;
			case 5:
				return '(週五)';
				break;
			case 6:
				return '(週六)';
				break;
		}
	}
}

if (!function_exists('objectToArray'))
{
	 function objectToArray($d) {
		 if (is_object($d)) {
			 // Gets the properties of the given object
			 // with get_object_vars function
			 $d = get_object_vars($d);
		 }
		 
		 if (is_array($d)) {
			 /*
			 * Return array converted to object
			 * Using __FUNCTION__ (Magic constant)
			 * for recursive call
			 */
			 return array_map(__FUNCTION__, $d);
		 }
		 else {
			 // Return array
			 return $d;
		 }
	 }
}

if (!function_exists('isJson'))
{
	function isJson($string) {
		return json_decode($string) != null;
	}
}

?>