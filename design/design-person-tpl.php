<div class="container-fluid">
  <div class="row search-div" ng-show="SearchDiv">
    
    <div class="container-fluid">
      <div class="row" style="margin-top: 10px;">       
        <div class="col-sm-3 col-md-3 form-group">
          <input type="text" class="form-control" id="idnumber" placeholder="ID No." ng-keypress="KeyPress($event,searchForm)" ng-model="searchForm.idno">
        </div>
        <div class="col-sm-6 col-md-6 form-group">
          <input type="text" class="form-control" id="name" placeholder="Juan Dela Cruz" ng-keypress="KeyPress($event,searchForm)" ng-model="searchForm.person">
        </div>
        <div class="col-sm-3 col-md-3 form-group">
          <button class="btn btn-primary" type="button" id="searchbtn" ng-click="CmdSearch(searchForm)">Search</button>
          <button class="btn btn-success" type="button" ng-click="CmdAdd()"><span><b>&plus;&nbsp;</b></span>Add New</button>
        </div>
      </div>
    </div>
  </div>


  <!-- DATA ELEMENT THAT HOLDS THE PERSON INFORMATION -->
  <span ng-show="ShowLabelRecords"><br>No record(s) found.</span>
  <div class="row" ng-show="Loading">
    <div class="col-sm-12 text-center">
      <img style="width:50px; height:50px; text-align: center; margin-top: 100px;" src="/lib/img/loading.gif">
    </div>
  </div>

  <div class="row" id="datadiv" ng-repeat="person in personlist" ng-show="WithRecords">
    <div class="col-sm-4 col-md-4 col-lg-4" id="leftdiv">
      <br>
      <div class="row text-center">
        <div class="container">
          <img src="../img/profile/{{person.gender}}.PNG" class="rounded-circle img-div">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 per-details-first">
          <label ng-bind="SentenceCase(person.firstname)"></label>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 per-details-last">
          <label ng-bind="SentenceCase(person.lastname)"></label>
          <label ng-if="person.nameex" ng-bind="SentenceCase(person.nameex + '.')"></label>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 per-details-lrn">
          <label ng-bind="SentenceCase(person.schoolidno)"></label>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2 col-md-2 col-lg-2 per-details-lrn"></div>
        <div class="col-sm-8 col-md-8 col-lg-8 per-details-lrn">
          <hr>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2 per-details-lrn"></div>
      </div>
      <!-- <div class="row">
        <div class="container-fluid" style="position: absolute; bottom: 0; background: white; height: 50px;">
          &nbsp;
        </div>
      </div> -->
    </div>
    <div class="col-sm-8 col-md-8 col-lg-8" id="rightdiv">
      <div class="row">
        <div class="col-sm-4 col-md-4 form-group">
          <label>Course:</label>
          <div class="form-control" id="lblValue" ng-bind="person.course"></div>
        </div>
        <div class="col-sm-4 col-md-4 form-group">
          <label class="margin-bottom-0">Major:</label>
          <div class="form-control" id="lblValue" ng-bind="SentenceCase(person.major)"></div>
        </div>        
        <div class="col-sm-4 col-md-4 form-group">
          <label class="margin-bottom-0">Year level:</label>
          <div class="form-control" id="lblValue" ng-bind="person.year">Fourth year</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4 col-md-4 form-group">
          <label class="margin-bottom-0">Gender:</label>
          <div class="form-control" id="lblValue" ng-bind="SentenceCase(person.gender)"></div>
        </div>
        <div class="col-sm-4 col-md-4 form-group">
          <label class="margin-bottom-0">Civil Status:</label>
          <div class="form-control" id="lblValue" ng-bind="SentenceCase(person.civilstatus)"></div>
        </div>
        <div class="col-sm-4 col-md-4 form-group">
          <label class="margin-bottom-0">Religion:</label>
          <div class="form-control" id="lblValue" ng-bind="SentenceCase(person.religion)"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4 col-md-4 form-group">
          <label class="margin-bottom-0">Age:</label>
          <div class="form-control" id="lblValue" ng-bind="person.age"></div>
        </div>
        <div class="col-sm-4 col-md-4 form-group">
          <label class="margin-bottom-0">Height(cm):</label>
          <div class="form-control" id="lblValue" ng-bind="person.height"></div>
        </div>
        <div class="col-sm-4 col-md-4 form-group">
          <label class="margin-bottom-0">Weight(lbs):</label>
          <div class="form-control" id="lblValue" ng-bind="person.weight"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4 col-md-4 form-group">
          <label class="margin-bottom-0">Email:</label>
          <div class="form-control" id="lblValue" ng-bind="person.email"></div>
        </div>
        <div class="col-sm-4 col-md-4 form-group">
          <label class="margin-bottom-0">Contact:</label>
          <div class="form-control" id="lblValue" ng-bind="person.contact"></div>
        </div>
        <div class="col-sm-4 col-md-4 form-group">
          <label class="margin-bottom-0">Birthday</label>
          <div class="form-control" id="lblValue" ng-bind=" (person.birthdate | date: 'MMM dd, yyyy') "></div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <label class="margin-bottom-0">Type:</label>
          <div class="form-control" id="lblValue" ng-bind="SentenceCase(person.entrytype)"></div>
        </div>
        <div class="col-sm-4 col-md-4 form-group">
          <label class="margin-bottom-0">Date Enrolled:</label>
          <div class="form-control" id="lblValue" ng-bind=" (person.dateenrolled | date: 'MMM dd, yyyy') "></div>
          <!-- <div class="form-control" id="lblValue" ng-bind=" (person.dateenrolled | date: 'MM/dd/yyyy') "></div> -->
        </div>
        <div class="col-sm-4 col-md-4 form-group">
          <label class="margin-bottom-0">Status:</label>
          <div class="form-control" id="lblValue"  ng-bind="person.status"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 text-right">
            <button class="btn btn-danger" type="button" ng-click="Update(person)">Update</button>
        </div>
      </div>
    </div>    
  </div>


  <!-- FORM FOR NEW PERSON DATA -->

  <div class="row" id="FormPerson" ng-show="ShowForm">
    <div class="col-sm-12 col-md-12">
      <?php
        include '../includes/dataform.inc'
      ?>
    </div>
  </div>
</div>
