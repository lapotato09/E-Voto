<link rel="stylesheet" type="text/css" href="../lib/custom/signup.css">
<div class="main">
  <header class="signupHeader">
  </header>
  <div class="signUpCont">
    <div class="row">      
      <div class="left-cont col-sm-6 col-md-6 col-lg-6">
        <div class="SignUp">
          <h3 class="text-center">YAccounts <span><img id="logo" src="../img/logo1.png"></span></h3>
          <hr>
          <form name="signUpFrm" ng-submit="submitForm(signUpFrm.$valid, CreateAcc)" novalidate>
            <h6>Personal</h6>
            <div class="form-row">
              <div class="form-group col-md-4 mb-3" ng-class="{ 'has-error' : signUpFrm.fname.$invalid && !signUpFrm.fname.$pristine }">
                <label for="validationCustom01">First name <span class="req">*</span></label>
                <input type="text" name="fname" class="form-control" id="validationCustom01" placeholder="John" ng-model="CreateAcc.fname" required>
                <p class="req" ng-show="signUpFrm.fname.$invalid && !signUpFrm.fname.$pristine">First name is required.</p>
              </div>
              <div class="form-group col-md-4 mb-3" ng-class="{ 'has-error' : signUpFrm.lname.$invalid && !signUpFrm.lname.$pristine }">
                <label for="validationCustom02">Last name <span class="req">*</span></label>
                <input type="text" name="lname" class="form-control" id="validationCustom02" placeholder="Doe" ng-model="CreateAcc.lname" required>
                <p class="req" ng-show="signUpFrm.lname.$invalid && !signUpFrm.lname.$pristine">Last name is required.</p>
              </div>
              <div class="form-group col-md-4 mb-3">
                <label for="validationCustom03">Middle name</span></label>
                <input type="text" class="form-control" id="validationCustom03" placeholder="Tes" ng-model="CreateAcc.mname" value="">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6 mb-3" ng-class="{'has-error' : signUpFrm.email.$invalid && signUpFrm.email.$pristine }">
                <label for="validationCustom04">Email <span class="req">*</span></label>
                <input type="email" class="form-control" name="email" id="validationCustom04" placeholder="Johndoe@rocketmail.com" ng-model="CreateAcc.email" required>
                <p class="req" ng-show="signUpFrm.email.$invalid && !signUpFrm.email.$pristine">Please fill out correctly</p>
              </div>
              <div class="form-group col-md-3 mb-3" ng-class="{'has-error' : signUpFrm.mobile.$invalid && signUpFrm.mobile.$pristine }">
                <label for="validationCustom05">Mobile <span class="req">*</span></label>
                <input type="" class="form-control" name="mobile" id="validationCustom05" placeholder="Mobile" maxlength="11" ng-model="CreateAcc.mobile" number-only required>
                <p class="req" ng-show="signUpFrm.mobile.$invalid && !signUpFrm.mobile.$pristine">Mobile is required</p>
              </div>
              <div class="form-group col-md-3 mb-3">
                <label for="validationCustom06">Gender <span class="req">*</span></label>
                <select class="form-control" name="" id="validationCustom06" placeholder="Gender" ng-model="CreateAcc.gender">
                  <option>Male</option>
                  <option>Female</option>
                </select>
              </div>
            </div>
            <hr>
            <h6>Account</h6>
            <div class="form-row">
              <div class="form-group col-md-4 mb-3" ng-class="{ 'has-error': signUpFrm.username.$invalid && signUpFrm.username.$pristine }">
                <label for="validationCustom07">Username <span class="req">*</span></label>
                <input type="text" name="username" class="form-control" id="validationCustom07" placeholder="Username" ng-model="CreateAcc.username"  required>
                <p class="req" ng-show="signUpFrm.username.$invalid && !signUpFrm.username.$pristine"> Username is required.</p>
              </div>
              <div class="form-group col-md-4 mb-3" ng-class="{ 'has-error': signUpFrm.password.$invalid && signUpFrm.password.$pristine }">
                <label for="validationCustom08">Password <span class="req">*</span></label>
                <input type="password" name="password" class="form-control" id="validationCustom08" placeholder="Password" ng-model="CreateAcc.pass"  required>
                <p class="req" ng-show="signUpFrm.password.$invalid && !signUpFrm.password.$pristine"> Password is required.</p>
              </div>
              <div class="form-group col-md-4 mb-3" ng-class="{ 'has-error': signUpFrm.confpass.$invalid && signUpFrm.confpass.$pristine }">
                <label for="validationCustom09">Confirm Password <span class="req">*</span></label>
                <input type="password" name="confpass" class="form-control" id="validationCustom09" placeholder="Confirm Password" ng-model="CreateAcc.confpass"  required>
                <p class="req" ng-show="signUpFrm.confpass.$invalid && !signUpFrm.confpass.$pristine"> This field is required.</p>
              </div>
            </div>
            <button class="btn" type="submit">Submit</button>
          </form>

        </div>
      </div> 
    </div>
  </div>
</div>



