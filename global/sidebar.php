<style>
	.greet {
		margin-bottom: 10px;
	}

	.filing-head {
		background: #0b0c10;;
		color: white;
	}

	.in-cards {
		margin-bottom: 20px; 
	}
</style>

<div class="greet">
	<ul class="sidebar-nav nav flex-column">
		<h5><u>EVENTS</u></h5>
		<li><button class="btn btn-block" type="button" ng-click="ProcessShow()">Process</button></li>
	  <li><button class="btn btn-block" type="button" onclick="window.location.href = '../filing/'">Candidacy</button></li>
	  <li><button class="btn btn-block">Schedule</button></li>
	  <li><button class="btn btn-block">Candidate</button></li>
		<li><button class="btn btn-block" type="button" ng-click="AnnouncementShow()" >Announcement</button></li>
	</ul>
</div>

<div class="greet" ng-show="Countdown">
	<div class="sidebar-nav nav flex-column">
		<div ng-repeat="process in ProcessList">
			<div class="card in-cards">
				<div class="card-header filing-head" ng-bind="(process.processname +' '+ 'Countdown') "></div>
				<div class="card-body text-center">
					<div class="row text-center" style="font-weight: bold;">
						<div class="col-sm-12 col-md-12">REMAINING</div>
					</div>
					<div class="row">
						<div class="text-left"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div>
						<div class="text-center"> DAY&nbsp;&nbsp;</div>
						<div class="text-center"> HRS&nbsp;&nbsp;</div>
						<div class="text-center"> MIN&nbsp;&nbsp;</div>
						<div class="text-center"> SEC&nbsp;&nbsp;</div>
					</div>
					<div class="row">
						<div class="text-left"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div>
						<div class="text-center" style="border-color: red; height: 30px; width: 30px;"> {{days}} <span>:</span> </div>
						<div class="text-center" style="border-color: red; height: 30px; width: 30px;"> {{hours}} <span>:</span> </div>
						<div class="text-center" style="border-color: red; height: 30px; width: 30px;"> {{minutes}} <span>:</span> </div>
						<div class="text-center" style="border-color: red; height: 30px; width: 30px;"> {{seconds}} </div>
					</div>
					<div>
						<br>
						<span style="font-weight: bold;"> DEADLINE:</span>
						<div ng-bind="(EnddatePrase | date: 'medium')"></div>
						<!-- <div> <script> {{ (Date.parse(Enddate) | date: 'medium' ) }} </script>></div> -->
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.11/angular.min.js"></script> -->