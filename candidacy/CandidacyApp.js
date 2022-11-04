
var app = angular.module('CandidacyApp', ['ngRoute','ngAnimate', 'ui.bootstrap']);

app.config(['$routeProvider','$locationProvider',
	function($routeProvider,$locationProvider) {
		$locationProvider.html5Mode(true).hashPrefix('!');

		$routeProvider
		.when('/candidacy', {
			templateUrl: 'candidacy/filing-tpl.php?_=' + Date.now(),
			controller: 'CandidacyCtrl'
		})

	}]);


// This is my controller
app.controller('CandidacyCtrl', ['CandidacySrvcs','$scope','$location','$window','$uibModal','$filter', function(CandidacySrvcs, $scope,$location,$window,$uibModal,$filter) {
	
	// TOP IS PORTION FOR DECLARING VARIABLE 
	$scope.info = {};
	$scope.evaluation_info = {};

	$scope.showTable = false;
	$scope.Loading = false;
	$scope.showBodySection = false;
	$scope.withRecords = true;

	//THIS IS FOR INITALIZATION OF VARIABLE
	$scope.NumberREgex = /^[0-9]\d{0,8}(\.\d{1,6})?%?$/;
	$scope.EmailRegex = /\S+@\S+\.\S+/;
	$scope.ParamValue = {};
	$scope.evaluation_info.form = [];

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
		{'id': 2, 'name': 'For Evaluation', 'value': 'FOR_EVALUATION'},
		{'id': 2, 'name': 'For Approval', 'value': 'FOR_APPROVAL'},
		{'id': 3, 'name': 'Approved', 'value': 'APPROVED'},
		{'id': 4, 'name': 'Disapproved', 'value': 'DISAPPROVED'},
		{'id': 5, 'name': 'Cancelled', 'value': 'CANCELLED'},
		{'id': 6, 'name': 'Withdrawn', 'value': 'WITHDRAWN'}
	];

	$scope.qualifications = [
		{'id': 1, 'label': 'Bonifide Campus Students', 'remarks': 'remarks1'},
		{'id': 2, 'label': 'Able to read and write', 'remarks': 'remarks2'},
		{'id': 3, 'label': 'Must a regular Student', 'remarks': 'remarks3'},
		{'id': 4, 'label': 'With at least one year remaining on campus prior on election day', 'remarks': 'remarks4'},
		{'id': 5, 'label': 'GWA must higher than 2.5', 'remarks': 'remarks5'},
		{'id': 6, 'label': 'No Failing grades (3.0, 5.0, INC, DROP ) on current semester enrolled.', 'remarks': 'remarks5'}
	];

	function Loaddata() {
		$scope.info.organization_lst = [];
		$scope.info.electoral = [];
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
			templateUrl: '/candidacy/req-modal-tpl.php?_' + Date.now(),
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

	$scope.ShowCandidacyDetails = function(response) {

		var DetailsModal = $uibModal.open({
			templateUrl: '/candidacy/candidacy-details-modal-tpl.php?_' + Date.now(),
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
			};
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
			$scope.info.electoral.splice(index,1);
		}
		else if (array == 'ORG') {
			$scope.info.organization_lst.splice(index,1);
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

				if (response.data.status == "error") {
					ModalValidation(response.data);
				}
				else {
					var data = {
					 'message': 'Candidacy form successfully saved!' };
					ModalValidation(data);
					Loaddata();
					$scope.showBodySection = false;
					$scope.info = {};
				}

			});
		}
		else {
			var data = {
				 'message': 'Please fill out all the required fields before you proceed!' };
			ModalValidation(data);
		}
	};

	$scope.InventoryGet = function(param) {
		$scope.Loading = true;
		if (param.year == undefined && param.status == undefined) {
			param.status = 'ALL';
			param.year = new Date().getFullYear();
		}
		else if (param.status == undefined) {
			param.status = 'ALL';
		}
		else if (param.year == undefined) {
			param.year = new Date().getFullYear();
		}

		param.flag = 'LOAD';
		var data = angular.toJson(param);
		CandidacySrvcs.Get(data)
		.then(function success(response) {
			$scope.filedForms = response.data.data;
			$scope.datenow = Date.parse(new Date());
			$scope.showTable = true;
			$scope.Loading = false;
		});
	};


	$scope.ChangeTpl = function(tpl) {
		$scope.showBodySection = false;
		$scope.withRecords = true;
		$scope.ParamValue = {};
		$scope.TmplName = '/candidacy/candidacy-'+ tpl + '-tpl.php';
		$scope.tpl = tpl;
		if (tpl == 'add') {
			$scope.showBodySection = false;
			$scope.info = {};
		}
		else if (tpl == 'evaluation') {
			$scope.ApprovalEvaluationDataGet('FOR_EVALUATION');
		}
		else if (tpl == 'approval') {
			$scope.ApprovalEvaluationDataGet('FOR_APPROVAL');
		}
		else {
			$scope.InventoryGet($scope.ParamValue);
		}
	};

	$scope.LoadProcess = function() {
    CandidacySrvcs.ProcessListGet()
    .then(function successCallback(response) {
      $scope.ProcessListActive = $filter('filter')(response.data.data, {'active'	: '1'});
      $scope.ProcessFiling = $filter('filter')($scope.ProcessListActive, {'processname'	: 'Filing'});
    })
  };

  $scope.SentenceCase = function(param) {
  	var data = param.toString().replace("_", " ");
  	data = data.toLowerCase().split(" ");
  	for (var i = data.length - 1; i >= 0; i--) {
  		data[i] = data[i][0].toUpperCase() + data[i].slice(1);
  	}
  	return data.join(' ');
  };

  $scope.OrganizationListGet = function() {
  	CandidacySrvcs.OrganizationGet()
  	.then( function successCallback(response) {
  		$scope.OrganizationList = response.data.data;
  	});
  }

  $scope.showDataRow = function(searchData) {
  	if (searchData) {
  		$scope.Loading = true;
	  	var data = angular.toJson({'schoolid': searchData});
	  	CandidacySrvcs.PersonDetailsGet(data)
	  	.then(function successCallback(response) {
	  		$scope.Loading = false;
	  		$scope.info = response.data.data;

	  		if ($scope.info.length == 0) {
			  	$scope.showBodySection = false;
			  	$scope.withRecords = false;
			  } else {
			  	$scope.OrganizationListGet();
			  	$scope.withRecords = true;
			  	$scope.showBodySection = true;
			  	Loaddata();
			  }
	   });
	  }
  };

  $scope.KeyPress = function(event, data) {
		if (event.which === 13) {
			$scope.showDataRow(data);
		}
	};

	$scope.ApprovalEvaluationDataGet = function(data) {
		var data = angular.toJson({'status': data});
		CandidacySrvcs.ApprovalEvaluationDataGet(data)
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
  	CandidacySrvcs.CandidacyWithdrawal(data)
  	.then( function successCallback(response) {

  		if (response.data.status == 'success') {
	  		ModalValidation(response.data);
	  		if ($scope.tpl == 'evaluation') {
  				$scope.ApprovalEvaluationDataGet('FOR_EVALUATION');
	  		}
	  		else {
	  			$scope.ApprovalEvaluationDataGet('FOR_APPROVAL');
	  		}
  		}
  	})
  }

	$scope.ApprovalEvaluationSave = function(id, form, status) {
		var data = angular.toJson({'candidacy00id': id, 'status': status});
		CandidacySrvcs.ApprovalEvaluationDataSave(data)
		.then( function successCallback(response){
			if (response.data.status == 'success') {
				var data = {
					'message': 'Evaluation Form saved.'
				}
				ModalValidation(data);
				$scope.ApprovalEvaluationDataGet(status);
			}
		})
	}

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

app.controller('CandidacyDetailsModal',['CandidacySrvcs','$scope','$uibModalInstance','response','$filter','$uibModal', function(CandidacySrvcs,$scope,$uibModalInstance,response,$filter,$uibModal) {
	
	$scope.closeModal = function() {
    $uibModalInstance.close();
  };	

  function ModalValidation(response) {

		var mymodal = $uibModal.open({
			templateUrl: '/candidacy/req-modal-tpl.php?_' + Date.now(),
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

  	// var str = 'ORGNAME1';
  	// console.log((str.length-1) - (str.length) );
  	// console.log(str.substring(str.length-1,str.length) );

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

  $scope.WithdrawCancelledCandidacy = function(schoolidno, action) {
  	var data = angular.toJson({'lrn': schoolidno, 'action': action})
  	CandidacySrvcs.CandidacyWithdrawal(data)
  	.then( function successCallback(response) {

  		if (response.data.status == 'success') {
  			$scope.closeModal();
  		}
  		ModalValidation(response.data);
  	})
  }

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
    },
    PersonDetailsGet: function(data) {
    	return $http({
    		method: 'POST',
    		url: 'api/candidacy/CandidateDetailsGet.php?_=' + Date.now(),
    		data: 'data=' + encodeURIComponent(data), 
    		headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    	});
    },
    OrganizationGet: function(){
    	return $http({
    		method: 'GET',
    		url: 'api/candidacy/OrganizationGet.php?_=' + Date.now()
    	});
    },
    CandidacyWithdrawal: function(data) {
    	return $http({
	    	method: 'POST',
    		url: 'api/candidacy/CandidacyWithdrawalPost.php?_=' + Date.now(),
    		data: 'data=' + encodeURIComponent(data),
    		headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    	});
    },
    ApprovalEvaluationDataGet: function(data){
    	return $http({
    		method: 'POST',
    		url: 'api/candidacy/CandidacyApprovalEvaluationGet.php?_=' + Date.now(),
    		data: 'data=' + encodeURIComponent(data),
    		headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    	})
    },
    ApprovalEvaluationDataSave: function(data){
    	return $http({
    		method: 'POST',
    		url: 'api/candidacy/CandidacyApprovalEvaluationSave.php?_=' + Date.now(),
    		data: 'data=' + encodeURIComponent(data),
    		headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    	});
    }

	}
});

