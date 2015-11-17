<?
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require '../../inc/config.php';
require 'defconfig.php';
#################################
defconfig::checkusrlogin();

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
          <?/*
        <div class="page-head">
          <h2>Data Tables</h2>
          <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">DataTables</li>
          </ol>
        </div>
        <div class="cl-mcont">
          <div class="row">
            <div class="col-md-12">
              <div class="block-flat">
                <div class="header">
                  <h3>Basic DataTable</h3>
                </div>
                <div class="content">
                  <div class="table-responsive">
                    <table id="datatable" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Rendering engine</th>
                          <th>Browser</th>
                          <th>Platform(s)</th>
                          <th>Engine version</th>
                          <th>CSS grade</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="odd gradeX">
                          <td>Trident</td>
                          <td>
                            Internet
                            Explorer 4.0
                          </td>
                          <td>Win 95+</td>
                          <td class="center"> 4</td>
                          <td class="center"></td>
                        </tr>
                        <tr class="even gradeC">
                          <td>Trident</td>
                          <td>
                            Internet
                            Explorer 5.0
                          </td>
                          <td>Win 95+</td>
                          <td class="center">5</td>
                          <td class="center">C</td>
                        </tr>
                        <tr class="odd gradeA">
                          <td>Trident</td>
                          <td>
                            Internet
                            Explorer 5.5
                          </td>
                          <td>Win 95+</td>
                          <td class="center">5.5</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="even gradeA">
                          <td>Trident</td>
                          <td>
                            Internet
                            Explorer 6
                          </td>
                          <td>Win 98+</td>
                          <td class="center">6</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="odd gradeA">
                          <td>Trident</td>
                          <td>Internet Explorer 7</td>
                          <td>Win XP SP2+</td>
                          <td class="center">7</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="even gradeA">
                          <td>Trident</td>
                          <td>AOL browser (AOL desktop)</td>
                          <td>Win XP</td>
                          <td class="center">6</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Firefox 1.0</td>
                          <td>Win 98+ / OSX.2+</td>
                          <td class="center">1.7</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Firefox 1.5</td>
                          <td>Win 98+ / OSX.2+</td>
                          <td class="center">1.8</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Firefox 2.0</td>
                          <td>Win 98+ / OSX.2+</td>
                          <td class="center">1.8</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Firefox 3.0</td>
                          <td>Win 2k+ / OSX.3+</td>
                          <td class="center">1.9</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Camino 1.0</td>
                          <td>OSX.2+</td>
                          <td class="center">1.8</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Camino 1.5</td>
                          <td>OSX.3+</td>
                          <td class="center">1.8</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Netscape 7.2</td>
                          <td>Win 95+ / Mac OS 8.6-9.2</td>
                          <td class="center">1.7</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Netscape Browser 8</td>
                          <td>Win 98SE+</td>
                          <td class="center">1.7</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Netscape Navigator 9</td>
                          <td>Win 98+ / OSX.2+</td>
                          <td class="center">1.8</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Mozilla 1.0</td>
                          <td>Win 95+ / OSX.1+</td>
                          <td class="center">1</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Mozilla 1.1</td>
                          <td>Win 95+ / OSX.1+</td>
                          <td class="center">1.1</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Mozilla 1.2</td>
                          <td>Win 95+ / OSX.1+</td>
                          <td class="center">1.2</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Mozilla 1.3</td>
                          <td>Win 95+ / OSX.1+</td>
                          <td class="center">1.3</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Mozilla 1.4</td>
                          <td>Win 95+ / OSX.1+</td>
                          <td class="center">1.4</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Mozilla 1.5</td>
                          <td>Win 95+ / OSX.1+</td>
                          <td class="center">1.5</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Mozilla 1.6</td>
                          <td>Win 95+ / OSX.1+</td>
                          <td class="center">1.6</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Mozilla 1.7</td>
                          <td>Win 98+ / OSX.1+</td>
                          <td class="center">1.7</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Mozilla 1.8</td>
                          <td>Win 98+ / OSX.1+</td>
                          <td class="center">1.8</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Seamonkey 1.1</td>
                          <td>Win 98+ / OSX.2+</td>
                          <td class="center">1.8</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Gecko</td>
                          <td>Epiphany 2.20</td>
                          <td>Gnome</td>
                          <td class="center">1.8</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Webkit</td>
                          <td>Safari 1.2</td>
                          <td>OSX.3</td>
                          <td class="center">125.5</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Webkit</td>
                          <td>Safari 1.3</td>
                          <td>OSX.3</td>
                          <td class="center">312.8</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Webkit</td>
                          <td>Safari 2.0</td>
                          <td>OSX.4+</td>
                          <td class="center">419.3</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Webkit</td>
                          <td>Safari 3.0</td>
                          <td>OSX.4+</td>
                          <td class="center">522.1</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Webkit</td>
                          <td>OmniWeb 5.5</td>
                          <td>OSX.4+</td>
                          <td class="center">420</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Webkit</td>
                          <td>iPod Touch / iPhone</td>
                          <td>iPod</td>
                          <td class="center">420.1</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Webkit</td>
                          <td>S60</td>
                          <td>S60</td>
                          <td class="center">413</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Presto</td>
                          <td>Opera 7.0</td>
                          <td>Win 95+ / OSX.1+</td>
                          <td class="center">-</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Presto</td>
                          <td>Opera 7.5</td>
                          <td>Win 95+ / OSX.2+</td>
                          <td class="center">-</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Presto</td>
                          <td>Opera 8.0</td>
                          <td>Win 95+ / OSX.2+</td>
                          <td class="center">-</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Presto</td>
                          <td>Opera 8.5</td>
                          <td>Win 95+ / OSX.2+</td>
                          <td class="center">-</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Presto</td>
                          <td>Opera 9.0</td>
                          <td>Win 95+ / OSX.3+</td>
                          <td class="center">-</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Presto</td>
                          <td>Opera 9.2</td>
                          <td>Win 88+ / OSX.3+</td>
                          <td class="center">-</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Presto</td>
                          <td>Opera 9.5</td>
                          <td>Win 88+ / OSX.3+</td>
                          <td class="center">-</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Presto</td>
                          <td>Opera for Wii</td>
                          <td>Wii</td>
                          <td class="center">-</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Presto</td>
                          <td>Nokia N800</td>
                          <td>N800</td>
                          <td class="center">-</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Presto</td>
                          <td>Nintendo DS browser</td>
                          <td>Nintendo DS</td>
                          <td class="center">8.5</td>
                          <td class="center">C/A<sup>1</sup></td>
                        </tr>
                        <tr class="gradeC">
                          <td>KHTML</td>
                          <td>Konqureror 3.1</td>
                          <td>KDE 3.1</td>
                          <td class="center">3.1</td>
                          <td class="center">C</td>
                        </tr>
                        <tr class="gradeA">
                          <td>KHTML</td>
                          <td>Konqureror 3.3</td>
                          <td>KDE 3.3</td>
                          <td class="center">3.3</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeA">
                          <td>KHTML</td>
                          <td>Konqureror 3.5</td>
                          <td>KDE 3.5</td>
                          <td class="center">3.5</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeX">
                          <td>Tasman</td>
                          <td>Internet Explorer 4.5</td>
                          <td>Mac OS 8-9</td>
                          <td class="center">-</td>
                          <td class="center">X</td>
                        </tr>
                        <tr class="gradeC">
                          <td>Tasman</td>
                          <td>Internet Explorer 5.1</td>
                          <td>Mac OS 7.6-9</td>
                          <td class="center">1</td>
                          <td class="center">C</td>
                        </tr>
                        <tr class="gradeC">
                          <td>Tasman</td>
                          <td>Internet Explorer 5.2</td>
                          <td>Mac OS 8-X</td>
                          <td class="center">1</td>
                          <td class="center">C</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Misc</td>
                          <td>NetFront 3.1</td>
                          <td>Embedded devices</td>
                          <td class="center">-</td>
                          <td class="center">C</td>
                        </tr>
                        <tr class="gradeA">
                          <td>Misc</td>
                          <td>NetFront 3.4</td>
                          <td>Embedded devices</td>
                          <td class="center">-</td>
                          <td class="center">A</td>
                        </tr>
                        <tr class="gradeX">
                          <td>Misc</td>
                          <td>Dillo 0.8</td>
                          <td>Embedded devices</td>
                          <td class="center">-</td>
                          <td class="center">X</td>
                        </tr>
                        <tr class="gradeX">
                          <td>Misc</td>
                          <td>Links</td>
                          <td>Text only</td>
                          <td class="center">-</td>
                          <td class="center">X</td>
                        </tr>
                        <tr class="gradeX">
                          <td>Misc</td>
                          <td>Lynx</td>
                          <td>Text only</td>
                          <td class="center">-</td>
                          <td class="center">X</td>
                        </tr>
                        <tr class="gradeC">
                          <td>Misc</td>
                          <td>IE Mobile</td>
                          <td>Windows Mobile 6</td>
                          <td class="center">-</td>
                          <td class="center">C</td>
                        </tr>
                        <tr class="gradeC">
                          <td>Misc</td>
                          <td>PSP browser</td>
                          <td>PSP</td>
                          <td class="center">-</td>
                          <td class="center">C</td>
                        </tr>
                        <tr class="gradeU">
                          <td>Other browsers</td>
                          <td>All others</td>
                          <td>-</td>
                          <td class="center">-</td>
                          <td class="center">U</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          */?>
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