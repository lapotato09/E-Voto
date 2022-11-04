<style>
  .myModal {
    width: 800px;
    /*position: absolute;*/
    /*top: 20px;*/
    left: -130px;
  }

</style>

<div class="modal-content myModal">
  <div class="modal-header">
    <div class="modal-title">
      <p style="font-size: 20px; font-weight: bold;">UPDATE [{{details.schoolidno}}]</p>
    </div>
  </div>
  <div class="modal-body">
    <form name="UpdateForm" class="needs-validation" ng-submit="SaveUpdate(UpdateForm.$valid, details)" novalidate>
      <div ng-form="UpdateFormNew">
        <div class="row">
          <div class="col-md-6 form-group">
            <label for="lname" class="text-muted">Last Name <span style="color: red;">*</span></label>
            <input type="text" name="lname" id="lname" class="form-control" ng-model="details.lastname" required>
          </div>
          <div class="col-md-6 form-group">
            <label for="fname" class="text-muted">First Name <span style="color: red;">*</span></label>
            <input type="text" name="fname" id="fname" class="form-control" ng-model="details.firstname" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="mname" class="text-muted">Middle Name </label>
            <input type="text" name="mname" id="mname" class="form-control" ng-model="details.middlename">
          </div>
          <div class="col-md-6">
            <label for="exname" class="text-muted">Extension Name</label>
            <input type="text" name="exname" id="exname" class="form-control" ng-model="details.nameex">
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-4 form-group">
            <label for="course" class="text-muted">Course <span style="color: red;">*</span></label>
            <select class="form-control" name="course" id="course" ng-change="change_course(details.course)" ng-model="details.course" required>
              <option ng-repeat="myCourse in course" ng-bind="myCourse.degreecode + ' ' + myCourse.course" ng-value="myCourse.code"></option>
            </select>
          </div>
          <div class="col-md-4 form-group">
            <label for="year" class="text-muted">Year Level <span style="color: red;">*</span></label>
            <select class="form-control" name="year" id="year" ng-model="details.year">
              <option ng-repeat="myYear in retYear" ng-bind="myYear.fieldvalue" ng-value="myYear.fieldname"></option>
            </select>
          </div>
          <div class="col-md-4 form-group">
            <label for="major" class="text-muted">Major</label>
            <select class="form-control" name="major" id="major" ng-model="details.major">
              <option ng-repeat="myMajor in retMajor" ng-bind="myMajor.fieldvalue" ng-value="myMajor.fieldname"></option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 form-group">
            <label for="gender" class="text-muted">Gender <span style="color: red;">*</span></label>
            <!-- <input type="text" name="gender" id="gender" class="form-control" ng-model="details.gender" required> -->
            <select class="form-control" name="gender" id="gender" ng-model="details.gender" required>
              <option ng-repeat="mygender in gender" ng-bind="mygender.name" ng-value="mygender.name"></option>
            </select>
          </div>
          <div class="col-md-4 form-group">
            <label for="civil" class="text-muted">Civil Status <span style="color: red;">*</span></label>
            <select class="form-control" id="cstatus" name="cstatus" ng-model="details.civilstatus" required>
              <option ng-repeat="status in civilstatus" ng-bind="status.name" ng-value="status.value"></option>
            </select>
          </div>
          <div class="col-md-4 form-group">
            <label for="religion" class="text-muted">Religion</label>
            <input type="text" name="religion" id="religion" class="form-control text-muted" ng-model="details.religion">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 form-group">
            <label for="age" class="text-muted">Age <span style="color: red;">*</span></label>
            <input type="text" name="age" id="age" class="form-control" ng-model="details.age" ng-pattern="NumberRegex" required>
            <span class="helpblock error invalid-data" ng-show="UpdateFormNew.age.$error.pattern">Invalid number</span>
          </div>
          <div class="col-md-4 form-group">
            <label for="height" class="text-muted">Height (cm) <span style="color: red;">*</span></label>
            <input type="text" name="height" id="height" class="form-control" ng-model="details.height" required>
          </div>
          <div class="col-md-4 form-group">
            <label for="weight" class="text-muted">Weight (lbs) <span style="color: red;">*</span></label>
            <input type="text" name="weight" id="weight" class="form-control" ng-model="details.weight" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 form-group">
            <label for="email" class="text-muted">Email <span style="color: red;">*</span></label>
            <input type="text" name="email" id="email" class="form-control" ng-model="details.email" ng-pattern="EmailRegex" required>
            <span class="helpblock error invalid-data" ng-show="UpdateFormNew.email.$error.pattern">Invalid Email</span>
          </div>
          <div class="col-md-4 form-group">
            <label for="contact" class="text-muted">Contact <span style="color: red;">*</span></label>
            <input type="text" name="contact" id="contact" class="form-control" ng-model="details.contact" required> 
          </div>
          <div class="col-md-4 form-group">
            <label for="birthpe" class="text-muted">Birthday <span style="color: red;">*</span></label>
            <input type="date" name="birthdate" id="birthdate" class="form-control"  ng-model="details.ldbirthdate" ng-value="details.birthdate | date: 'yyyy-MM-dd' " readonly>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-4 form-group">
            <label for="type" class="text-muted">Type <span style="color: red;">*</span></label>
            <select class="form-control" name="type" id="type" ng-model="details.entrytype" required>
              <option ng-repeat="type in entrytype" ng-bind="type.name" ng-value="type.name"></option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="status" class="text-muted">Status <span style="color: red;">*</span></label>
            <select class="form-control" id="status" name="status" ng-model="details.status" required>
              <option ng-repeat="mystatus in schoolstatus" ng-bind="mystatus.name" ng-value="mystatus.name"></option>
            </select>
          </div>
          <div class="col-md-4 form-group">
            <label for="dateenrolled" class="text-muted">Date Enrolled <span style="color: red;">*</span></label>
            <input type="date" name="dateenrolled" max="2099-12-31T00:00" id="dateenrolled" class="form-control" ng-model="details.lddateenrolled" ng-value="details.dateenrolled | date: 'yyyy-MM-dd'" readonly>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-right">
            
            <p class="text-left text-muted"><small><b>Note: </b><i>Please fill out all the necessary field.</i></small></p>
            <button class="btn btn-success" type="Submit" ng-disabled="!UpdateForm.$valid">Save</button>
            <button class="btn btn-danger" type="button" ng-click="closeModal()">Cancel</button>          
          </div>
        </div>
      </div>

    </form>
    <br>
  </div>
</div>