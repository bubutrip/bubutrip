<?
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require '../../inc/config.php';
require 'defconfig.php';
#################################
defconfig::checkusrlogin();

#取所有參與的會員資料
$members = dbconn::query_all_mem();

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
    <link rel="stylesheet" type="text/css" href="assets/lib/jquery.datatables/plugins/bootstrap/3/dataTables.bootstrap.css"/>
    <link href="assets/css/style.css" rel="stylesheet">
  </head>
  <body>
    <div id="head-nav" class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-toggle"><span class="fa fa-gear"></span></button><a href="#" class="navbar-brand"><span>BuBuTrip</span></a>
        </div>
      </div>
    </div>
    <div id="cl-wrapper">
            <!--Sidebar item function-->
            <!--Sidebar sub-item function-->
            <? include( "menu.php" ) ?>
      <div id="pcont" class="container-fluid">
        <div class="page-head">
          <h2>會員票券對應</h2>
        </div>
        <div class="cl-mcont">
          <div class="row">
            <div class="col-md-12">
              <div class="block-flat">
                <div class="header">
                  <h3>會員票券對應</h3>
                  <button type="button" class="btn btn-success" onclick="window.open('/event/admin/makecsv.php?type=1')"><i class="fa fa-cloud-download"></i> Download CSV</button>
                </div>
                <div class="content">
                  <div class="table-responsive">
                    <table id="datatable" class="table table-bordered">
                      <thead>
                        <tr class="text-center">
                          <th class="text-center">項次</th>
                          <th class="text-center">會員ID</th>
                          <th class="text-center">會員Email</th>
                          <th class="text-center">新舊會員</th>
                          <th class="text-center">領取票券</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?$m=1?>
                        <? foreach ($members as $member) { ?>
                        <? if( ( !empty( $member['ticket_info']) and $member['mem_ticket'] == 1 ) or ( $member['mem_newuser'] == 0 and $member['mem_ticket'] == 1 ) ){ ?>
                        <tr class="odd gradeX text-center">
                          <td><?=$m?></td>
                          <td><?=$member['mem_uid']?></td>
                          <td><?=$member['sns_info']['sns_email']?></td>
                          <td><?=( $member['mem_newuser'] == 1 )?"新會員":"舊會員"?></td>
                          <td>
                          <?
                              if( $member['mem_newuser'] == 1 and ( !empty( $member['ticket_info'] )) ){
                                echo "票號：".$member['ticket_info'];
                              }elseif( $member['mem_newuser'] == 1 and empty( $member['ticket_info'] ) ){
                                echo "未參與贈票活動";#(".$member['mem_newuser'].":".$member['mem_ticket'].")";
                              }elseif( $member['mem_newuser'] == 0 and $member['mem_ticket'] == 1 ){
                                echo "已取得抽獎資格";#(".$member['mem_newuser'].":".$member['mem_ticket'].")";
                              }else{
                                #echo "(".$member['mem_newuser'].":".$member['mem_ticket'].")";
                              }
                          ?>
                        </tr>
                        <? } ?>
                        <?$m++?>
                        <? } ?>
                      </tbody>
                    </table>
                  <? #dbconn::showDebug( $members ) ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="assets/lib/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/lib/jquery.nanoscroller/javascripts/jquery.nanoscroller.js"></script>
    <script type="text/javascript" src="assets/js/cleanzone.js"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/voice-recognition.js"></script>
    <script src="assets/lib/jquery.datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="assets/lib/jquery.datatables/plugins/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="assets/js/page-data-tables.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
      	App.dataTables();
      });
    </script>
  </body>
</html>