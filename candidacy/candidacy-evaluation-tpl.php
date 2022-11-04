<br>

<div>	
	<h3 class="text-gray">Evaluation of Candidacy</h3>
	<div ng-if="evaluation_info.length == 0">
		<label style="margin-left: 50px; font-weight: bold;">No record(s) found.</label>
	</div>
	<div class="card card-yellow mt20" ng-repeat="eval in evaluation_info">
		<div class="card-body">
			<div class="container">
				<form name="EvaluationForm" ng-submit="ApprovalEvaluationSave(eval.candidacy00id, EvaluationForm, 'FOR_EVALUATION')" novalidate>
					<div class="row">
						<div class="text-title" ng-bind="'CANDIDACY - ' + eval.position"></div>
					</div>
					<div class="row mt20 ml10">
						<div class="col-md-2">
							<img src="../img/profile.jpg" class="rounded-circle profile-img" alt="Profile" style="width: 100px; height: 100px;">
						</div>
						<div class="col-md-10">
							<div class="row">&nbsp;</div>
							<div class="row">
								<div class="col-md-2">Name: </div>
								<div class="col-md-4 text-label" ng-bind="eval.firstname + ' ' + eval.middlename + ' ' + eval.lastname "></div>
								<div class="col-md-2">ID No. : </div>
								<div class="col-md-4 text-label" ng-bind="eval.studentnumber"></div>
							</div>
							<div class="row">
								<div class="col-md-2">Course:</div>
								<div class="col-md-4 text-label" ng-bind="eval.course"></div>
							</div>
						</div>
					</div>
					<table class="table mt10">
						<thead>
							<th>No. </th>
							<th>Qualifications</th>
							<th>Remarks</th>
						</thead>
						<tbody>
							<tr ng-repeat="quali in qualifications">
								<td class="col-md-2" ng-bind="quali.id">1</td>
								<td class="col-md-8" ng-bind="quali.label"></td>
								<td class="col-md-2">
									<input type="checkbox" name="remarks" ng-model="evaluation_info.form[eval.candidacy00id][$index]" required><label> &nbsp;Passed</label>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="row">		
						<div class="col-md-12 text-right">
							<button class="btn btn-danger" ng-click="WithdrawCancelledCandidacy(eval.candidacy00id, 'WITHDRAW')" type="button">Withdraw</button>
							<button class="btn btn-primary" ng-disabled="EvaluationForm.$invalid" type="submit">Cleared</button>
						</div>			
					</div>
				</form>
			</div>
		</div>
		<div class="card-footer text-right" ng-bind="'Transaction No.: ' + eval.candidacy00id"> 
		</div>
	</div>	
</div>