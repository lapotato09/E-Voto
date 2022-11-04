
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
  <h4> C E R T I F I C A T E&nbsp;&nbsp;&nbsp;&nbsp;O F&nbsp;&nbsp;&nbsp;&nbsp;C A N D I D A C Y</h4>
  <hr>
</div>
<div class="container body-cont">
  <form name="Information" class="needs-validation" ng-submit="FilingSave(Information.$valid, info)" novalidate>
    <div class="card">
      <div class="card-body" ng-form="InformationNew">

        <h6>PERSONAL</h6>
        <hr>

        <div class="row">
          <div class="col-sm-12 col-md-12 form-group" ng-class="{ 'has-error' : Information.lrn.$invalid && !Information.lrn.$pristine }">
            <label for="lrn">LRN/ Student No.: <span class="req">*</span></label>
            <input id="lrn" type="text" name="lrn" ng-model="info.lrn" class="form-control" ng-required="true">
            <p class="req" ng-show="Information.lrn.$invalid && !Information.lrn.$pristine">LRN is required.</p>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-4 col-md-4 form-group">
            <label for="lname">Last Name: <span class="req">*</span> </label>
            <input id="lname" type="text" name="name" ng-model="info.lname" class="form-control" required>
          </div>
          <div class="col-sm-4 col-md-4 form-group">
            <label for="fname">First Name: <span class="req">*</span> </label>
            <input id="fname" type="text" name="name" ng-model="info.fname" class="form-control" ng-required="true">
          </div>
          <div class="col-sm-4 col-md-4 form-group">
            <label for="mname">Middle Name: <span class="req">*</span></label>
            <input id="mname" type="text" name="name" ng-model="info.mname" class="form-control" ng-required="true">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-4 col-sm-4">
            <label for="gender">Gender: <span class="req">*</span></label>
            <select name="gender" class="form-control" ng-model="info.gender" ng-required="true">
              <option ng-repeat="mygender in gender" ng-bind="mygender.name" ng-value="mygender.value"></option>
            </select>
          </div>

          <div class="col-sm-4 col-md-4 form-group">
            <label for="age">Age: <span class="req">*</span></label>
            <input class="form-control" type="text" name="age" ng-model="info.age" ng-pattern="NumberREgex" ng-required="true">
            <span class="helpblock error" ng-show="InformationNew.age.$error.pattern">Invalid Number</span>
          </div>

          <div class="col-sm-4 col-md-4 form-group">
            <label for="status">Status: <span class="req">*</span></label>
            <select name="status" class="form-control" ng-model="info.status" ng-required="true">
              <option ng-repeat="status in civilstatus" ng-bind="status.name" ng-value="status.value"></option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-4 col-md-4 form-group">
            <label> Course: <span class="req">*</span></label>
            <select name="course" ng-model="info.course" class="form-control" ng-change="change_course(info.course)">
              <option ng-repeat="mcourse in course" ng-bind="mcourse.name" ng-value="mcourse.value" ng-required="true"> </option>
            </select>
          </div>
          <div class="col-md-4 col-sm-4 form-group">
            <label>Major:</label>
            <select name="major" ng-model="info.major" class="form-control">
              <option ng-repeat="mmajor in retMajor" ng-bind="mmajor.name" ng-value="mmajor.value"></option>
            </select>
          </div>
          <div class="col-md-4 col-sm-4 form-group">
            <label>Year: <span class="req">*</span></label>
            <select name="major" ng-model="info.acadyear" class="form-control" ng-required="true">
              <option value="I">First Year</option>
              <option value="II">Second Year</option>
              <option value="III">Third Year</option>
              <option value="IV">Fourth Year</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-sm-6 col-md-6">
            <label for="number">Contact:</label>
            <input class="form-control" ng-model="info.contact" type="text" name="number" maxlength="11" ng-required="true">
          </div>

          <div class="form-group col-sm-6 col-md-6">
            <label for="email">Email: <span class="req">*</span></label>
            <input class="form-control" ng-model="info.email" type="text" name="email" ng-pattern="EmailRegex" ng-required="true">
            <span class="helpblock error" ng-show="InformationNew.email.$error.pattern">Invalid Email</span>
          </div>
          
        </div>


        <br>
        <br>
        <h6>CANDIDACY</h6>
        <hr>

        <div class="row">

          <div class="col-sm-5 col-md-5 form-group">
            <label for="position">Position: <span class="req">*</span></label>
            <select name="position" class="form-control" ng-model="info.position" ng-required="true">
              <option ng-repeat="pos in position" ng-bind="pos.name" ng-value="pos.value"></option>
            </select>
          </div>

          <div class="col-sm-5 col-md-5 form-group">
            <label for="party">Partylist: <span class="req">*</span></label>
            <select name="party" class="form-control" ng-model="info.party" ng-required="true">
              <option ng-repeat="party in partylist" ng-bind="party.name" ng-value="party.value"></option>
            </select>
          </div>

          <div class="col-sm-2 col-md-2 form-group">
            <label>Year: <span class="req">*</span></label>
            <select name="acadyear" class="form-control" ng-model="info.year" ng-required="true">
              <option ng-repeat="year in acadyear" ng-bind="year.name" ng-value="year.value"></option>
            </select>
          </div>            

        </div>
        <br>
        <br>
        <h6>ORGANIZATION</span></h6>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <table class="table table-hover form-group">
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
                  <td><input type="text" class="form-control" ng-model="org.orgname"></td>
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
        <h6>ELECTORAL BACKGROUND  <span>(Please state key point only in accomplishment.)</h6>
        <div class="row">
          <div class="col-sm-12 col-md-12 table-scrollable">
            <table class="table table-hover form-group">
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
            <input type="date" ng-model="info.datefiled" class="form-control" name="fileddate" max="2099-12-31" min="2021-01-01" placeholder="Date filed. .." ng-required="true">

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

