<style>
  #config {
    border-radius: 5px;
    background: white;
    min-height: 670px;
    padding: 10px;
    box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
  }

  .selectui {
    width: 100%;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
  }

  .selectui:active {
    background: red;
    color: red;
  }

  .selectui:visited {
    background: green;
    color: green;
  }

  .selectui:focus {
    background: blue;
    color: blue;
  }

  .selectui:after {
    background: blue;
    color: blue;
  }

  .select2 > .select2-choice.ui-select-match {
    /* Because of the inclusion of Bootstrap */
    height: 29px;
  }

  .selectize-control > .selectize-dropdown {
    top: 36px;
  }

  .ui-select-dropdown {
    opacity: 1 !important;
  }

  .ui-select-choices {
    min-height: 100px;
    opacity: 1 !important;
    display: block;
  }

  .ui-select-match:active {
    outline: none !important;
  }

</style>

<div ng-controller="CanvassingProcessingCtrl">
  <div class="container-fluid">
    <div class="row main-container" style="padding-bottom: 20px;">
      <div class="col-md-10" style="border-right: 2px solid #f8f8ff;">
        <!-- card for candidates -->
        <div ng-show="Initialized">

          <div class="row mb20 mt5">
            <div class="col-md-9">
              <ui-select name="name" class="selectui" ng-model="Param.position" theme="bootstrap" sortable="true" required>
                <ui-select-match placeholder="Position...">{{$select.selected.fieldname}}</ui-select-match>
                <ui-select-choices repeat="position in PositionList | filter: $select.search">
                  <div ng-bind-html="position.fieldname | highlight: $select.search"></div>
                </ui-select-choices>
              </ui-select>

            </div>
            <div class="col-md-2">
              <button class="btn btn-primary btn-block"><i class="fa fa-magnifying-glass"></i></button>
            </div>
          </div>

          <div>
            <div style="padding: 10px; font-weight: bold; background: #f8f8ff; border-top: 4px solid #04b3dd; border-top-left-radius: 5px; border-top-right-radius: 5px;">
              Candidate(s) for President with partial vote counts.
              <span style="position: absolute; right: 0; padding-right: 30px; color: red;" ng-bind="datenow | date: 'medium'"></span>
            </div>

            <div class="table" style="padding: 20px; border: 2px solid #f8f8ff; border-radius: 5px;">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>&nbsp;</th>
                    <th>Ballot No.</th>
                    <th>Name</th>
                    <th>Unofficial Vote Count(s)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>&nbsp;</td>
                    <td>1</td>
                    <td>Leogie Dela Pena</td>
                    <td>100</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>2</td>
                    <td>Leogie Dela Pena</td>
                    <td>100</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>3</td>
                    <td>Leogie Dela Pena</td>
                    <td>100</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>4</td>
                    <td>Leogie Dela Pena</td>
                    <td>100</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>5</td>
                    <td>Leogie Dela Pena</td>
                    <td>100</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>6</td>
                    <td>Leogie Dela Pena 1</td>
                    <td>200</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>7</td>
                    <td>Leogie Dela Pena 2</td>
                    <td>200</td>
                  </tr>
                </tbody>
              </table>

            </div>
          </div>

        </div>

        <div ng-show="!Initialized">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
              <h4>Canvassing Process is not yet initialized. Wait for the election officer.</h4>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-2 text-center">
        <ul style="list-style: none;">
          <li class="mb10">
            <button class="btn btn-success btn-block" data-toggle="tooltip" title="Clean Up" ng-click="CleanUpPost()">
              <i class="fa fa-broom"></i>
            </button>
          </li>
          <li class="mb10">
            <button class="btn btn-primary btn-block" data-toggle="tooltip" title="Initializiation">
              <i class="fa fa-rocket"></i>
            </button>
          </li>
          <li class="mb10">
            <button class="btn btn-danger btn-block" data-toggle="tooltip" title="Start Vote Count"> <!-- Start Vote count --> 
              <i class="fa fa-poll-h"></i>
            </button>
          </li>
          <li class="mb10">
            <button class="btn btn-danger btn-block"> <!-- retrigger Vote count --> 
              <i class="fa fa-poll-h"></i>
            </button>
          </li>
          <li>
            <button class="btn btn-danger btn-block"> <!-- Finalize Vote count --> 
              <i class="fa fa-poll-h"></i>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </div>



</div>
