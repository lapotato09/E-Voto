<?php 
  session_start();
  include '../../../includes/Conn.inc';

  $retArrayCollection = array();
  $retArray = array();
  $looper = array();

  $stAccessCode = '';
  $stAccessName = '';
  $stAccessType = '';
  $stAccessGroup = '';
  $stAccessParent = '';

  $stSQL1 = "";
  $stSQL1 .= " SELECT * FROM accesscontrol00 WHERE active = 1 ";

  try {
    $retVal = mysqli_query($conn, $stSQL1);
    if (mysqli_num_rows($retVal) > 0) {
      while ($res = mysqli_fetch_array($retVal)) {
        $stAccessCode = $res['code'];
        $stAccessName = $res['name'];
        $stAccessType = $res['type'];
        $stAccessGroup = $res['group'];
        $stAccessParent = $res['parentcode'];

        $looper = array(
          "accesscode" => $stAccessCode,
          "description" => $stAccessName,
          "type" => $stAccessType,
          "group" => $stAccessGroup,
          "parentcode" => $stAccessParent
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