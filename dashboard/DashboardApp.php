<?php header("Content-Type: application/x-javascript"); ?>

var app = angular.module('DashboardApp', ['ngRoute']);

app.config(['$routeProvider', '$locationProvider',
  function($routeProvider, $locationProvider) {
  $locationProvider.html5Mode(true).hashPrefix('!');
    
  $routeProvider
    .when('/dashboard', {
        templateUrl: 'dashboard/dashboard-tpl.php?_=' + Date.now(),
        controller: 'DashboardCtrl'
    })
    .otherwise({
      redirectTo: '/login' 
    });

}]);

app.controller('DashboardCtrl', ['DashboardSrvcs', '$scope', '$location', '$window','$filter' ,'$interval', function(DashboardSrvcs, $scope, $location, $window,$filter, $interval) {

  // DECLARING AND INIT
  $scope.Countdown = false;
  $scope.ClockWatchdog = false;
  $scope.Process = {};

  $scope.AnnouncementLoad = function() {
    DashboardSrvcs.AnnouncementGet()
    .then( function successCallback(response) {
      $scope.Announcement = $filter('filter')(response.data.data, {'active': '1'});
    });
  }

  function LoadCountdown(param) {
    $scope.EnddatePrase = Date.parse(param.dateend);

    if (Date.parse(param.dateend) - Date.parse(new Date()) <= 0) {
      $scope.days = '00';
      $scope.hours = '00';
      $scope.minutes = '00';
      $scope.seconds = '00';
    }
    else {
      $scope.initializeClock(param.dateend);
    }

  };

  $scope.getTimeRemaining = function(endtime) {
    var t = Date.parse(endtime) - Date.parse(new Date());
    var seconds = Math.floor((t / 1000) % 60);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));

    if (t <= 0) {
      $scope.ClockWatchdog = true;
    }

    return {
      'total': t,
      'days': days,
      'hours': hours,
      'minutes': minutes,
      'seconds': seconds
    };
  };

  $scope.initializeClock = function(endtime) {
    function updateClock() {
      var t = $scope.getTimeRemaining(endtime);

      $scope.days = t.days;
      $scope.hours = ('0' + t.hours).slice(-2);
      $scope.minutes = ('0' + t.minutes).slice(-2);
      $scope.seconds = ('0' + t.seconds).slice(-2);

      if (t.total <= 0) {
        $interval.cancel(timeinterval);
      }

    }

    if ($scope.ClockWatchdog == false) {
      updateClock();
      var timeinterval = $interval(updateClock, 1000);
    }
    else {
      $scope.days = '00';
      $scope.hours = '00';
      $scope.minutes = '00';
      $scope.seconds = '00';
    }
    $scope.Countdown = false;
  }

  $scope.LoadProcess = function() {
    DashboardSrvcs.ProcessListGet()
    .then(function (response) {
      $scope.ProcessList = $filter('filter')(response.data.data, {'active': '1'});
      angular.forEach($scope.ProcessList, function(data) {
        $scope.DataCountdown = data;
      });

      LoadCountdown($scope.DataCountdown);


    })
    
  };

  $scope.AnnouncementLoad();
  $scope.LoadProcess();


}]);

app.factory('DashboardSrvcs', function($http){
	return {
    AccountsGet: function (data) {
      return $http({
        method: 'POST',
        url: '../api/login/getAccount.php',
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    AnnouncementGet: function(){
      return $http({
        method: 'GET',
        url: '../api/dashboard/Announcement/AnnouncementGet.php?_' + Date.now()
      });
    },
    ProcessListGet: function() {
      return $http({
        method: 'GET',
        url: '../api/dashboard/process/ProcessListLoad.php?_' + Date.now()
      });
    }

	}
});