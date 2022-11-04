<style>
#main {
	border-radius: 5px;
	background: white;
	min-height: 670px;
	padding: 10px;
	padding-bottom: 20px;
	width: 100%;
  box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
}

.search-div {
  margin-top: 10px;
  background: #f1f2f6;
  padding-top: 5px;
  border-radius: 5px;

}

#coc-head {
	letter-spacing: 15px;
	margin-top: 20px;
	text-align: center;
	font-size: 20px;
	font-weight: bolder;
}

.row-header {
	font-weight: bold;
	font-size: 20px;"
}

.req {
	color: red;
}

.scrollable-menu {
  height: auto;
  max-height: 200px;
  overflow-x: hidden;
}
</style>

<div id="main">	
  <div class="container-fluid">

    <div class="row search-div">
      <div class="container-fluid">
        <div class="row" style="margin-top: 10px;">       
          <div class="col-sm-3 col-md-3 form-group">
            <input class="form-control" placeholder="Enter ID No." type="text" ng-keypress="KeyPress($event, param)" ng-model="param.idno">
          </div>
          <div class="col-sm-6 col-md-6 form-group">
            <input type="text" class="form-control" id="name" placeholder="Enter last name. .." ng-keypress="KeyPress($event, param)" ng-model="param.name">
          </div>
          <div class="col-sm-3 col-md-3 form-group">
            <button class="btn btn-primary" type="button" id="searchbtn" ng-click="CmdSearch(searchForm)">Search</button>
            <button class="btn btn-success" type="button" ng-click="CmdAdd()"><span><b>&plus;&nbsp;</b></span>Add New</button>
          </div>
        </div>
      </div>
    </div>

    <div class="row" ng-show="Loading">
      <div class="col-sm-12 text-center">
        <img style="width: 30px; height: 30px; text-align: center; margin: 100px;" src="/lib/img/loading.gif">
      </div>
    </div>

    <div ng-show="!withRecords" ng-hide="withRecords" style="margin: 20px;">
      <h6><b>No Record(s) found.</b></h6>
    </div>

    <div ng-show="showBodySection">
      <br>
      <div class="container-fluid header-cont">
        <!-- FORM HEADER -->
        <?php include '../../global/header/school-header.php'; ?> 

        <div id="coc-head">
          CERTIFICATE OF CANDIDACY
          <hr>
        </div>
      </div>
      <div class="container body-cont">
        <form name="Information" class="needs-validation" ng-submit="FilingSave(Information.$valid, info)" novalidate>
          <div class="card">
            <div class="card-body" ng-form="InformationNew">

              <span class="row-header">CANDIDACY</span>
              <hr>

              <div class="row">
                <div class="col-sm-5 col-md-5 form-group">
                  <label for="position">Position: <span class="req">*</span></label>
                  <select name="position" class="form-control" ng-model="info.position" required>
                    <option ng-repeat="pos in position" ng-value="pos.fieldcode" ng-bind="SentenceCase(pos.fieldname)" ></option>
                  </select>
                </div>

                <div class="col-sm-5 col-md-5 form-group">
                  <label for="party">Partylist: <span class="req">*</span></label>
                  <select name="party" class="form-control" ng-model="info.party" required>
                    <option ng-repeat="party in partylist" ng-bind="party.name" ng-value="party.value"></option>
                  </select>
                </div>

                <div class="col-sm-2 col-md-2 form-group">
                  <label>Year: <span class="req">*</span></label>
                  <select name="acadyear" class="form-control" ng-model="info.candidacyyear" required>
                    <option ng-repeat="year in acadyear" ng-bind="year.name" ng-value="year.value"></option>
                  </select>
                </div>            

              </div>
              <br>

              <span class="row-header">PERSONAL</span>
              <hr>

              <div class="row">
                <div class="col-sm-12 col-md-12 form-group" ng-class="{ 'has-error' : Information.lrn.$invalid && !Information.lrn.$pristine }">
                  <label for="lrn">LRN/ Student No.: <span class="req">*</span></label>
                  <input id="lrn" type="text" name="lrn" ng-model="info.schoolidno" class="form-control" required disabled style="border: none;">
                  <p class="req" ng-show="Information.lrn.$invalid && !Information.lrn.$pristine">LRN is required.</p>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-4 col-md-4 form-group">
                  <label for="lname">Last Name: <span class="req">*</span> </label>
                  <input id="lname" type="text" name="name" ng-model="info.lastname" class="form-control" required disabled style="border: none;">
                </div>
                <div class="col-sm-4 col-md-4 form-group">
                  <label for="fname">First Name: <span class="req">*</span> </label>
                  <input id="fname" type="text" name="name" ng-model="info.firstname" class="form-control" required disabled style="border: none;">
                </div>
                <div class="col-sm-4 col-md-4 form-group">
                  <label for="mname">Middle Name: </label>
                  <input id="mname" type="text" name="name" ng-model="info.middlename" class="form-control" disabled style="border: none;">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-4 col-sm-4">
                  <label for="gender">Gender: <span class="req">*</span></label>
                  <input name="gender" type="text" class="form-control" ng-model="info.gender" required disabled style="border: none;">
                </div>

                <div class="col-sm-4 col-md-4 form-group">
                  <label for="age">Age: <span class="req">*</span></label>
                  <input class="form-control" type="text" name="age" ng-model="info.age" ng-pattern="NumberREgex" required disabled style="border: none;">
                  <span class="helpblock error" ng-show="InformationNew.age.$error.pattern">Invalid Number</span>
                </div>

                <div class="col-sm-4 col-md-4 form-group">
                  <label for="status">Status: <span class="req">*</span></label>
                  <input type="text" name="status" class="form-control" ng-model="info.status" required disabled style="border: none;">
                </div>
              </div>

              <div class="row">
                <div class="col-sm-4 col-md-4 form-group">
                  <label> Course: <span class="req">*</span></label>
                  <input type="text" name="course" ng-model="info.course" class="form-control" ng-change="change_course(info.course)" disabled style="border: none;">
                </div>
                <div class="col-md-4 col-sm-4 form-group">
                  <label>Major:</label>
                  <input type="text" name="major" ng-model="info.major" class="form-control" disabled style="border: none;">
                </div>
                <div class="col-md-4 col-sm-4 form-group">
                  <label>Year: <span class="req">*</span></label>
                  <input type="text" name="major" ng-model="info.year" class="form-control" disabled style="border: none;">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-sm-6 col-md-6">
                  <label for="number">Contact:</label>
                  <input class="form-control" ng-model="info.contact" type="text" name="number" maxlength="11" required disabled style="border: none;">
                </div>

                <div class="form-group col-sm-6 col-md-6">
                  <label for="email">Email: <span class="req">*</span></label>
                  <input class="form-control" ng-model="info.email" type="text" name="email" ng-pattern="EmailRegex" required disabled style="border: none;">
                  <span class="helpblock error" ng-show="InformationNew.email.$error.pattern">Invalid Email</span>
                </div>
                
              </div>

              <br><br>
              <span class="row-header">ORGANIZATION</span>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <table class="table table-hover table-sm form-group" ng-show="info.organization_lst.length > 0">
                    <thead class="text-center">
                      <tr>
                        <th>Org Name</th>
                        <th>Position</th>
                        <th>Year of Membership</th>
                        <th>&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr ng-repeat="org in info.organization_lst track by $index">
                        <td>
                          <select class="form-control" ng-model="org.orgname">
                            <option ng-repeat="org_list in OrganizationList" ng-bind="org_list.orgname" ng-value="org_list.orgname"></option>
                          </select>
                        </td>
                        <td><input type="text" class="form-control" ng-model="org.orgpos"></td>
                        <td><input type="text" class="form-control" ng-model="org.orgyear"></td>
                        <td><button type="button" class="btn btn-sm btn-danger" ng-click="deleteRow($index, 'ORG')"><b>x</b></button></td>
                      </tr>
                    </tbody>
                  </table>
                  <button type="button" class="btn btn-success btn-sm addbutton" ng-click="addRow('ORG')">
                  <i class="fa fa-add"></i> Add
                  </button>             
                </div>

              </div>
              <br>
              <br>
              <span class="row-header">ELECTORAL BACKGROUND <small> (Please state key point only in accomplishment.)</small></span>
              <div class="row">
                <div class="col-sm-12 col-md-12 table-scrollable">
                  <table class="table table-hover table-sm form-group" ng-show="info.electoral.length > 0">
                    <thead style="text-align: center;">
                      <tr>
                        <th>Year</th>
                        <th>Position</th>
                        <th>Accomplishment</th>
                        <th>&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr ng-repeat="elec in info.electoral track by $index">
                        <td><input type="text" class="form-control" ng-model="elec.elecyear"></td>
                        <td><input type="text" class="form-control" ng-model="elec.elecpos"></td>
                        <td><textarea type="text" rows="1" class="form-control" ng-model="elec.elecaccomplishment"></textarea></td>
                        <td><button type="button" class="btn btn-sm btn-danger" ng-click="deleteRow($index,'ELEC')"><b>x</b></button></td>
                      </tr>
                    </tbody>
                  </table>
                  <button type="button" class="btn btn-success btn-sm addbutton" ng-click="addRow('ELEC')"><i class="fa fa-add"></i> Add</button>
                </div>

              </div>

              <br>
              <br>
              <div class="row">
                
                <div class="col-sm-4 col-md-4 form-group">
                  <label for="fileddate">Date filed: <span class="req">*</span></label>
                  <input type="date" ng-model="info.datefiled" class="form-control" name="fileddate" max="2099-12-31" min="2021-01-01" placeholder="Date filed. .." required>

                </div>

              </div>
                
            </div>
            <div>
              <p style="font-size: 12px; font-style: italic;">&nbsp;&nbsp;NOTE: This form is subject for approval by the Filing and Candidacy COMSELEC officer.</p>
            </div>
            
            <div class="card-footer" style="text-align: right;" >
              <div class="row" style="text-align: center; font-size: 12px; font-style: italic;">
              <div class="col-sm-12 col-md-12">
                <p>I hereby certify that the information provided in this form is complete, true and correct to the best of my knowledge.</p>
              </div>
            </div>

              <div>
                <!-- <input class="btn btn-primary" type="submit" value="Submit Form" ng-disabled="Information.$invalid" /> -->
                <input class="btn btn-primary" type="submit" value="Submit Application" />
              </div>
            </div>
          </div>
        </form>
      </div>  
    </div>
    
  </div>

</div>
