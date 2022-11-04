<?php header("Content-Type: application/x-javascript"); ?>

var app = angular.module('CanvassingOverviewApp', ['ngRoute']);

app.config(['$routeProvider', '$locationProvider',
  function($routeProvider, $locationProvider) {
  $locationProvider.html5Mode(true).hashPrefix('!');
    
  $routeProvider
    .when('/canvassing/overview', {
      templateUrl: 'canvassing/overview/canvassing-overview-tpl.php?_=' + Date.now()
      // controller: 'DashboardCtrl'
    })
    .otherwise({
      redirectTo: '/login' 
    });

}]);

app.controller('CanvassingCtrl', ['$scope', 'CanvassingSrvs', function($scope, CanvassingSrvs) {
  $scope.datenow = new Date();

  function BarGraph(data1, data2) {
    var voted = (data1/data2) * 100;
    var population = (data2 * 100) / data2;
    var options1 = {
      chart: {
        height: 180,
        type: 'bar',
        // stacked: true
      },
      legend: {
        position: 'bottom',
        verticalAlign: 'top'
      },
      plotOptions: {
        bar: {
          horizontal: true
        }
      },
      series: [
        {
          name: 'Voted count',
          data: [voted.toFixed(2)]
        },
        {
          name: 'Registered Voters',
          data: [population]
        }
      ],
      xaxis: {
        categories: [''],
        max: 100,
      },
      dataLabels: {
        enabled: true,
        formatter: function (val) {  
          return val + "%"
        }
      },
      title: {
        text: 'Vote counts'
      },
      stroke: {
        width: 1,
        colors: ['#fff']
      }
    };

    var chrVotersCount = new ApexCharts(document.querySelector("#chrVotersCount"), options1);
    chrVotersCount.render();
  }

  function PieGraph (data) {
    // console.log(data);
    var locX = [];
    var locY = [];

    angular.forEach(data, function(val) {
      locX.push(val.percentage);
      locY.push(val.course);
    });

    var options2 = {
    chart: {
      height: 300,
      type: 'donut'
    },
    dataLabels: {
      enabled: true,
      formatter: function (val) {  
        return val.toFixed(1) + "%"
      }
    },
    series: locX,
    labels: locY,
    plotOptions: {
      pie: {
        donut: {
          size: 60,
          labels: {
            show: true,
            name: {
              formatter: function (val) {  
                return val
              }
            },
            value: {
              formatter: function (val) {  
                return parseFloat(val).toFixed(2) + '% of votes'
              }
            }
          }
        }
      }
    },
    legend: {
      position: 'right',
      verticalAlign: 'top'
    },
    title: {
      text: 'Vote distribution percentage per courses.'
    }
  };

  var chrVotersVoted = new ApexCharts(document.querySelector("#chrVotersVoted"), options2);

  chrVotersVoted.render();
  }

  $scope.blockUI = function() {
    var element = $('[name="blkTimer"]')
    console.log(element);
    element.block({message:'hello world of block'})
    ngBlock.blockUI({target: element, boxed: true, message: 'Please wait.'})
  }

  $scope.LoadOverviewDetails = function(){
    $scope.TotalPopSummary = 0;
    $scope.TotalVoteSummary = 0;
    $scope.TotalPercentage = 0;

    CanvassingSrvs.LoadOverview()
    .then( function(response) {
      $scope.TotalPopulation = response.data.total_population;
      $scope.TotalVoted = response.data.total_voted;
      $scope.Distribution = response.data.distribution;
      $scope.Votesummary = response.data.summary;
      angular.forEach($scope.Votesummary, function(val) {
        $scope.TotalPopSummary += parseInt(val.course_population);
        $scope.TotalVoteSummary += parseInt(val.course_vote);
        $scope.TotalPercentage += parseFloat(val.percentage);
      })

      BarGraph($scope.TotalVoted, $scope.TotalPopulation);
      PieGraph($scope.Distribution);
    });
  }

  $scope.LoadOverviewDetails();

}]);


app.factory('CanvassingSrvs', function($http) {
  return {
    LoadOverview: function(){
      return $http({
        method: 'GET',
        url: '/api/canvassing/LoadOverviewDetails.php?_=' + Date.now(),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      })
    }
  }
});

