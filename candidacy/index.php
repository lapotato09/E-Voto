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
    <title> E-Voto | Filing of Candidacy</title>
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
    <link rel="stylesheet" href="../lib/custom/custom.css">
    <base href="/">

  </head>
  <body style="background: #ecf0f1;">    
    <div><?php include '../global/nav-header.php';?></div>
    <div ng-app="CandidacyApp">

      <div ng-view></div>
    </div>
  </body>
   <footer>
    <script type="text/javascript" src="candidacy/CandidacyApp.js"></script>
    <script type="text/javascript" src="../lib/angular/angular-animate.js"></script>
    <script type="text/javascript" src="../lib/angular/angular-animate.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/ui-bootstrap4@3.0.6/dist/ui-bootstrap-tpls.js"></script>
  </footer>
</html>