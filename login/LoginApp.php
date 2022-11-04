<?php 
    header("Content-Type: application/x-javascript");
?>

var app = angular.module('LoginApp', ['ngRoute']);

app.config(['$routeProvider', '$locationProvider',
  function($routeProvider, $locationProvider) {
  $locationProvider.html5Mode(true).hashPrefix('!');
    
  $routeProvider
    .when('/login', {
        templateUrl: 'login/landing.php?_=' + Date.now(),
        controller: 'LoginCtrl'
    })
    .when('/signup', {
        templateUrl: '../signup/signup.php?_=' + Date.now(),
        controller: 'LoginCtrl'
    })
    .otherwise({
      redirectTo: '/login' 
    });

}]);


app.controller('LoginCtrl', ['LoginSrvcs', '$scope', '$location', '$window',  function(LoginSrvcs, $scope, $location, $window) {
  $scope.Account = {};
  $scope.CreateAcc = {};
  $scope.LoggedOn = true;
  $scope.showpass = false;

  var url = $location.url();
  var Base = 'base' + url;

  $scope.GetAccount = function(data) {
    var data = angular.toJson(data);
    LoginSrvcs.AccountsGet(data)
    .then(function success(response) {
      if (response.data.status == 'success') {
        if (response.data.data.length > 0) {
          $scope.Account = response.data.data[0];
          $window.location.href = '/dashboard/';
          // angular.forEach($scope.Account, function(k){
          //   $scope.Session = k;
          // });
        }
        else {
          $scope.Account = {};
          $scope.LoggedOn = false;
        }
        
      }
      else {
        $scope.Account = {};
        $scope.LoggedOn = false;
      }

    });
  }

  $scope.CreateAccount = function(data) {
    var data = angular.toJson(data);
    LoginSrvcs.CreateAccount(data)
    .then(function success(response) {
      alert('success!')
    });
  }


  $scope.submitForm = function(isValid, data) {
    // check to make sure the form is completely valid
    if (isValid) { 
      if (data.pass != data.confpass) {
        alert('Password and confirm Password does not match!');
      }
      else {
        $scope.CreateAccount(data);  
      }
    }
    if (!isValid)
    {
      alert('Please fill up the rquired fields!')
    }

  };

  $scope.$watch('showpass', function(val) {
    var el = document.getElementById('password');
    if (val) {
      el.type = 'text';
    } 
    else {
      el.type = 'password';
    }
  })

}]);


app.factory('LoginSrvcs', function($http){
	return {
    AccountsGet: function (data) {
      return $http({
        method: 'POST',
        url: '../api/login/getAccount.php',
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    CreateAccount: function(data) {
      return $http({
        method: 'POST',
        url: '../api/login/emailSending.php?request=create',
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    }
	}
});
