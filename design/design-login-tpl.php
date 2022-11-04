<style>
  .command {
    background: #f8f8ff;
    padding: 10px;
    margin-top: 20px;
    border-top: 5px solid #f1f2f6;
  }

  .req {
    color: red;
  }

  .has-error {
    border-color: red;
  }

</style>


<div class="container" style="margin-top: 20px;">
  <form name="frmLoginSetup" novalidate>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label class="text-muted">ID No:</label>
          <input type="text" name="idno" class="form-control" ng-model="loginDetails.idno" ng-keypress="findLogin($event, loginDetails)">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="text-muted">Person Name: <span class="req"> *</span></label>
          <input type="text" name="name" class="form-control" ng-model="login.fullname" readonly required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="text-muted">Email: <span class="req"> *</span></label>
          <input type="text" name="email" class="form-control" ng-model="login.email" readonly required>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label class="text-muted">Login Name: <span class="req"> *</span></label>
          <input type="text" name="loginname" class="form-control" ng-model="login.loginname" ng-disabled="tempDisabled" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="text-muted">Password: <span class="req"> *</span></label>
          <input type="password" name="password" class="form-control" ng-model="login.password" ng-class="{'has-error': passShort}" ng-disabled="tempDisabled" required>
          <div class="req" ng-show="passShort"><small><i class="fa fa-info-circle"></i> Use 8 characters or more for your passsword.</small></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="text-muted">Confirm Password: <span class="req"> *</span></label>
          <input type="password" name="conpass" class="form-control" ng-model="login.confirmpassword" ng-class="{'has-error': PassNotMatch}" ng-disabled="tempDisabled" required>
          <span ng-show="PassNotMatch" class="req"><small> Password does not match.</small></span>
        </div>
      </div>
    </div>

    <div class="row command">
      <div class="col-md-12 text-right">
        <button class="btn btn-link" ng-click="Reset()">Reset</button>
        <button class="btn btn-primary" ng-disabled="frmLoginSetup.$invalid || passShort || PassNotMatch" ng-click="SaveLogin(frmLoginSetup, login)">Save <i class="fa fa-save" style="color: white;"></i></button>
      </div>
    </div>

  </form>
  

</div>