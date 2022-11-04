<style>
  .page-wrapper-con {
    background: #ffffff;
    margin-top: 0;
    border-style: dashed;
    border-width: 13px 8px;
    font-family: 'Arial';
  }

  .candidate-container {
    background-color: #ecf0f1;
    height: 63px;
    padding-top: 5px;
    padding-bottom: 5px;
    border-radius: 5px;
    cursor: pointer;
    padding-left: 20px;
    margin-bottom: 10px;
  }

  .main-label {
    font-size: 12px;
    font-weight: bold;
  }

  .sub-label {
    font-size: 10px;
    font-style: italic;
    font-weight: normal;
  }

  #profile-img {
    margin-top: 5px;
    width: 40px;
    height: 40px;
    cursor: pointer;
    transition: transform 1s;
    object-fit: cover;
  }

  .cat-header {
    padding: 10px 0;
    background: #4484ce;
    color: white;
    font-size: 15px;
    font-weight: bold; 
  }

  .candidate-name {
    font-size: 12px;
  }

  .body-footer {
    background: #ecf0f1;
    margin-top: 100px;
    margin-bottom: 20px;
    margin-left: 2px;
    margin-right: 2px;
    padding-top: 20px;
    padding-bottom: 70px;
  }

  .body-footer button {
    /*font-weight: bold;*/
  }

  .candidate-container label{
      overflow: hidden;
      position: relative;
  }
  .imgbgchk:checked + label>.tick_container{
      opacity: 1;
  }

/* ANIMATION */
  .imgbgchk:checked + label>img{
      transform: scale(1.25);
      opacity: 0.3;
  }
  .tick_container {
      transition: .5s ease;
      opacity: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      cursor: pointer;
      text-align: center;
  }
  .tick {
      background-color: #4CAF50;
      color: white;
      font-size: 16px;
      padding: 6px 12px;
      height: 40px;
      width: 40px;
      border-radius: 100%;
  }

</style>


<div class="container page-wrapper-con">

  <br>
  <div class="row header text-gray mt50">
    <div class="col-md-6">
      <div>
        <p>
          <span class="text-gray mt20">OFFICIAL BALLOT</span>
          <br> <b>May 13, 2022 - EARIST ISG ELECTION</b>
          <br>  EARIST - General Mariano Alvarez, Cavite
          <br>  Commission on Student Election
        </p>
      </div>
    </div>
    <div class="col-md-6 text-right">
      <div>
        <br>
        <br>
        <p>
          Student ID number: <b> 20201-044</b>
          <br>Precint ID no: <b> 2021-04444 </b>
        </p>
      </div>
    </div>

  </div>
  <hr>
  <div class="body">

    <div ng-repeat="settings in VotingSettings" ng-init="$posCode = settings.fieldcode.substring(0,4)">
      <h4 class="text-center cat-header mt10" ng-bind="settings.fieldcode + ' / Vote for ' + settings.fieldvalue"></h4>
      <span class="text-center" ng-if="OrganizedList[settings.fieldcode].list.length == 0">No candidate.</span>
      <div class="row mt10" id="row-pres">

        <div class="col-md-12">
          <div class="row" ng-repeat="candid in ExtractedCandidate[settings.fieldcode]">
            <div class="col-md-3" ng-repeat="details in candid">
              <div class="candidate-container">
                <input type="checkbox" name="$posCode + {{details.lastname}}" id="{{details.lastname}}" class="d-none imgbgchk" ng-value="details.lastname + details.firstname" ng-model="votersVote[$posCode][$posCode + details.code]" ng-change="pinVote(details.code, OrganizedList[settings.fieldcode].settings)">
                <label for="{{details.lastname}}">
                  <img id="profile-img" src="../img/profile.jpg" class="rounded-circle profile-img" alt="Profile">
                  <div class="tick_container">
                    <div class="tick"><i class="fa fa-check"></i></div>
                  </div>
                  <span class="main-label" style="text-transform: uppercase;" ng-bind="(details.no + '. ' + details.lastname + ', ' + details.firstname +' ' + details.exname)"></span>
                  <span class="sub-label" style="text-transform: uppercase;" ng-bind="'(' + details.partylist + ')'"></span>
                </label>
              </div>
            </div>
          </div>
        </div>   
      </div>
    </div>

   <div class="row body-footer">
      <div class="col-md-12 text-right">
        <button class="btn btn-danger" ng-click="ShowVotingTpl()">Cancel</button>
        <button class="btn btn-primary" ng-click="SubmitVotes(votersVote)">Submit Vote <i class="fa fa-save"></i></button>
      </div>
    </div>
  </div>

