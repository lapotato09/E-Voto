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

app.controller('DashboardCtrl', ['DashboardSrvcs', '$scope', '$location', '$window','$filter', function(DashboardSrvcs, $scope, $location, $window,$filter) {

  // DECLARING AND INIT
  $scope.Countdown = false;
  $scope.ClockWatchdog = false;

  $scope.AnnouncementLoad = function() {
    DashboardSrvcs.AnnouncementGet()
    .then( function successCallback(response) {
      $scope.Announcement = $filter('filter')(response.data.data, {'active': '1'});
    });
  }

  $scope.AnnouncementLoad();


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
    }

	}
});