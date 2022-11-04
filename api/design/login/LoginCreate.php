<?php

  session_start();
  include '../../../includes/Conn.inc';

  $stIdno = '';
  $stLastName = '';
  $stFirstName = '';
  $stMiddleName = '';
  $stExName = '';
  $stGender = '';
  $stEmail = '';
  $stContact = '';
  $nPerson00id = 0;
  $stUserName = '';
  $stPassword = '';

  $nAccount00id = 0;

  // SALUHIN ANG PINASA NA DATA
  $userdata = json_decode($_REQUEST['data'], true);

  $stIdno       = $userdata['schoolidno'];
  $stLastName   = $userdata['lastname'];
  $stFirstName  = $userdata['firstname'];
  $stMiddleName = $userdata['middlename'];
  $stExName     = $userdata['nameex'];
  $stGender     = $userdata['gender'];
  $stEmail      = $userdata['email'];
  $stContact    = $userdata['contact'];

  $nPerson00id  = $userdata['person00id'];
  $stUserName   = $userdata['loginname'];
  $stPassword   = $userdata['password'];
  $hashpass     = hash('md5', $stPassword);

  $stSQL1 = "";
  $stSQL1 .= " SELECT account00id FROM account01 WHERE idno = '" .$stIdno . "' ";

  try {
    $retval = mysqli_query($conn, $stSQL1);
    if (mysqli_num_rows($retval) > 0) {
      $retArray = array(
        "message" => "Account already exists.",
        "status" => "error"); 

      print json_encode($retArray);
      exit();
    }
    else {

      $stSQL1 = "";
      $stSQL1 .= " CALL ev_Login00Create (" ;
      $stSQL1 .= "  '".$stUserName."', ";
      $stSQL1 .= "  '".$hashpass."', ";
      $stSQL1 .= "  '".$stIdno."' ) ";
      mysqli_query($conn, $stSQL1);

      $stSQL1 = "";
      $stSQL1 .= " SELECT account00id FROM account00 ORDER BY datecreated DESC LIMIT 1 ";

      $retval = mysqli_query($conn, $stSQL1);
      if (mysqli_num_rows($retval) > 0) {
        while ($res = mysqli_fetch_array($retval)) {
          $nAccount00id = $res['account00id'];
        }
      }

      $stSQL1 = "";
      $stSQL1 .= " CALL ev_Login01Create ( ";
      $stSQL1 .= "  '" . $nAccount00id . "', ";
      $stSQL1 .= "  '" . $stFirstName . "', ";
      $stSQL1 .= "  '" . $stLastName . "', ";
      $stSQL1 .= "  '" . $stMiddleName . "', ";
      $stSQL1 .= "  '" . $stExName . "', ";
      $stSQL1 .= "  '" . $stGender . "', ";
      $stSQL1 .= "  '" . $stEmail . "', ";
      $stSQL1 .= "  '" . $stContact . "', ";
      $stSQL1 .= "  '" . $nPerson00id . "', ";
      $stSQL1 .= "  '" . $stIdno . "', ";
      $stSQL1 .= "  'REGSTUD_USER' ";
      $stSQL1 .= " ) ";
      mysqli_query($conn, $stSQL1);

    }
  } catch (Exception $e) {
    $retArray = array(
        "data" => 'Caught exception: '. $e->getMessage(),
        "status" => "error" ); 

    print json_encode($retArray);
    exit();
  }

  $retArray = array(
      "message" => "Account successfully created.",
      "data" => null,
      "status" => "success" );

  print json_encode($retArray);

?>

