<?php 
  session_start();

  include '../../../includes/Conn.inc';

  $nRole00id = 0;
  $stRoleCode = '';
  $stRoleDescription = '';
  $stRoleName = '';
  $stRoleGroup = '';
  $bActive = '';
  $stCreatedBy = '';
  $dDateCreated = '';

  $RetArray = array();
  $looper = array();
  $ReturnArray = array();

  $stSQL1 = "";
  $stSQL1 .= " SELECT * FROM role00 WHERE active = 1 ";

  try {
    $retval = mysqli_query($conn, $stSQL1);
    if (mysqli_num_rows($retval) > 0) {
      while ($res = mysqli_fetch_array($retval)) {
        $nRole00id = $res['role00id'];
        $stRoleCode = $res['rolecode'];
        $stRoleDescription = $res['roledescription'];
        $stRoleName = $res['rolename'];
        $stRoleGroup = $res['rolegroup'];
        $bActive = $res['active'];
        $stCreatedBy = $res['createdby'];
        $dDateCreated = $res['datecreated'];

        $looper = array(
          "role00id" => $nRole00id,
          "rolecode" => $stRoleCode,
          "roledescription" => $stRoleDescription,
          "rolename" => $stRoleName,
          "rolegroup" => $stRoleGroup,
          "active" => $bActive,
          "created" => $stCreatedBy,
          "datecreated" => $dDateCreated
        );

        array_push($RetArray, $looper);
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

  $ReturnArray = array(
    "data" => $RetArray,
    "status" => "success"
  );  

  print json_encode($ReturnArray);

?>