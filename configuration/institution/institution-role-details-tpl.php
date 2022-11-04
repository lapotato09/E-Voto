<style>
  .action-div {
    height: 60px;
    background: #f1f2f6;
    margin-top: 10px;
    padding-top: 10px;
    padding-right: 10px;
  }
  .fs-20 {
    font-size: 20px;
  }
</style>


<div class="modal-content">
  <div class="modal-body">

    <form name="frmRoleDetails" novalidate>

      <br>

      <div class="row">
        <div class="col-md-12 fs-20 text-muted">
          <div>{{RoleDetails.roledescription}} - {{RoleDetails.rolecode}}</div>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Role Code:</label>
            <input type="" name="rolecode" class="form-control" ng-model="RoleEditDetails.rolecode" ng-disabled="readonly" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Role Description:</label>
            <input type="" name="roledesc" class="form-control" ng-model="RoleEditDetails.roledescription" ng-disabled="readonly" required>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Role Name:</label>
            <input type="" name="rolename" class="form-control" ng-model="RoleEditDetails.rolename" ng-disabled="readonly" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Role Group:</label>
            <input type="" name="rolegroup" class="form-control" ng-model="RoleEditDetails.rolegroup" ng-disabled="readonly">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 text-right">
          <div class="action-div">
            <button class="btn btn-sm btn-primary" ng-show="readonly && RoleEditDetails.active == 1">Inactive</button>
            <button class="btn btn-sm btn-primary" ng-show="readonly && RoleEditDetails.active == 0">Activate</button>
            <button class="btn btn-sm btn-success" ng-click="EditDetails()" ng-show="readonly">Edit</button>
            <button class="btn btn-sm btn-primary" ng-show="!readonly" ng-disabled="frmRoleDetails.$invalid" ng-click="SaveEditedDetails(RoleEditDetails)"><i class="fa fa-save"></i> Save</button>
            <button class="btn btn-sm btn-link" ng-click="CancelEdit()" ng-hide="readonly">Cancel</button>
          </div>
        </div>
      </div>
    </form>
  </div>

</div>