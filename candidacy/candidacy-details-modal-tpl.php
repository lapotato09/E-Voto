<style>
	.myModal {
		width: 800px;
		/*height: 800px;*/
		position: absolute;
    top: 15px;
    left: -150px;
    margin-bottom: 100px;
		font-family: 'Ruda', sans-serif;	
	}

</style>
<div class="modal-content myModal">
	<div class="modal-header">
		<div class="modal-title text-gray">
			<h4 ng-bind="(fullname.last + ', '+ fullname.first +' '+ fullname.mid +' ('+ fullname.lrn +')' )"></h4>
		</div>
	</div>
	<div class="modal-body">
		<div class="table-responsive">
			<table class="table table-sm table-hover">
				<thead class="table-dark">
					<tr>
						<th class="col-md-4">Form ID</th>
						<th class="col-md-4">Fieldcode</th>
						<th class="col-md-4">Value</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="details in CandidacyDetails" 
					ng-if="(
						details.fieldcode != 'FIRSTNAME' &&
						details.fieldcode != 'LASTNAME' &&
						details.fieldcode != 'MIDDLENAME' &&
						details.fieldcode != 'STUDNUMBER' &&
						(details.fieldcode.substring(0,7) ) != 'ORGNAME' &&
						(details.fieldcode.substring(0,7) ) != 'ORGYEAR' &&
						(details.fieldcode.substring(0,11) ) != 'ORGPOSITION' &&
						(details.fieldcode.substring(0,8) ) != 'ELECYEAR' &&
						(details.fieldcode.substring(0,7) ) != 'ELECPOS' &&
						(details.fieldcode.substring(0,18) ) != 'ELECACCOMPLISHMENT'
					)"
					>
						<td ng-bind="details.formid" class="col-md-4"></td>
						<td ng-bind="details.fieldcode" class="col-md-4"></td>
						<td ng-bind="details.fieldvalue" class="col-md-4"></td>
					</tr>
				</tbody>

			</table>
			<br>
			<table class="table table-sm table-hover">				
				<thead style="background: #01a3a4; color: white;">
					<tr>
						<th class="col-md-4 text-left"	>Organization Name</th>
						<th class="col-md-4 text-center">Position</th>
						<th class="col-md-4 text-right"	>Year</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="org in orgdetails">
						<td class="col-md-4 text-left" ng-bind="org.name"></td>
						<td class="col-md-4 text-center" ng-bind="org.position"></td>
						<td class="col-md-4 text-right" ng-bind="org.year"></td>
					</tr>
				</tbody>
				<tfoot style="background: #ecf0f1;">
					<tr>
						<td colspan="12" ng-show="orgdetails.length < 1">No Record found.</td>
					</tr>
				</tfoot>
			</table>

			<br>
			<table class="table table-sm table-hover">				
				<thead style="background: #4484ce; color: white;">
					<tr>
						<th class="col-md-4 text-left">Election Position</th>
						<th class="col-md-4 text-center">Accomplishment</th>
						<th class="col-md-4 text-right">Year</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="elec in elecdetails">
						<td class="col-md-4 text-left" ng-bind="elec.position"></td>
						<td class="col-md-4 text-center" ng-bind="elec.accomp"></td>
						<td class="col-md-4 text-right" ng-bind="elec.year"></td>
					</tr>
				</tbody>
				<tfoot style="background: #ecf0f1;">
					<tr>
						<td colspan="12" ng-show="elecdetails.length < 1">No Record found.</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-link" ng-click="closeModal()">Close</button>
	</div>
</div>