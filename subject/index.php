<!DOCTYPE html>
<html>
  <head>
    <title>myNotebook | Subjects</title>
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
    <base href="/">

  </head>
  <body>    
    <div ng-app="SubjectApp">
      <div><?php include '../global/nav-header.php';?></div>
      <div ng-view></div>
      <a href="/addSubject/">Add Subjects<a>
    	<a href="/subject">mySubjects<a>
    </div>
  </body>
   <footer>
    <script type="text/javascript" src="subject/SubjectApp.js"></script>
  </footer>
</html>