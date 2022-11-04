<?php 
  session_start();
  include '../../../includes/Conn.inc';

  $retval_array = array();
  $stUserData = json_decode($_REQUEST['data'], true);

  $nRole00id = $stUserData['details']['role00id'];
  $stRoleCode = $stUserData['details']['rolecode'];

  try {
    $stSQL1 = "";
    $stSQL1 .= " DELETE FROM access_control_list WHERE role00id = ". $nRole00id ." AND rolecode = '". $stRoleCode ."' ";
    mysqli_query($conn, $stSQL1);

    foreach ($stUserData['param'] as $key => $value) {
      if ($stUserData['param'][$key]['present'] == 1) {
        $stSQL1 = "";
        $stSQL1 .= " CALL ev_ConfigRoleAccessSave (" ;
        $stSQL1 .= "  '".$stUserData['param'][$key]['accesscode']."', ";
        $stSQL1 .= "  '".$nRole00id."', ";
        $stSQL1 .= "  '".$stRoleCode."') ";

        mysqli_query($conn, $stSQL1);
      }

    }

    $retval_array = array(
      "data" => null,
      "message" => "Role access successfully saved.",
      "status" => "success"
    );

  } catch (Exception $e) {
    $retval_array = array(
      "data" => null,
      "status" => "error"
    );    

    print json_encode($retval_array);
    exit();
  }

  print json_encode($retval_array);

?>