<?php 
  session_start();
  include '../../../includes/Conn.inc';

  $retval_array = array();

  $stUserData = json_decode($_REQUEST['data'], true);

  $nPerson00id = $stUserData['details']['person00id'];
  $stIDNo = $stUserData['details']['idno'];


  try {
    $stSQL1 = "";
    $stSQL1 .= " DELETE FROM role01 WHERE person00id = ". $nPerson00id ." AND schoolidno = '". $stIDNo ."' ";
    mysqli_query($conn, $stSQL1);

    foreach ($stUserData['param'] as $key => $value) {
      if ($stUserData['param'][$key]['present'] == 1) {
        $stSQL1 = "";
        $stSQL1 .= " CALL ev_ConfigPersonRoleSave (" ;
        $stSQL1 .= "  '".$stUserData['param'][$key]['role00id']."', ";
        $stSQL1 .= "  '".$nPerson00id."', ";
        $stSQL1 .= "  '".$stUserData['param'][$key]['rolecode']."', ";
        $stSQL1 .= "  '".$stIDNo."' ) ";

        mysqli_query($conn, $stSQL1);
      }

    }

    $retval_array = array(
      "data" => null,
      "message" => "Person role successfully saved.",
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