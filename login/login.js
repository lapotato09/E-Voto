var app = angular.module('App', ['ngRoute']);


app.controller('myController', function($scope, $location) {
  $scope.weburi = $location.absUrl();
  $scope.myhostname = $location.host();
  $scope.webportno = $location.port();
  $scope.path = $location.path();
  $scope.webprotocol = $location.protocol();

  console.log($scope.weburi);
  console.log($scope.myhostname);
  console.log($scope.webportno);
  console.log($scope.webprotocol);
  console.log($scope.path);
});

app.config(['$routeProvider', '$locationProvider',
  function($routeProvider, $locationProvider) {
  $locationProvider.html5Mode(true).hashPrefix('!');
    
  $routeProvider
    .when('/login/', {
        templateUrl: 'login/landing.php',
        controller: 'myController'
    })
    .when('/signup/', {
        templateUrl: '../landing/signup.html'
    })
    .otherwise({
    	redirectTo: '/login/'
    });

}]);



