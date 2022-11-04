var app = angular.module('App', ['ngAnimate', 'ui.bootstrap']);

app.controller('NavigationCtrl', ['$scope', '$modal',  function($scope, $modal, $log) {

  $scope.Announcement = function() {
    var data = 'hello modal';

    var modal = $modal.open({
        animation: true,
        templateUrl: '/dashboard/announcement-modal-tpl.php?_' + Date.now(),
        // controller: 'MoadlCtrl',
        dialogClass: 'container',
        resolve: {
          data: function () {
            return data;
          }
        }
      });

      modal.result.then(function () {

      }, function () {

      });

    };


}]);




