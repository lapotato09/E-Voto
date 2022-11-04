<?php

  session_start();
  include '../../../includes/Conn.inc';

  // DECLARING VARIABLES
  $retArray      = array();
  $arrCollection = array();
  $stProcessName = '';
  $dDateStart    = '';
  $dDateEnd      = '';
  $stActive      = '';
  $stPosted      = '';
  $stSortOrder   = '';
  $nProcessId    = '';

  $stSql = "";
  $stSql .= " SELECT process00id, ";
  $stSql .= " COALESCE(processname,'') AS processname, ";
  $stSql .= " COALESCE(datestarteffectivity, '') AS datestart, ";
  $stSql .= " COALESCE(dateendeffectivity, '') AS dateend, ";
  $stSql .= " COALESCE(`active`, 0) AS active, ";
  $stSql .= " COALESCE(posted, 0) AS posted, ";
  $stSql .= " COALESCE(`order`, '000') AS sortorder ";
  $stSql .= " FROM process00 ";

  // EXECUTE QUERY
  $retVal = mysqli_query($conn, $stSql);
  if (mysqli_num_rows($retVal) > 0) {
    while ($res = mysqli_fetch_array($retVal)) {
      $nProcessId     = $res['process00id'];
      $stProcessName  = $res['processname'];
      $dDateStart     = $res['datestart'];
      $dDateEnd       = $res['dateend'];
      $stActive       = $res['active'];
      $stPosted       = $res['posted'];
      $stSortOrder    = $res['sortorder'];

      // store to array
      $arrayLooper = array(
        'process00id' => $nProcessId,
        'processname' => $stProcessName,
        'datestart' => $dDateStart,
        'dateend' => $dDateEnd,
        'active' => $stActive,
        'posted' => $stPosted,
        'sortorder' => $stSortOrder
      );

      array_push($arrCollection, $arrayLooper);
    }
  }

  $retArray = array(
    'data' => $arrCollection,
    'status'=> 'success'
  );

  print json_encode($retArray);

?>