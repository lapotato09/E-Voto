<style>
  #inventory-tpl {
    border-radius: 5px;
    background: white;
    min-height: 670px;
    padding: 0 10px;
    box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
  }
  #search-row {
    background: #ecf0f1;
    margin: 5px;
    padding: 10px 0;
    border-radius: 3px;
  }

</style>
<div id="inventory-tpl">
  <br>
  <div class="row" id="search-row">
    <div class="col-sm-6 col-md-6 text-gray">
      <div style="font-size: 20px;"> Candidacy Form</div>
      <p>Filed form(s) displayed as of: <span><b> {{ datenow | date: 'medium' }} </b></span>
      </p>
    </div>
    <div class="col-sm-1 col-md-1 form-group">
      <p>&nbsp;</p>
    </div>
    <div class="col-sm-2 col-sm-2 form-group">
      <select class="form-control" ng-model="ParamValue.status" ng-required="true">
        <option ng-repeat="ostatus in status" ng-bind="ostatus.name" ng-value="ostatus.value"></option>
      </select>     
    </div>
    <div class="col-sm-3 col-md-3 form-group">
      <div class="input-group mb-3">
        <select aria-describedby="basic-addon2" class="form-control" ng-model="ParamValue.year">
          <option value=""></option>
          <option ng-repeat="year in acadyear" ng-value="year.value" ng-bind="year.name"></option>
        </select>
        <div class="input-group-append">
          <button class="input-group-text btn btn-primary" id="basic-addon2" ng-click="InventoryGet(ParamValue)"><i class="fa fa-magnifying-glass"></i></button>
        </div>
      </div>
    </div>
  </div>
  <br>

  <div class="row" ng-show="showTable">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table table-sm table-hover">
          <thead style="background: #04b3dd; color: white;">
            <tr>
              <th>Form No.</th>
              <th>Student Number</th>
              <th>Full Name</th>
              <th>Year&Course Major</th>
              <th>Position</th>
              <th>Party</th>
              <th>Year</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-class="{'note-success': forms.status == 'APPROVED', 'note-info': forms.status == 'FOR_EVALUATION'}" ng-repeat="forms in filedForms track by forms.candidacy00id" ng-click="ShowCandidacyDetails(forms.candidacy00id)">
              <td ng-bind="forms.candidacy00id"></td>
              <td ng-bind="forms.studnumber"></td>
              <td ng-bind="SentenceCase(forms.fullname)"></td>
              <td ng-bind="forms.acadyear +'-' + forms.course +' ' + SentenceCase(forms.major)"></td>
              <td ng-bind="SentenceCase(forms.position)"></td>
              <td ng-bind="forms.party"></td>
              <td ng-bind="forms.year"></td>
              <td ng-bind="SentenceCase(forms.status)"></td>
            </tr>
          </tbody>
          <tfoot style="font-weight: bold; font-size: 15px; background: #ecf0f1;">
            <tr>
              <td colspan="6" ng-show="filedForms.length > 0"> Count: {{ filedForms.length }} </td>
              <td colspan="6" ng-show="filedForms.length > 0" class="text-right"> 
                <button type="button" class="btn btn-sm btn-primary">Generate XLS</button>
              </td>
              <td colspan="12" ng-hide="filedForms.length > 0"> No record(s) found.</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <div class="row" ng-show="Loading">
    <div class="col-sm-12 text-center">
      <img style="width:50px; height:50px; text-align: center; margin-top: 100px;" src="/lib/img/loading.gif">
    </div>
  </div>
  <div class="row" style="text-align: center;" ng-show="!showTable">
    <div class="col-md-2 col-sm-2">&nbsp;</div>
    <div class="col-md-8 col-sm-8">
      <br><br><br>
      <br><br><br>
      <hr>
      <small>DATA TABLE WILL DISPLAY ON THIS PART!</small>
    </div>
    <div class="col-md-2 col-sm-2">&nbsp;</div>
  </div>
</div>