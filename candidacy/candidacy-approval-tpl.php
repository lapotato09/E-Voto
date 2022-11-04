<br>
<div>	
	<h3 class="text-gray">Approval of Candidacy</h3>  
	<!-- <span style="text-align: right;" ng-if="evaluation_info.length > 0">Count: {{ evaluation_info.length }}</span> -->
	<div ng-if="evaluation_info.length == 0">
		<label style="margin-left: 50px; font-weight: bold;">No record(s) found.</label>
	</div>
	<div class="card card-green mt20" ng-repeat="approve in evaluation_info">
		<div class="card-body">
			<div class="container">
				<form name="ApprovalForm" ng-submit="ApprovalEvaluationSave(approve.candidacy00id, ApprovalForm, 'FOR_APPROVAL')" novalidate>
					<div class="row">
						<div class="text-title" ng-bind="'CANDIDACY - ' + approve.position"></div>
					</div>
					<div class="row mt20 ml10">
						<div class="col-md-2">
							<img src="../img/profile.jpg" class="rounded-circle profile-img" alt="Profile" style="width: 100px; height: 100px;">
						</div>
						<div class="col-md-10">
							<div class="row">&nbsp;</div>
							<div class="row">
								<div class="col-md-2">Name: </div>
								<div class="col-md-4 text-label" ng-bind="approve.firstname + ' ' + approve.middlename + ' ' + approve.lastname "></div>
								<div class="col-md-2">ID No. : </div>
								<div class="col-md-4 text-label" ng-bind="approve.studentnumber"></div>
							</div>
							<div class="row">
								<div class="col-md-2">Course:</div>
								<div class="col-md-4 text-label" ng-bind="approve.course"></div>
							</div>
						</div>
					</div>
					<div class="row">		
						<div class="col-md-12 text-right">
							<button class="btn btn-warning" ng-click="WithdrawCancelledCandidacy(approve.candidacy00id, 'DISAPPROVE')" type="button" style="color: white;">Disapproved</button>
							<button class="btn btn-danger" ng-click="WithdrawCancelledCandidacy(approve.candidacy00id, 'WITHDRAW')" type="button">Withdraw</button>
							<button class="btn btn-success" ng-disabled="ApprovalForm.$invalid" type="submit">Approved</button>
						</div>			
					</div>
				</form>
			</div>
		</div>
		<div class="card-footer text-right" ng-bind="'Transaction No.: ' + approve.candidacy00id"> 
		</div>
	</div>	
</div>