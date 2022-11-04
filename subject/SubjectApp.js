var app = angular.module('SubjectApp', ['ngRoute']);

app.config(['$routeProvider', '$locationProvider', 
	function($routeProvider, $locationProvider) {
	$locationProvider.html5Mode(true).hashPrefix('!')	;

	$routeProvider
		.when('/subject/', {
			templateUrl: 'subject/subject-tpl.php?_=' + Date.now()
			// controller: 'DashboardCtrl'
		})
		.when('/addSubject/', {
			templateUrl: 'subject/subject-add-tpl.php?_=' + Date.now()
		})

}]);