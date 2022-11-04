
<div>
	<br>
	
	<div class="row">
		<div class="col-sm-6 col-md-6">
			<h3>CANDIDACY FORM </h3>
			<p>Filed form(s) displayed as of: </p>
		</div>
		<div class="col-sm-6 col-md-6 form-group">
			<div class="input-group mb-3">
			  <input type="text" class="form-control" placeholder="From:" aria-label="Recipient's username" aria-describedby="basic-addon2">
			  <div class="input-group-append">
			    <span class="input-group-text" id="basic-addon2">-</span>
			  </div>			  
			  <input type="text" class="form-control" placeholder="To:" aria-label="Recipient's username" aria-describedby="basic-addon2">
			  <div class="input-group-append">
			    <input type="button" class="input-group-text btn btn-primary" id="basic-addon2" ng-click="InventoryGet()" value="Search">
			  </div>
			</div>
		</div>
	</div>
	<br>

	<div class="row" ng-show="showTable">
		<div class="col-sm-12 col-md-12">
			<table class="table table-hover">
				<thead style="background: blue; color: white;">
					<tr>
						<th>Form No.</th>
						<th>Student Number</th>
						<th>Full Name</th>
						<th>Year&Course</th>
						<th>Position</th>
						<th>Party</th>
						<th>Year</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="forms in filedForms track by forms.candidacy00id">
						<td ng-bind="forms.candidacy00id"></td>
						<td ng-bind="forms.studnumber"></td>
						<td ng-bind="forms.fullname"></td>
						<td ng-bind="forms.acadyear +'-' + forms.course"></td>
						<td ng-bind="forms.position"></td>
						<td ng-bind="forms.party"></td>
						<td ng-bind="forms.year"></td>
						<td ng-bind="forms.status"></td>
					</tr>
				</tbody>
				<tfoot style="font-weight: bold; font-size: 15px; background: #dfe6e9;">
					<tr>
						<td colspan="12"> Count: {{ filedForms.length }} </td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<div class="row" style="text-align: center;" ng-show="!showTable">
		<div class="col-md-2 col-sm-2">&nbsp;</div>
		<div class="col-md-8 col-sm-8">
			<br><br><br><br><br><br>
			<hr>
			<small>DATA TABLE WILL DISPLAY ON THIS PART!</small>
		</div>
		<div class="col-md-2 col-sm-2">&nbsp;</div>
	</div>
</div>