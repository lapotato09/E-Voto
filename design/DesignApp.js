var app = angular.module('DesignApp', ['ngRoute','ngAnimate','ui.bootstrap']);

app.config(['$routeProvider','$locationProvider',
	function($routeProvider,$locationProvider) {
		$locationProvider.html5Mode(true).hashPrefix('!');

		$routeProvider
		.when('/design', {
			templateUrl: 'design/design-tpl.php?_='+ Date.now(),
			controller: ''
		})
		// .when('/design/organization',{
		// 	templateUrl: 'design/design-organization-tpl.php?_=' + Date.now()
		// })
		// .otherwise({
		// 	templateUrl
		// });

	}]);

app.controller('DesignCtrl', ['$scope','$filter','DesignSrvcs','$uibModal', function($scope,$filter,DesignSrvcs,$uibModal) {
	$scope.WithRecords = false;
	$scope.ShowForm = false;
	$scope.NumberRegex = /^[0-9]\d{0,8}(\.\d{1,6})?%?$/;
	$scope.EmailRegex = /\S+@\S+\.\S+/;
	$scope.ParamValue = {};
	$scope.data = {};
	$scope.searchForm = {};
	$scope.ShowLabelRecords = false;
	$scope.SearchDiv = true;

	$scope.course = [
		{'id': 1, 'name': 'BS Computer Science', 'value':'BSCS'},
		{'id': 2, 'name': 'BS Business Administration', 'value': 'BSBA'},
		{'id': 3, 'name': 'BS Office Administration', 'value': 'BSBM'}
	];

	$scope.major = [
		{'id': 1, 'course': 'BSCS', 'name': 'Hardware', 'value':'Hardware'},
		{'id': 1, 'course': 'BSCS', 'name': 'Software', 'value':'Software'},
		{'id': 1, 'course': 'BSCS', 'name': 'CHS', 'value':'CHS'},
		{'id': 2, 'course': 'BSBA', 'name': 'Marketing', 'value': 'Marketing'},
		{'id': 2, 'course': 'BSBA', 'name': 'Management', 'value': 'Management'},
		{'id': 3, 'course': 'BSBM', 'name': 'Steno', 'value': 'Steno'},
		{'id': 3, 'course': 'BSBM', 'name': 'Office Management', 'value': 'Office Management'}
	];

	$scope.gender = [
		{'id': 1, 'name': 'Male', 'value': 'M'},
		{'id': 2, 'name': 'Female', 'value': 'F'},
		{'id': 3, 'name': 'Others', 'value': 'O'}
	];

	$scope.civilstatus = [
		{'id': 1, 'name': 'Single','value': 'S'},
		{'id': 2, 'name': 'Married', 'value': 'M'},
		{'id': 3, 'name': 'Widow', 'value': 'W'},
		{'id': 4, 'name': 'Others', 'value': 'O'}
	];

	$scope.position = [
		{'id': 1, 'name': 'President', 'value': 'President'},
		{'id': 2, 'name': 'Vice President', 'value': 'Vice President'},
		{'id': 3, 'name': 'Secretary', 'value': 'Secretary'},
		{'id': 4, 'name': 'Treasurer', 'value': 'Treasurer'},
		{'id': 5, 'name': 'Peace In Order', 'value': 'Peace In Order'},
		{'id': 6, 'name': 'Auditor', 'value': 'Auditor'}
	];

	$scope.partylist = [
		{'id': 1, 'name': 'DD Squad', 'value':'DDS'},
		{'id': 2, 'name': 'Liberal Party', 'value':'LP'},
		{'id': 3, 'name': 'United Alliance', 'value':'UNA'},
		{'id': 4, 'name': 'Magdalo Party', 'value':'MGDL'},
		{'id': 5, 'name': 'Independent', 'value':'IND'}
	];

	$scope.entrytype = [
		{'id': 1, 'name': 'Professor'},
		{'id': 2, 'name': 'Student'}
	];

	function ModalSave() {
		var modal = $uibModal.open({
			templateUrl: '../global/confirmation/confirmation-modal-tpl.php?_' + Date.now(),
			controller: 'ConfirmationCtrl',
			dialogClass: 'container',
			backdrop: 'static',
			resolve: {
				param: function() {
					return {
						title: 'Saving Confirmation',
						body: 'Are you sure you want to save this information?'
					}
				}
			}
		});

		return modal;
	};

	function ModalResponse() {
		var modal = $uibModal.open({
			templateUrl: '../global/confirmation/response-modal-tpl.php?_' + Date.now(),
			controller: 'SuccessCtrl',
			dialogClass: 'container',
			backdrop: 'static',
			resolve: {
				param: function() {
					return {
						title: 'Person Creation',
						body: 'Person successfully save!'
					}
				}
			}
		})

		modal.result.then(function() {

		}, function() {

		});
	};

	function ModalConfirmation() {
		var modal = $uibModal.open({
			templateUrl: '../global/confirmation/response-modal-tpl.php?_' + Date.now(),
			controller: 'SuccessCtrl',
			dialogClass: 'container',
			backdrop: 'static',
			resolve: {
				param: function() {
					return {
						title: 'Person Search',
						body: 'Please select atleast one of the listed paramter to search!'
					}
				}
			}
		})

		modal.result.then(function() {

		}, function() {

		});
	};
	
	$scope.ChangeTpl = function(param) {
		$scope.Template = '/design/design-' +param+ '-tpl.php';
		$scope.WithRecords = false;
		$scope.ShowForm = false;
		$scope.SearchDiv = true;
		$scope.searchForm = {};
	}

	$scope.change_course = function (data) {
		$scope.retMajor = [];
		angular.forEach($scope.major, function(k,v) {
			if (k.course == data) {
				$scope.retMajor.push(k);
			}
		});
	};

	$scope.CmdSearch = function(param) {

		if ( param.person == undefined && param.idno == undefined && param.course == undefined ) {
			ModalConfirmation();
		}
		else {
			var data = angular.toJson(param);
			DesignSrvcs.PersonDetailsGet(data)
			.then( function successCallback(response) {
				$scope.personlist = response.data.data;
				if ($scope.personlist.length > 0) {
					$scope.ShowForm = false;
					$scope.WithRecords = true;
					$scope.ShowLabelRecords = false;
				}
				else if ($scope.personlist.length == 0) {
					$scope.ShowLabelRecords = true;
				}
			});

		}
		
	}
	
	$scope.CmdAdd =	function() {
		$scope.WithRecords = false;
		$scope.ShowForm = true;
		$scope.searchForm = {};
		$scope.ShowLabelRecords = false;
		$scope.SearchDiv = false;
	}

	$scope.CancelAdd = function() {
		$scope.ShowForm = false;
		$scope.SearchDiv = true;
		$scope.searchForm = {};
	}

	$scope.GenerateId = function() {
		DesignSrvcs.IdNumberGet()
		.then( function successCallback(response) {
			$scope.idnumber = response.data.data;
			angular.forEach($scope.idnumber, function(value) {
				$scope.data.lrn = value.schoolidno;
			});
		})
	}

	$scope.PersonSave = function (valid, data) {
		if (valid) {
			var data = angular.toJson(data);
			var modal = ModalSave();
			modal.result.then(function(result) {
				if (result == 'submit') {
					DesignSrvcs.PersonSave(data)
					.then( function successCallback(response) {
						ModalResponse();
						$scope.data = {};
						$scope.CancelAdd();

					})
				}
			});

		}
	}

	$scope.ChangeTpl('person');
	
}]);

app.controller('ConfirmationCtrl', ['$filter','$scope','$uibModalInstance','param', function($filter,$scope,$uibModalInstance,param){
	$scope.param = param;
	$scope.closeModal = function(param) {
    $uibModalInstance.close(param);
  };
}]);

app.controller('SuccessCtrl', ['$filter','$scope','$uibModalInstance','param', function($filter,$scope,$uibModalInstance,param) {
	$scope.param = param;
	$scope.closeModal = function() {
		$uibModalInstance.close();
	};
}]);

app.controller('ValidationCtrl',['$filter','$scope','$uibModalInstance','param', function() {

}]);

app.factory('DesignSrvcs', function($http) {
	return {
		PersonSave: function(data) {
			return $http({
				method: 'POST',
				url: '/api/design/person/PersonCreate.php?_=' + Date.now(),
				data: 'data=' + encodeURIComponent(data),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			});
		},
		IdNumberGet: function() {
			return $http({
				method: 'GET',
				url: '/api/design/person/IDNumberGet.php?_=' + Date.now()
			});
		},
		PersonDetailsGet: function(data){
			return $http({
				method: 'POST',
				url: '/api/design/person/PersonDetailsGet.php?_=' + Date.now(),
				data: 'data=' + encodeURIComponent(data),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			});
		}
	}
})