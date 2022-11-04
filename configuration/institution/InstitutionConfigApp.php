<?php header("Content-Type: application/x-javascript"); ?>

(function(window, angular, undefined){
  'use strict';

var app = angular.module('InstitutionConfigApp', ['ngRoute', 'ngAnimate', 'ui.bootstrap', 'ui.select', 'ngSanitize']);

app.config(['$routeProvider', '$locationProvider', '$animateProvider',
  function($routeProvider, $locationProvider, $animateProvider) {
    $locationProvider.html5Mode(true).hashPrefix('!');

    $routeProvider
    .when('/configuration/institution/', {
      templateUrl: 'configuration/institution/institution-config-tpl.php?_=' + Date.now(),
      controller: 'InsitutionConfigCtrl'
    });

    $animateProvider.classNameFilter(/angular-animate/);

}]);


app.controller('InsitutionConfigCtrl', ['$scope', '$filter', 'InstitutionSrvcs', '$uibModal', function($scope, $filter, InstitutionSrvcs, $uibModal) {
  $scope.localData = {};
  $scope.PersonMod = {};
  $scope.RoleMod = {};
  $scope.ShowAddCourseForm = false;
  $scope.ShowAddRoleForm = false;
  $scope.showAssignedForms = false;
  $scope.UpdateRoleList = [];
  $scope.PersonRoleList = [];
  $scope.RoleAccesslist = [];
  $scope.UpdateRoleAccessList = [];

  $scope.availableColors = ['Red','Green','Blue','Yellow','Magenta','Maroon','Umbra','Turquoise'];

  $scope.singleDemo = {};
  $scope.singleDemo.color = '';

  $scope.CourseEntry = [
    {'no': 1, 'degreecode': '', 'degree': '', 'coursecode': '', 'course': '', 'description': ''}
  ];

  $scope.TemplateList = [
    {'no': 1, 'code':'course', 'name': 'course', 'label': 'Set Course'},
    {'no': 2, 'code':'personoption', 'name': 'personoption', 'label': 'Set Person Option'},
    {'no': 3, 'code':'role', 'name':'role', 'label': 'Create Role'},
    {'no': 4, 'code':'assignrole', 'name':'assignrole', 'label': 'Assign Role'},
    {'no': 5, 'code':'accesscontrol', 'name':'accesscontrol', 'label': 'Access Control'}
  ];

  $scope.ChangeTpl = function(code) {
    $scope.TplUrl = 'configuration/institution/institution-' + code + '-tpl.php?_=' + Date.now();
    if (code == 'course') {
      $scope.LoadCourse();
    }
    else if (code == 'role' || code == 'assignrole') {
      $scope.LoadRole();
      $scope.PersonListGet();
    }
    else if (code == 'accesscontrol') {
      $scope.LoadRole();
      $scope.LoadAccessControl();
    }
  }

  // COURSE CTRL STARTS HERE
  $scope.LoadCourse = function() {
    InstitutionSrvcs.CourseGet()
    .then( function(response) {
      if (response.data.status === 'success') {
        $scope.courseList = response.data.data;
      }
    })
  }

  $scope.AddCourse = function() {
    if ($scope.ShowAddCourseForm) {
      $scope.ShowAddCourseForm = false;
    }
    else {
      $scope.ShowAddCourseForm = true;
    }
  }

  $scope.EditCourse = function(data) {
    var myModal = $uibModal.open({
      templateUrl: '../../configuration/institution/institution-course-modal-tpl.php?_' + Date.now(),
      controller: 'UpdateCourseCtrl',
      dialogClass: 'container',
      backdrop: 'static',
      resolve: {
        data: function() {
          return data;
        }
      }
    });

    myModal.result.then(function() {
      $scope.LoadCourse();
    }, function() {

    });
  }

  $scope.AddItem = function() {
    var data = {
      'no': $scope.CourseEntry.length + 1,
      'degreecode': '',
      'degree': '',
      'coursecode': '',
      'course': '',
      'description': ''
    };
    $scope.CourseEntry.push(data);
  };

  $scope.RemoveItem = function(index) {
    if ($scope.CourseEntry.length != 1) {
      $scope.CourseEntry.splice(index, 1);      
    }
  }

  $scope.SaveItem = function(data) {
    data = angular.toJson(data);
    InstitutionSrvcs.SaveCourses(data)
    .then( function(response) {
      if (response.status === 200) {
        var modal = $uibModal.open({
          templateUrl: '../../global/confirmation/response-modal-tpl.php?_' + Date.now(),
          controller: 'SuccessCtrl',
          dialogClass: 'container',
          backdrop: 'static',
          resolve: {
            param: function() {
              return {
                title: 'Configuration',
                body: 'Course successfully save.'
              }
            }
          }
        })

        $scope.CourseEntry = [
          {'no': 1, 'degreecode': '', 'degree': '', 'coursecode': '', 'course': '', 'description': ''}
        ];

        $scope.LoadCourse();
        $scope.ShowAddCourseForm = false;
      }
    })
  }

  // CREATE ROLES SETTINGS CTRL
  $scope.LoadRole = function(){
    InstitutionSrvcs.RoleGet()
    .then( function(response) {
      $scope.Rolelist = response.data.data;
      $scope.PersonRoleList = response.data.data;
    })
  }
  
  $scope.AddRole = function() {
    if ($scope.ShowAddRoleForm) {
      $scope.ShowAddRoleForm = false;
    }
    else {
      $scope.ShowAddRoleForm = true;
      $scope.CreateRole = {
        'rolecode': '',
        'roledesc': '',
        'rolename': '',
        'rolegroup': ''
      }
    }
  }

  $scope.RoleDetails = function(data) {
    var modal = $uibModal.open({
      templateUrl: 'configuration/institution/institution-role-details-tpl.php?_' + Date.now(),
      controller: 'RoleDetailsCtrl',
      dialogClass: 'container',
      backdrop: 'static',
      resolve: {
        data: function() {
          return data;
        }
      }

    });
  }

  $scope.RoleSave = function(data) {
    data = angular.toJson(data);
    InstitutionSrvcs.RoleSave(data)
    .then( function(response) {
      if (response.status === 200) {
        if (response.data.status == 'success') {
          var modal = $uibModal.open({
            templateUrl: '../../global/confirmation/response-modal-tpl.php?_' + Date.now(),
            controller: 'SuccessCtrl',
            dialogClass: 'container',
            backdrop: 'static',
            resolve: {
              param: function() {
                return {
                  title: 'Role creation. ',
                  body: 'Role successfully saved.'
                }
              }
            }
          })

          $scope.LoadRole();
          $scope.ShowAddRoleForm = false;
        }
        else if (response.data.status == 'error') {
          var modal = $uibModal.open({
            templateUrl: '../../global/confirmation/response-modal-tpl.php?_' + Date.now(),
            controller: 'SuccessCtrl',
            dialogClass: 'container',
            backdrop: 'static',
            resolve: {
              param: function() {
                return {
                  title: 'Role creation. ',
                  body: response.data.message
                }
              }
            }
          })
        }
      }
    });
  }

  // END OF ROLES
  // START OF ASSIGN ROLES
  $scope.PersonListGet = function() {
    InstitutionSrvcs.GetPersonList()
    .then(function(response) {
      $scope.PersonList = response.data.data;
    })
  }

  $scope.UpdateAssignedRoles = function() {
    $scope.showAssignedForms = true;
  }

  $scope.CancelAssRolesEdit = function(data) {
    $scope.showAssignedForms = false;
  }

  $scope.ChangePerson = function(param) {
    $scope.PersonRoleList = [];
    var data = angular.toJson(param.persondetails);
    InstitutionSrvcs.GetRoleList(data)
    .then(function(response) {
      $scope.PersonRole = response.data.data;

      angular.forEach($scope.Rolelist, function(v, k) {
        var going = true;
        var withAccess = false;
        angular.forEach($scope.PersonRole, function(val, key) {
          if (going) {
            if (val.rolecode == v.rolecode) {
              withAccess = true;
              going = false;
            }
          }
        })

        var data = {
          'role00id': v.role00id,
          'rolecode': v.rolecode,
          'rolename': v.rolename,
          'roledescription': v.roledescription,
          'present': false
        }

        if (withAccess) {
          data.present = true;
        }
        $scope.PersonRoleList.push(data);
        $scope.UpdateRoleList.push(data);
      });

    })
  }

  $scope.PersonRoleSave = function(param, details) {
    var data = {
      'details': details.persondetails,
      'param': param
    }
    data = angular.toJson(data);
    InstitutionSrvcs.SavePersonRole(data)
    .then( function(response) {
      if (response.status === 200) {
        var modal = $uibModal.open({
          templateUrl: 'global/confirmation/response-modal-tpl.php?_' + Date.now(),
          controller: 'SuccessCtrl',
          dialogClass: 'container',
          backdrop: 'static',
          resolve: {
            param: function() {
              return {
                title: 'Configuration',
                body: response.data.message
              }
            }
          }
        })
      }
    }) 
  }
  // END OF ASSIGNED ROLES

  // ACCESS CONTROL PART
  $scope.ChangeRole = function(param) {
    $scope.RoleAccesslist = [];
    $scope.AccessModel = {};
    var data = angular.toJson(param.roledetails);
    InstitutionSrvcs.GetRoleAccessList(data)
    .then( function(response){
      if (response.status === 200) {
        if (response.data.data.length > 0) {
          $scope.RoleAccess = response.data.data;

          angular.forEach($scope.AccessControlList, function(v, k) {
            var going = true;
            var withAccess = false;
            angular.forEach($scope.RoleAccess, function(val, key) {
              if (going) {
                if (val.accesscode == v.accesscode) {
                  withAccess = true;
                  going = false;
                }
              }
            })

            var data = {
              'accesscode': v.accesscode,
              'description': v.description,
              'parentcode': v.parentcode,
              'present': false
            }

            if (withAccess) {
              data.present = true;
            }
            $scope.RoleAccesslist.push(data);
            $scope.AccessModel[v.accesscode] = data.present;
          });

        }
        else {
          angular.forEach($scope.AccessControlList, function(v, k) {
            var data = {
              'accesscode': v.accesscode,
              'description': v.description,
              'parentcode': v.parentcode,
              'present': false
            }

            $scope.RoleAccesslist.push(data);
            $scope.AccessModel[v.accesscode] = false;
          });

        }
      }
    });

  }

  $scope.LoadAccessControl = function(){
    $scope.AccessModel = {};
    InstitutionSrvcs.LoadAccessControlList()
    .then(function(response){
      $scope.AccessControlList = response.data.data;
      angular.forEach($scope.AccessControlList, function(v, k) {
        var data = {
          'accesscode': v.accesscode,
          'description': v.description,
          'parentcode': v.parentcode,
          'present': false
        }

        $scope.RoleAccesslist.push(data);
        $scope.AccessModel[v.accesscode] = false;

      });
    });
  }

  $scope.RoleAccessSave = function(data, param) {
    var AccessParam = [];
    angular.forEach(data, function(v, k){
      var ldata = {
        'accesscode': k,
        'present': v
      }
      AccessParam.push(ldata);
    });

    var data = {
      'details': param.roledetails,
      'param': AccessParam
    }
    data = angular.toJson(data);
    InstitutionSrvcs.SaveRoleAccess(data)
    .then( function(response) {
      if (response.status === 200) {
        var modal = $uibModal.open({
          templateUrl: 'global/confirmation/response-modal-tpl.php?_' + Date.now(),
          controller: 'SuccessCtrl',
          dialogClass: 'container',
          backdrop: 'static',
          resolve: {
            param: function() {
              return {
                title: 'Configuration',
                body: response.data.message
              }
            }
          }
        })
      }
    }) 
  }

  // END OF ACCESS CONTROL



}]);

app.controller('SuccessCtrl', ['$filter','$scope','$uibModalInstance','param', function($filter,$scope,$uibModalInstance,param) {
  $scope.param = param;
  $scope.closeModal = function() {
    $uibModalInstance.close();
  };
}]);


app.controller('UpdateCourseCtrl', ['$scope', 'InstitutionSrvcs', 'data', '$uibModal', '$uibModalInstance', function($scope, InstitutionSrvcs, data, $uibModal, $uibModalInstance) {
  $scope.lData = angular.copy(data);
  $scope.CourseDetails = angular.copy(data);

  $scope.majorUpdate = false;
  $scope.sectionUpdate = false;
  $scope.yearUpdate = false;

  $scope.closeModal = function() {
    $uibModalInstance.close();
  };

  $scope.Entry = {
    'MajorEntry': [],
    'SectionEntry': [],
    'YearLevelEntry': [],
    'data': $scope.lData
  }

  $scope.ExisitingData = angular.copy($scope.Entry);

  $scope.LoadDetails = function(param) {
    var data = angular.toJson(param);
    InstitutionSrvcs.CourseDetailsGet(data)
    .then( function(response) {
      $scope.major = response.data.major;
      $scope.section = response.data.section;
      $scope.yearlevel = response.data.year;
    })
  }

  $scope.AddItem = function(code) {
    if (code == 'major') {
      var data = {
        'no': 1,
        'fieldcode': '',
        'fieldvalue': ''
      }
      $scope.Entry.MajorEntry.push(data);
    }
    else if (code == 'section') {
      var data = {
        'no': 1,
        'fieldcode': '',
        'fieldvalue': ''
      }
      $scope.Entry.SectionEntry.push(data); 
    }
    else if (code == 'year') {
      var data = {
        'no': 1,
        'fieldcode': '',
        'fieldvalue': ''
      }
      $scope.Entry.YearLevelEntry.push(data); 
    }
  };

  $scope.RemoveItem = function(index, code) {
    if (code == 'major') {
      $scope.Entry.MajorEntry.splice(index, 1);
    }

    else if (code == 'section') {
      $scope.Entry.SectionEntry.splice(index, 1);
    }

    else if (code == 'year') {
      $scope.Entry.YearLevelEntry.splice(index, 1);
    }
  }


  $scope.EditDetails = function(code, data) {
    if (code == 'major') {
      if ($scope.majorUpdate) {
        $scope.majorUpdate = false;
        $scope.Entry.MajorEntry = $scope.major;
      }
      else {
        $scope.majorUpdate = true;
        $scope.Entry.MajorEntry = angular.copy(data);
        if ($scope.Entry.MajorEntry.length == 0) {
          $scope.AddItem('major')
        }
      }
    }
    else if (code == 'section') {
      if ($scope.sectionUpdate) {
        $scope.sectionUpdate = false;
        $scope.Entry.SectionEntry = $scope.section;
      }
      else {
        $scope.sectionUpdate = true;
        $scope.Entry.SectionEntry = angular.copy(data);
        if ($scope.Entry.SectionEntry.length == 0) {
          $scope.AddItem('section')
        }
      }
    }
    else if (code == 'year') {
      if ($scope.yearUpdate) {
        $scope.yearUpdate = false;
        $scope.Entry.YearLevelEntry = $scope.yearlevel;
      }
      else {
        $scope.yearUpdate = true;
        $scope.Entry.YearLevelEntry = angular.copy(data);
        if ($scope.Entry.YearLevelEntry.length == 0) {
          $scope.AddItem('year')
        }
      }
    }

  }

  $scope.SaveDetails = function(param) {
    var data = {
      "olddata": $scope.ExisitingData,
      "newdata": param,
      "major": $scope.majorUpdate,
      "section": $scope.sectionUpdate,
      "year": $scope.yearUpdate
    }
    data = angular.toJson(data);
    InstitutionSrvcs.CourseUpdate(data)
    .then( function(response) {
      if (response.data.status == 'success') {
        
        var modal = $uibModal.open({
          templateUrl: '../../global/confirmation/response-modal-tpl.php?_' + Date.now(),
          controller: 'SuccessCtrl',
          dialogClass: 'container',
          backdrop: 'static',
          resolve: {
            param: function() {
              return {
                title: 'Configuration',
                body: 'Details successfully save.'
              }
            }
          }
        })
        $scope.closeModal();

      }
    })
  }

  $scope.LoadDetails($scope.lData);

}]);

app.controller('RoleDetailsCtrl', ['$scope', 'InstitutionSrvcs', 'data', '$uibModal', '$uibModalInstance', function($scope, InstitutionSrvcs, data, $uibModal, $uibModalInstance) {
  $scope.RoleDetails = data;
  $scope.RoleEditDetails = angular.copy(data);
  $scope.readonly = true;

  $scope.EditDetails = function() {
    $scope.readonly = false;
  }

  $scope.CancelEdit = function() {
    $scope.readonly = true;
    $scope.RoleEditDetails = angular.copy($scope.RoleDetails);
  }

  $scope.SaveEditedDetails = function(data) {
    data = angular.toJson(data);
    InstitutionSrvcs.RoleUpdate(data)
    .then( function(response) {
      if (response.status === 200) {
        var modal = $uibModal.open({
          templateUrl: 'global/confirmation/response-modal-tpl.php?_' + Date.now(),
          controller: 'SuccessCtrl',
          dialogClass: 'container',
          backdrop: 'static',
          resolve: {
            param: function() {
              return {
                title: 'Role Update',
                body: 'Role successfully updated.'
              }
            }
          }
        })
      }
    });
  }

}]);


app.factory('InstitutionSrvcs', function($http) {
  return {
    CourseGet: function(){
      return $http({
        method: 'POST',
        url: 'api/configuration/institution/ConfigCourseGet.php?_=' + Date.now(),
        data: 'data=',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    CourseDetailsGet: function(data) {
      return $http({
        method: 'POST',
        url: 'api/configuration/institution/ConfigCourseDetailsGet.php?_=' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    CourseUpdate: function(data) {
      return $http({
        method: 'POST',
        url: 'api/configuration/institution/ConfigCourseUpdate.php?_=' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    SaveCourses: function(data){
      return $http({
        method: 'POST',
        url: 'api/configuration/institution/ConfigCourseSave.php?_=' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    RoleGet: function(){
      return $http({
        method: 'GET',
        url: 'api/configuration/institution/ConfigRolelistGet.php?_' + Date.now(),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      })
    },
    RoleSave: function(data) {
      return $http({
        method: 'POST',
        url: 'api/configuration/institution/ConfigRoleSave.php?_=' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    RoleUpdate: function(data) {
      return $http({
        method: 'POST',
        url: 'api/configuration/institution/ConfigRoleUpdate.php?_' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    GetPersonList: function() {
      return $http({
        method: 'GET',
        url: 'api/shared/PersonListGet.php?_' + Date.now(),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    GetRoleList: function(data) {
      return $http({
        method: 'POST',
        url: 'api/configuration/institution/ConfigPersonRoleGet.php?_' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    SavePersonRole: function(data) {
      return $http({
        method: 'POST',
        url: 'api/configuration/institution/ConfigPersonRoleSave.php?_' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    LoadAccessControlList: function(){
      return $http({
        method: 'GET',
        url: 'api/configuration/institution/ConfigAccessControlGet.php?_' + Date.now(),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    GetRoleAccessList: function(data) {
      return $http({
        method: 'POST',
        url: 'api/configuration/institution/ConfigRoleAccessList.php?_' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    SaveRoleAccess: function(data) {
      return $http({
        method: 'POST',
        url: 'api/configuration/institution/ConfigRoleAccessSave.php?_' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    }
  }
});


})(window, window.angular)