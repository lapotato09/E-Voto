<!-- login css -->
<link rel="stylesheet" type="text/css" href="../lib/custom/landing.css">

<div>
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-10 mb-2 col-md-10 main">
        <div class="row text-right">
          <div class="col-12">
            <div style="font-weight: bold; font-size: 28px;">E-Voto</div>
          </div>
        </div>  
        <div class="row">
          <div class="col-lg-5">
            <span style="font-weight: bold; font-size: 32px;">Welcome Back!</span><br>
            <span style="color: gray; font-size: 17px;">Login to continue</span>
            <hr>
            <div>
              <form name="LoginFrm" class="loginform text-center">
                <!-- <h4>Signin</h4> -->
                
                <div class="form-group">
                  <div ng-show="!LoggedOn" class="alert alert-danger" >
                    <strong>Authentication failed!</strong>
                  </div>
                </div>
                <div class="form-group">
                  <input class="form-control" name="user" placeholder="Username" ng-model="Account.user" type="text" ng-required="true">
                  <span ng-show="LoginFrm.user.$invalid && LoginFrm.btn.$touched" class="req"> 
                    This is the required field. 
                  </span> 
                </div>
                <div class="form-group">
                  <input class="form-control" name="password" id="password" placeholder="Password" ng-model="Account.pass" type="password" ng-required="true">
                  <!-- <i class="fa fa-eye" style="margin-left: -100px;"></i> -->
                  <span ng-show="LoginFrm.password.$invalid && LoginFrm.btn.$touched" class="req"> 
                    This is the required field. 
                  </span> 
                </div>
                <div class="text-left" style="margin-bottom: 10px;">
                  <input type="checkbox" name="showpass" id="showpass" ng-model="showpass"> <span>Show Password</span>
                </div>
                <button style="width: 120px; padding: 10px;" name="btn" class="btn btn-primary" type="submit" ng-click="LoginFrm.user.$valid && LoginFrm.password.$valid && GetAccount(Account)">Sign In</button>
                <hr>
                <small>Forgot password? Click <a href="#">here!</a></small>
              </form>
            </div>
            </div>
            <div class="col-md-8 col-lg-8 text-center">
              &nbsp;
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>

  

</div>

