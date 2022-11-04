<?php header("Content-Type: application/x-javascript"); ?>

var app = angular.module('CandidacyEvaluationApp', ['ngRoute', 'ngAnimate', 'ui.bootstrap']);

app.config(['$routeProvider', '$locationProvider',
	function($routeProvider, $locationProvider) {
		$locationProvider.html5Mode(true).hashPrefix('!');

		$routeProvider
		.when('/candidacy/evaluation', {
			templateUrl: 'candidacy/evaluation/candidacy-evaluation-tpl.php?_=' + Date.now(),
			controller: 'CandidacyEvaluationCtrl'
		})

}]);

app.controller('CandidacyEvaluationCtrl', ['CandidacyEvaluationSrvs', '$scope', '$filter', '$uibModal', '$window', function(CandidacyEvaluationSrvs, $scope, $filter, $uibModal, $window) {
	$scope.qualifications = [
		{'id': 1, 'label': 'Bonifide Campus Students', 'remarks': 'remarks1'},
		{'id': 2, 'label': 'Able to read and write', 'remarks': 'remarks2'},
		{'id': 3, 'label': 'Must a regular Student', 'remarks': 'remarks3'},
		{'id': 4, 'label': 'With at least one year remaining on campus prior on election day', 'remarks': 'remarks4'},
		{'id': 5, 'label': 'GWA must higher than 2.5', 'remarks': 'remarks5'},
		{'id': 6, 'label': 'No Failing grades (3.0, 5.0, INC, DROP ) on current semester enrolled.', 'remarks': 'remarks5'}
	];

	function ModalValidation(response) {
		var mymodal = $uibModal.open({
			templateUrl: '../candidacy/req-modal-tpl.php?_' + Date.now(),
			controller: 'ValidationModalCtrl',
			dialogClass: 'container',
			backdrop: 'static',
			resolve: {
				title: function() {
					return "Candidacy Evaluation";
				},
				response: function() {
					return response;
				}
			}
		});

		mymodal.result.then(function() {
		}, function() {
		});

	};

	$scope.EvaluationDataGet = function(data) {
		var data = angular.toJson({'status': data});
		CandidacyEvaluationSrvs.EvaluationDataGet(data)
		.then( function successCallback(response) {
			$scope.evaluation_info = response.data.data;
			for (var i = $scope.evaluation_info.length - 1; i >= 0; i--) {
				$scope.evaluation_info[i];
				$scope.evaluation_info[i].candidacy00id = $scope.evaluation_info[i].candidacy00id.toString().padStart(5, '0');
			}
		})
	}

	$scope.WithdrawCancelledCandidacy = function(idno, action) {
  	var data = angular.toJson({'candidacy00id': idno, 'action': action})
  	CandidacyEvaluationSrvs.CandidacyWithdrawal(data)
  	.then( function successCallback(response) {

  		if (response.data.status == 'success') {
	  		ModalValidation(response.data);
				$scope.EvaluationDataGet('FOR_EVALUATION');
  		}
  	})
  }

	$scope.EvaluationSave = function(id, form, status) {
		var data = angular.toJson({'candidacy00id': id, 'status': status});
		CandidacyEvaluationSrvs.EvaluationDataSave(data)
		.then( function successCallback(response){
			if (response.data.status == 'success') {
				var data = {
					'message': 'Evaluation Form saved.'
				}
				ModalValidation(data);
				$scope.EvaluationDataGet(status);
			}
		})
	}

	$scope.EvaluationDataGet('FOR_EVALUATION');

}]);

app.controller('ValidationModalCtrl', ['CandidacyEvaluationSrvs','$scope','$uibModalInstance','title','response', function(CandidacySrvcs,$scope,$uibModalInstance,title,response) {

	var data = {
		'message': response.message,
		'title': title
	};
	$scope.detailsmodal = data;


	$scope.closeModal = function() {
    $uibModalInstance.close();
  };

}]);

app.factory('CandidacyEvaluationSrvs', function($http) {
	return {
		CandidacyWithdrawal: function(data) {
    	return $http({
	    	method: 'POST',
    		url: 'api/candidacy/CandidacyWithdrawalPost.php?_=' + Date.now(),
    		data: 'data=' + encodeURIComponent(data),
    		headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    	});
    },
    EvaluationDataGet: function(data){
    	return $http({
    		method: 'POST',
    		url: 'api/candidacy/CandidacyApprovalEvaluationGet.php?_=' + Date.now(),
    		data: 'data=' + encodeURIComponent(data),
    		headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    	})
    },
    EvaluationDataSave: function(data){
    	return $http({
    		method: 'POST',
    		url: 'api/candidacy/CandidacyApprovalEvaluationSave.php?_=' + Date.now(),
    		data: 'data=' + encodeURIComponent(data),
    		headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    	});
    }
	}
});
