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
    
    <title> E-Voto | Canvassing</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../lib/angular/angular.js"></script>

    <!-- Google fonts -->
    <?php include '../includes/google-fonts/google-fonts.inc'; ?>

    <!-- This is for scripts -->
    <script type="text/javascript" src="../lib/angular/angular-route.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="../lib/js/bootstrap.min.js" ></script>

    <!-- This is for the stylesheets -->
    <link rel="stylesheet" href="../lib/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/custom/custom.css">
    <link rel="stylesheet" href="../lib/custom/dashboard-tpl.css">
    <base href="/">

  </head>
  <body class="ffam-sig">    
    <div class="container-fluid" id="app1">
      <div>
        <?php include '../global/nav-header.php';?>
      </div>
      <div ng-view></div>
    </div> 
  </body>
   <footer>
    <script type="text/javascript" src="canvassing/CanvassingApp.php"></script>
    <script type="text/javascript" src="global/sidebar/sidebarApp.php"></script>
    <script type="text/javascript" src="../lib/angular/angular-animate.js"></script>
    <script type="text/javascript" src="../lib/angular/angular-animate.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/ui-bootstrap4@3.0.6/dist/ui-bootstrap-tpls.js"></script>
    <script>
      angular.bootstrap(document.querySelector('#app1'),['CanvassingApp']);
      angular.bootstrap(document.querySelector('#app2'),['SidebarApp']);
    </script>
    <div>
      <?php include '../global/footer.php'?>
    </div>
  </footer>
</html>
