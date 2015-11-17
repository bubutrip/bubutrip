<?
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require '../../inc/config.php';
require 'defconfig.php';
#################################
defconfig::checkusrlogin();

$members = dbconn::query_allmemneweve();

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
          <h2>周年慶會員表</h2>
        </div>
        <div class="cl-mcont">
          <div class="row">
            <div class="col-md-12">
              <div class="block-flat">
                <div class="header">
                  <h3>周年慶會員表</h3>
                  <!--button type="button" class="btn btn-success" onclick="window.open('/event/admin/makecsv.php?type=2')"><i class="fa fa-cloud-download"></i> Download CSV</button-->
                </div>
                <div class="content">
                  <div class="table-responsive">
                    <table id="datatable" class="table table-bordered">
                      <thead>
                        <tr class="text-center">
                          <th class="text-center">項次</th>
                          <th class="text-center">會員名稱</th>
                          <th class="text-center">會員ID</th>
                          <th class="text-center">會員Email</th>
                          <th class="text-center">新舊會員</th>
                          <th class="text-center">邀請碼</th>
                          <th class="text-center">被邀請碼</th>
                          <th class="text-center">APP</th>
                          <th class="text-center">device id</th>
                          <th class="text-center">栗子</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?$m=1?>
                        <? foreach ($members as $member) { ?>
                        <tr class="odd gradeX text-center">
                          <td><?=$m?></td>
                          <td><?=$member['definfo']['name']?></td>
                          <td><?=$member['definfo']['id']?></td>
                          <td><?=( !empty($member['definfo']['email']) )?$member['definfo']['email']:$member['sns_info']['sns_email']?></td>
                          <td><?=( $member['usr_new'] == 1 )?"新會員":"舊會員"?></td>
                          <td><?=$member['usr_makekey']?></td>
                          <td><?=$member['usr_comkey']?></td>
                          <td><?=( $member['usr_appstatus'] == 1 )?"已安裝":"未安裝"?></td>
                          <td class="text-left">
                              <? foreach( $member['deviceids'] as $deviceid ){ ?>
                              <div style="border-bottom: 1px solid #000;"><?=$deviceid['dev_deviceid']?></div>
                              <? } ?>
                          </td>
                          <td><?=$member['countn']?></td>
                        </tr>
                        <?$m++?>
                        <? } ?>
                      </tbody>
                    </table>
                  <? //dbconn::showDebug( $members[14] ) ?>
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