<?php

  session_start();

  include '../../../includes/Conn.inc';

  // RETURN ARRAY
  $retval_array = array();
  $looper = array();
  $array_collection = array();

  // LOCALS
  $stForm = "";
  $nCandidacy00ID = 0;
  $stFieldcode = "";
  $stFieldname = "";
  $stFieldType = "";
  $stFieldValue = "";
  $nLevel = 0;

  $stUserData = json_decode($_REQUEST['data'], true);
  $stForm = $stUserData['form'];

  if ($stForm == 'POSITION') {
    // QUERY
    $stsql1 = "";
    $stsql1 .= " SELECT candidacysettings00id, " ;
    $stsql1 .= "     fieldcode, " ;
    $stsql1 .= "     fieldname, " ;
    $stsql1 .= "     fieldtype, " ;
    $stsql1 .= "     fieldvalue, " ;
    $stsql1 .= "     `level` " ;
    $stsql1 .= " FROM candidacysettings00 " ;

    try {
      $retval = mysqli_query($conn, $stsql1);
      if (mysqli_num_rows($retval) > 0) {
        while ($res = mysqli_fetch_array($retval)) {
          $nCandidacy00ID = $res['candidacysettings00id'];
          $stFieldcode    = $res['fieldcode'];
          $stFieldname    = $res['fieldname'];
          $stFieldType    = $res['fieldtype'];
          $stFieldValue   = $res['fieldvalue'];
          $nLevel         = $res['level'];

          $looper = array(
            'candidacysettings00id' => $nCandidacy00ID,
            'fieldcode' => $stFieldcode,
            'fieldname' => $stFieldname,
            'fieldtype' => $stFieldType,
            'fieldvalue' => (int)$stFieldValue,
            'level' => (int)$nLevel
          );

          array_push($array_collection, $looper);

        }       
      }
    } catch (Exception $e) {
      $retval_array = array(
        "data" => null,
        "status" => "error"
      );    

      print json_encode($retval_array);
      exit();
    }

    $retval_array = array(
      "position" => $array_collection,
      "status" => "success"
    );

    print json_encode($retval_array);

  }

?>


