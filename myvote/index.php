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
	<title>E-Voto | myVote</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <base href="/">
  <script type="text/javascript" src="lib/angular/angular.js"></script>

  <!-- GOOGLE FONTS -->
  <?php include '../includes/google-fonts/google-fonts.inc'; ?>

  <!-- This is for scripts -->
  <script type="text/javascript" src="../lib/angular/angular-route.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
  <script src="../lib/js/bootstrap.min.js" ></script>

  <!-- This is for the stylesheets -->
  <!-- <link rel="stylesheet" type="text/css" href="../lib/custom/modal-css.css"></link> -->
  <link rel="stylesheet" href="lib/css/bootstrap.min.css">
  <link rel="stylesheet" href="lib/custom/custom.css">
  <link rel="stylesheet" href="fa/css/all.css">

</head>

<!-- <body class="ffam-sig"> -->
<body style="background: white;">
  <div class="container-fluid">
    <div><?php include '../global/nav-header.php';?></div>
    <div ng-app="myVoteApp">
      <div ng-view></div>
    </div>
  </div>  
</body>

<footer>
  <script type="text/javascript" src="myvote/VoteApp.php"></script>
  <script type="text/javascript" src="lib/angular/angular-animate.js"></script>
  <script type="text/javascript" src="lib/angular/angular-animate.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/ui-bootstrap4@3.0.6/dist/ui-bootstrap-tpls.js"></script>
  <!-- <div style="position: absolute; bottom: 0; width: 100%;">
    <?php include '../global/footer.php'?>
  </div> -->
</footer>

</html>