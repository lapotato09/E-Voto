<?php 
  session_start();

  include '../../../includes/Conn.inc';

  $stRoleCode = '';
  $stRoleDesc = '';
  $stRoleName = '';
  $stRoleGroup = '';
  $nRole00id = 0;
  $aRetval = array();

  $data = json_decode($_REQUEST['data'], true);

  $nRole00id   = $data['role00id'];
  $stRoleCode  = $data['rolecode'];
  $stRoleDesc  = $data['roledescription'];
  $stRoleName  = $data['rolename'];
  $stRoleGroup = $data['rolegroup'];

  $stSQL1 = "";
  $stSQL1 .= " UPDATE role00 SET " ;
  $stSQL1 .= " rolecode = '". $stRoleCode ."'," ;
  $stSQL1 .= " roledescription = '". $stRoleDesc ."'," ;
  $stSQL1 .= " rolename = '". $stRoleName ."', " ;
  $stSQL1 .= " rolegroup = '". $stRoleGroup ."' " ;
  $stSQL1 .= " WHERE role00id = " .$nRole00id;

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

  print json_encode($aRetval);

?>