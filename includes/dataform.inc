<form name="Information" class="needs-validation"  ng-submit="PersonSave(InformationNew.$valid, personData)" novalidate>
  <div class="row" ng-form="InformationNew">
    <div class="col-sm-4 col-md-4" style="background: #f1f2f6;">
      <br>
      <div class="form-group">
        <label>ID Number:<span class="req"> *</span> <small><a href="" ng-click="GenerateId()">Generate</a></small></label>
        <input type="text" name="lrn" id="lrn" class="form-control" placeholder="202X-XXXX" ng-model="personData.lrn" style="font-weight: bold;" required readonly>
      </div>
      <div class="form-group">
        <label>Last Name:<span class="req"> *</span></label>
        <input type="text" name="lname" id="lname" class="form-control" placeholder="Doe" ng-model="personData.lname" required>
      </div>
      <div class="form-group">
        <label>First Name:<span class="req"> *</span></label>
        <input type="text" name="fname" id="fname" class="form-control" placeholder="John" ng-model="personData.fname" required>
      </div>  
      <div class="form-group">
        <label>Middle Name:</label>
        <input type="text" name="mname" id="mname" class="form-control" placeholder="Boo" ng-model="personData.mname">
      </div>  
      <div class="form-group">
        <label>Suffix Name: </label>
        <input type="text" name="xname" id="xname" class="form-control" placeholder="Ex: Jr." ng-model="personData.xname">
      </div>
      <br>
    </div>
    <div class="col-sm-8 col-md-8" style="border: 1px solid #f1f2f6;" style=" background: #ffffff;">
      <br>
      <div class="row">
        <div class="col-sm-4 col-md-4">
          <div class="form-group">
            <label>Course: <span class="req"> *</span></label>
            <select id="course" name="course" class="form-control" ng-model="personData.course" ng-change="change_course(personData.course)" required>
              <option ng-repeat="myCourse in course" ng-bind="myCourse.degreecode + ' ' + myCourse.course" ng-value="myCourse.code"></option>
            </select>
          </div>
        </div>
        <div class="col-sm-4 col-md-4">
          <div class="form-group">
            <label>Major:</label>
            <select class="form-control" name="major" id="major" ng-model="personData.major">
              <option ng-repeat="myMajor in retMajor" ng-bind="myMajor.fieldvalue" ng-value="myMajor.fieldname"></option>
            </select>
          </div>
        </div>

        <div class="col-sm-4 col-md-4">
          <div class="form-group">
            <label>Year Level:</label>
            <select class="form-control" name="year" id="year" ng-model="personData.year">
              <option ng-repeat="myYear in retYear" ng-bind="myYear.fieldvalue" ng-value="myYear.fieldname"></option>
            </select>
          </div>
        </div>


        <!-- SECTION COMMNET TEMPORARILY -->
        <!-- <div class="col-sm-4 col-md-4">
          <div class="form-group">
            <label>Section: </label>
            <input type="text" name="section" id="section" class="form-control" placeholder="A" ng-model="personData.section">
          </div>
        </div> -->
      </div>
      <div class="row">
        <div class="col-sm-4 col-md-4">
          <div class="form-group">
            <label for="gender">Gender: <span class="req"> *</span></label>
            <div style="margin-top: 13px; font-weight: bold;">
              <input type="radio" name="gender"  id="gender" value="Male" ng-model="personData.gender"> Male &nbsp;&nbsp;&nbsp;
              <input type="radio" name="gender"  id="gender" value="Female" ng-model="personData.gender">&nbsp;Female
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-4">
          <div class="form-group">
            <label>Civil Status: <span class="req"> *</span></label>
            <select class="form-control" name="civil" id="civil" ng-model="personData.civil" required>
              <option ng-repeat="myCivil in civilstatus" ng-bind="myCivil.name" ng-value="myCivil.value"></option>
            </select>
          </div>
        </div>
        <div class="col-sm-4 col-md-4">
          <div class="form-group">
            <label>Religion: </label>
            <input type="text" name="religion" id="religion" class="form-control" placeholder="Catholic" ng-model="personData.religion">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4 col-md-4">
          <div class="form-group">
            <label>Age: <span class="req"> *</span></label>
            <input type="text" name="age" class="form-control" ng-model="personData.age" placeholder="Age" ng-pattern="NumberRegex" required readonly>
            <span class="helpblock error invalid-data" ng-show="InformationNew.age.$error.pattern">Invalid Number</span>
          </div>
        </div>
        <div class="col-sm-4 col-md-4">
          <div class="form-group">
            <label>Height: <span class="req"> *</span></label>
            <input type="text" name="height" id="height" class="form-control" placeholder="cm" ng-model="personData.height" required>
          </div>
        </div>
        <div class="col-sm-4 col-md-4">
          <div class="form-group">
            <label>Weight: <span class="req"> *</span></label>
            <input type="text" name="weight" id="weight" class="form-control" placeholder="lbs" ng-model="personData.weight" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4 col-md-4">
          <div class="form-group">
            <label>Email: <span class="req"> *</span></label>
            <input type="text" name="email" id="email" class="form-control" placeholder="johndoe@rocketmail.com" ng-pattern="EmailRegex" ng-model="personData.email" required>
            <span class="helpblock error invalid-data" ng-show="InformationNew.email.$error.pattern">Invalid Email</span>
          </div>
        </div>
        <div class="col-sm-4 col-md-4">
          <div class="form-group">
            <label>Contact: <span class="req"> *</span></label>
            <input type="text" name="contact" id="contact" class="form-control" maxlength="11" placeholder="0909-XXXX" ng-model="personData.contact" required>
          </div>
        </div>
        <div class="col-sm-4 col-md-4">
          <div class="form-group">
            <label>Birthdate: <span class="req"> *</span></label>
            <input type="date" min="1900-01-01T00:00" max="2099-12-31T00:00" name="birthdate" id="birthdate" class="form-control" ng-model="personData.birthdate" ng-change="ChangeBirthdate(personData.birthdate)" required>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-4 col-md-4">
          <div class="form-group">
            <label>Entry Type: <span class="req"> *</span></label>
            <select name="entry" id="entry" class="form-control" ng-model="personData.entrytype" required>
              <option ng-repeat="type in entrytype" ng-bind="type.name" ng-value="type.name"></option>
            </select>
          </div>
        </div>
        <div class="col-sm-4 col-md-4">
          <div class="form-group">
            <label>Status: <span class="req"> *</span></label>
            <select name="status" id="status" class="form-control" ng-model="personData.status" required>
              <option ng-repeat="entStatus in entryStatus" ng-bind="entStatus.name" ng-value="entStatus.value"></option>
            </select>
          </div>
        </div>  
        <div class="col-sm-4 col-md-4">
          <div class="form-group">
            <label>Date Enrolled: <span class="req"> *</span></label>
            <input type="date" min="2000-01-01T00:00" max="2099-12-31T00:00" name="dateenrolled" id="dateenrolled" class="form-control" ng-model="personData.dateenrolled" required>
          </div>
        </div>          
      </div>
      <div class="row" style="margin-top: 10px; padding-bottom: 10px;">
        <div class="col-md-12 col-sm-12 text-right">
          <button class="btn btn-primary" type="Submit" ng-disabled="!InformationNew.$valid">Submit</button>
          <button class="btn btn-danger" type="button" ng-click="CancelAdd()">Cancel</button>
        </div>
      </div>
      <!-- END OF FORM -->
    </div>
  </div>
</form>