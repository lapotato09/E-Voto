<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
      session_start();

      if (isset($_SESSION['user']) || !empty($_SESSION['user'])) {
        if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
            $uri = 'https://';
        } else {
          $uri = 'http://';
        }
        $uri .= $_SERVER['HTTP_HOST'];
        
        header('Location: '.$uri.'/dashboard');
      }
    ?>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="lib/angular/angular.js"></script>

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merienda&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ruda:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="lib/custom/custom.css">
    <link rel="stylesheet" href="fa/css/all.css">

    <!-- This is for the stylesheets -->
    <link rel="stylesheet" href="lib/css/bootstrap.min.css">

    <!-- This is for scripts -->

    <script type="text/javascript" src="lib/angular/angular-route.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="lib/js/bootstrap.min.js" ></script>
  
    <title>Welcome to E-Voto!</title>


  </head>
  <!-- <body class="ffam-sig" ng-app="LoginApp"> -->
  <body class="ffam-sig" ng-app="LoginApp" style="background-image: url('img/bg/bg-sample2.jpg'); background-size: cover; background-repeat: no-repeat;">
    <div ng-view></div>
  </body>

  <footer>
    <script type="text/javascript" src="login/LoginApp.php"></script>
  </footer>
</html>