<?php header("Content-Type: application/x-javascript"); ?>

var app = angular.module('myVoteApp', ['ngRoute','ngAnimate','ui.bootstrap']);

app.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {
  $locationProvider.html5Mode(true).hashPrefix('!');
    
  $routeProvider
    .when('/myvote/', {
      templateUrl: 'myvote/voting-tpl.php?_=' + Date.now(),
      controller: 'myVoteCtrl'
    })
    .when('/myvote/voting/', {
      templateUrl: 'myvote/voting-add-tpl.php?_=' + Date.now()
    })
    .otherwise({
      redirectTo: '/dashboard' 
    });
}]);

app.controller('myVoteCtrl', ['$scope', '$location', '$window', '$filter', 'myVoteSrvcs', '$uibModal', function($scope, $location, $window, $filter, myVoteSrvcs, $uibModal) {
  $scope.votingTpl = false;
  $scope.votersVote = {};
  $scope.candidate = {};

  // status = [
    // FOR_EVALUATION
    // FOR_APPROVAL
    // APPROVED
    // DISAPPROVED
    // CANCELLED
    // WITHDRAWN
  // ];

  function ModalSave() {
    var modal = $uibModal.open({
      templateUrl: 'global/confirmation/confirmation-modal-tpl.php?_' + Date.now(),
      controller: 'ConfirmationCtrl',
      dialogClass: 'container',
      backdrop: 'static',
      resolve: {
        param: function() {
          return {
            title: 'Saving Confirmation',
            body: 'Are you sure you want to save your votes?'
          }
        }
      }
    });

    return modal;
  };

  $scope.FetchCandidate = function(data) {
    $scope.ExtractedCandidate = {};
    localArray = [];

    angular.forEach(data, function(value, key) {
      var code = value.settings.fieldcode;

      value.list = value.list.sort((a, b) => (a.lastname > b.lastname ? 1 : 1));
      $scope.ExtractedCandidate[code] = [];

      if (value.list.length <= 4) {
        $scope.ExtractedCandidate[code].push(value.list);
      }
      else if (value.list.length > 4) {
        var ctr = 0;
        var gCtr = 0;

        angular.forEach(value.list, function(val) {
          ctr += 1;
          gCtr += 1;
          localArray.push(val);

          if (ctr == 4) {
            $scope.ExtractedCandidate[code].push(localArray);
            localArray = [];
            ctr = 0;
          }
          else if (ctr != 4 && gCtr == value.list.length) {
            $scope.ExtractedCandidate[code].push(localArray);
            localArray = [];
            ctr = 0;
          }
        })
      }

    });

  }

  $scope.CandidacySettingsGet = function() {
    var data = angular.toJson({'form':'POSITION'});
    myVoteSrvcs.CandidacySettingsGet(data)
    .then( function(response) {
      $scope.VotingSettings = response.data.position;
    })
  }

  $scope.CandidatesGet = function() {
    myVoteSrvcs.GetAllCandidates()
    .then(function(response) {
      $scope.CandidatesList = response.data.data;
      $scope.OrganizeCandidate($scope.VotingSettings, $scope.CandidatesList);
    })
  }

  $scope.OrganizeCandidate = function(settings, list) {
    $scope.OrganizedList = {};
    angular.forEach(settings, function(v,k) {
      var lList = [];
      angular.forEach(list, function(val, key) {
        if (val.position == v.fieldcode) {
          lList.push(val);
        } 
      })

      $scope.OrganizedList[v.fieldcode] = {
        'settings': v,
        'list': lList
      }
    })

    $scope.FetchCandidate($scope.OrganizedList);
  }

  $scope.ShowVotingTpl = function() {
    var withRecords = false;
    myVoteSrvcs.CheckVoters()
    .then( function(response) {
      if (response.data.data.length > 0) {
        withRecords = true;
      }

      if (!withRecords) {
        if (!$scope.votingTpl) {
          $scope.votingTpl = true;
          $scope.CandidacySettingsGet();
          $scope.CandidatesGet();
        }
        else {
          $scope.votingTpl = false;
        }
      }
      else {
        var modal = $uibModal.open({
          templateUrl: 'global/confirmation/response-modal-tpl.php?_' + Date.now(),
          controller: 'SuccessCtrl',
          dialogClass: 'container',
          backdrop: 'static',
          resolve: {
            param: function() {
              return {
                title: 'Election ' + new Date().getFullYear(),
                body: response.data.message
              }
            }
          }
        })

        modal.result.then(function() {

        }, function() {

        });
      }
    })

    
  }

  $scope.pinVote = function(data, settings) {
    var lVotes = [];
    var posCode = settings.fieldcode.substring(0,4);
    var limit = settings.fieldvalue;

    angular.forEach($scope.votersVote[posCode], function(val, key) {
      var data = {};
      if (val) {
        data[key] = val;
        lVotes.push(data);
      } else {
        delete $scope.votersVote[posCode][key];
      }
    });

    if (lVotes.length > limit) {
      angular.forEach(lVotes[0], function(val, key){
        lVotes[0][key] = false;
        delete $scope.votersVote[posCode][key];
      });
    }

  }

  $scope.SubmitVotes = function(data) {
    param = {};
    settings = angular.copy($scope.VotingSettings);

    angular.forEach(data, function(v, k) {
      angular.forEach(settings, function(val, key) {
        if (k == val.fieldcode.substring(0,4)) {
          param[val.fieldcode] = v;
        }
      });
    })

    var modal = ModalSave();
    modal.result.then(function(result) {
      if (result == 'submit') {
        data = angular.toJson(param);
        myVoteSrvcs.VoteSave(data)
        .then(function(response) {
          if (response.status === 200) {
            var modal = $uibModal.open({
              templateUrl: 'myvote/voting-receipt-tpl.php?_' + Date.now(),
              controller: 'VotingReceiptCtrl',
              dialogClass: 'container',
              backdrop: 'static',
              keyboard: false,
              resolve: {
                param: function() {
                  return {
                    title: 'Saving Confirmation',
                    body: 'Are you sure you want to save your votes?',
                    data: response.data.data
                  }
                },
              }
            });
            
          }
        });

        
      }
    })
  }

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

app.controller('VotingReceiptCtrl', ['$filter', '$scope', '$uibModalInstance', 'param', 'myVoteSrvcs', function($filter, $scope, $uibModalInstance, param, myVoteSrvcs) {
  $scope.VoteDetails = param.data;
  $scope.finalList = [];

  $scope.list = [];
  var data = angular.toJson({'form':'POSITION'});
  myVoteSrvcs.CandidacySettingsGet(data)
  .then( function(response) {
    $scope.VotingSettings = response.data.position;
  })

  myVoteSrvcs.GetAllCandidates()
  .then(function(response) {
    $scope.CandidatesList = response.data.data;

    angular.forEach($scope.VoteDetails, function(val, key){
      angular.forEach($scope.CandidatesList, function(v, k) {
        if (v.position.substring(0,4)+ v.code == val.value ) {
          var data = {
            'position': val.position,
            'value': val.value,
            'fullname': v.lastname +', '+ v.firstname + ' ' + v.middlename,
            'party': v.partylist,
            'label': v.lastname +', '+ v.firstname + ' ' + v.middlename + ' (' + v.partylist + ')'
          }
          $scope.list.push(data);
        }
      })
    })

    angular.forEach($scope.VotingSettings, function(val, key) {
      var limit = val.fieldvalue;
      var list = $filter('filter')($scope.list, {position: val.fieldcode}, true);

      if (limit - list.length != 0) {
        for (var i = limit - list.length; i >= 1; i--) {
          var localData = {
            'position': '',
            'value': '',
            'fullname': '',
            'party': '',
            'label': '-- UNDERVOTE --'
          }

          list.push(localData);
        }
      }

      $scope.finalList.push({
        'position': val.fieldcode,
        'value': list
      });
    })

    console.log($scope.VoteDetails);
  })



  function gotoDashBoard() {
    window.location.href = '../dashboard';    
  }

  $scope.closeModal = function() {
    $uibModalInstance.close();
    gotoDashBoard();
  };

}]);

app.factory('myVoteSrvcs', function($http){
  return {
    CandidacySettingsGet: function(data) {
      return $http({
        method: 'POST',
        url: 'api/configuration/candidacy/ConfigOrganizationGet.php?_=' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    GetAllCandidates: function(data) {
      return $http({
        method: 'POST',
        url: 'api/myvote/CandidateAllGet.php?_=' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      })
    },
    VoteSave: function(data) {
      return $http({
        method: 'POST',
        url: 'api/myvote/SubmitVote.php?_=' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      })
    },
    CheckVoters: function(){
      return $http({
        method: 'GET',
        url: 'api/myvote/CheckVoterecordGet.php?_=' + Date.now(),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      })
    }
  }
});