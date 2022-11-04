<?php header("Content-Type: application/x-javascript"); ?>

var app = angular.module('CanvassingProcessingApp', ['ngRoute', 'ngAnimate', 'ui.bootstrap', 'ui.select', 'ngSanitize']);

app.config(['$routeProvider', '$locationProvider', '$animateProvider',
  function($routeProvider, $locationProvider, $animateProvider) {
  $locationProvider.html5Mode(true).hashPrefix('!');

  $routeProvider
    .when('/canvassing/processing', {
      templateUrl: 'canvassing/processing/canvassing-processing-tpl.php?_=' + Date.now()
    })
    .otherwise({
      redirectTo: '/login'
    });

    $animateProvider.classNameFilter(/angular-animate/);

}]);

app.controller('CanvassingProcessingCtrl', ['$scope', 'CanvassingProcessingSrvs', '$uibModal', function($scope, CanvassingProcessingSrvs, $uibModal) {
  $scope.Initialized = false;
  $scope.datenow = new Date();
  $scope.Param = {};

  function OKModal(response) {

    var mymodal = $uibModal.open({
      templateUrl: 'shared/ok-modal.php?_' + Date.now(),
      controller: 'OKModalCtrl',
      dialogClass: 'container',
      backdrop: 'static',
      resolve: {
        title: function() {
          return "Cleaning Up data";
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

  $scope.GetPositionList = function() {
    CanvassingProcessingSrvs.CandidacyPositionGet()
    .then( function(response) {
      $scope.PositionList = response.data.position;
    });
  }

  $scope.CleanUpPost = function(){
    CanvassingProcessingSrvs.PostCleanUp({})
    .then( function(response) {
      OKModal(response);
    });
  }

  $scope.GetPositionList();

}]);

app.controller('OKModalCtrl', ['$scope','$uibModalInstance','title','response', function($scope,$uibModalInstance,title,response) {

  var data = {
    'message': response.data.message,
    'title': title
  };
  $scope.detailsmodal = data;


  $scope.closeModal = function() {
    $uibModalInstance.close();
  };

}]);



app.factory('CanvassingProcessingSrvs', function($http){
  return {
    PostCleanUp: function(data) {
      return $http({
        method: 'POST',
        url: 'api/canvassing/CleanUpPost.php?_=' + Date.now(),
        data: encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    CandidacyPositionGet: function(){
      return $http({
        method: 'GET',
        url: 'api/shared/PositionDetailsGet.php?_=' + Date.now(),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    VoteCountingInitialization: function(data){
      return $http({
        method: 'POST',
        url: '',
        data: encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    }
  }
});


