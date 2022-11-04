<?php
  session_start();
  include '../../../includes/Conn.inc';

  $retArray = array();

  // MAG CREATE NG VARIABLES
  $stIdno       = '';
  $stLastName   = '';
  $stFirstName  = '';
  $stMiddleName = '';
  $stExName     = '';
  $stCourse     = '';
  $stMajor      = '';
  $stSection    = '';
  $stYearLevel  = '';
  $stGender     = '';
  $stCivil      = '';
  $stReligion   = '';
  $nAge         = '';
  $stHeight     = '';
  $stWeight     = '';
  $stEmail      = '';
  $stContact    = '';
  $dBirthdate   = '';
  $stEntrytype  = '';
  $stStatus     = '';
  $dDateEnroll  = '';

  $nPerson00id  = 0;

  // SALUHIN ANG PINASA NA DATA
  $userdata = json_decode($_REQUEST['data'], true);

  $stIdno       = $userdata['lrn'];
  $stLastName   = ucwords($userdata['lname']);
  $stFirstName  = ucwords($userdata['fname']);
  $stMiddleName = ucwords($userdata['mname']);
  $stExName     = ucwords($userdata['xname']);
  $stCourse     = ucwords($userdata['course']);
  $stMajor      = ucwords($userdata['major']);
  $stYearLevel  = ucwords($userdata['year']);
  $stSection    = ucwords($userdata['section']);
  $stGender     = ucwords($userdata['gender']);
  $stCivil      = ucwords($userdata['civil']);
  $stReligion   = ucwords($userdata['religion']);
  $nAge         = $userdata['age'];
  $stHeight     = $userdata['height'];
  $stWeight     = $userdata['weight'];
  $stEmail      = $userdata['email'];
  $stContact    = $userdata['contact'];
  $dBirthdate   = $userdata['birthdate'];
  $stEntrytype  = ucwords($userdata['entrytype']);
  $stStatus     = ucwords($userdata['status']);
  $dDateEnroll  = $userdata['dateenrolled'];

  // mag create ng query pang insert 
  // INSERT PERSON00 TABLE

  $stSql1 = "";
  $stSql1 .= " INSERT person00 (lastname,firstname,middlename,nameex,active,dateencoded,datecreated) ";
  $stSql1 .= " VALUES ('". $stLastName ."', '". $stFirstName."', '". $stMiddleName ."','". $stExName ."',1,now(), now() )";

  try {
    mysqli_query($conn, $stSql1); // EXECUTE QUERY
  } catch (Exception $e) {
    $retArray = array(
        "data" => 'Caught exception: '. $e->getMessage(),
        "status" => "error" ); 

    print json_encode($retArray);
    exit();
  }

  $stSql1 = "";
  $stSql1 .= "  SELECT person00id FROM person00";
  $stSql1 .= " WHERE lastname = '". $stLastName ."' ";
  $stSql1 .= " AND firstname = '". $stFirstName ."' ";
  $stSql1 .= " AND middlename = '". $stMiddleName ."' ";
  $stSql1 .= " AND nameex = '". $stExName ."' ";

  // FINDING PERSON00ID AND EXEC
  try {
    $res = mysqli_query($conn,$stSql1);
    if (mysqli_num_rows($res) > 0) {
      while ($retval = mysqli_fetch_array($res) ) {
        $nPerson00id = $retval['person00id'];
      }
    }
  } catch (Exception $e) {
    $retArray = array(
        "data" => 'Caught exception: '. $e->getMessage(),
        "status" => "error" ); 

    print json_encode($retArray);
    exit();
  }

  // INSERT PERSON01 TABLE
  $stSql1 = "";
  $stSql1 .= " INSERT person01 (person00id,fieldcode,fieldtype,fieldvalue,datecreated)";
  $stSql1 .= " VALUES ";
  $stSql1 .= " ('".$nPerson00id."','AGE','DOUBLE','". $nAge ."',now() )," ;
  $stSql1 .= " ('".$nPerson00id."','GENDER','VARCHAR','". $stGender ."',now() ),";
  $stSql1 .= " ('".$nPerson00id."','HEIGHT','VARCHAR','". $stHeight ."',now() ),";
  $stSql1 .= " ('".$nPerson00id."','WEIGHT','VARCHAR','". $stWeight ."',now() ),";
  $stSql1 .= " ('".$nPerson00id."','CIVILSTATUS','VARCHAR','". $stCivil ."',now() ),";
  $stSql1 .= " ('".$nPerson00id."','RELIGION','VARCHAR','". $stReligion ."',now() ),";
  $stSql1 .= " ('".$nPerson00id."','CONTACT','VARCHAR','". $stContact ."',now() ),";
  $stSql1 .= " ('".$nPerson00id."','EMAIL','VARCHAR','". $stEmail ."',now() ),";
  $stSql1 .= " ('".$nPerson00id."','BIRTHDATE','VARCHAR','".$dBirthdate."',now() ),";
  $stSql1 .= " ('".$nPerson00id."','ADDRESS','VARCHAR','',now() )";

  try {
    mysqli_query($conn,$stSql1);
  } catch (Exception $e) {
    $retArray = array(
      "data" => 'Caught exception: '. $e->getMessage(),
      "status" => "error" );

    print json_encode($retArray);
    exit();
  }

  // INSERT PERSON02 TABLE
  $stSql1 = "";
  $stSql1 .= " INSERT person02 (person00id,fieldcode,fieldtype,fieldvalue,datecreated)";
  $stSql1 .= " VALUES ";
  $stSql1 .= " ('".$nPerson00id."','COURSE','VARCHAR','". strtoupper($stCourse) ."',now() ),";
  $stSql1 .= " ('".$nPerson00id."','YEAR','VARCHAR','". $stYearLevel ."',now() ),";
  $stSql1 .= " ('".$nPerson00id."','MAJOR','VARCHAR','". strtoupper($stMajor) ."',now() ),";
  $stSql1 .= " ('".$nPerson00id."','DATEENROLLED','VARCHAR','". $dDateEnroll ."',now() ),";
  $stSql1 .= " ('".$nPerson00id."','ENTRYTYPE','VARCHAR','". $stEntrytype ."',now() ),";
  $stSql1 .= " ('".$nPerson00id."','STATUS','VARCHAR','". strtoupper($stStatus)."',now() )";

  try {
    mysqli_query($conn,$stSql1);
  } catch (Exception $e) {
    $retArray = array(
      "data" => 'Caught exception: '. $e->getMessage(),
      "status" => "error" );

    print json_encode($retArray);
    exit();
  }

  // INSERT MASTERLIST00 TABLE
  $stSql1 = "";
  $stSql1 .= " INSERT masterlist00 (person00id,datestarteffectivity,dateendeffectivity,active,datecreated,schoolidno)" ;
  $stSql1 .= " VALUES ('".$nPerson00id."',now(),'2099-12-31 00:00:00',1,now(),'".$stIdno."') " ;

  try {
    mysqli_query($conn,$stSql1);
  } catch (Exception $e) {
    $retArray = array(
      "data" => 'Caught exception: '. $e->getMessage(),
      "status" => "error" );

    print json_encode($retArray);
    exit();
  }

  $retArray = array(
      "data" => null,
      "status" => "success" );

  print json_encode($retArray);

?>