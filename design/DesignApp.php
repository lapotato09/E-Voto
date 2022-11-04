<?php header("Content-Type: application/x-javascript"); ?>

var app = angular.module('DesignApp', ['ngRoute','ngAnimate','ui.bootstrap']);

app.config(['$routeProvider','$locationProvider',
  function($routeProvider,$locationProvider) {
    $locationProvider.html5Mode(true).hashPrefix('!');

    $routeProvider
    .when('/design', {
      templateUrl: 'design/design-tpl.php?_='+ Date.now(),
      controller: ''
    })

  }]);

app.controller('DesignCtrl', ['$scope','$filter','DesignSrvcs','$uibModal', function($scope,$filter,DesignSrvcs,$uibModal) {
  // LOCAL VARIABLE DECLARATION
  $scope.NumberRegex = /^[0-9]\d{0,8}(\.\d{1,6})?%?$/;
  $scope.EmailRegex = /\S+@\S+\.\S+/;
  $scope.passwordRegex = /^[^@]+$/;
  $scope.ParamValue = {};
  $scope.WithRecords = false;
  $scope.ShowForm = false;
  $scope.ShowLabelRecords = false;
  $scope.SearchDiv = true;
  $scope.Loading = false;
  $scope.AddOrgTemplate = false;
  $scope.template = 'person';
  $scope.loginDetails = {};
  $scope.LogWithRecords = false;
  $scope.tempDisabled = true;

  $scope.searchForm = {
    'person': '',
    'idno': ''
  };

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
    {'id': 1, 'name': 'Student', 'code': 'S'}
  ];

  $scope.entryStatus = [
    {'id': 1, 'name': 'Regular', 'value': 'REG'},
    {'id': 2, 'name': 'Iregular', 'value': 'IREG'},
  ];

  // MODAL PART --------------------

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
            title: 'Data Design Creation',
            body: 'Data successfully save!'
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
            body: 'Please select atleast one of the listed parameter to search!'
          }
        }
      }
    })

    modal.result.then(function() {

    }, function() {

    });
  };

  $scope.ChangeBirthdate = function(data) {
    var date1 = Date.parse(new Date(data));
    var date2 = Date.now();
    var datediff = date2 - date1;
    var milsec = datediff / (1000 * 60 * 60 * 24);
    var year = milsec / 365.25;
    if (year) {
      $scope.personData.age = year.toFixed(2);      
    }
  }

  // END OF MODAL -------------


  function initPersonVar() {
    $scope.personData = {
      'lrn': '',
      'lname': '',
      'fname': '',
      'mname': '',
      'xname': '',
      'course': '',
      'major': '',
      'section': '',
      'gender': '',
      'gender': '',
      'civil': '',
      'religion': '',
      'age': '',
      'height': '',
      'weight': '',
      'email': '',
      'contact': '',
      'birthdate': '',
      'entrytype': '',
      'status': '',
      'dateenrolled': ''
    }
  }

  function formatDate(data) {

    const monthNames = [
      {'id': '01', 'code': 'Jan', 'name':'January'},
      {'id': '02', 'code': 'Feb', 'name':'February'},
      {'id': '03', 'code': 'Mar', 'name':'March'},
      {'id': '04', 'code': 'Apr', 'name':'April'},
      {'id': '05', 'code': 'May', 'name':'May'},
      {'id': '06', 'code': 'June', 'name':'June'},
      {'id': '07', 'code': 'Jul', 'name':'July'},
      {'id': '08', 'code': 'Aug', 'name':'August'},
      {'id': '09', 'code': 'Sep', 'name':'September'},
      {'id': '10', 'code': 'Oct', 'name':'October'},
      {'id': '11', 'code': 'Nov', 'name':'November'},
      {'id': '12', 'code': 'Dec', 'name':'December'}
    ];

    var retval = data.toString().split(' ');
    var month = retval[1].toString();
    var day = retval[2].toString();
    var year = retval[3].toString();

    for (var i = monthNames.length - 1; i >= 0; i--) {
      if (monthNames[i].code.toUpperCase() == month.toUpperCase()) {
        month = monthNames[i].id;
        break;
      }
    }

    retval = month + '/' + day + '/' + year;
    return retval;
  }

  function findCivilStatus(code) {
    var retval = '';

    for (var i = $scope.civilstatus.length - 1; i >= 0; i--) {
      if (code.toUpperCase() == $scope.civilstatus[i].value) {
        retval = $scope.civilstatus[i].name; 
        break;
      }
    }

    return retval;
  }

  function findCourse(code) {
    var retval = '';
    for (var i = $scope.course.length - 1; i >= 0; i--) {
      if (code.toUpperCase() == $scope.course[i].code) {
        retval = $scope.course[i].degreecode + ' ' + $scope.course[i].course ;
        break;
      }
    }

    return retval;

  }

  function findMajor(code) {
    var retval = '';
    for (var i = $scope.major.length - 1; i >= 0; i--) {
      if (code.toUpperCase() == $scope.major[i].fieldname) {
        retval = $scope.major[i].fieldvalue ;
        break;
      }
    }

    return retval;

  }

  $scope.SentenceCase = function(param) {
    var data = param.toString().replace("_", " ");
    data = data.toLowerCase().split(" ");
    for (var i = data.length - 1; i >= 0; i--) {
      if (data[i] != '') {
        data[i] = data[i][0].toUpperCase() + data[i].slice(1);
      }
    }
    return data.join(' ');
  };
  
  $scope.ChangeTpl = function(param) {
    $scope.Template = '/design/design-' +param+ '-tpl.php';
    $scope.WithRecords = false;
    $scope.ShowForm = false;
    $scope.SearchDiv = true;
    $scope.AddOrgTemplate = false;
    $scope.searchForm = {
      'person': '',
      'idno': ''
    };
    initPersonVar();

    if (param == 'organization') {
      $scope.LoadOrganization();
    }
    else if (param == 'masterlist') {
      $scope.loadMasterlist();
    }
  }

  // PERSON -------------------

  $scope.LoadCourseDetails = function() {
    DesignSrvcs.CourseDetailsGet()
    .then( function(response) {
      $scope.course = response.data.data.course;
      $scope.major = response.data.data.major;
      $scope.yearlevel = response.data.data.year;
    });
  }

  $scope.change_course = function (data) {
    $scope.retMajor = [];
    $scope.retYear = [];
    angular.forEach($scope.major, function(k,v) {
      if (k.coursecode == data) {
        $scope.retMajor.push(k);
      }
    });

    angular.forEach($scope.yearlevel, function(k,v) {
      if (k.coursecode == data) {
        $scope.retYear.push(k);
      }
    });
  };

  $scope.CmdSearch = function(param) {
    $scope.WithRecords = false;

    if (param.person == '' && param.idno == '' ) {
      ModalConfirmation();
    }
    else {
      $scope.Loading = true;
      $scope.ShowLabelRecords = false;

      var data = angular.toJson(param);
      DesignSrvcs.PersonDetailsGet(data)
      .then( function successCallback(response) {
        $scope.personlist = response.data.data;

        if ($scope.personlist) {
          angular.forEach($scope.personlist, function(k, v) {
            $scope.personlist[v].civilstatus = findCivilStatus(k.civilstatus);
            $scope.personlist[v].course = findCourse(k.course);
            $scope.personlist[v].major = findMajor(k.major);
            $scope.personlist[v].dateenrolled = new Date(k.dateenrolled).toISOString();
            $scope.personlist[v].birthdate = new Date(k.birthdate).toISOString();

          }); 
        }
        
        $scope.Loading = false;
        if (!$scope.personlist || $scope.personlist.length > 0) {
          $scope.ShowForm = false;
          $scope.ShowLabelRecords = false;
          $scope.WithRecords = true;
        }
        else if ($scope.personlist.length == 0 || $scope.personlist) {
          $scope.ShowLabelRecords = true;
        }
      });

    }
    
  }
  
  $scope.CmdAdd = function() {
    $scope.WithRecords = false;
    $scope.ShowForm = true;
    $scope.ShowLabelRecords = false;
    $scope.SearchDiv = false;
    $scope.searchForm = {
      'person': '',
      'idno': ''
    };
  }

  $scope.CancelAdd = function() {
    $scope.ShowForm = false;
    $scope.SearchDiv = true;
    $scope.searchForm = {
      'person': '',
      'idno': ''
    };
  }

  $scope.GenerateId = function() {
    DesignSrvcs.IdNumberGet()
    .then( function successCallback(response) {
      $scope.idnumber = response.data.data;
      angular.forEach($scope.idnumber, function(value) {
        $scope.personData.lrn = value.schoolidno;
      });
    })
  }

  $scope.PersonSave = function (valid, data) {
    if (valid) {
      var paramData = angular.copy(data);
      paramData.birthdate = formatDate(paramData.birthdate);
      paramData.dateenrolled = formatDate(paramData.dateenrolled);

      var data = angular.toJson(paramData);
      var modal = ModalSave();
      modal.result.then(function(result) {
        if (result == 'submit') {
          DesignSrvcs.PersonSave(data)
          .then( function successCallback(response) {
            ModalResponse();
            $scope.data = {};
            $scope.CancelAdd();
            initPersonVar();

          })
        }
      });

    }
  }

  $scope.KeyPress = function(event,data) {
    if (event.which === 13) {
      $scope.CmdSearch(data);
    }
  };

  $scope.Update = function(data) {
    var myModal = $uibModal.open({
      templateUrl: '/design/design-person-update-tpl.php?_' + Date.now(),
      controller: 'UpdatePersonDetails',
      backdrop: 'static',
      dialogClass: 'container',
      resolve: {
        param: function() {
          return {
            persondata: data
          }
        }
      }
    });

    myModal.result.then(function(result) {
      if (result == 'submit') {
        var lData = {
          'idno': data.schoolidno,
          'person': data.lastname
        }
        $scope.CmdSearch(lData)
      }

    });
  }

  // END OF PERSON -------------------------

  // ORGANIZATION PART ---------------------

  $scope.Orgdetails = function(action) {
    if (action == 'ADD') {
      $scope.AddOrgTemplate = true;
    }
    else if (action == 'CANCEL') {
      $scope.AddOrgTemplate = false;
    }
  }

  $scope.SaveOrganization = function(orgdata) {
    var modal = ModalSave();
    modal.result.then(function(result) {
      if (result == 'submit') {
        var data = angular.toJson(orgdata);
        DesignSrvcs.organizationAdd(data)
        .then( function successCallback(response) {
          if (response.data.status == 'success') {
            ModalResponse();
            $scope.AddOrgTemplate = false;
            $scope.data = {};
            $scope.LoadOrganization();
          }
        })
      }
    });
  }

  $scope.LoadOrganization = function() {
    $scope.datenow = new Date();
    DesignSrvcs.OrganizationGet()
    .then( function successCallback(response) {
      $scope.organizationdata = response.data.data;
    })
  }

  $scope.OrgDetails = function(data){
    var mymodal = $uibModal.open({
      templateUrl: '/design/design-organization-modal-tpl.php?_' + Date.now(),
      controller: 'UpdateOrgCtrl',
      resolve: {
        param: function(){
          return {
            orgdata: data
          }
        } 
      }
    });

    mymodal.result.then(function () {

    }, function() {

    });
  }

  // END OF ORGANIZATION PART ---------------------


  // START OF MASTERLIST
  $scope.loadMasterlist = function() {

    DesignSrvcs.MasterlistGet({})
    .then( function successCallback(response) {
      if (response.status === 200) {
        $scope.MasterList = response.data.data;
      }
    });
  }

  // END OF MASTERLIST

  // START OF LOGIN
  $scope.findLogin = function(code, data) {
    if (code.which === 13) {
      data = {
        'person': '',
        'idno': data.idno
      }
      data = angular.toJson(data);
      DesignSrvcs.PersonDetailsGet(data)
      .then( function(response) {
        if (response.data.data) {
          $scope.login = response.data.data[0];
          $scope.login.fullname = $scope.login.lastname + ', ' + $scope.login.firstname + ' ' + $scope.login.middlename;
          $scope.login.loginname = angular.copy($scope.login.schoolidno);
          $scope.loginDetails.idno = angular.copy($scope.login.schoolidno);
          $scope.tempDisabled = false;

          if (response.data.data.length != 0) {
            $scope.LogWithRecords = true;
          }
        }

      });
    }
  }

  $scope.Reset = function(){
    $scope.tempDisabled = true;
    $scope.LogWithRecords = false;
    $scope.login = {};
    $scope.loginDetails = {};
  } 

  $scope.formValidation = function(data) {
    if (!$scope.passShort && !$scope.PassNotMatch) {
      return true;
    } 
    else {
      return false;
    }
  }

  $scope.SaveLogin = function(form, data) {
    var valid = $scope.formValidation(data);
    if (valid) {
      var confirm = ModalSave();
      confirm.result.then( function(result) {
        if (result == 'submit') {
          data = angular.toJson(data);
          DesignSrvcs.LoginCreateSave(data)
          .then(function(response) {
            var modal = $uibModal.open({
              templateUrl: 'global/confirmation/response-modal-tpl.php?_' + Date.now(),
              controller: 'SuccessCtrl',
              dialogClass: 'container',
              backdrop: 'static',
              resolve: {
                param: function() {
                  return {
                    title: 'Setup Login',
                    body: response.data.message
                  }
                }
              }
            })

            modal.result.then(function() {

            }, function() {

            });

            if (response.data.status == 'success') {
              $scope.tempDisabled = true;
              $scope.LogWithRecords = false;
              $scope.login = {};
              $scope.loginDetails = {};
            }
          })
        }
      })
    }

  }

  $scope.$watch('login.password', function() {
    if ($scope.login.password) {
      if ($scope.login.password.length < 8) {
        $scope.passShort = true;
      }
      if ($scope.login.password.length >= 8) {
        $scope.passShort = false;
      }
    }
    else {
      $scope.passShort = false;
    }
  });

  $scope.$watch('login.confirmpassword', function() {
    if ($scope.login.confirmpassword) {
      if ($scope.login.password === $scope.login.confirmpassword) {
        $scope.PassNotMatch = false;
      }
      else {
        $scope.PassNotMatch = true;
      }
    }
    else {
      $scope.PassNotMatch = false; 
    }
  });

  $scope.valid = false;


  // END OF LOGIN

  $scope.ChangeTpl($scope.template);
  initPersonVar();
  $scope.LoadCourseDetails();
  
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


app.controller('UpdatePersonDetails', ['$filter','$scope','$uibModalInstance','param','DesignSrvcs', function($filter,$scope,$uibModalInstance,param,DesignSrvcs) {
  //controller
  $scope.NumberRegex = /^[0-9]\d{0,8}(\.\d{1,6})?%?$/;
  $scope.EmailRegex = /\S+@\S+\.\S+/;

  $scope.civilstatus = [
    {'id': 1, 'name': 'Single','value': 'S'},
    {'id': 2, 'name': 'Married', 'value': 'M'},
    {'id': 3, 'name': 'Widow', 'value': 'W'},
    {'id': 4, 'name': 'Others', 'value': 'O'}
  ];

  $scope.gender = [
    {'id': 1, 'name': 'Male', 'value': 'M'},
    {'id': 2, 'name': 'Female', 'value': 'F'},
    {'id': 3, 'name': 'Others', 'value': 'O'}
  ];

  $scope.entrytype = [
    {'id': 1, 'name': 'Professor'},
    {'id': 2, 'name': 'Student'}
  ];

  $scope.schoolstatus = [
    {'id': 1, 'name': 'Regular', 'value': 'REG'},
    {'id': 2, 'name': 'Iregular', 'value': 'IREG'},
  ];

  DesignSrvcs.CourseDetailsGet()
  .then( function(response) {
    if (response.status === 200) {
      $scope.course = response.data.data.course;
      $scope.major = response.data.data.major;
      $scope.year = response.data.data.year;
      onLoad();
    }
    
  });

  function formatDate(data) {

    const monthNames = [
      {'id': '01', 'code': 'Jan', 'name':'January'},
      {'id': '02', 'code': 'Feb', 'name':'February'},
      {'id': '03', 'code': 'Mar', 'name':'March'},
      {'id': '04', 'code': 'Apr', 'name':'April'},
      {'id': '05', 'code': 'May', 'name':'May'},
      {'id': '06', 'code': 'June', 'name':'June'},
      {'id': '07', 'code': 'Jul', 'name':'July'},
      {'id': '08', 'code': 'Aug', 'name':'August'},
      {'id': '09', 'code': 'Sep', 'name':'September'},
      {'id': '10', 'code': 'Oct', 'name':'October'},
      {'id': '11', 'code': 'Nov', 'name':'November'},
      {'id': '12', 'code': 'Dec', 'name':'December'}
    ];

    var retval = data.toString().split(' ');
    var month = retval[1].toString();
    var day = retval[2].toString();
    var year = retval[3].toString();

    for (var i = monthNames.length - 1; i >= 0; i--) {
      if (monthNames[i].code.toUpperCase() == month.toUpperCase()) {
        month = monthNames[i].id;
        break;
      }
    }

    retval = month + '/' + day + '/' + year;
    return retval;
  }

  function findCivilStatus(code) {
    var retval = '';

    for (var i = $scope.civilstatus.length - 1; i >= 0; i--) {
      if (code.toUpperCase() == $scope.civilstatus[i].name.toUpperCase()) {
        retval = $scope.civilstatus[i].value; 
        break;
      }
    }

    return retval;
  }

  function findCourse(code) {
    var retval = '';
    for (var i = $scope.course.length - 1; i >= 0; i--) {
      if (code.toUpperCase() == $scope.course[i].degreecode.toUpperCase() + ' ' + $scope.course[i].course.toUpperCase()) {
        retval = $scope.course[i].code;
        break;
      }
    }

    return retval;

  }

  function findMajor(course, code) {
    var retval = '';
    for (var i = $scope.major.length - 1; i >= 0; i--) {
      if (course.toUpperCase() == $scope.major[i].coursecode.toUpperCase() && code.toUpperCase() == $scope.major[i].fieldvalue.toUpperCase()) {
        retval = $scope.major[i].fieldname ;
        break;
      }
    }

    return retval;

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

  function findStatus(code) {
    var retval = '';
    for (var i = $scope.schoolstatus.length - 1; i >= 0; i--) {
      if (code.toUpperCase() == $scope.schoolstatus[i].name.toUpperCase()) {
        retval = $scope.schoolstatus[i].value;
        break;
      }
    }

    return retval;

  }


  $scope.change_course = function (data) {
    $scope.retMajor = [];
    $scope.retYear = [];
    angular.forEach($scope.major, function(k,v) {
      if (k.coursecode == data) {
        $scope.retMajor.push(k);
      }
    });

    angular.forEach($scope.year, function(k,v) {
      if (k.coursecode == data) {
        $scope.retYear.push(k);
      }
    });
  };

  $scope.SaveUpdate = function(valid,data) {
    data.status = findStatus(data.status);

    var data = angular.toJson(data);
    DesignSrvcs.PersonDetailsUpdate(data)
    .then( function successCallback(response) {

      $scope.details = {};
      $uibModalInstance.close('submit');
    })

  };

  $scope.closeModal = function() {
    $uibModalInstance.close();
  };

  function onLoad() {
    $scope.details = angular.copy(param.persondata);
    $scope.details.lddateenrolled = $scope.details.dateenrolled;
    $scope.details.ldbirthdate = $scope.details.birthdate;

    $scope.details.civilstatus = findCivilStatus($scope.details.civilstatus);
    $scope.details.course = findCourse($scope.details.course);
    $scope.details.major = findMajor($scope.details.course, $scope.details.major);
    $scope.details.year = findYear($scope.details.course, $scope.details.year);
    $scope.change_course($scope.details.course);
    
  }

}]);

app.controller('UpdateOrgCtrl', ['$filter', '$scope', '$uibModalInstance', 'param', 'DesignSrvcs', function($filter, $scope, $uibModalInstance, param, DesignSrvcs) {
  $scope.localData = param.orgdata;
  $scope.lData = angular.copy(param.orgdata);

  $scope.UpdateOrganization = function(data) {
    var data = angular.toJson(data);
    DesignSrvcs.OrganizationUpdate(data)
    .then( function successCallback(response) {
      if (response.status == 200) {
        $scope.closeModal();
      }
    });

  }

  $scope.closeModal = function() {
    $uibModalInstance.close();
  }


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
    },
    PersonDetailsUpdate: function(data){
      return $http({
        method: 'POST',
        url: '/api/design/person/PersonDetailsUpdate.php?_=' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    organizationAdd: function(data){
      return $http({
        method: 'POST',
        url: '/api/design/organization/OrganizationAdd.php?_=' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      })
    },
    OrganizationGet: function() {
      return $http({
        method: 'GET',
        url: '/api/design/organization/OrganizationGet.php?_=' + Date.now()
      })
    },
    OrganizationUpdate: function(data) {
      return $http({
        method: 'POST',
        url: '/api/design/organization/OrganizationUpdate.php?_=' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    MasterlistGet: function(data) {
      return $http({
        method: 'POST',
        url: '/api/design/masterlist/MasterListGet.php?_=' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    CourseDetailsGet: function() {
      return $http({
        method: 'POST',
        url: '/api/shared/CourseDetailsGet.php?_=' + Date.now(),
        // data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    LoginCreateSave: function(data) {
      return $http({
        method: 'POST',
        url: 'api/design/login/LoginCreate.php?_=' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    }
  }
})