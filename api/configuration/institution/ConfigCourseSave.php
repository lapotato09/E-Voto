<?php
  session_start();

  include '../../../includes/Conn.inc';
  $aRetval = array();

  $stUserData = json_decode($_REQUEST['data'], true);

  foreach ($stUserData as $key => $value) {
    $stSQL1 = "" ;
    $stSQL1 .= " INSERT INTO course00(degree, degreecode, course, coursecode, description, code, active, datecreated) " ;
    $stSQL1 .= " VALUES ( " ;
    $stSQL1 .= " '". ucwords($stUserData[$key]['degree']) ."', " ;
    $stSQL1 .= " '". strtoupper($stUserData[$key]['degreecode']) ."', " ;
    $stSQL1 .= " '". ucwords($stUserData[$key]['course']) ."', " ;
    $stSQL1 .= " '". strtoupper($stUserData[$key]['coursecode']) ."', " ;
    $stSQL1 .= " '". ucwords($stUserData[$key]['description']) ."', " ;
    $stSQL1 .= " '". strtoupper($stUserData[$key]['degreecode'] . $stUserData[$key]['coursecode']) ."', " ;
    $stSQL1 .= " 1, " ;
    $stSQL1 .= " NOW() " ;
    $stSQL1 .= " ) " ;

    try {
      mysqli_query($conn, $stSQL1);
      $aRetval = array(
        "data" => null,
        "status" => "success"
      );

    } catch (Exception $e) {
      $aRetval = array(
        "data" => null,
        "status" => "error",
        "message" => "Caught Exception" .$e->getMessage()
      );  

      print json_encode($aRetval);
      exit();
    }
  }

print json_encode($aRetval);

?>