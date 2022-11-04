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
 /* .check {
    width: 60px;
    height: 20px;
  }*/
</style>

<div>
  <div class="row">
    <div class="col-md-12">
      <div class="subheader text-muted">Access Control</div> 
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <form name="frmAccessControlList" novalidate>
        <div class="row">
          <div class="col-md-12">
            <ui-select name="name" class="selectui" ng-model="RoleMod.roledetails" theme="bootstrap" sortable="true" ng-change="ChangeRole(RoleMod)" required>
              <ui-select-match placeholder="Input Role...">{{$select.selected.rolename}}</ui-select-match>
              <ui-select-choices repeat="role in Rolelist | filter: $select.search">
                <div ng-bind-html="role.rolename | highlight: $select.search"></div>
              </ui-select-choices>
            </ui-select>
          </div>
        </div>
        <br>

        <div class="row"> 
          <div class="col-md-12"><b>Description</b></div>
        </div>
        <hr>

        <div class="row" ng-repeat="rolea in RoleAccesslist" ng-init="MotherIndex = $index">
          <div class="col-md-4" ng-if="rolea.parentcode == ''" >
            <div class="boxed-check-group boxed-check-primary">
              <label class="boxed-check">
                <input class="boxed-check-input" type="checkbox" name="custom-checkbox{{MotherIndex}}" data-toggle="collapse" data-target="#collapseMenu{{MotherIndex}}" ng-checked="rolea.present" ng-model="AccessModel[rolea.accesscode]" ng-value="rolea.present">
                <div class="boxed-check-label">
                  <h6> {{ rolea.description }} </h6>
                </div>
              </label>
            </div>

            <div class="collapse" id="collapseMenu{{MotherIndex}}">
              <div class="row" ng-repeat="child in RoleAccesslist" ng-if="rolea.accesscode == child.parentcode">
                <div class="col-md-2">&nbsp;</div>
                <div class="col-md-10">
                  <div class="boxed-check-group boxed-check-primary">
                    <label class="boxed-check">
                      <input class="boxed-check-input" type="checkbox" name="custom-checkbox{{MotherIndex}}" ng-checked="child.present" ng-model="AccessModel[child.accesscode]" ng-value="child.present">
                      <div class="boxed-check-label">
                        <h6>{{ child.description }}</h6>
                      </div>
                    </label>
                  </div>

                </div>
              </div>
            </div>

          </div>

        </div>

        <div class="row" style="height: 60px; background: #f1f2f6; margin-top: 10px; padding-top: 10px;">
          <div class="col-md-12 text-right">
            <button class="btn btn-sm btn-link"> Reset</button>
            <button class="btn btn-sm btn-primary" ng-disabled="frmAccessControlList.$invalid" ng-click="RoleAccessSave(AccessModel, RoleMod)"><i class="fa fa-save"></i> Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>