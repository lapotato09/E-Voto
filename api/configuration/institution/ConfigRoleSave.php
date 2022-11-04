<?php 
  session_start();

  include '../../../includes/Conn.inc';

  $stRoleCode = '';
  $stRoleDesc = '';
  $stRoleName = '';
  $stRoleGroup = '';
  $aRetval = array();

  $data = json_decode($_REQUEST['data'], true);

  $stRoleCode = $data['rolecode'];
  $stRoleDesc = $data['roledesc'];
  $stRoleName = $data['rolename'];
  $stRoleGroup = $data['rolegroup'];

  $stSQL1 = "";
  $stSQL1 .= " SELECT * FROM role00 ";
  $stSQL1 .= " WHERE rolecode = '". $stRoleCode ."' ";

  try {
    $res = mysqli_query($conn, $stSQL1);
    if (mysqli_num_rows($res) > 0) {
      $aRetval = array(
        "data" => null,
        "message" => "Role code is existing already. Use new role code.",
        "status" => "error"
      );

      print json_encode($aRetval);
      exit();
    }
  } catch (Exception $e) {
    $aRetval = array(
      "data" => null,
      "status" => "error",
      "message" => "Caught Exception" .$e->getMessage()
    );  

    print json_encode($aRetval);
    exit();    
  }

  $stSQL1 = "";
  $stSQL1 .= " INSERT INTO role00(rolecode, roledescription, rolename, rolegroup, active, datecreated) ";
  $stSQL1 .= " VALUES('". $stRoleCode ."', '". $stRoleDesc ."', '". $stRoleName ."', '". $stRoleGroup ."', 1, NOW()) ";

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