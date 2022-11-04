<link href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="global/sidebar/sidebar.css">
<link rel="stylesheet" href="../../fa/css/all.css">

  <div ng-controller="SidebarCtrl">
    <div class="greet" style="margin-left: -6%; margin-right: -6%; min-height: 760px;">
      <ul class="sidebar-nav nav flex-column" id="parentCollapse">        
        <?php if (in_array('ACDB00001', $_SESSION['loggeduser']['accesscontrol'], true)) { ?>
        <li>
          <button class="btn btn-block text-left" ng-class="{'note-active': localPath == '/dashboard'}" type="button" onclick="window.location.href = '../dashboard'">
            <i class="fa fa-home" style="margin-right: 10%;"></i>Dashboard
          </button>
        </li>

        <?php } ?>

        <?php if (in_array('ACAM00001', $_SESSION['loggeduser']['accesscontrol'], true)) { ?>
        <li>
          <button class="btn btn-block text-left" type="button" ng-click="AnnouncementShow()" >
            <i class="fa fa-bullhorn" style="margin-right: 10%;"></i>
            Announcement
          </button>
        </li>
        <?php } ?>

        <?php if (in_array('ACCD00001', $_SESSION['loggeduser']['accesscontrol'], true)) { ?>
        <li>
          <button class="btn btn-block text-left" ng-class="{'note-active': localPath == '/candidacy/filing' || localPath == '/candidacy/evaluation' || localPath == '/candidacy/approval' || localPath == '/candidacy/inventory'}" type="button" data-toggle="collapse" data-target="#collapseItem1" aria-expanded="false" aria-controls="collapseItem1">
          <i class="fa fa-file" style="margin-right: 10%;"></i>Candidacy</button> 
        </li>
        <?php } ?>
        <div class="collapse submenu" id="collapseItem1" data-parent="#parentCollapse">
          <ul style="list-style: none; padding-left: 5px; ">
            <?php if (in_array('ACCD00002', $_SESSION['loggeduser']['accesscontrol'], true)) { ?>
            <li>
              <button class="btn btn-block text-left" type="button" onclick="window.location.href = '../candidacy/filing/'">
                <span style="margin-left: 20%;">Filing</span>
              </button>
            </li>
            <?php } ?>

            <?php if (in_array('ACCD00003', $_SESSION['loggeduser']['accesscontrol'], true)) { ?>
            <li>
              <button class="btn btn-block text-left" type="button" onclick="window.location.href='/candidacy/evaluation/'">
                <span style="margin-left: 20%;">Evaluation</span>
              </button>
            </li>
            <?php } ?>

            <?php if (in_array('ACCD00004', $_SESSION['loggeduser']['accesscontrol'], true)) { ?>
            <li>
              <button class="btn btn-block text-left" type="button" onclick="window.location.href='/candidacy/approval/'">
                <span style="margin-left: 20%;">Approval</span>
              </button>
            </li>
            <?php } ?>

            <?php if (in_array('ACCD00005', $_SESSION['loggeduser']['accesscontrol'], true)) { ?>
            <li>
              <button class="btn btn-block text-left" type="button" onclick="window.location.href='../candidacy/inventory/'">
                <span style="margin-left: 20%;">Inventory</span>
              </button>
            </li>
            <?php } ?>

          </ul>
        </div>

        <?php if (in_array('ACDD00001', $_SESSION['loggeduser']['accesscontrol'], true)) { ?>
        <li>
          <button class="btn btn-block text-left" ng-class="{'note-active': localPath == '/design'}" type="button" onclick="window.location.href='/design/'">
            <i class="fa fa-database" style="margin-right: 10%;"></i>Data Design
          </button>
        </li>
        <?php } ?>

        <?php if (in_array('ACPC00001', $_SESSION['loggeduser']['accesscontrol'], true)) { ?>
        <li>
          <button class="btn btn-block text-left" type="button" ng-click="ProcessShow()">
            <i class="fa fa-project-diagram" style="margin-right: 10%;"></i>Process
          </button>
        </li>
        <?php } ?>

        <?php if (in_array('ACMV00001', $_SESSION['loggeduser']['accesscontrol'], true)) { ?>
        <li>
          <button class="btn btn-block text-left" type="button" onclick="window.location.href= '/myvote'">
            <i class="fa fa-vote-yea" style="margin-right: 10%;"></i>myVote
          </button></li>  
        </li>
        <?php } ?>


        <?php if (in_array('ACCV00001', $_SESSION['loggeduser']['accesscontrol'], true)) { ?>
        <li>
          <button class="btn btn-block text-left" ng-class="{'note-active': localPath == '/canvassing/overview' || localPath == '/canvassing/partial-result' || localPath == '/canvassing/processing'}" type="button" data-toggle="collapse" data-target="#canvassing-submenu" aria-expanded="false" aria-controls="canvassing-submenu">
            <i class="fa fa-edit" style="margin-right: 10%;"></i>Canvassing
          </button>
        </li> 
        <?php } ?> 
        <div class="collapse submenu" id="canvassing-submenu" data-parent="#parentCollapse">
          <ul style="list-style: none;padding-left: 5px;">
            <li>
              <button class="btn btn-block text-left" type="button" onclick="window.location.href='../canvassing/overview/'">
                <span style="margin-left: 20%;">Overview</span>
              </button>
            </li>
            <li>
              <button class="btn btn-block text-left" type="button" onclick="window.location.href='../canvassing/processing/'">
                <span style="margin-left: 20%;">Processing</span>
              </button>
            </li>
            <li>
              <button class="btn btn-block text-left" type="button" onclick="window.location.href='../canvassing/partial-result/'">
                <span style="margin-left: 20%;">Partial Result</span>
              </button>
            </li>
          </ul>
        </div>

        <?php if (in_array('ACCG00001', $_SESSION['loggeduser']['accesscontrol'], true)) { ?>
        <li>
          <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseItem2" aria-expanded="false" aria-controls="collapseItem2">
            <i class="fa fa-tools" style="margin-right: 10%;"></i>Configuration
          </button>
        </li>
        <?php } ?>

        <div class="collapse submenu" id="collapseItem2" data-parent="#parentCollapse">
          <ul style="list-style: none; padding-left: 5px;">
            <?php if(in_array('ACCG00002', $_SESSION['loggeduser']['accesscontrol'], true)) { ?>
            <li>
              <button class="btn btn-block text-left" type="button" onclick="window.location.href='../configuration/candidacy/'">
                <span style="margin-left: 20%;">Candidacy Set Up</span>
              </button>
            </li>
            <?php } ?>
            <?php if(in_array('ACCG00003', $_SESSION['loggeduser']['accesscontrol'], true)) { ?>
            <li>
              <button class="btn btn-block text-left" type="button" onclick="window.location.href='../configuration/institution/'">
                <span style="margin-left: 20%;">Institution Set Up</span>
              </button>
            </li>
            <?php } ?>
          </ul>
        </div>

        <li>
          <button class="btn btn-block text-left" type="button" onclick="window.location.href= '/canvassing'">
            <i class="fa fa-info-circle" style="margin-right: 10%;"></i>Help
          </button>
        </li>
      </ul>
    </div>

    
  </div>
