<?php header("Content-Type: application/x-javascript"); ?>

var app = angular.module('CanvassingApp', ['ngRoute']);

app.config(['$routeProvider', '$locationProvider',
  function($routeProvider, $locationProvider) {
  $locationProvider.html5Mode(true).hashPrefix('!');
    
  $routeProvider
    .when('/canvassing', {
        templateUrl: 'canvassing/canvassing-tpl.php?_=' + Date.now()
        // controller: 'DashboardCtrl'
    })
    .otherwise({
      redirectTo: '/login' 
    });

}]);
