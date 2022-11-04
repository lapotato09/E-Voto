var app = angular.module('myVoteApp', ['ngRoute']);

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

app.controller('myVoteCtrl', ['$scope', '$location', '$window', '$filter', function($scope, $location, $window, $filter) {
	$scope.votingTpl = false;
	$scope.votersVote = {};

	$scope.candidate = {};

	$scope.candidate.president = [
		{'no': 1, 'lastname': 'dela rosa', 'firstname': 'ronald', 'exname': '', 'party': 'ind'},
		{'no': 2, 'lastname': 'domagoso', 'firstname': 'isko', 'exname': '' , 'party': 'una'},
		{'no': 3, 'lastname': 'lacson', 'firstname': 'panfilo', 'exname': '', 'party': 'sdp'},
		{'no': 4, 'lastname': 'marcos', 'firstname': 'ferdinand', 'exname': 'jr.', 'party': 'pdp'},
		{'no': 5, 'lastname': 'robredo', 'firstname': 'leni', 'exname': '', 'party': 'liberal'}
		// {'no': 6, 'lastname': 'pacquiao', 'firstname': 'emannuel', 'exname': 'jr', 'party': 'nationalista'}
	];

	$scope.candidate.vicepresident = [
		{'no': 1, 'lastname': 'duterte', 'firstname': 'sara', 'exname': '' , 'party': 'una'},
		{'no': 2, 'lastname': 'ong', 'firstname': 'willie', 'exname': 'Dr.', 'party': 'ind'},
		{'no': 3, 'lastname': 'pacquiao', 'firstname': 'emannuel', 'exname': 'jr', 'party': 'nationalista'},
		{'no': 4, 'lastname': 'pangilinan', 'firstname': 'sanaall', 'exname': '', 'party': 'liberal'}
	];

	$scope.candidate.senator = [
		{'no': 1, 'lastname': 'adams', 'firstname': 'michael', 'exname': '', 'party': 'una'},
		{'no': 2, 'lastname': 'baker', 'firstname': 'christopher', 'exname': '', 'party': 'pdp'},
		{'no': 3, 'lastname': 'clark', 'firstname': 'jessica', 'exname': '', 'party': 'ucmd'},
		{'no': 4, 'lastname': 'davis', 'firstname': 'matthew', 'exname': '', 'party': 'lakas'},
		{'no': 5, 'lastname': 'evans', 'firstname': 'ashley', 'exname': '', 'party': 'lp'},
		{'no': 6, 'lastname': 'mobley', 'firstname': 'rigori', 'exname': '', 'party': 'lp'},
		{'no': 7, 'lastname': 'santos', 'firstname': 'rigori', 'exname': '', 'party': 'lp'},
		{'no': 8, 'lastname': 'luther', 'firstname': 'martin', 'exname': 'king', 'party': 'cmd'},
		{'no': 9, 'lastname': 'manila', 'firstname': 'mahal', 'exname': '', 'party': 'una'},
		{'no': 10, 'lastname': 'leody', 'firstname': 'degus', 'exname': 'jr', 'party': 'ind'},
		{'no': 11, 'lastname': 'sample', 'firstname': 'name', 'exname': '', 'party': 'ind'},
		{'no': 12, 'lastname': 'lazada', 'firstname': 'shoppee', 'exname': '', 'party': 'cmd'},
		{'no': 13, 'lastname': 'muros', 'firstname': 'intra', 'exname': '', 'party': 'lakas'}
	];

	$scope.FetchCandidate = function() {

		$scope.ExtractedCandidate = {};
		localArray = [];

		angular.forEach($scope.candidate, function(value, key) {
			value = value.reverse();
			$scope.ExtractedCandidate[key] = [];

			if (key == 'senator') {
				if (value.length <= 4) {
					$scope.ExtractedCandidate[key].push($scope.candidate[key]);
				}
				else {

					ctr = 0;

					for (var i = $scope.candidate[key].length - 1; i >= 0; i--) {
						ctr += 1;
						localArray.push($scope.candidate[key][i]);

						if (ctr == 4) {
							$scope.ExtractedCandidate[key].push(localArray);
							ctr = 0;
							localArray = [];
						} 
						else if (ctr != 4 && i == 0) {
							$scope.ExtractedCandidate[key].push(localArray);
							ctr = 0;
							localArray = [];
						}
					}
				}
			}
			else {
				if (value.length <= 3) {
					$scope.ExtractedCandidate[key].push($scope.candidate[key]);
				}
				else {

					ctr = 0;

					for (var i = $scope.candidate[key].length - 1; i >= 0; i--) {
						ctr += 1;
						localArray.push($scope.candidate[key][i]);

						if (ctr == 3) {
							$scope.ExtractedCandidate[key].push(localArray);
							ctr = 0;
							localArray = [];
						} 
						else if (ctr != 3 && i == 0) {
							$scope.ExtractedCandidate[key].push(localArray);
							ctr = 0;
							localArray = [];
						}
					}
				}
			}

		});
		
		console.log($scope.ExtractedCandidate);

	}

	$scope.ShowVotingTpl = function() {
		if (!$scope.votingTpl) {

			$scope.votingTpl = true;
		}
		else {
			$scope.votingTpl = false;
		}
	}

	$scope.SubmitVotes = function(data) {
		console.log(data);
	}

	var queue = [];
	$scope.checkingVotes = function(data, id) {
		console.log(data);
		// console.log(id);
		// console.log($scope.votersVote.senator);

		// if (data) {
		// 	queue.push({id:data});
		// }
		// console.log(queue);

		// if (flag == 'PRES') {
		// 	if (data.length > 1) {
		// 		console.log(data[data.length-1]);
		// 	}
		// }
	}

	$scope.pinVote = function(value, code) {
		$scope.pinVoteData = {};
		if (!$scope.pinVoteData[code] ) {
			$scope.pinVoteData[code] = [];
		}

		$scope.pinVoteData[code].push(value);
		$scope.local = angular.copy($scope.pinVoteData);
		// console.log(value);
		console.log($scope.pinVoteData);
		console.log($scope.local);
		// console.log(code);
	}

	$scope.FetchCandidate();


}]);

app.factory('myVoteSrvcs', function($http){
	return {
		smplefunction: function(data) {
			return $http({
				
			})
		}
	}
});