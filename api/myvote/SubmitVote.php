<?php 

  session_start();
  include '../../includes/Conn.inc';

  // INITIALIZE
  $stPosition = '';
  $stValue = '';
  $array_collection = array();
  $looper = array();

  // data
  $userdata = json_decode($_REQUEST['data'], true);

  // array
  $aPositionArray = array();
  $retval_array = array();

  $uPerson00id = $_SESSION['loggeduser']['person00id'];
  $uIDNo = $_SESSION['loggeduser']['idno'];
  $uLastName = $_SESSION['loggeduser']['lastname'];
  $uFirstName = $_SESSION['loggeduser']['firstname'];
  $uMiddleName = $_SESSION['loggeduser']['middlename'];
  $uSuffName = $_SESSION['loggeduser']['suffixname'];

  $stsql1 = "";
  $stsql1 .= " INSERT rawvotes00(idno, lastname, firstname, middlename, suffixname, is_active, datesubmitted) " ;
  $stsql1 .= " VALUES('". $uIDNo ."', '". $uLastName ."', '". $uFirstName ."','". $uMiddleName ."', '". $uSuffName ."', 1, NOW()) " ;

  try {
    mysqli_query($conn, $stsql1);

    $stsql1 = "";
    $stsql1 .= " SELECT rawvotes00id FROM rawvotes00 ORDER BY datesubmitted DESC  LIMIT 1 ";
    $retval = mysqli_query($conn, $stsql1);
    if (mysqli_num_rows($retval) > 0) {
      while ($res = mysqli_fetch_array($retval)) {
        $nRawVotes00id = $res['rawvotes00id'];
      }
    }

    foreach ($userdata as $key => $value) {
      foreach ($userdata[$key] as $k => $v) {
        $stsql1 = "";
        $stsql1 .= " INSERT rawvotes01(rawvotes00id, position, value, datecreated) ";
        $stsql1 .= "VALUES ('". $nRawVotes00id ."', '". $key ."', '". $k ."', NOW())" ;
        mysqli_query($conn, $stsql1);
      }
    }


  } catch (Exception $e) {
    $retval_array = array(
      "data" => null,
      "status" => "error"
    );    

    print json_encode($retval_array);
    exit();
  }

  $stsql1 = "";
  $stsql1 .= "  SELECT ";
  $stsql1 .= "      idno, ";
  $stsql1 .= "      `position`, ";
  $stsql1 .= "      `value` ";
  $stsql1 .= "  FROM rawvotes00 ";
  $stsql1 .= "    LEFT JOIN rawvotes01  ";
  $stsql1 .= "    ON rawvotes00.rawvotes00id = rawvotes01.rawvotes00id ";
  $stsql1 .= "  WHERE idno = '". $uIDNo ."' ";
  $stsql1 .= "  AND is_active = 1 ";
  $stsql1 .= "  ORDER BY `position` ";

  try {
    $retval = mysqli_query($conn, $stsql1);
    if (mysqli_num_rows($retval) > 0) {
      while ($res = mysqli_fetch_array($retval)) {
        $stPosition = $res['position'];
        $stValue    = $res['value'];

        $looper = array(
          'position' => $stPosition,
          'value' => $stValue
        );

        array_push($array_collection, $looper);
      }
      # code...
    }
  } catch (Exception $e) {
    
  }


  $retval_array = array(
    "message" => "Vote Successfully save.",
    "data" => $array_collection,
    "status" => "success"
  );    

  print json_encode($retval_array);  

?>

