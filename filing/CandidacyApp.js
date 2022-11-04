
var app = angular.module('CandidacyApp', ['ngRoute','ngAnimate', 'ui.bootstrap']);

app.config(['$routeProvider','$locationProvider',
	function($routeProvider,$locationProvider) {
		$locationProvider.html5Mode(true).hashPrefix('!');

		$routeProvider
		.when('/filing', {
			templateUrl: 'filing/filing-tpl.php?_=' + Date.now(),
			controller: 'CandidacyCtrl'
		})

	}]);


// This is my controller
app.controller('CandidacyCtrl', ['CandidacySrvcs','$scope','$location','$window','$uibModal','$filter', function(CandidacySrvcs, $scope,$location,$window,$uibModal,$filter) {
	
	// TOP IS PORTION FOR DECLARING VARIABLE 
	$scope.info = {};
	$scope.organization_lst = [];
	$scope.electoral = [];
	$scope.showTable = false;

	//THIS IS FOR INITALIZATION OF VARIABLE
	$scope.NumberREgex = /^[0-9]\d{0,8}(\.\d{1,6})?%?$/;
	$scope.EmailRegex = /\S+@\S+\.\S+/;
	$scope.ParamValue = {};

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

	$scope.acadyear = [
		{'id': 1, 'name': '2021', 'value': '2021'},
		{'id': 2, 'name': '2022', 'value': '2022'},
		{'id': 3, 'name': '2023', 'value': '2023'}
	];

	$scope.status = [
		{'id': 1, 'name': 'All', 'value': 'ALL'},
		{'id': 2, 'name': 'For Approval', 'value': 'FORAPPROVAL'},
		{'id': 3, 'name': 'Approved', 'value': 'APPROVED'},
		{'id': 4, 'name': 'Disapproved', 'value': 'DISAPPROVED'},
		{'id': 5, 'name': 'Cancelled', 'value': 'CANCELLED'}
	];

	function Loaddata() {
		$scope.info.lrn		= '';
		$scope.info.lname = '';
		$scope.info.fname = '';
		$scope.info.mname = '';
		$scope.info.course = '';
		$scope.info.major = '';
		$scope.info.gender = '';
		$scope.info.age = '';
		$scope.info.status = '';
		$scope.info.contact = '';
		$scope.info.email = '';
		$scope.info.position = '';
		$scope.info.party = '';
		$scope.info.year = '';
		$scope.info.datefiled = '';
		$scope.info.organization_lst = [];
		$scope.info.electoral = [];
		$scope.addRow('ELEC');
		$scope.addRow('ORG');
		$scope.showTable = false;
		$scope.datenow = '';
	};

	function getdate() {
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

	function ModalValidation(response) {

		var mymodal = $uibModal.open({
			templateUrl: '/filing/req-modal-tpl.php?_' + Date.now(),
			controller: 'ValidationModalCtrl',
			dialogClass: 'container',
			backdrop: 'static',
			resolve: {
				title: function() {
					return "Filing of Candidacy!";
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

	$scope.ShowCandidacyDetails = function(response) {

		var DetailsModal = $uibModal.open({
			templateUrl: '/filing/candidacy-details-modal-tpl.php?_' + Date.now(),
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

	$scope.addRow = function(array) {
		if (array == 'ELEC') {
			var data = {
				'id': $scope.info.electoral.length + 1,
				'elecyear': '',
				'elecpos': '',
				'elecaccomplishment': ''
			}
			$scope.info.electoral.push(data);
		}
		else if (array == 'ORG') {
			var data = {
				'id': $scope.info.organization_lst.length + 1,
				'orgname': '',
				'orgyear': '',
				'orgpos': ''
			};
			$scope.info.organization_lst.push(data);
		}
	};

	$scope.deleteRow = function(index,array) {
		if (array == 'ELEC') {
			if ($scope.info.electoral.length > 1) {
				$scope.info.electoral.splice(index,1);
			};
		}
		else if (array == 'ORG') {
			if ($scope.info.organization_lst.length > 1) {
				$scope.info.organization_lst.splice(index,1);
			};
		}
	};

	$scope.change_course = function (data) {
		$scope.retMajor = [];
		angular.forEach($scope.major, function(k,v) {
			if (k.course == data) {
				$scope.retMajor.push(k);
			}
		});
	};

	$scope.FilingSave = function (form,data) {
		// body...
		if (form) {
			var data = angular.toJson(data);
			CandidacySrvcs.Save(data)
			.then(function success(response) {
				var data = {
				 'message': 'Candidacy form successfully saved!' };
				ModalValidation(data);
				Loaddata();
			});
		}
		else {
			var data = {
				 'message': 'Please fill out all the required fields before you proceed!' };
			ModalValidation(data);
		}
	};

	$scope.InventoryGet = function(param) {
		if (param.year == undefined && param.status == undefined) {
			param.status = 'ALL';
			param.year = '2021';
		}
		else if (param.status == undefined) {
			param.status = 'ALL';
		}
		else if (param.year == undefined) {
			param.year = getFullYear();
		}

		param.flag = 'LOAD';
		var data = angular.toJson(param);
		CandidacySrvcs.Get(data)
		.then(function success(response) {
			$scope.filedForms = response.data.data;
			$scope.datenow = Date.parse(new Date());
			$scope.showTable = true;
		});
	};


	$scope.ChangeTpl = function(tpl) {
		$scope.TmplName = '/filing/candidacy-'+ tpl + '-tpl.php';
		if (tpl == 'add') {
				Loaddata();
		};
	};

	$scope.LoadProcess = function() {
    CandidacySrvcs.ProcessListGet()
    .then(function successCallback(response) {
      $scope.ProcessListActive = $filter('filter')(response.data.data, {'active'	: '1'});
      $scope.ProcessFiling = $filter('filter')($scope.ProcessListActive, {'processname'	: 'Filing'});
    })
  };

  $scope.SentenceCase = function(param) {
  	var data = param.toLowerCase().split(" ");
  	for (var i = data.length - 1; i >= 0; i--) {
  		data[i] = data[i][0].toUpperCase() + data[i].slice(1);
  	}
  	return data.join(' ');
  };

  $scope.LoadProcess();
	$scope.ChangeTpl('inventory');

}]);

app.controller('ValidationModalCtrl', ['CandidacySrvcs','$scope','$uibModalInstance','title','response', function(CandidacySrvcs,$scope,$uibModalInstance,title,response) {

	var data = {
		'message': response.message,
		'title': title
	};
	$scope.detailsmodal = data;


	$scope.closeModal = function() {
    $uibModalInstance.close();
  };

}]);

app.controller('CandidacyDetailsModal',['CandidacySrvcs','$scope','$uibModalInstance','response','$filter', function(CandidacySrvcs,$scope,$uibModalInstance,response,$filter) {
	
	$scope.closeModal = function() {
    $uibModalInstance.close();
  };	

  $scope.LoadDetails = function(param) {

  	var str = 'ORGNAME1';
  	// console.log((str.length-1) - (str.length) );
  	console.log(str.substring(str.length-1,str.length) );

		$scope.fullname = {};
  	var data = angular.toJson({'candidacy00id':param, 'flag':'DETAILS'});
  	CandidacySrvcs.Get(data)
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

  $scope.LoadDetails(response);

}]);

app.factory('CandidacySrvcs', function($http) {
	return {
		Save: function(data) {
			return $http({
				method: 'POST',
				url: '../api/candidacy/FilingSave.php',
				data: 'data=' + encodeURIComponent(data),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			});
		},
		Get: function(data) {
			return $http({
				method: 'POST',
				url: 'api/candidacy/FiledFormsGet.php?_=' + Date.now(),
				data: 'data=' + encodeURIComponent(data),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
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

