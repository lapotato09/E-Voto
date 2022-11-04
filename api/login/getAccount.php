<?php

  session_start();
  include '../../includes/Conn.inc';

  //Declaring variables
  $stUsername = '';
  $user = '';
  $hashpass = '';
  $retArray = array();
  $nPerson00id = 0;
  $_SESSION['loggeduser']['accesscontrol'] = array();
  // array_push(array, var)
  // function ot push into array

  // print_r(getdate());
  $userdata = json_decode($_REQUEST['data'], true);
  $user     = $userdata['user'];
  $hashpass = hash('md5', $userdata['pass']);

  $Sql1 = "";
  $Sql1 .= " SELECT * FROM account00 ";
  $Sql1 .= " LEFT JOIN account01  ";
  $Sql1 .= "   ON account00.account00id = account01.account00id ";
  $Sql1 .= " WHERE username ='" . $user . "'";
  $Sql1 .= " AND password ='" . $hashpass . "'";
  $Sql1 .= " AND active = 1 ";

  // Perform query
  $arrCollection = array();
  $arrCollection1 = array();

  $result = mysqli_query($conn, $Sql1);
  if (mysqli_num_rows($result) > 0) {
    while($res = mysqli_fetch_array($result)){
      $stUserId    = $res['account00id'];
      $stUsername  = $res['username'];
      $ver         = $res['verified'];
      $datecreated = $res['datecreated'];
      $_SESSION['user'] = $stUsername;
      $_SESSION['userid'] = $stUserId;
      $_SESSION['sidebaraccess'] = 1;
      $_SESSION['loggeduser']['person00id'] = $res['person00id'];
      $_SESSION['loggeduser']['idno'] = $res['idno'];
      $_SESSION['loggeduser']['lastname'] = $res['lastname'];
      $_SESSION['loggeduser']['firstname'] = $res['firstname'];
      $_SESSION['loggeduser']['middlename'] = $res['middlename'];
      $_SESSION['loggeduser']['suffixname'] = $res['suffixname'];
      $_SESSION['loggeduser']['gender'] = $res['gender'];
      $_SESSION['loggeduser']['email'] = $res['email'];

      $nPerson00id = $res['person00id'];
      // Feed into array
      $arrCollection = array(
                    'userid' => $stUserId,
                    'username' => $stUsername,
                    'verified' => $ver,
                    'datecreated' => $datecreated);

      array_push($arrCollection1, $arrCollection);
    }
  }
  else {
    // Return Collection
    $retArray = array( 
      "data" => null,
      "status" => "failed" );
  }

  // Free result set
  mysqli_free_result($result);

  $Sql1 = "";
  $Sql1 .= " SELECT DISTINCT ";
  $Sql1 .= "   code,  ";
  $Sql1 .= "   access_control_list.rolecode, ";
  $Sql1 .= "   access_control_list.role00id ";
  $Sql1 .= " FROM access_control_list ";
  $Sql1 .= " LEFT JOIN role01 ";
  $Sql1 .= "   ON role01.rolecode = access_control_list.rolecode ";
  $Sql1 .= " WHERE role01.person00id = ".$nPerson00id ;

  try {
    $retVal = mysqli_query($conn, $Sql1);
    if (mysqli_num_rows($retVal) > 0) {
      while ($res = mysqli_fetch_array($retVal)) {
        array_push($_SESSION['loggeduser']['accesscontrol'], trim($res['code']));
      }
    }
  } catch (Exception $e) {
    $retArray = array( 
      "data" => null,
      "status" => "failed" );

    print json_encode($retArray);
    exit();    
  }

  // Return Collection
  $retArray = array( 
    "data" => $arrCollection1,
    "status" => "success" );
  
  print json_encode($retArray);

?>