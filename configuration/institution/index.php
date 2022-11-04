<!DOCTYPE html>
<html>
<head>
	<?php
		session_start();

		if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
			if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
				$uri = "https://";
			} else {
				$uri = "http://";
			}

			$uri .= $_SERVER['HTTP_POST'];

			header('Location: '.$uri.'/login');
		}
	?>
	<title>E-Voto | Configuration</title>
	<!-- Required Meta Tags -->
	<meta charset="utf-8">
  <base href="/">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <script type="text/javascript" src="lib/angular/angular.js"></script>

  <!-- GOOGLE FONTS -->
  <?php include '../../includes/google-fonts/google-fonts.inc'; ?>

  <!-- This is for scripts -->
  <!-- <script type="text/javascript" src="lib/angular/angular.min.js"></script> -->
  <script type="text/javascript" src="lib/angular/angular-sanitize.js"></script>
  <script type="text/javascript" src="lib/angular/angular-route.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
  <script src="lib/js/bootstrap.min.js"></script>

  <!-- ui-select files -->
  <script src="node_modules/ui-select/dist/select.js"></script>
  <script src="node_modules/ui-select/dist/select.min.js"></script>


  <!-- Select2 theme -->
  <link rel="stylesheet" href="node_modules/ui-select/dist/select.css">
  <link rel="stylesheet" href="node_modules/ui-select/dist/select.min.css">
  <link rel="stylesheet" href="lib/custom/css/selectize.default.css">


  <!-- This is for the stylesheets -->
  <link rel="stylesheet" href="lib/css/bootstrap.css">
  <link rel="stylesheet" href="lib/css/bootstrap.min.css">
  <link rel="stylesheet" href="fa/css/all.css">
  <link rel="stylesheet" href="lib/custom/custom.css">
  <link rel="stylesheet" href="lib/custom/css/boxed-check.min.css"/>

  <script type="text/javascript" src="node_modules/requirejs/require.js"></script>

</head>
<body class="ffam-sig">
  <div>
    <?php include '../../global/nav-header.php'; ?> 
  </div>
  <div class="container-fluid">
    <div class="row">
      <div id="app2" class="col-sm-2 col-md-2 col-lg-2" style="margin-top: -50px; padding-top: 10px;">
        <?php include '../../global/sidebar/sidebar.php';?>
      </div>
      <div id="app1" class="col-sm-10 col-md-10 col-lg-10">
        <div ng-view></div>
      </div>
    </div>
  </div>
</body>

<footer>
  <script type="text/javascript" src="configuration/institution/InstitutionConfigApp.php"></script>
  <script type="text/javascript" src="global/sidebar/sidebarApp.php"></script>
  <script type="text/javascript" src="lib/angular/angular-animate.js"></script>
  <script type="text/javascript" src="lib/angular/angular-animate.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/ui-bootstrap4@3.0.6/dist/ui-bootstrap-tpls.js"></script>
  
  <script>
    angular.bootstrap(document.querySelector('#app1'), ['InstitutionConfigApp']);
    angular.bootstrap(document.querySelector('#app2'), ['SidebarApp']);
  </script>
  <div>
    <?php include '../../global/footer.php'; ?>
  </div>
</footer>

</html>