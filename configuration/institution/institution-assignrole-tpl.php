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
  .check {
    width: 60px;
    height: 20px;
  }
</style>

<div>
  <div class="row">
    <div class="col-md-12">
      <div class="subheader text-muted">Assign Role Type</div> 
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <form name="frmPersonRole" novalidate>
        <div class="row">
          <div class="col-md-12">
            <!-- <input type="text" class="form-control" name="" placeholder="Name . .."> -->
            <ui-select name="name" class="selectui" ng-model="PersonMod.persondetails" theme="bootstrap" sortable="true" ng-change="ChangePerson(PersonMod)" required>
              <ui-select-match placeholder="Input Name...">{{$select.selected.fullname}}</ui-select-match>
              <ui-select-choices repeat="person in PersonList | filter: $select.search">
                <div ng-bind-html="person.fullname | highlight: $select.search"></div>
              </ui-select-choices>
            </ui-select>
          </div>
        </div>
        <br>

        <div class="row">
          <div class="col-sm-12 col-md-12">
            <!-- Custom layout -->
            <div class="table">
              <table class="table table-sm table-hover">
                <thead>
                  <tr>
                    <th>Role Name</th>
                  </tr>
                </thead>
                <tbody>
                  <tr ng-repeat="role in PersonRoleList">
                    <td>
                      <div class="boxed-check-group boxed-check-primary">
                        <label class="boxed-check">
                          <input class="boxed-check-input" type="checkbox" name="checkbox-overview-custom" ng-checked="role.present" ng-model="UpdateRoleList[$index].present" ng-value="role.present">
                          <div class="boxed-check-label">
                            <h6 ng-bind="role.rolecode + ' - ' + role.rolename"></h6>
                          </div>
                        </label>
                      </div>

                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>

        </div>

        <div class="row" style="height: 60px; background: #f1f2f6; margin-top: 10px; padding-top: 10px;">
          <div class="col-md-12 text-right">
            <button class="btn btn-sm btn-link"> Reset</button>
            <button class="btn btn-sm btn-primary" ng-disabled="frmPersonRole.$invalid" ng-click="PersonRoleSave(UpdateRoleList, PersonMod)"><i class="fa fa-save"></i> Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  

  <!-- Custom layout -->
  <!-- <div class="boxed-check-group boxed-check-success">
    <label class="boxed-check">
      <input class="boxed-check-input" type="checkbox" name="checkbox-overview-custom" checked>
      <div class="boxed-check-label boxed-check-primary">
        <h2>Breakfast</h2>
        <span>Good Morning</span>
      </div>
    </label>
  </div> -->
  
</div>