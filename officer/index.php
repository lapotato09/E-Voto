<!DOCTYPE html>
<html>
  <head>
    <?php
      session_start();

      if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
        if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
            $uri = 'https://';
        } else {
          $uri = 'http://';
        }
        $uri .= $_SERVER['HTTP_HOST'];
        
        header('Location: '.$uri.'/login');
      }
    ?>
    <title> E-Voto | Officer</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../lib/angular/angular.js"></script>

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merienda&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ruda:wght@500&display=swap" rel="stylesheet">

    <!-- This is for scripts -->
    <script type="text/javascript" src="../lib/angular/angular-route.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="../lib/js/bootstrap.min.js" ></script>

    <!-- This is for the stylesheets -->
    <link rel="stylesheet" href="../lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../global/sidebar/sidebar.css">
    <base href="/">

  </head>
  <body style="background: #ecf0f1;">  
  	<div ng-app="RootApp" class="container-fluid">
      <div><?php include '../global/nav-header.php';?></div>
      <div class="row">
        <div id="app2" class="col-sm-2 col-md-2 col-lg-2">
          <div ng-app="SidebarApp">
            <?php include '../global/sidebar/sidebar.php';?>
          </div>
        </div>
        <div id="app1" class="col-sm-10 col-md-10 col-lg-10">
          <div ng-app="OfficerApp">
            <div ng-view></div>
          </div>
        </div>
      </div>
    </div>  
  </body>
   <footer>
    <script type="text/javascript" src="global/sidebar/sidebarApp.php"></script>
    <script type="text/javascript" src="officer/OfficerApp.js"></script>
    <script type="text/javascript" src="../lib/angular/angular-animate.js"></script>
    <script type="text/javascript" src="../lib/angular/angular-animate.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/ui-bootstrap4@3.0.6/dist/ui-bootstrap-tpls.js"></script>
    <script>
      const rootApp = angular.module('RootApp',['OfficerApp','SidebarApp']);

      angular.bootstrap(document.querySelector('#app1'),['OfficerApp']);
      angular.bootstrap(document.querySelector('#app2'),['SidebarApp']);
    </script>
  </footer>
</html>