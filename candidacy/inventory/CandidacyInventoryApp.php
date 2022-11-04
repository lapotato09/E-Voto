<?php header("Content-Type: application/x-javascript"); ?>

var app = angular.module('CandidacyInventoryApp', ['ngRoute', 'ngAnimate', 'ui.bootstrap']);

app.config(['$routeProvider', '$locationProvider', 
	function($routeProvider, $locationProvider) {
	$locationProvider.html5Mode(true).hashPrefix('!');

	$routeProvider
	.when('/candidacy/inventory', {
		templateUrl: 'candidacy/inventory/candidacy-inventory-tpl.php?_=' + Date.now(),
		controller: 'CandidacyInventoryCtrl'
	})

}]);


app.controller('CandidacyInventoryCtrl', ['CandidacyInventorySrvcs', '$scope', '$location', '$window', '$filter', '$uibModal', function(CandidacyInventorySrvcs, $scope, $location, $window, $filter, $uibModal) {
	$scope.datenow = Date.parse(new Date());

	$scope.acadyear = [
		{'id': 1, 'name': '2021', 'value': '2021'},
		{'id': 2, 'name': '2022', 'value': '2022'},
		{'id': 3, 'name': '2023', 'value': '2023'}
	];

	$scope.status = [
		{'id': 1, 'name': '', 'value': 'ALL'},
		{'id': 2, 'name': 'For Evaluation', 'value': 'FOR_EVALUATION'},
		{'id': 2, 'name': 'For Approval', 'value': 'FOR_APPROVAL'},
		{'id': 3, 'name': 'Approved', 'value': 'APPROVED'},
		{'id': 4, 'name': 'Disapproved', 'value': 'DISAPPROVED'},
		{'id': 5, 'name': 'Cancelled', 'value': 'CANCELLED'},
		{'id': 6, 'name': 'Withdrawn', 'value': 'WITHDRAWN'}
	];

	$scope.getdate = function() {
		const monthNames = ["January",
									"February",
									"March",
									"April",
									"May",
									"June",
									"July",
									"August",
									"September",
									"October",
									"November",
									"December"];

		var today = new Date();

		var dd = today.getDate();
		var MM = today.getMonth();
		var yyy = today.getFullYear();

		if (dd<10) {
			dd = '0'+dd;
		};

		today = monthNames[MM] + ' ' + dd + ', ' + yyy
		return today;
	};

	$scope.ShowCandidacyDetails = function(response) {

		var DetailsModal = $uibModal.open({
			templateUrl: '../candidacy/inventory/candidacy-details-modal-tpl.php?_' + Date.now(),
			controller: 'CandidacyDetailsModal',
			dialogClass: 'container',
			// backdrop: 'static',
			resolve: {
				response: function() {
					return response;
				}
			}
		});

		DetailsModal.result.then(function() {

		}, function() {

		});

	};

	$scope.SentenceCase = function(param) {
		var data = param.toString().replace("_", " ");
  	data = data.toLowerCase().split(" ");
  	for (var i = data.length - 1; i >= 0; i--) {
  		if (data[i] != '') {
	  		data[i] = data[i][0].toUpperCase() + data[i].slice(1);
  		}
  	}
  	return data.join(' ');
  	// return param
  };

	$scope.InventoryGet = function(param) {
		$scope.Loading = true;
		if (!param.status) {
			param.status = 'ALL';
		}
		else if (!param.year) {
			param.year = new Date().getFullYear();
		}

		param.flag = 'LOAD';
		var data = angular.toJson(param);
		CandidacyInventorySrvcs.CandidacyGet(data)
		.then(function success(response) {
			$scope.filedForms = response.data.data;
			$scope.datenow = Date.parse(new Date());
			$scope.showTable = true;
			$scope.Loading = false;
		});
	};

	$scope.InventoryGet({'year': new Date().getFullYear(), 'status': 'ALL'});

}]);


app.controller('CandidacyDetailsModal', ['CandidacyInventorySrvcs','$scope','$uibModalInstance','response','$filter','$uibModal', function(CandidacyInventorySrvcs,$scope,$uibModalInstance,response,$filter,$uibModal) {
	
	$scope.closeModal = function() {
    $uibModalInstance.close();
  };	

  function ModalValidation(response) {

		var mymodal = $uibModal.open({
			templateUrl: '../candidacy/req-modal-tpl.php?_' + Date.now(),
			controller: 'ValidationModalCtrl',
			dialogClass: 'container',
			backdrop: 'static',
			resolve: {
				title: function() {
					return "Candidacy";
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

  $scope.LoadDetails = function(param) {

		$scope.fullname = {};
  	var data = angular.toJson({'candidacy00id':param, 'flag':'DETAILS'});
  	CandidacyInventorySrvcs.CandidacyGet(data)
  	.then( function successCallback(response) {
  		$scope.CandidacyDetails = response.data.data;
  		$scope.orgdetails = response.data.org ;
  		$scope.elecdetails = response.data.elec ;

  		angular.forEach($scope.CandidacyDetails, function(k) {
  			if (k.fieldcode == 'FIRSTNAME') {
  				$scope.fullname.first = k.fieldvalue;
  			}

  			if (k.fieldcode == 'LASTNAME') {
  				$scope.fullname.last = k.fieldvalue;
  			}

  			if (k.fieldcode == 'MIDDLENAME') {
  				$scope.fullname.mid = k.fieldvalue;
  			}

  			if (k.fieldcode == 'STUDNUMBER') {
  				$scope.fullname.lrn = k.fieldvalue;
  			}

  		});
  	});
  };

  $scope.WithdrawCancelledCandidacy = function(schoolidno, action) {
  	var data = angular.toJson({'lrn': schoolidno, 'action': action})
  	CandidacyInventorySrvcs.CandidacyWithdrawal(data)
  	.then( function successCallback(response) {

  		if (response.data.status == 'success') {
  			$scope.closeModal();
  		}
  		ModalValidation(response.data);
  	})
  }

  $scope.LoadDetails(response);

}]);

app.factory('CandidacyInventorySrvcs', function($http){
	return {
		CandidacyGet: function(data) {
			return $http({
				method: 'POST',
				url: 'api/candidacy/FiledFormsGet.php?_=' + Date.now(),
				data: 'data=' + encodeURIComponent(data),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			});
		},
		CandidacyWithdrawal: function(data) {
    	return $http({
	    	method: 'POST',
    		url: 'api/candidacy/CandidacyWithdrawalPost.php?_=' + Date.now(),
    		data: 'data=' + encodeURIComponent(data),
    		headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    	});
    }
	}
});

