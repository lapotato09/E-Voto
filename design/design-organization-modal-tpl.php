<link rel="stylesheet" type="text/css" href="/lib/custom/modal-css.css">
<div class="modal-content myModal mb-100">
	<div class="modal-header">
		<div class="modal-title">
			<h4>{{ localData.orgname }}
			</h4>
		</div>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 form-group">
				<label>Organization Name:</label>
				<input type="text" name="" class="form-control" ng-model="lData.orgname">

				<label>Organization Description:</label>
				<textarea type="text" name="" class="form-control" rows="3" ng-model="lData.orgdesc"></textarea>

				<label>Founded by:</label>
				<input type="text" name="" class="form-control"  ng-model="lData.foundedby">
				
				<label>Status:</label>
				<select class="form-control" ng-value="lData.active">
					<option value="0">Inactive</option>
					<option value="1">Active</option>
				</select>
			</div>

		</div>
		<br>
		<div style="position: absolute; bottom: 10px; right: 0;">
			<button class="btn btn-primary" ng-click="UpdateOrganization(lData)">Save</button>
			<button class="btn btn-link"> Close</button>
		</div>
	</div>
</div>