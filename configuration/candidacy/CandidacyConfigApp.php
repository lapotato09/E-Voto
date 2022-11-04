<?php header("Content-Type: application/x-javascript"); ?>

var app = angular.module('CandidacyConfigApp', ['ngRoute', 'ngAnimate', 'ui.bootstrap']);

app.config(['$routeProvider', '$locationProvider', 
  function($routeProvider, $locationProvider) {
    $locationProvider.html5Mode(true).hashPrefix('!');

    $routeProvider
    .when('/configuration/candidacy/', {
      templateUrl: 'configuration/candidacy/candidacy-config-tpl.php?_=' + Date.now(),
      controller: 'CandidacyConfigCtrl'
    })

  }
]);

app.controller('CandidacyConfigCtrl', ['$scope', '$filter', 'CandidacyConfigSrvcs', '$uibModal', function($scope, $filter, CandidacyConfigSrvcs, $uibModal) {
  $scope.orgParam = {};
  $scope.locallevel = [1, 2, 3, 4, 5];
  $scope.EnableUpdate = false;

  $scope.LoadSettings = function(form) {
    var data = angular.toJson({'form': form});
    CandidacyConfigSrvcs.CandidacySettingsGet(data)
    .then( function(response) {
      $scope.positionDetails = response.data.position;
    }) 
  }

  $scope.AddItem = function(data) {
    var data = {
      'candidacysettings00id': 0,
      'fieldcode': '',
      'fieldvalue': 1,
      'level': 1
    };
    $scope.positionDetails.push(data);
  };

  $scope.RemoveItem = function(index, data) {
    var id = data['candidacysettings00id'];
    if (id == 0) {
      $scope.positionDetails.splice(index, 1);            
    }
    else {
      data.candidacysettings00id = id;
      data.action = 'DELETE';
      data = angular.toJson(data);

      CandidacyConfigSrvcs.PositionSave(data)
      .then( function(response) {
        if (response.data.status == 'success') {
          var modal = $uibModal.open({
            templateUrl: '../global/confirmation/response-modal-tpl.php?_' + Date.now(),
            controller: 'SuccessCtrl',
            dialogClass: 'container',
            backdrop: 'static',
            resolve: {
              param: function() {
                return {
                  title: 'Configuration',
                  body: 'Position Details successfully save.'
                }
              }
            }
          })

          $scope.LoadSettings('POSITION');
        }

      })
    }
  }

  $scope.UpdatePosition = function() {
    $scope.EnableUpdate = true;
    $scope.positionDetailscopy = angular.copy($scope.positionDetails);
    if ($scope.positionDetails.length == 0) {
      $scope.AddItem();
    }
  }

  $scope.CancelUpdate = function() {
    $scope.EnableUpdate = false;
    $scope.positionDetails = angular.copy($scope.positionDetailscopy);
  }

  $scope.SaveSettings = function(param, action) {
    var data = {
      'action': action,
      'data': param
    }

    data = angular.toJson(data);
    CandidacyConfigSrvcs.PositionSave(data)
    .then( function(response) {
      if (response.data.status == 'success') {
        var modal = $uibModal.open({
          templateUrl: '../global/confirmation/response-modal-tpl.php?_' + Date.now(),
          controller: 'SuccessCtrl',
          dialogClass: 'container',
          backdrop: 'static',
          resolve: {
            param: function() {
              return {
                title: 'Configuration',
                body: 'Position Details successfully save.'
              }
            }
          }
        })

        $scope.EnableUpdate = false;
      }

      $scope.LoadSettings('POSITION');

    })

  }

  $scope.LoadSettings('POSITION');

}]);

app.controller('SuccessCtrl', ['$filter','$scope','$uibModalInstance','param', function($filter,$scope,$uibModalInstance,param) {
  $scope.param = param;
  $scope.closeModal = function() {
    $uibModalInstance.close();
  };
}]);


app.factory('CandidacyConfigSrvcs', function($http) {
  return {
    CandidacySettingsGet: function(data) {
      return $http({
        method: 'POST',
        url: 'api/configuration/candidacy/ConfigOrganizationGet.php?_=' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    PositionSave : function(data){
      return $http({
        method: 'POST',
        url: 'api/configuration/candidacy/PositionDetailsSave.php?_=' + Date.now(), 
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    }
  }
});