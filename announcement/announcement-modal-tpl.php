<style>
	.myModal {
    width: 800px;
    position: absolute;
    top: 20px;
    left: -130px;
  }
  .myModal .addbutton {
    width: 80px;
    height: 22px;
    font-size: 12px;
    padding: 0px;
    margin: 0px;
  }
  .myModal .addForm {
    padding-top: 20px;
    padding-bottom: 20px;
    background: #ecf0f1;
  }

</style>

<div class="modal-content myModal">
	<div class="modal-header">
		<div class="modal-title">
			<h6>ANNOUNCEMENT</h6>
		</div>
	</div>
	<div class="modal-body">
		<div class="table-cont table-responsive" ng-show="!formShow" >
      <table class="table table-bordered table-hover">
        <thead style="background: #4484ce; color: white;">
          <th>Subject</th>
          <th>Title</th>
          <th>Active</th>
          <th>Date Posted</th>
          <th class="text-center">Post/Unpost</th>
        </thead>
        <tbody>
          <tr ng-repeat="value in Announcement track by value.ann00id">
            <td ng-bind="value.subject"></td>
            <td ng-bind="value.title"></td>
            <td ng-bind="value.active" class="text-center"></td>
            <td ng-bind="(value.dateposted | date: 'MMM dd, yyyy') "></td>
            <td class="text-center">
              <button class="btn btn-success" ng-hide="value.active == 1" ng-click="AnnouncementPostUnpost(value.ann00id,'POST')">P</button>
              <button class="btn btn-danger" ng-hide="value.active == 0" ng-click="AnnouncementPostUnpost(value.ann00id,'UNPOST')">U</button>
            </td>
          </tr>
        </tbody>
	      <tfoot style="font-weight: bold; font-size: 15px; background: #ecf0f1;">
					<tr>
						<td colspan="12" ng-show="Announcement.length > 0"> Count: {{ Announcement.length }} </td>
						<td colspan="12" ng-hide="Announcement.length > 0"> No record(s) found.</td>
					</tr>
				</tfoot>
      </table>
    </div>
    <div class="text-right">
      <button class="btn btn-info mt-3" id="add" ng-click="AddAnnouncement('CREATE')" ng-show="!formShow">Create New</button>
    </div>




    <!-- Create new announcement form -->
    <form name="FRMAnncmnt" ng-show="formShow" ng-hide="!formShow" ng-submit="AnnouncementCreate(FRMAnncmnt.$valid, AnnForm)" novalidate>
      <h5>Create an announcement:</h5>
      <hr>
      <div class="input-group mb-2 col-sm-12 col-md-12 col-lg-12">
        <div class="input-group-prepend">
          <span class="input-group-text" name="subject">Subject: *</span>
        </div>
        <input type="text" class="form-control" placeholder="Subject" ng-model="AnnForm.subj" required>
      </div>

      <div class="input-group mb-2 col-sm-12 col-md-12 col-lg-12">
        <div class="input-group-prepend">
          <span class="input-group-text" name="title">Title: *</span>
        </div>
        <input type="text" class="form-control" placeholder="Title" ng-model="AnnForm.title"required>
      </div>
      
      <div class="form-group col-sm-12 col-md-12 col-lg-12">
        <label for="textarea">Content:<span style="color: red;">*</span></label>
        <textarea class="form-control" rows="5" id="textarea" name="content" ng-model="AnnForm.content" required></textarea>
      </div>

      <div class="form-group col-sm-12 col-md-12 col-lg-12 text-right">
        <button class="btn btn-primary" type="submit" ng-disabled="FRMAnncmnt.$invalid">Post Announcenment</button>
        <button class="btn btn-link" type="button" ng-click="AddAnnouncement('CANCEL')">Cancel</button>
      </div>

    </form>

	</div>

	<div class="modal-footer">
		<button class="btn btn-link" ng-click="closeModal()">Close</button>
	</div>
</div>