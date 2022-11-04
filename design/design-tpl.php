<link rel="stylesheet" type="text/css" href="../lib/custom/design/design-person.css">

<div class="container-fluid main" ng-controller="DesignCtrl">
  <div class="container-fluid main-tab">
    <!-- <ul class="nav nav-tabs nav-header">
      <li class="nav-item" >
        <a href="" class="nav-link active tab1" data-toggle="tab" ng-click="ChangeTpl('person')"><b><h6>PERSON</h6></b></a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link tab2" data-toggle="tab" ng-click="ChangeTpl('organization')"><h6>ORGANIZATION</h6></a>
      </li>
      <li class="nav-item ">
        <a href="" class="nav-link tab4" data-toggle="tab" ng-click="ChangeTpl('officer')"><h6>OFFICER</h6></a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link" data-toggle="tab" ng-click="ChangeTpl('masterlist')"><h6>MASTERLIST</h6></a>
      </li>
      <div class="animation start"></div>design
    </ul> -->

    <div class="card" style="width: 100%;">
      <div class="card-header" style="background: #4484ce;">

        <div class="row">
          <div class="col-md-12 col-lg-12">         
            <select class="form-control" ng-click="ChangeTpl(template)" ng-model="template">
              <option value="person">Person</option>
              <option value="organization">Ogranization</option>
              <option value="officer">Officer</option>
              <option value="masterlist">Masterlist</option>
              <option value="login">Setup Login</option>
            </select>
          </div>
        </div>
      </div>
    </div>


    <div class="tab-content">
      <div ng-include="Template"></div>
    </div>
  </div>

  

</div>
