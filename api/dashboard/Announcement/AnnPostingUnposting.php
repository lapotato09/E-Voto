<?php
  session_start();
  include '../../../includes/Conn.inc';

  $stAnnId = '';
  $stTitle = '';
  $stFlag  = '';

  $retArray = array();

  $userdata = json_decode($_REQUEST['data'], true);
  $stFlag  = $userdata['flag'];
  $stAnnId = $userdata['ann00id'];

  if ($stFlag == 'POST') {
    $sql_query = "";
    $sql_query .= "UPDATE announcement00 ";
    $sql_query .= "SET active = 1, dateposted = now(), dateunposted = null ";
    $sql_query .= "WHERE ann00id = " . $stAnnId . " ";
  }
  elseif ($stFlag == 'UNPOST') {
    $sql_query = "";
    $sql_query .= "UPDATE announcement00 ";
    $sql_query .= "SET active = 0, dateunposted = now()";
    $sql_query .= "WHERE ann00id = " . $stAnnId . " ";
  }

  try {
    mysqli_query($conn, $sql_query);
    $data   = null;
    $status = "success";

  } catch(Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
    $status = "error";
  }

  $retArray = array(
      "data" => $data,
      "status" => $status);

  print json_encode($retArray);

?>