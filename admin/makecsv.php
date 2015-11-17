<?
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require '../../inc/config.php';
require 'defconfig.php';

header("content-type: text/html; charset=utf-8");
echo "正在產生檔案中...<br>";

$type = $_GET['type'];

if( $type > 0 ){

	$output = '';

	if( $type == 1 ){
		$members = dbconn::query_all_mem();
		$output = "會員ID,會員Email,新舊會員(0:舊 1:新),票券\r\n";
		foreach ($members as $member) {
			if( ( !empty( $member['ticket_info']) and $member['mem_ticket'] == 1 ) or ( $member['mem_newuser'] == 0 and $member['mem_ticket'] == 1 ) ){
				if( $member['mem_newuser'] == 1 and ( !empty( $member['ticket_info'] )) ){
					$tickinfo = "票號：".$member['ticket_info'];
				}elseif( $member['mem_newuser'] == 1 and empty( $member['ticket_info'] ) ){
					#$tickinfo = "未參與贈票活動";#(".$member['mem_newuser'].":".$member['mem_ticket'].")";
				}elseif( $member['mem_newuser'] == 0 and $member['mem_ticket'] == 1 ){
					$tickinfo = "已取得抽獎資格";#(".$member['mem_newuser'].":".$member['mem_ticket'].")";
				}
				if( !empty( $tickinfo ) ){
					$output .= $member['mem_uid'].",".$member['sns_info']['sns_email'].",".$member['mem_newuser'].",".$tickinfo."\r\n";	
				}
			}
		}
	}


	if( $type == 2 ){
		$tickets = dbconn::query_all_tripname();
		$output = "會員ID,會員Email,新舊會員(0:舊 1:新),命名名稱,命名意涵\r\n";
		foreach ($tickets as $ticket){
			$output .= $ticket['mem_uid'].','.$ticket['sns_info']['sns_email'].",".$ticket['mem_newuser'].",".$ticket['mem_tripname'].','.preg_replace("/\s/","",$ticket['mem_namemean'] )."\r\n";
		}
	}

	$fp = fopen("/home/na/web/bubutrip.com.tw/event/admin/makefile/t".$type.".csv","w");
	fwrite($fp, "\xEF\xBB\xBF".$output);

	echo "<script>";
	echo "location.href='/event/admin/makefile/t".$type.".csv'";
	echo "</script>";

}



?>