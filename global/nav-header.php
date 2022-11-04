<style type="text/css">
	nav {
		/*background: #0b0c10;*/
    /*background: #ffffff;*/
    background: #0b0c10;
		font-family: "Oswald" , sans-serif;
    /*color: #77a6f7;*/
    /*color: red;*/
    font-color: black;
	}
</style>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01" style="color: red;">
    <a class="navbar-brand nav-link" href="" onclick="window.location.href = '../dashboard'" style="font-weight: bold;"> E-Voto </a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="" onclick="window.location.href = '../dashboard'">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Movement</a>
      </li>
    </ul>
    <div class="dropdown">
    	<button type="button" class="btn btn-link dropdown-toggle" style="color: gray;" data-toggle="dropdown">
        <img src="https://img.icons8.com/cotton/30/000000/guest-male.png"/>
      </button>
    	<div class="dropdown-menu dropdown-menu-right">
    		<a href="#" class="dropdown-item">   
          <span><img src="https://img.icons8.com/color/30/000000/circled-user-male-skin-type-1-2.png"/>
                  <?php echo strtoupper($_SESSION['loggeduser']['firstname']);?></span>
        </a>
    		<a href="#" class="dropdown-item"><span> <img src="https://img.icons8.com/color/30/000000/settings.png"/>&nbsp;Settings</span></a>
    		<div class="dropdown-divider"></div>
        <a class="dropdown-item" onclick="window.location.href = '../logout/'">
          <span> <img src="https://img.icons8.com/color/30/000000/exit.png"/>&nbsp;Logout</span>
        </a>       
    		
    	</div>
    </div>
  </div>
</nav>
<br>
<br>
<br>