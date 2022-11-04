<?php 
  session_start();
  include '../../../includes/Conn.inc';

  $retArrayCollection = array();
  $retArray = array();
  $looper = array();

  $stAccessCode = '';

  $stUserdata = json_decode($_REQUEST['data'], true);
  $nRole00id = $stUserdata['role00id'];
  $stRoleCode = $stUserdata['rolecode'];

  $stSQL1 = "";
  $stSQL1 .= " SELECT * FROM access_control_list ";
  $stSQL1 .= " WHERE role00id = " .$nRole00id ;
  $stSQL1 .= " AND rolecode = '" .$stRoleCode. "' ";

  try {
    $retVal = mysqli_query($conn, $stSQL1);
    if (mysqli_num_rows($retVal) > 0) {
      while ($res = mysqli_fetch_array($retVal)) {
        $stAccessCode = $res['code'];

        $looper = array(
          "accesscode" => $stAccessCode
        );

        array_push($retArrayCollection, $looper);
      }
    }
  } catch (Exception $e) {
    $retArray = array(
      "data" => null,
      "status" => "error",
      "message" => "Caught Exception" .$e->getMessage()
    );  

    print json_encode($retArray);
    exit();
  }

  $retArray = array(
    "data" => $retArrayCollection,
    "status" => "success"
  );

  print json_encode($retArray);

?>