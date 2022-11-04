<?php 
  session_start();
  include '../../../includes/Conn.inc';
  $nRole01id = 0;
  $nRole00id = 0;
  $stRoleCode = '';
  $RetArray = array();
  $ACollection = array();

  $stUserdata   = json_decode($_REQUEST['data'], true);
  $nPerson00id  = $stUserdata['person00id'];
  $stIDNo       = $stUserdata['idno'];

  $stSQL1 = "";
  $stSQL1 .= " SELECT * FROM role01 ";
  $stSQL1 .= " WHERE person00id = " .$nPerson00id;
  $stSQL1 .= " AND schoolidno = '" .$stIDNo. "' ";

  try {
    $retval = mysqli_query($conn, $stSQL1);
    if (mysqli_num_rows($retval) > 0) {
      while ($res = mysqli_fetch_array($retval)) {
        $nRole01id  = $res['role01id'];
        $nRole00id  = $res['role00id'];
        $stRoleCode = $res['rolecode'];

        $looper = array(
          "role00id" => $nRole00id,
          "role01id" => $nRole01id,
          "rolecode" => $stRoleCode
        );

        array_push($ACollection, $looper);
      }
    }
  } catch (Exception $e) {
    $RetArray = array(
      "data" => null,
      "status" => "error",
      "message" => "Caught Exception" .$e->getMessage()
    );  

    print json_encode($RetArray);
    exit();    
  }


  $RetArray = array(
    "data" => $ACollection,
    "status" => "success"
  );  

  print json_encode($RetArray);

?>