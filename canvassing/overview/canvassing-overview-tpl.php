<style>
  .arrow {
    background-color: red;
    position: relative;
    border: 2px solid #000000;
  }
</style>

<div ng-controller="CanvassingCtrl"> <!--- CONTANINER CLASS --->

  <div class="container-fluid">
    <div class="row main-container" >
      <div class="col-sm-6 col-md-6 col-lg-6">
        <h4 class="mb10">Overview as of <span ng-bind="datenow | date: 'medium'" style="color: red; font-weight: bold;"></span> </h4>
        <h5> <span class="text-muted">Total Population:</span> {{ TotalPopulation }}</h5>
        <h5> <span class="text-muted">Total Voted:</span> {{ TotalVoted }}</h5>
        <br>
        <div id="chrVotersCount">
        </div>

      </div>

      <div class="col-md-6">
        <div id="chrVotersVoted"></div>        
      </div>
    </div>
    <div class="row main-container mt10" style="min-height: 250px;padding-bottom: 10px;">
      <div class="col-sm-3 col-md-3 col-lg-3">
        <h5>Voting Countdown</h5>
        <div class="row">
          <div class="col-md-12">
            <div class="text-center">
              <img src="img/gif/clock.gif" style="width: 200px; height: 150px;">
            </div>
            <div class="row text-center" style="font-weight: bold; color: red;">
              <div class="col-sm-12 col-md-12">REMAINING</div>
            </div>
            <div class="row text-center">
              <div class="col-md-12" style="font-weight: bold;">
                <div>DAY&nbsp; HRS&nbsp; MIN&nbsp; SEC&nbsp; </div>
              </div>
            </div>
            <div class="row text-center">
              <div class="col-md-12">
                <div>20  :   21  :   02  :   16 </div>
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
        </div>
      </div>
      <div class="col-sm-9 col-md-9 col-lg-9">
        <h4>Vote Summary</h4>
        <br>
        <div class="table table-responsive">
          <table class="table table-sm table-hover">
            <thead class="thead-dark">
            <!-- <thead> -->
              <tr>
                <th>&nbsp;</th>
                <th>Course</th>
                <th>Population</th>
                <th>Voted count</th>
                <th>Percentage / course</th>
              </tr>
            </thead>
            <tbody class="text-muted">
              <tr ng-repeat="summary in Votesummary">
                <th>{{$index + 1}}</th>
                <td ng-bind="summary.course"></td>
                <td ng-bind="summary.course_population"></td>
                <td ng-bind="summary.course_vote"></td>
                <td ng-bind="(summary.percentage | number: 2) + '%'"></td>
              </tr>
            </tbody>
            <tfoot>
              <tr style="font-weight: bold;">
                <td>Total:</td>
                <td>&nbsp;</td>
                <td ng-bind="TotalPopSummary"></td>
                <td ng-bind="TotalVoteSummary"></td>
                <td ng-bind="((TotalVoteSummary / TotalPopSummary) * 100 | number: 2) + '%'"></td>
                <!-- <td ng-bind="(TotalPercentage | number: 2) + '%'"></td> -->
                <td>&nbsp;</td>
              </tr>
            </tfoot>
          </table>
        </div>

      </div>
    </div>
    <br>
  </div>


</div>