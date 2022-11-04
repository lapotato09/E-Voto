<div class="container-fluid" style="padding-bottom: 100px;">
	
	<div class="row" style="margin-top: 10px; margin-bottom: 10px;">
		<div class="col-md-10">
			<h4 ng-hide="AddOrgTemplate" >Organizations List <small>as of: {{ (datenow | date: 'medium') }}</small></h4>
		</div>
		<div class="col-md-2 text-right">
			<button class="btn btn-success" type="button" ng-click="Orgdetails('ADD')" ng-hide='AddOrgTemplate'>Add new</button>
		</div>
	</div>

	<div class="row" ng-hide= "AddOrgTemplate">
		<div class="col-sm-12 col-md-12">
			<div class="table-responsive">
				<table class="table table-sm table-hover">
					<thead class="thead-dark">
						<tr>
							<th class="col-md-3">Organization Name</th>
							<th class="col-md-3">Organization Description</th>
							<th class="col-md-1 text-center">Active</th>
							<th class="col-md-2 text-left">Founded by</th>
							<th class="col-md-2 text-right">Date Founded</th>
							<th class="col-md-1 text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="org in organizationdata" ng-click="OrgDetails(org)">
							<td ng-bind="org.orgname"></td>
							<td ng-bind="org.orgdesc"></td>
							<td ng-bind="org.active" class="text-center"></td>
							<td ng-bind="org.foundedby" class="text-left"></td>
							<td ng-bind="(org.datefounded | date: 'MMM dd, yyyy')" class="text-right"></td>
							<td class="text-center">
								<button type="button" class="btn btn-sm btn-success" style="font-weight: bold;" ng-show="org.active == '0'">A</button>
								<button type="button" class="btn btn-sm btn-danger" style="font-weight: bold;" ng-show="org.active == '1'">D</button>
							</td>
						</tr>
					</tbody>
					<tfoot style="background: #ecf0f1; color: gray;">
						<tr ng-show="organizationdata.length == 0">
							<td colspan="12">
								No record(s) found.
							</td>
						</tr>
						<tr>
							<td colspan="12"><b>Count: {{ organizationdata.length }}</b> </td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<div class="row" ng-hide="!AddOrgTemplate">
		<div class="col-sm-8 col-md-8">
			<form name="FrmOrganization" ng-submit="SaveOrganization(data)" class="needs-validation" no-validate>
				<div ng-form="FrmOrganizationNew">
					<div class="row">
						<div class="col-md-12">					
							<h4>Create new: </h4>
							<hr>
							<div class="form-group">
								<label for="orgname">Organization Name:</label>
								<input class="form-control" type="text" name="orgname" id="orgname" ng-model="data.orgname" required>
							</div>
							<div class="form-group">
								<label for="orgdesc">Organization Description:</label>
								<textarea class="form-control" type="text" name="orgdesc" id="orgdesc" rows="2" ng-model="data.orgdesc" required></textarea>
							</div>
							<div class="form-group">
								<label>Date Founded:</label>
								<input class="form-control" type="date" name="datefounded" id="datefounded" ng-model="data.orgdatefounded" required>
							</div>
							<div class="form-group">
								<label>Founded by:</label>
								<input class="form-control" type="text" name="foundedby" id="foundedby" ng-model="data.orgfounder" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-primary" type="submit" ng-disabled="!FrmOrganization.$valid">Save</button>
							<button class="btn btn-link" type="button" ng-click="Orgdetails('CANCEL')">Cancel</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

</div>
