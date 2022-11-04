<?php header("Content-Type: application/x-javascript"); ?>

var app = angular.module('CandidacyApprovalApp', ['ngRoute', 'ngAnimate', 'ui.bootstrap']);

app.config(['$routeProvider', '$locationProvider',
	function($routeProvider, $locationProvider) {
		$locationProvider.html5Mode(true).hashPrefix('!');

		$routeProvider
		.when('/candidacy/approval', {
			templateUrl: 'candidacy/approval/candidacy-approval-tpl.php?_=' + Date.now(),
			controller: 'CandidacyApprovalCtrl'
		})

}]);


app.controller('CandidacyApprovalCtrl', ['CandidacyApprovalSrvs', '$scope', '$filter', '$uibModal', '$window', function(CandidacyApprovalSrvs, $scope, $filter, $uibModal, $window) {

	function ModalValidation(response) {
		var mymodal = $uibModal.open({
			templateUrl: '../candidacy/req-modal-tpl.php?_' + Date.now(),
			controller: 'ValidationModalCtrl',
			dialogClass: 'container',
			backdrop: 'static',
			resolve: {
				title: function() {
					return "Candidacy Approval";
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

	$scope.ApprovalDataGet = function(data) {
		var data = angular.toJson({'status': data});
		CandidacyApprovalSrvs.ApprovalDataGet(data)
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
  	CandidacyApprovalSrvs.CandidacyWithdrawal(data)
  	.then( function successCallback(response) {

  		if (response.data.status == 'success') {
	  		ModalValidation(response.data);
  			$scope.ApprovalDataGet('FOR_APPROVAL');
  		}
  	})
  }

	$scope.ApprovalSave = function(id, form, status) {
		var data = angular.toJson({'candidacy00id': id, 'status': status});
		CandidacyApprovalSrvs.ApprovalDataSave(data)
		.then( function successCallback(response){
			if (response.data.status == 'success') {
				var data = {
					'message': 'Candidacy Form saved.'
				}
				ModalValidation(data);
				$scope.ApprovalDataGet(status);
			}
		})
	}

	$scope.ApprovalDataGet('FOR_APPROVAL');

}]);

app.controller('ValidationModalCtrl', ['CandidacyApprovalSrvs','$scope','$uibModalInstance','title','response', function(CandidacySrvcs,$scope,$uibModalInstance,title,response) {

	var data = {
		'message': response.message,
		'title': title
	};
	$scope.detailsmodal = data;


	$scope.closeModal = function() {
    $uibModalInstance.close();
  };

}]);


app.factory('CandidacyApprovalSrvs', function($http) {
	return {
		CandidacyWithdrawal: function(data) {
    	return $http({
	    	method: 'POST',
    		url: 'api/candidacy/CandidacyWithdrawalPost.php?_=' + Date.now(),
    		data: 'data=' + encodeURIComponent(data),
    		headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    	});
    },
    ApprovalDataGet: function(data){
    	return $http({
    		method: 'POST',
    		url: 'api/candidacy/CandidacyApprovalEvaluationGet.php?_=' + Date.now(),
    		data: 'data=' + encodeURIComponent(data),
    		headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    	})
    },
    ApprovalDataSave: function(data){
    	return $http({
    		method: 'POST',
    		url: 'api/candidacy/CandidacyApprovalEvaluationSave.php?_=' + Date.now(),
    		data: 'data=' + encodeURIComponent(data),
    		headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    	});
    }
	}
});
