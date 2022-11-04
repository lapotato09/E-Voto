<style>
  .subheader {
    font-size: 25px;
    margin-bottom: 20px;
  }
  #action-div {
    height: 60px; background: #f1f2f6;
    /*background: #f8f8ff;*/
    background: #f1f2f6;
  }
  .req {
    color: red;
  }
</style>


<!-- LSIT CONTAINER -->
<div>
  <div class="row">
    <div class="col-md-6">
      <div class="subheader text-muted">Role Type List</div>      
    </div>
    <div class="col-md-6 text-right">
      <button class="btn btn-sm btn-success" ng-click="AddRole()" ng-hide="ShowAddRoleForm"> &plus; Add New</button>
    </div>
  </div>
  <div class="row" ng-hide="ShowAddRoleForm">
    <div class="col-md-12">
      <div class="table">
        <table class="table table-sm table-hover">
          <thead>
            <tr>
              <th>Role Code</th>
              <th>Role Description</th>
              <th>Role Name</th>
              <th>Role Group</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="role in Rolelist" ng-click="RoleDetails(role)">
              <td ng-bind="role.rolecode"></td>
              <td ng-bind="role.roledescription"></td>
              <td ng-bind="role.rolename"></td>
              <td ng-bind="role.rolegroup"></td>
            </tr>
            <tr ng-if="Rolelist.length > 0">
              <td colspan="12">Count: {{Rolelist.length}}</td>
            </tr>
            <tr ng-if="Rolelist.length == 0">
              <td colspan="12">No record found.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="row" ng-show="ShowAddRoleForm">
    <div class="col-md-12">
      <form name="frmCreateRole" novalidate>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Role Code: <span class="req">*</span></label>
              <input type="text" class="form-control" name="rolecode" ng-model="CreateRole.rolecode" required>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>Role Description: <span class="req">*</span></label>
              <input type="text" class="form-control" name="roledesc" ng-model="CreateRole.roledesc" required>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>Role Name: <span class="req">*</span></label>
              <input type="text" class="form-control" name="rolename" ng-model="CreateRole.rolename" required>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>Role Group:</label>
              <input type="text" class="form-control" name="rolegroup" ng-model="CreateRole.rolegroup">
            </div>
          </div>

        </div>

        <div class="row" style="height: 60px; background: #f1f2f6; margin-top: 10px; padding-top: 10px;">
          <div class="col-md-4">
            <small class="text-muted"><i>Note: Red askterisk means required.</i></small>
          </div>
          <div class="col-md-8 text-right">
            <button class="btn btn-sm btn-primary" ng-disabled="frmCreateRole.$invalid" ng-click="RoleSave(CreateRole)"><i class="fa fa-save"></i> Save</button>
            <button class="btn btn-sm btn-link" ng-click="AddRole()" ng-show="ShowAddRoleForm"> Cancel</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

