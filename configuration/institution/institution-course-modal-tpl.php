<style>
	.myModal {
		width: 800px;
		position: absolute;
	  top: 20px;
	  left: -30%;
	  /*transform: translate(-15%, 0%);*/
	}

	.myModal table tbody {
		max-height: 100px;
	}

</style>

<div class="modal-content myModal">

	<div class="modal-header">
		<div class="modal-title" ng-bind="CourseDetails.degreecode + ' ' + CourseDetails.course">
		</div>
	</div>
	
	<div class="modal-body">

		<form name="frmUpdateCourse" novalidate>

			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-4 form-group">
							<label>Degree Code</label>
							<input type="text" name="degreecode" class="form-control" ng-model="Entry.data.degreecode" required>
						</div>
						<div class="col-md-8 form-group">
							<label>Degree</label>
							<input type="text" name="degree" class="form-control" ng-model="Entry.data.degree" required>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4 form-group">
							<label>Course Code</label>
							<input type="text" name="coursecode" class="form-control" ng-model="Entry.data.coursecode" required>
						</div>
						<div class="col-md-8 form-group">
							<label>Course Name</label>
							<input type="text" name="course" class="form-control" ng-model="Entry.data.course" required>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 form-group">
							<label>Description</label>
							<input type="text" name="description" class="form-control" ng-model="Entry.data.description" required>
						</div>
					</div>

				</div>			
			</div>

			<hr>

			<h6>Major Set Up</h6>
			
			<div class="row">
				<div class="col-md-12">
					<table class="table table-sm" style="white-space: nowrap;" ng-show="majorUpdate">
						<thead>
							<tr>
								<th class="text-center col-md-4">Major Code</th>
								<th class="text-center col-md-7">Name</th>
								<th class="text-center col-md-1">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="entry in Entry.MajorEntry">
								<td>
									<input type="text" name="majorcode" class="form-control" ng-model="entry.fieldname">
								</td>
								<td>
									<input type="text" name="majorname" class="form-control" ng-model="entry.fieldvalue">
								</td>
								<td class="text-center">
									<button class="btn btn-sm btn-danger" ng-click="RemoveItem($index, 'major')"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="12" class="text-right">
									<button class="btn btn-sm btn-success" ng-click="AddItem('major')">	<i class="fa fa-add"></i></button>
									<button class="btn btn-sm btn-link" ng-click="EditDetails('major')">	Cancel</button>
								</td>
							</tr>
						</tfoot>
					</table>

					<table class="table table-sm table-bordered" style="white-space: nowrap;" ng-show="!majorUpdate">
						<thead>
							<tr>
								<th class="text-center col-md-4">Major Code</th>
								<th class="text-center col-md-7">Name</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-if="major.length == 0">
								<td colspan="12">
									No record found.
								</td>
							</tr>
							<tr ng-repeat="list in major">
								<td class="text-center" ng-bind="list.fieldname"></td>
								<td class="text-center" ng-bind="list.fieldvalue"></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="12" class="text-right">
									<button class="btn btn-sm btn-primary" ng-click="EditDetails('major', major)">	<i class="fa fa-pen"></i></button>
								</td>
							</tr>
						</tfoot>
					</table>

				</div>

			</div>

			<h6>Year Level Set Up</h6>

			<div class="row">
				<div class="col-md-12">
					<table class="table table-sm" style="white-space: nowrap;" ng-show="yearUpdate">
						<thead>
							<tr>
								<th class="text-center col-md-4">Year Level Code</th>
								<th class="text-center col-md-7">Name</th>
								<th class="text-center col-md-1">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="entry in Entry.YearLevelEntry">
								<td>
									<input type="text" name="yearcode" class="form-control" ng-model="entry.fieldname">
								</td>
								<td>
									<input type="text" name="yearname" class="form-control" ng-model="entry.fieldvalue">
								</td>
								<td class="text-center">
									<button class="btn btn-sm btn-danger" ng-click="RemoveItem($index, 'year')"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="12" class="text-right">
									<button class="btn btn-sm btn-success" ng-click="AddItem('year')">	<i class="fa fa-add"></i></button>
									<button class="btn btn-sm btn-link" ng-click="EditDetails('year')">	Cancel</button>
								</td>
							</tr>
						</tfoot>
					</table>

					<table class="table table-sm table-bordered" style="white-space: nowrap;" ng-show="!yearUpdate">
						<thead>
							<tr>
								<th class="text-center col-md-4">Year Level Code</th>
								<th class="text-center col-md-7">Name</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-if="yearlevel.length == 0">
								<td colspan="12">
									No record found.
								</td>
							</tr>
							<tr ng-repeat="entry in yearlevel">
								<td class="text-center" ng-bind="entry.fieldname"></td>
								<td class="text-center" ng-bind="entry.fieldvalue"></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="12" class="text-right">
									<button class="btn btn-sm btn-primary text-right" ng-click="EditDetails('year', yearlevel)">	<i class="fa fa-pen"></i></button>
								</td>
							</tr>
						</tfoot>
					</table>

				</div>

			</div>


			<!-- <h6>Section Set Up </h6> 

			<div class="row">
				<div class="col-md-12">
					<table class="table table-sm" style="white-space: nowrap;" ng-show="sectionUpdate">
						<thead>
							<tr>
								<th class="text-center col-md-4">Section Code</th>
								<th class="text-center col-md-7">Name</th>
								<th class="text-center col-md-1">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="entry in Entry.SectionEntry">
								<td>
									<input type="text" name="sectioncode" class="form-control" ng-model="entry.fieldname">
								</td>
								<td>
									<input type="text" name="sectionname" class="form-control" ng-model="entry.fieldvalue">
								</td>
								<td class="text-center">
									<button class="btn btn-sm btn-danger" ng-click="RemoveItem($index, 'section')"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="12" class="text-right">
									<button class="btn btn-sm btn-success" ng-click="AddItem('section')">	<i class="fa fa-add"></i></button>
									<button class="btn btn-sm btn-link" ng-click="EditDetails('section')">	Cancel</button>
								</td>
							</tr>
						</tfoot>
					</table>

					<table class="table table-sm table-bordered" style="white-space: nowrap;" ng-show="!sectionUpdate">
						<thead>
							<tr>
								<th class="text-center col-md-4">Section Code</th>
								<th class="text-center col-md-7">Name</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-if="section.length == 0">
								<td colspan="12">
									No record found.
								</td>
							</tr>
							<tr ng-repeat="entry in section">
								<td class="text-center" ng-bind="entry.fieldname"></td>
								<td class="text-center" ng-bind="entry.fieldvalue"></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="12" class="text-right">
									<button class="btn btn-sm btn-primary" ng-click="EditDetails('section', section)">	<i class="fa fa-pen"></i></button>
								</td>
							</tr>
						</tfoot>
					</table>

				</div>

			</div> -->
		</form>

	</div>
	<div class="modal-footer">
		<button class="btn btn-sm btn-primary" ng-click="SaveDetails(Entry)" ng-disabled="!frmUpdateCourse.$valid"> <i class="fa fa-save"></i> Save</button>
		<button class="btn btn-sm btn-link" ng-click="closeModal()">Cancel</button>
	</div>

</div>