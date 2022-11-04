<style>
  .myModal {
    width: 800px;
    position: absolute;
    top: 20px;
    left: -130px;
    
    /*transform: translate(-15%, 0%);*/
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
<div class="modal-content myModal min-vh-100">
  <div class="modal-header">
    <div class="modal-title">
        <b>PROCESS</b>
    </div>
  </div>
  <div class="modal-body">
    <div class="row">
      <div class="col-sm-8">
        <h6>NOTE:<span><small><i>&nbsp;(Please create a schedule before activating process.)</i></small></span></h6>
      </div>
      <div class="col-sm-4 text-right" style="margin-bottom: 10px;" ng-show="showDataTable">
        <button class="btn btn-success" ng-click="AddProcess('PROC')"> <span>&plus;</span> Process</button>
        <button class="btn btn-primary" ng-click="AddProcess('SCHED')"><span>&plus;</span> Schedule</button>
      </div>

    </div>

    <div class="row" ng-show="showDataTable">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive">
          <div class="table table-sm">
            <table class="table table-hover">
              <thead class="table-dark">
                <tr>
                  <th>Name</th>
                  <th>Start</th>
                  <th>End</th>
                  <th>Active</th>
                  <th>Posted</th>
                  <th>Order</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="process in ProcessList track by process.process00id">
                  <td ng-bind="process.processname"></td>
                  <td ng-bind="(process.datestart | date: 'medium') "></td>
                  <td ng-bind="(process.dateend | date: 'medium') "></td>
                  <td ng-bind="process.active"></td>
                  <td ng-bind="process.posted"></td>
                  <td ng-bind="process.sortorder"></td>
                  <td class="text-center" ng-show="(process.active == 0 && process.posted == 0)">
                    <button class="btn btn-success" ng-click="ActivateDeactivateProcess(process.process00id,'ACTIVATE')"><b>A</b></button>
                  </td>
                  <td class="text-center" ng-show="(process.active == 0 && process.posted == 1)">
                    <button class="btn btn-danger" ng-click="ActivateDeactivateProcess(process.process00id,'DEACTIVATE')"><b>D</b></button>
                  </td>
                  <td class="text-center" ng-show="(process.active == 1 && process.posted == 0)">
                    <button class="btn btn-danger" ng-click="ActivateDeactivateProcess(process.process00id,'POSTING')"><b>P</b></button>
                  </td>
                </tr>
                <tr>
                  <td colspan="12" ng-show="ProcessList.length == 0">No process found.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<!--     <div ng-show="showDataTable">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Search Process:</label>
            <select class="form-control" name="" ng-change="ChangeProcess(lProcessName)" ng-model="lProcessName">
              <option ng-repeat="process in ProcessList" ng-value="process.processname" ng-bind="process.processname"></option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Process Name:</label>
            <input type="text" name="" class="form-control" ng-model="ProcessDetails.processname" disabled>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Start Date:</label>
            <input type="text" name="" class="form-control" ng-model="ProcessDetails.datestart | date: 'medium' " disabled>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>End Date:</label>
            <input type="text" name="" class="form-control" ng-model="ProcessDetails.dateend | date: 'medium' " disabled>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Active:</label>
            <input type="text" name="" class="form-control" ng-model="ProcessDetails.active" disabled>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Posted:</label>
            <input type="text" name="" class="form-control" ng-model="ProcessDetails.posted" disabled>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Sort Order:</label>
            <input type="text" name="" class="form-control" ng-model="ProcessDetails.sortorder" disabled>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12 text-right">
          <button class="btn btn-primary" ng-show="(ProcessDetails.active == '1' && ProcessDetails.posted == '0')" ng-click="ActivateDeactivateProcess(ProcessDetails.process00id,'POSTING')">Post</button>
          <button class="btn btn-success" ng-show="(ProcessDetails.active == '0' && ProcessDetails.posted == '0')" ng-click="ActivateDeactivateProcess(ProcessDetails.process00id,'ACTIVATE')">Activate</button>
          <button class="btn btn-danger" ng-show="(ProcessDetails.active == '0' && ProcessDetails.posted == '1')" ng-click="ActivateDeactivateProcess(ProcessDetails.process00id,'DEACTIVATE')">Deactivate</button>
        </div>
      </div>
    </div>
 -->
    <div class="row" ng-show="showProcessFrm">
      <div class="col-sm-12 col-md-12">
        <div class="card ">
          <div class="card-body addForm">
            <form name="FrmProcess">
              <h6>ADD PROCESS LIST:</h6>
              <hr>
              <div class="row">
                <div class="col-sm-6 col-md-6 form-group">
                  <input class="form-control" type="text" id="processname" placeholder="Process name:" ng-model="ProcDetails.name" required>    
                </div>
                <div class="col-sm-4 col-md-4 form-group">
                  <select class="form-control" ng-model="ProcDetails.sortorder" required>
                    <option ng-repeat="LOrder in LocalSortoder" ng-bind="LOrder.sortorder" ng-value="LOrder.sortorder"></option>
                  </select>
                </div>
                <div class="col-md-2 col-sm-2">
                  <button type="submit" class="btn btn-primary" ng-disabled="!FrmProcess.$valid" ng-click="AddProcesslist(ProcDetails,'ADD')">Submit</button>
                </div>
              </div>
            </form>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-12 col-md-12  text-right">
                <a href="" ng-click="CancelAdd()">Cancel</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" ng-show="showSchedFrm">
      <div class="col-sm-12 col-md-12">
        <div class="card ">
          <div class="card-body addForm">
            <form name="FrmScheduleUpdate">
              <h6>SCHEDULE<span><small><i>&nbsp;(This is add and update schedule.)</i></small></span></h6>
              <hr>
              <div class="row">
                <div class="col-sm-4 col-md-4 form-group">
                  <label for="name">Start Date: </label>
                  <select class="form-control" id="name" ng-model="UpdateDetails.processid" required>
                    <option ng-repeat="process in ProcessList" ng-bind="process.processname" ng-value="process.process00id"></option>
                  </select> 
                </div>
                <div class="col-sm-4 col-md-4 form-group">
                  <label for="startdate">Start Date: </label>
                  <input type="datetime-local" min="2000-01-01T00:00" max="2099-12-31T00:00" name="date" class="form-control" id="startdate" ng-model="UpdateDetails.startdate" required>
                </div>
                <div class="col-sm-4 col-md-4 form-group">
                  <label for="endate">End Date: </label>
                  <input type="datetime-local" min="2000-01-01T00:00" max="2099-12-31T00:00" name="date" class="form-control" id="endate" ng-model="UpdateDetails.enddate" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12 text-right">
                  <button type="submit" class="btn btn-primary" ng-disabled="!FrmScheduleUpdate.$valid" ng-click="AddProcesslist(UpdateDetails,'UPDATE')">Submit</button>
                </div>
              </div>
            </form>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-12 col-md-12  text-right">
                <a href="" ng-click="CancelAdd()">Cancel</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="modal-footer">
    <button class="btn btn-link" ng-click="CloseModal()">Close</button>
  </div>
</div>