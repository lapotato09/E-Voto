<div class="container-fluid main-cont">
  <div class="row mb-3">
    <div class="col-md-12">

      <!-- TOP CONTAINER FOR PROFILE -->
      <div class="row pb-3 mr-md-0" id="components">
        <div class="col-12 col-md-4 col-lg-3 col-xl-2">
          <img src="../img/profile.jpg" class="rounded-circle profile-img" alt="Profile">
        </div>
        <div class="col-12 mt-5 col-md-8">
          <h3>Great day, 
            <span> 
              <?php
                session_start();
                echo $_SESSION['loggeduser']['firstname'];
              ?>!
            </span>
          </h3><small>(CHAIRMAN)</small>
          <hr>
        </div>
      </div>
      <!-- END OF PROFILE CONTAINER -->

      <!-- BOTTOM DASHBOARD CONTAINER -->
      <div class="row pb-3 mr-md-0 mt-3" id="components">
        <div class="col-12 col-lg-9">
          <div class="card parent-card">
            <div class="card-header">Shortcut</div>
            <div class="card-body text-center d-md-flex justify-content-center" >
              <div class="card internal-card mb-3 mr-3 mb-md-0">
                <div class="card-body text-center pr-lg-3 pl-lg-3 pr-xl-5 pl-xl-5">
                  <img src="https://img.icons8.com/wired/40/000000/overtime.png"/>
                </div>
                <div class="card-footer text-center">Schedule</div>
              </div>

              <div class="card internal-card mb-3 mr-3  mb-md-0">
                <div class="card-body text-center pr-lg-3 pl-lg-3 pr-xl-5 pl-xl-5">
                  <img src="https://img.icons8.com/ios/40/000000/speaker-notes.png"/>
                </div>
                <div class="card-footer text-center">Notes</div>
              </div>

              <div class="card internal-card mb-3 mr-3  mb-md-0">
                <div class="card-body text-center pr-lg-3 pl-lg-3 pr-xl-5 pl-xl-5">
                  <img src="https://img.icons8.com/ios/40/000000/test.png"/>
                </div>
                <div class="card-footer text-center">Exams</div>
              </div>

              <div class="card internal-card mb-3 mr-3  mb-md-0">
                <div class="card-body text-center pr-lg-3 pl-lg-3 pr-xl-5 pl-xl-5">
                  <img src="https://img.icons8.com/wired/40/000000/appointment-reminders.png"/>
                </div>
                <div class="card-footer text-center">Reminder</div>
              </div>
            </div>
          </div>
        </div>


        <!-- CountDown TPL -->
        <div class="col-lg-3">
          <div class="card in-cards" ng-class="{'text-muted': seconds === 0}">
            <div class="card-header text-center" ng-bind="ProcessList[0].processname + ' Countdown'" style="font-weight: bold; background: #0b0c10; color: white;"></div>
            <div class="card-body">
              <div class="row text-center" style="font-weight: bold;">
                <div class="col-sm-12 col-md-12">REMAINING</div>
              </div>
              <div class="row text-center">
                <div class="col-md-12">
                  <div>DAY&nbsp; HRS&nbsp; MIN&nbsp; SEC&nbsp; </div>
                </div>
              </div>
              <div class="row text-center">
                <div class="col-md-12">
                  <div>{{ days }} &nbsp;: &nbsp; {{ hours }} &nbsp;: &nbsp; {{ minutes }} &nbsp;: &nbsp; {{ seconds }} </div>
                </div>
              </div>

              <div class="row text-center">
                <div class="col-md-12">
                  <br>
                  <span style="font-weight: bold;"> DEADLINE:</span>
                  <div ng-bind="(EnddatePrase | date: 'medium')"></div>
                </div>
              </div>
            </div>
          </div>

          <!-- <h5 ng-bind="ProcessList[0].processname + ' Countdown'"></h5>
          <div class="row">
            <div class="col-md-12">
              <div class="text-center">
                <img src="img/gif/clock.gif" style="width: 200px; height: 150px;">
              </div>
              <div class="row text-center" style="font-weight: bold;">
                <div class="col-sm-12 col-md-12">REMAINING</div>
              </div>
              <div class="row text-center">
                <div class="col-md-12">
                  <div>DAY&nbsp; HRS&nbsp; MIN&nbsp; SEC&nbsp; </div>
                </div>
              </div>
              <div class="row text-center">
                <div class="col-md-12">
                  <div>{{ days }} &nbsp;: &nbsp; {{ hours }} &nbsp;: &nbsp; {{ minutes }} &nbsp;: &nbsp; {{ seconds }} </div>
                </div>
              </div>

              <div class="row text-center">
                <div class="col-md-12">
                  <br>
                  <span style="font-weight: bold; color: red;"> DEADLINE:</span>
                  <div>Oct 31, 2022 2:23:00 PM</div>
                </div>
              </div>

            </div>
          </div>
          <div class="row" style="margin-top: 5px;">
            <div class="col-md-12 text-center">
              <button class="btn btn-primary btn-block" type="button" ng-click="blockUI()">Close Voting</button>
            </div>
          </div> -->

        </div>



      </div>
      <!-- END DASHBOARD CONTAINER -->

      <!-- START OF ANNOUNCEMENT CONTAINER -->
      <div class="row mr-md-0 mt-3" id="components" ng-show="Announcement.length > 0">
        <div class="col-12">
          <h5>Post and Announcement</h5>
          <hr>
          <div class="card parent-card" ng-repeat="myAnnouncement in Announcement">
            <div class="card-header" ng-bind="myAnnouncement.title">
            </div>
            <div class="card-body">
              <h6 ng-bind="('Subject: ' + myAnnouncement.subject)"></h6>
              <hr>
              <div ng-bind="myAnnouncement.content"></div>
            </div>
            <div class="card-footer">
              <div ng-bind="'Posted: ' + (myAnnouncement.dateposted | date: 'medium' )"></div>
            </div>
          </div>
        </div>      
      </div>
      <!-- END OF ANNOUNCEMENT CONTAINER  -->
    </div>
  </div>
</div>



