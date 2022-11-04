<?php
  session_start();
  include '../../../includes/Conn.inc';

  $stAnnId = '';
  $stTitle = '';

  $retArray = array();

  $userdata = json_decode($_REQUEST['data'], true);
  $stAnnId = $userdata['ann00id'];
  $stTitle = $userdata['title'];


  $sql_query = "";
  $sql_query .= "UPDATE announcement00 ";
  $sql_query .= "SET active = 1, dateposted = now(), dateunposted = null ";
  $sql_query .= "WHERE ann00id = " . $stAnnId . " ";
  $sql_query .= "AND title = '" . $stTitle . "' ";

  // echo $sql_query;

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