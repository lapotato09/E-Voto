<?php header("Content-Type: application/x-javascript"); ?>

var app = angular.module('CanvassingPartialResultApp', ['ngRoute']);

app.config(['$routeProvider', '$locationProvider',
  function($routeProvider, $locationProvider) {
  $locationProvider.html5Mode(true).hashPrefix('!');
    
  $routeProvider
    .when('/canvassing/partial-result', {
        templateUrl: 'canvassing/partial-result/canvassing-partial-result-tpl.php?_=' + Date.now(),
        controller: 'CanvassingInitialResultCtrl'
    })
    .otherwise({
      redirectTo: '/login' 
    });

}]);

app.controller('CanvassingInitialResultCtrl', ['$scope', function($scope) {
  $scope.datenow = new Date();
  $scope.Initialized = false;
  console.log($scope.datenow);
  $scope.InitialResult = 'hello partial';
}]);
