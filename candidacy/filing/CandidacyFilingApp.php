<?php header("Content-Type: application/x-javascript"); ?>

var app = angular.module('CandidacyFilingApp', ['ngRoute', 'ngAnimate', 'ui.bootstrap']);

app.config(['$routeProvider', '$locationProvider',
  function($routeProvider, $locationProvider) {
    $locationProvider.html5Mode(true).hashPrefix('!');

    $routeProvider
    .when('/candidacy/filing', {
      templateUrl: 'candidacy/filing/candidacy-filing-tpl.php?_=' + Date.now(),
      controller: 'CandidacyFilingCtrl'
    })

}]);


// This is my controller
app.controller('CandidacyFilingCtrl', ['CandidacyFilingSrvcs', '$scope','$location','$window','$filter', '$uibModal', '$http', function(CandidacyFilingSrvcs,$scope,$location,$window,$filter,$uibModal,$http) {
  
  // TOP IS PORTION FOR DECLARING VARIABLE 
  $scope.param = {
    'idno': '',
    'name': ''
  };
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

  $scope.acadyear = [
    {'id': 1, 'name': '2021', 'value': '2021'},
    {'id': 2, 'name': '2022', 'value': '2022'},
    {'id': 3, 'name': '2023', 'value': '2023'}
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

  $scope.partylist = [
    {'id': 1, 'name': 'DD Squad', 'value':'DDS'},
    {'id': 2, 'name': 'Liberal Party', 'value':'LP'},
    {'id': 3, 'name': 'United Alliance', 'value':'UNA'},
    {'id': 4, 'name': 'Magdalo Party', 'value':'MGDL'},
    {'id': 5, 'name': 'Independent', 'value':'IND'}
  ];

  $scope.entryStatus = [
    {'id': 1, 'name': 'Regular', 'value': 'REG'},
    {'id': 2, 'name': 'Iregular', 'value': 'IREG'}
  ];

  CandidacyFilingSrvcs.CourseDetailsGet()
  .then( function(response) {
    if (response.status === 200) {
      $scope.course = response.data.data.course;
      $scope.major = response.data.data.major;
      $scope.year = response.data.data.year;
    }
    
  });

  function findCourse(code, key) {
    var retval = '';

    if (key == 'CV') {
      for (var i = $scope.course.length - 1; i >= 0; i--) {
        if (code.toUpperCase() == $scope.course[i].code.toUpperCase()) {
          retval = $scope.course[i].degreecode + ' ' + $scope.course[i].course;
          break;
        }
      }

      return retval;
    }
    else if (key == 'VC') {
      for (var i = $scope.course.length - 1; i >= 0; i--) {
        if (code.toUpperCase() == $scope.course[i].degreecode.toUpperCase() + ' ' + $scope.course[i].course.toUpperCase()) {
          retval = $scope.course[i].code;
          break;
        }
      }

      return retval;
    }

  }

  function findMajor(course, code, key) {
    var retval = '';

    if (key == 'CV') {
      for (var i = $scope.major.length - 1; i >= 0; i--) {
        if (course.toUpperCase() == $scope.major[i].coursecode.toUpperCase() && code.toUpperCase() == $scope.major[i].fieldname.toUpperCase()) {
          retval = $scope.major[i].fieldvalue ;
          break;
        }
      }

      return retval;
    }
    else if (key == 'VC') {
      for (var i = $scope.major.length - 1; i >= 0; i--) {
        if (course.toUpperCase() == $scope.major[i].coursecode.toUpperCase() && code.toUpperCase() == $scope.major[i].fieldvalue.toUpperCase()) {
          retval = $scope.major[i].fieldname ;
          break;
        }
      }

      return retval;
    }
  }

  function findYear(course, code) {
    var retval = '';
    for (var i = $scope.year.length - 1; i >= 0; i--) {
      if (course.toUpperCase() == $scope.year[i].coursecode.toUpperCase() && code.toUpperCase() == $scope.year[i].fieldname.toUpperCase()) {
        retval = $scope.year[i].fieldname ;
        break;
      }
    }

    return retval;

  }

  function findStatus(code, key) {
    var retval = '';
    if (key == 'CV') {
      for (var i = $scope.entryStatus.length - 1; i >= 0; i--) {
        if (code.toUpperCase() == $scope.entryStatus[i].name.toUpperCase()) {
          retval = $scope.entryStatus[i].value;
          break;
        }
      }

      return retval;
    }
    else if (key == 'VC') {
      for (var i = $scope.entryStatus.length - 1; i >= 0; i--) {
        if (code.toUpperCase() == $scope.entryStatus[i].value.toUpperCase()) {
          retval = $scope.entryStatus[i].name;
          break;
        }
      }

      return retval;
    }

  }

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

  $scope.LoadProcess = function() {
    CandidacyFilingSrvcs.ProcessListGet()
    .then(function successCallback(response) {
      $scope.ProcessListActive = $filter('filter')(response.data.data, {'active'  : '1'});
      $scope.ProcessFiling = $filter('filter')($scope.ProcessListActive, {'processname' : 'Filing'});
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
    CandidacyFilingSrvcs.OrganizationGet()
    .then( function successCallback(response) {
      $scope.OrganizationList = response.data.data;
    });
  }

  $scope.showDataRow = function(searchData) {
    if (searchData) {
      $scope.Loading = true;
      var data = angular.toJson(searchData);
      CandidacyFilingSrvcs.PersonDetailsGet(data)
      .then(function successCallback(response) {
        $scope.Loading = false;
        $scope.info = response.data.data;

        if ($scope.info.length == 0) {
          $scope.showBodySection = false;
          $scope.withRecords = false;
        } else {
          $scope.info.major = findMajor($scope.info.course, $scope.info.major, 'CV');
          $scope.info.course = findCourse($scope.info.course, 'CV');
          $scope.info.status = findStatus($scope.info.status, 'VC');

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

  $scope.GetCandidacySettings = function() {
    var data = angular.toJson({'form':'POSITION'});
    CandidacyFilingSrvcs.CandidacySettingsGet(data)
    .then( function(response) {
      $scope.position = response.data.position;
    });
  }

  $scope.FilingSave = function (form, data) {
    lData = angular.copy(data);
    
    lData.course = findCourse(lData.course, 'VC');
    lData.major = findMajor(lData.course, lData.major, 'VC');
    lData.status = findStatus(lData.status, 'CV');

    if (form) {
      lData = angular.toJson(lData);
      CandidacyFilingSrvcs.ApplicationSave(lData)
      .then(function success(response) {

        if (response.data.status == "error") {
          ModalValidation(response.data);
        }
        else {
          ModalValidation(response.data);
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

  $scope.printCOC = function(){
    $http({
      method: 'POST',
      url: 'candidacy/filing/print/print_coc.php',
      // data: 'data=' + encodeURIComponent(data),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    });

    $http
      .post('candidacy/filing/print/print_coc.php')
    
  }

  $scope.GetCandidacySettings();

}]);

app.controller('ValidationModalCtrl', ['CandidacyFilingSrvcs','$scope','$uibModalInstance','title','response', function(CandidacyFilingSrvcs,$scope,$uibModalInstance,title,response) {

  var data = {
    'message': response.message,
    'title': title
  };
  $scope.detailsmodal = data;


  $scope.closeModal = function() {
    $uibModalInstance.close();
  };

}]);


app.factory('CandidacyFilingSrvcs', function($http) {
  return {
    ApplicationSave: function(data) {
      return $http({
        method: 'POST',
        url: 'api/candidacy/FilingSave.php',
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    ProcessListGet: function() {
      return $http({
        method: 'GET',
        url: 'api/dashboard/process/ProcessListLoad.php?_' + Date.now()
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
    CandidacySettingsGet: function(data) {
      return $http({
        method: 'POST',
        url: 'api/configuration/candidacy/ConfigOrganizationGet.php?_=' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    CourseDetailsGet: function() {
      return $http({
        method: 'POST',
        url: 'api/shared/CourseDetailsGet.php?_=' + Date.now(),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    }

  }
});



