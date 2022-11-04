<?php header("Content-Type: application/x-javascript"); ?>

var app = angular.module('SidebarApp',['ngRoute','ngAnimate','ui.bootstrap']);

app.controller('SidebarCtrl', ['SidebarSrvcs', '$scope', '$location', '$window', '$interval', '$uibModal','$filter', function(SidebarSrvcs, $scope, $location, $window, $interval, $uibModal,$filter) {

  // DECLARING AND INIT
  $scope.Countdown = true;
  $scope.hideTemplate = true;
  $scope.ClockWatchdog = false;
  $scope.showHideDiv = false;
  $scope.Process = {};
  $scope.localPath = window.location.pathname;

  $scope.ShowHide = function(data) {
    if (data == 'show') {
      $scope.showHideDiv = true;
    } else {
      $scope.showHideDiv = false;
    }
  }

  $scope.ProcessShow = function() {
    var myModal = $uibModal.open({
      templateUrl: '/process/process-modal-tpl.php?_' + Date.now(),
      controller: 'ProcessModalCtrl',
      dialogClass: 'container',
      backdrop: 'static'
    });
  };

  $scope.AnnouncementShow = function() {

    var myModal = $uibModal.open({
      templateUrl: '/announcement/announcement-modal-tpl.php?_' + Date.now(),
      controller: 'AnnouncementModalCtrl',
      dialogClass: 'container',
      backdrop: 'static'
      // resolve: {
      //   response: function(){
      //     return response;
      //   }
      // }
    });
  };


}]);

app.controller('ProcessModalCtrl', ['SidebarSrvcs','$scope','$uibModalInstance','$uibModal','$filter', function(SidebarSrvcs,$scope,$uibModalInstance,$uibModal,$filter) {
  $scope.showDataTable = true;
  $scope.showProcessFrm = false;
  $scope.showSchedFrm = false;
  $scope.ProcDetails = {};
  $scope.UpdateDetails = {};
  $scope.lProcessName = '';
  $scope.ProcessDetails = {};

  $scope.LocalSortoder = [
    {'id': 1, 'sortorder': '000'},
    {'id': 2, 'sortorder': '001'},
    {'id': 3, 'sortorder': '002'},
    {'id': 4, 'sortorder': '003'},
    {'id': 5, 'sortorder': '004'},
    {'id': 6, 'sortorder': '005'},
    {'id': 6, 'sortorder': '006'},
    {'id': 6, 'sortorder': '007'},
    {'id': 6, 'sortorder': '008'},
    {'id': 6, 'sortorder': '009'},
  ];

  $scope.CloseModal = function(){
    $uibModalInstance.close();
  };

  $scope.AddProcess = function(param) {
    if (param == 'SCHED') {
      $scope.showSchedFrm = true;
      $scope.showProcessFrm = false;
      $scope.showDataTable = false;
    }
    else if (param == 'PROC') {
      $scope.showProcessFrm = true;
      $scope.showSchedFrm = false;
      $scope.showDataTable = false;
    }
  };

  $scope.CancelAdd = function() {
    $scope.showSchedFrm = false;
    $scope.showProcessFrm = false;
    $scope.showDataTable = true;
  };

  $scope.LoadProcess = function() {
    SidebarSrvcs.ProcessListGet()
    .then(function(response) {
      $scope.ProcessList = response.data.data;
    })
    
  };

  $scope.AddProcesslist = function(param,flag) {
    param.flag = flag;
    var data = angular.toJson(param);
    SidebarSrvcs.ProcessListProcess(data)
    .then( function success(response) {
      $scope.ProcDetails = {};
      $scope.UpdateDetails = {};
      $scope.showProcessFrm = false;
      $scope.showSchedFrm = false;
      $scope.LoadProcess();
    });

  };

  $scope.ActivateDeactivateProcess = function(processid,flag) {

    var data = angular.toJson({'processid':processid, 'flag':flag});
    SidebarSrvcs.ProcessListProcess(data)
    .then( function success(response) {
      if (response.data.status == 'success') {
        $scope.LoadProcess();
      }
      else if (response.data.status == 'error') {
        var data = {
          'message': response.data.data
        }
        ModalOkYes(data);
      }
    })
  };

  function ModalOkYes(response) {
    var myModal = $uibModal.open({
      templateUrl: '/modal/ok-modal.php?_' + Date.now(),
      controller: 'ModalConfirmationCtrl',
      dialogClass: 'container',
      backdrop: 'static',
      resolve: {
        title: function() {
          return "Posting and Unposting";
        },
        response: function() {
          return response;
        }
      }
    });
  };

  $scope.ChangeProcess = function(name) {
    angular.forEach($scope.ProcessList, function(value) {
      if (value.processname == name) {
        $scope.ProcessDetails = value;
        // if (value.active == '1') {
        //   value.active = 'Active';
        // } else {
        //   value.active = 'Inactive';
        // }

        // if (value.posted == '1') {
        //   value.posted = 'Posted';
        // } else {
        //   value.posted = 'Unposted';
        // }
      }
    })
  }

  $scope.LoadProcess();

}]);

app.controller('ModalConfirmationCtrl', ['SidebarSrvcs','$scope', '$uibModalInstance', 'response', 'title', function(SidebarSrvcs,$scope,$uibModalInstance,response,title) {
  var data = {
    'message': response.message,
    'title': title
  };
  $scope.detailsmodal = data;


  $scope.closeModal = function() {
    $uibModalInstance.close();
  };
}]);

app.controller('AnnouncementModalCtrl', ['SidebarSrvcs','$scope','$uibModalInstance','$uibModal', function(SidebarSrvcs,$scope,$uibModalInstance,$uibModal) {
  $scope.formShow = false;

  function ModalOkYes(response) {
    var myModal = $uibModal.open({
      templateUrl: '/modal/ok-modal.php?_' + Date.now(),
      controller: 'ModalConfirmationCtrl',
      dialogClass: 'container',
      backdrop: 'static',
      resolve: {
        title: function() {
          return "Announcement Create";
        },
        response: function() {
          return response;
        }
      }
    });
  };

  $scope.AddAnnouncement = function(param) {
    if (param == 'CANCEL') {
      $scope.formShow = false;
    }
    else if (param == 'CREATE') {
      $scope.formShow = true;
    }
  };

  $scope.AnnouncementCreate = function(valid, param) {
    if (valid) {
      var data = angular.toJson(param);
      SidebarSrvcs.AnnouncementCreate(data)
      .then( function successCallback(response) {
        var data = {
          'message': 'Announcement Successfully saved.'
        }
        ModalOkYes(data);
        $scope.AnnouncementLoad();
        $scope.formShow = false;
      });
    }
  }

  $scope.AnnouncementLoad = function() {
    SidebarSrvcs.AnnouncementGet()
    .then( function successCallback(response) {
      $scope.Announcement = response.data.data;
    });
  }

  $scope.AnnouncementPostUnpost = function(ann00id,flag) {
    var data = angular.toJson({'ann00id':ann00id, 'flag':flag});
    SidebarSrvcs.AnnouncementPostingUnposting(data)
    .then( function successCallback(response){
      if (response.data.status == 'success') {
        $scope.AnnouncementLoad();
      }
    });

  }

  $scope.closeModal = function(){
    $uibModalInstance.close();
  };

  $scope.AnnouncementLoad();

}]);


app.factory('SidebarSrvcs', function($http){
	return {
    ProcessListGet: function() {
      return $http({
        method: 'GET',
        url: '../api/dashboard/process/ProcessListLoad.php?_' + Date.now()
      });
    },
    ProcessListProcess: function(data) {
      return $http({
        method: 'POST',
        url: '../api/dashboard/process/ProcessListProcess.php?_'+ Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    AnnouncementCreate: function(data) {
      return $http({
        method: 'POST',
        url: '../api/dashboard/Announcement/AddAnnouncement.php?_'+ Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}        
      });
    },
    AnnouncementGet: function(){
      return $http({
        method: 'GET',
        url: '../api/dashboard/Announcement/AnnouncementGet.php?_' + Date.now()
      });
    },
    AnnouncementPostingUnposting: function(data) {
      return $http({
        method: 'POST',
        url: '../api/dashboard/Announcement/AnnPostingUnposting.php?_' + Date.now(),
        data: 'data=' + encodeURIComponent(data),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    }

	}
});