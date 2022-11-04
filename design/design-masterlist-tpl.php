<div style="margin-top: 10px;">	
	<div class="row">
		<div class="col-md-12">
			<div class="table">
				<table class="table table-sm table-hover">
					<thead class="thead-dark">
						<tr>
							<th class="col-md-2">School ID.</th>
							<th class="col-md-3">Full Name</th>
							<th class="col-md-2">Course & Major</th>
							<th class="col-md-2">Entry Type</th>
							<th class="col-md-2">Status</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="list in MasterList">
							<td class="col-md-2" ng-bind="list.schoolidno"> </td>
							<td class="col-md-3" ng-bind="SentenceCase(list.lastname) + ', ' + SentenceCase(list.firstname) + ' ' + SentenceCase(list.middlename)"></td>
							<td class="col-md-2" ng-bind="(list.course + ' ' + list.major)"></td>
							<td class="col-md-2" ng-bind="list.entrytype"></td>
							<td class="col-md-2" ng-bind="list.status"></td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="12">Count: {{MasterList.length}}</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>

</div>
