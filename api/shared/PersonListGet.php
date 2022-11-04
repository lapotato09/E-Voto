<?php
  session_start();
  include '../../includes/Conn.inc';

  // RETURN ARRAY 
  $retArray        = array();
  $arrayLooper     = array();
  $arrayCollection = array();

  // DECLARING LOCAL VARIABLE
  $nSchoolidno    = '';
  $nPerson00id    = 0;
  $stLastname     = '';
  $stFirstname    = '';
  $stMiddlename   = '';
  $stNameex       = '';
  $stFullname     = '';

  $stSql = "";
  $stSql .= " SELECT DISTINCT p0.person00id, ";
  $stSql .= "   COALESCE(schoolidno, '') AS schoolidno, ";
  $stSql .= "   COALESCE(lastname, '') AS lastname, ";
  $stSql .= "   COALESCE(firstname, '') AS firstname, ";
  $stSql .= "   COALESCE(middlename, '') AS middlename, ";
  $stSql .= "   COALESCE(nameex, '') AS nameex";
  $stSql .= " FROM masterlist00 p0 ";
  $stSql .= " LEFT JOIN (SELECT person00id,lastname,firstname,middlename,nameex FROM person00) tb1 ";
  $stSql .= "   ON tb1.person00id = p0.person00id  ";
  $stSql .= " WHERE p0.active = 1  ";

  $res = mysqli_query($conn,$stSql);
  if (mysqli_num_rows($res) > 0) {
    while ($retval = mysqli_fetch_array($res)) {
      $nPerson00id   =  $retval['person00id'];
      $nSchoolidno   =  $retval['schoolidno'];
      $stLastname    =  $retval['lastname'];
      $stFirstname   =  $retval['firstname'];
      $stMiddlename  =  $retval['middlename'];
      $stNameex      =  $retval['nameex'];

      if ($stNameex != '') {
        $stFullname = $stLastname .", " . $stFirstname ." ". $stMiddlename ."  ". $stNameex ." (". $nSchoolidno .")";
      }
      else {
        $stFullname = $stLastname .", " . $stFirstname ." ". $stMiddlename ." (". $nSchoolidno .")";
      }


      $arrayLooper = array(
        "person00id" => $nPerson00id ,
        "lastname" => $stLastname ,
        "firstname" => $stFirstname ,
        "middlename" => $stMiddlename ,
        "nameex" => $stNameex ,
        "idno" => $nSchoolidno ,
        "fullname" => $stFullname
      );

      array_push($arrayCollection,$arrayLooper);

    }

  }

  $retArray = array(
    "data" => $arrayCollection,
    "status" => "success" );


  print json_encode($retArray);

?>

