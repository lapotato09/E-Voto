<style>
	#config {
		border-radius: 5px;
		background: white;
		min-height: 670px;
		padding: 10px;
	  box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
	}
</style>
<div id="config">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header" style="background: #4484ce;">
					<select class="form-control">
						<option>Position</option>
					</select>
				</div>
			</div>
		</div>
	</div>


	<div class="row mt10">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<!-- <div class="row">
				<div class="col-sm-7 col-md-7 col-lg-7">
					<div class="form-group">
						<select class="form-control" ng-model="orgParam.orgid" ng-change="ChangeOrganization(orgParam.orgid)">
							<option ng-repeat="org in orglist" ng-value="org.id" ng-bind="org.orgname"></option>
						</select>
					</div>
				</div>
			</div> -->

			<div class="row">
				<div class="col-sm-7 col-md-7 col-lg-7">
					<div class="card">
						<div class="card-header">
							&nbsp;
						</div>
						<div class="card-body">
							<table class="table table-sm">
								<thead>
									<tr>
										<th>Position</th>
										<th>Level</th>
										<th>Voting Limit</th>
										<th ng-show="EnableUpdate">&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="position in positionDetails">
										<td>
											<label ng-bind="position.fieldcode" ng-show="!EnableUpdate"></label>
											<input type="text" class="form-control" name="" placeholder="Position .." ng-model="position.fieldcode" ng-show="EnableUpdate">
										</td>
										<td>
											<label ng-bind="position.level" ng-show="!EnableUpdate"></label>
											<select class="form-control" ng-model="position.level" ng-show="EnableUpdate">
												<option ng-repeat="lLevel in locallevel" ng-value="lLevel" ng-bind="lLevel"></option>
											</select>
										</td>
										<td>
											<label ng-bind="position.fieldvalue" ng-show="!EnableUpdate"></label>
											<input type="number" class="form-control" name="" placeholder="Limit .." ng-model="position.fieldvalue" ng-show="EnableUpdate">
										</td>
										<td ng-show="EnableUpdate">
											<button class="btn btn-danger btn-sm" ng-click="RemoveItem($index, position)">
												<i class="fa fa-trash"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td colspan="12" ng-if="positionDetails.length == 0">
											No Record(s) found.
										</td>
									</tr>
									<tr class="text-right" ng-show="EnableUpdate">
										<td colspan="12">
											<buttton class="btn btn-sm btn-success" ng-click="AddItem()">&plus; Add</buttton>
										</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="12" class="text-right">
											<button class="btn btn-sm btn-primary" ng-click="UpdatePosition()" ng-hide="EnableUpdate"> Update </button>
											<button class="btn btn-sm btn-primary" ng-show="EnableUpdate" ng-click="SaveSettings(positionDetails, 'SAVE')"> Save </button>
											<button class="btn btn-sm btn-link" ng-show="EnableUpdate" ng-click="CancelUpdate()"> Cancel </button>
										</td>
									</tr>
								</tfoot>

							</table>
						</div>
					</div>
				</div>
				<div class="col-sm-5 col-md-5 col-lg-5">
					<div class="card">
						<div class="card-header">
							Active Administration
						</div>
						<div class="card-body">
							<table class="table table-sm">
								<tbody>
									<tr>
										<td>President:</td>
										<td>Bong Bong Marcos</td>
									</tr>
									<tr>
										<td>Vice President:</td>
										<td>Sarah Duterte</td>
									</tr>
									<tr>
										<td>Senators:</td>
										<td>Win Gatchalian</td>
									</tr>
									<tr>
										<td>Governor:</td>
										<td>Jonvic Remulla</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
