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
		<div class="modal-title">
			<h4 ng-bind="(fullname.last + ', '+ fullname.first +' '+ fullname.mid +' ('+ fullname.lrn +')' )"></h4>
		</div>
	</div>
	<div class="modal-body">
		<div class="table-responsive">
			<table class="table table-sm table-hover">
				<thead class="table-dark">
					<tr>
						<th>Form ID</th>
						<th>Fieldcode</th>
						<th>Value</th>
						<th>Status</th>
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
						<td ng-bind="details.formid"></td>
						<td ng-bind="details.fieldcode"></td>
						<td ng-bind="details.fieldvalue"></td>
						<td ng-bind="details.status"></td>
					</tr>
				</tbody>

			</table>
			<br>
			<table class="table table-sm table-hover">				
				<thead style="background: green; color: white;">
					<tr>
						<th colspan="2" class="text-left"	>Organization Name</th>
						<th colspan="6"	class="text-left">Position</th>
						<th colspan="4" class="text-right"	>Year</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="org in orgdetails">
						<td colspan="2" ng-bind="org.name" class="text-left"></td>
						<td colspan="6" ng-bind="org.position" class="text-left"></td>
						<td colspan="4" ng-bind="org.year" class="text-right"></td>
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
						<th colspan="2" class="text-left">Election Position</th>
						<th colspan="6" class="text-left">Accomplishment</th>
						<th colspan="4" class="text-right">Year</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="elec in elecdetails">
						<td colspan="2" ng-bind="elec.position" class="text-left"></td>
						<td colspan="6" ng-bind="elec.accomp" class="text-left"></td>
						<td colspan="4" ng-bind="elec.year" class="text-right"></td>
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
		<button class="btn btn-danger" ng-click="closeModal()">Close</button>
	</div>
</div>