<br>
<div class="row">
  <div class="container">
    <div class="card">
      <div class="card-header" style="background: #4484ce;">
        <div class="row">
          <div class="input-group col-md-12">
            <input class="form-control" placeholder="Enter ID No." type="text" ng-keypress="KeyPress($event, info.searchdata)" ng-model="info.searchdata">
            <div class="input-group-append">
              <span><button class="btn btn-primary" ng-click="showDataRow(info.searchdata)">Search</button></span>      
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
      <div class="card-body" ng-show="showBodySection">
        <br>
        <div class="container-fluid header-cont">
          <div class="row">
            <div class="col-sm-2 col-md-2">
              <img src="../img/EARIST_Logo.png" style="width: 100px; height: 100px; text-align: left;">   
            </div>
            <div class="col-sm-8 col-md-8">
              <p>
             EULOGIO "AMANG" RODRIGUEZ INSTITUTE OF SCIENCE AND TECHNOLOGY
              <br>      General Mariano Alvarez, Cavite
              <br> <i>  Division of Cavite </i>
              <br>  <b>SUPREME STUDENT GOVERNMENT</b>
              </p>
            </div>
            <div class="col-sm-2 col-md-2">

              <img src="../img/EARISTCAVITE.png" style="width: 100px; height: 100px; text-align: right;">
            </div>
          </div>

          <br>
          <h4 style="letter-spacing: 15px;">CERTIFICATE OF CANDIDACY</h4>
          <hr>
        </div>
        <div class="container body-cont">
          <form name="Information" class="needs-validation" ng-submit="FilingSave(Information.$valid, info)" novalidate>
            <div class="card">
              <div class="card-body" ng-form="InformationNew">

                <span style="font-weight: bold; font-size: 22px;">CANDIDACY</span>
                <hr>

                <div class="row">

                  <div class="col-sm-5 col-md-5 form-group">
                    <label for="position">Position: <span class="req">*</span></label>
                    <select name="position" class="form-control" ng-model="info.position" required>
                      <option ng-repeat="pos in position" ng-bind="pos.name" ng-value="pos.value"></option>
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

                <span style="font-weight: bold; font-size: 22px;">PERSONAL</span>
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
                    <label for="mname">Middle Name: <span class="req">*</span></label>
                    <input id="mname" type="text" name="name" ng-model="info.middlename" class="form-control" required disabled style="border: none;">
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

                <br>
                <br>
                <span style="font-weight: bold; font-size: 22px;">ORGANIZATION</span>
                <div class="row">
                  <div class="col-sm-12 col-md-12">
                    <table class="table table-hover form-group" ng-show="info.organization_lst.length > 0">
                      <thead style="text-align: center;">
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
                    <button type="button" class="btn btn-success addbutton" ng-click="addRow('ORG')">
                    <i class="fa fa-plus"></i>Add
                    </button>             
                  </div>

                </div>
                <br>
                <br>
                <span style="font-weight: bold; font-size: 22px;">ELECTORAL BACKGROUND <small> (Please state key point only in accomplishment.)</small></span>
                <div class="row">
                  <div class="col-sm-12 col-md-12 table-scrollable">
                    <table class="table table-hover form-group" ng-show="info.electoral.length > 0">
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
                    <button type="button" class="btn btn-success addbutton" ng-click="addRow('ELEC')">Add</button>
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
                  <input class="btn btn-primary" type="submit" value="Submit Form" />
                </div>
              </div>
            </div>
          </form>
        </div>  
      </div>
    </div>
  </div>
</div>
