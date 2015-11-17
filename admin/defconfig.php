<?
session_start();
require '../dbconn.php';

class Defconfig {

	/***** Constructor *****/
    function __construct(){


    }

    public static function checkusrlogin(){

    	#dbconn::showDebug( $_SESSION );

    	if( !isset($_SESSION['eventadm:uid']) ){
			header("content-type: text/html; charset=utf-8");
			echo "<script>";
			echo "location.href='/event/admin/login.php'";
			echo "</script>";
    	}

    }


}

?>