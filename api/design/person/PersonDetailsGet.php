<?php
  session_start();
  include '../../../includes/Conn.inc';

  // RETURN ARRAY 
  $retArray        = array();
  $arrayLooper     = array();
  $arrayCollection = array();

  // DECLARING LOCAL VARIABLE
  $nPerson00id    = 0;
  $stLastname     = '';
  $stFirstname    = '';
  $stMiddlename   = '';
  $stNameex       = '';
  $stCourse       = '';
  $stYear         = '';
  $stMajor        = '';
  $stDateenrolled = '';
  $stEntrytype    = '';
  $stStatus       = '';
  $nAge           = 0;
  $stGender       = '';
  $stHeight       = '';
  $stWeight       = '';
  $stCivilstatus  = '';
  $stReligion     = '';
  $stContact      = '';
  $stEmail        = '';
  $stAddress      = '';
  $dBirthdate     = '';
  $nSchoolidno    = '';

  $stIDNO = "";
  $stName = "";

  $userdata = json_decode($_REQUEST['data'], true);
  $stIDNO   = $userdata['idno'];
  $stName   = $userdata['person'];
  // if (array_key_exists('idno', $userdata)) {
  //  $stIDNO = $userdata['idno'];
  // }
  // else {
  //  $stIDNO = 0;
  // }

  // if (array_key_exists('person', $userdata)) {
  //  $stName = $userdata['person'];
  // }
  // else {
  //  $stName = '';
  // }

  $stSql = "";
  $stSql .= " SELECT DISTINCT p0.person00id," ;
  $stSql .= "   COALESCE(schoolidno, '') AS schoolidno," ;
  $stSql .= "   COALESCE(lastname, '') AS lastname," ;
  $stSql .= "   COALESCE(firstname, '') AS firstname," ;
  $stSql .= "   COALESCE(middlename, '') AS middlename," ;
  $stSql .= "   COALESCE(nameex, '') AS nameex," ;
  $stSql .= "   COALESCE(COURSE, '') AS COURSE," ;
  $stSql .= "   COALESCE(YEAR, '') AS YEAR," ;
  $stSql .= "   COALESCE(MAJOR, '') AS MAJOR," ;
  $stSql .= "   COALESCE(DATEENROLLED, '') AS DATEENROLLED," ;
  $stSql .= "   COALESCE(ENTRYTYPE, '') AS ENTRYTYPE," ;
  $stSql .= "   COALESCE(STATUS, '') AS STATUS," ;
  $stSql .= "   COALESCE(AGE, '') AS AGE," ;
  $stSql .= "   COALESCE(GENDER, '') AS GENDER," ;
  $stSql .= "   COALESCE(HEIGHT, '') AS HEIGHT," ;
  $stSql .= "   COALESCE(WEIGHT, '') AS WEIGHT," ;
  $stSql .= "   COALESCE(CIVILSTATUS, '') AS CIVILSTATUS," ;
  $stSql .= "   COALESCE(RELIGION, '') AS RELIGION," ;
  $stSql .= "   COALESCE(CONTACT, '') AS CONTACT," ;
  $stSql .= "   COALESCE(EMAIL, '') AS EMAIL," ;
  $stSql .= "   COALESCE(ADDRESS, '') AS ADDRESS," ;
  $stSql .= "   COALESCE(BIRTHDATE, '') AS BIRTHDATE" ;
  $stSql .= "   FROM masterlist00 p0 " ;
  $stSql .= " LEFT JOIN (SELECT person00id, fieldvalue AS COURSE FROM person02 WHERE fieldcode = 'COURSE') tb1 " ;
  $stSql .= "   ON tb1.person00id = p0.person00id " ;
  $stSql .= " LEFT JOIN (SELECT person00id, fieldvalue AS YEAR FROM person02 WHERE fieldcode = 'YEAR') tb2 " ;
  $stSql .= "   ON tb2.person00id = p0.person00id " ;
  $stSql .= " LEFT JOIN (SELECT person00id, fieldvalue AS MAJOR FROM person02 WHERE fieldcode = 'MAJOR') tb3 " ;
  $stSql .= "   ON tb3.person00id = p0.person00id " ;
  $stSql .= " LEFT JOIN (SELECT person00id, fieldvalue AS DATEENROLLED FROM person02 WHERE fieldcode = 'DATEENROLLED') tb4 " ;
  $stSql .= "   ON tb4.person00id = p0.person00id " ;
  $stSql .= " LEFT JOIN (SELECT person00id, fieldvalue AS ENTRYTYPE FROM person02 WHERE fieldcode = 'ENTRYTYPE') tb5 " ;
  $stSql .= "   ON tb5.person00id = p0.person00id " ;
  $stSql .= " LEFT JOIN (SELECT person00id, fieldvalue AS STATUS FROM person02 WHERE fieldcode = 'STATUS') tb6 " ;
  $stSql .= "   ON tb6.person00id = p0.person00id " ;
  $stSql .= " LEFT JOIN (SELECT person00id, fieldvalue AS AGE FROM person01 WHERE fieldcode = 'AGE') tb7 " ;
  $stSql .= "   ON tb7.person00id = p0.person00id " ;
  $stSql .= " LEFT JOIN (SELECT person00id, fieldvalue AS GENDER FROM person01 WHERE fieldcode = 'GENDER') tb8 " ;
  $stSql .= "   ON tb8.person00id = p0.person00id " ;
  $stSql .= " LEFT JOIN (SELECT person00id, fieldvalue AS HEIGHT FROM person01 WHERE fieldcode = 'HEIGHT') tb9 " ;
  $stSql .= "   ON tb9.person00id = p0.person00id " ;
  $stSql .= " LEFT JOIN (SELECT person00id, fieldvalue AS WEIGHT FROM person01 WHERE fieldcode = 'WEIGHT') tb10 " ;
  $stSql .= "   ON tb10.person00id = p0.person00id " ;
  $stSql .= " LEFT JOIN (SELECT person00id, fieldvalue AS CIVILSTATUS FROM person01 WHERE fieldcode = 'CIVILSTATUS') tb11 " ;
  $stSql .= "   ON tb11.person00id = p0.person00id " ;
  $stSql .= " LEFT JOIN (SELECT person00id, fieldvalue AS RELIGION FROM person01 WHERE fieldcode = 'RELIGION') tb12 " ;
  $stSql .= "   ON tb12.person00id = p0.person00id " ;
  $stSql .= " LEFT JOIN (SELECT person00id, fieldvalue AS CONTACT FROM person01 WHERE fieldcode = 'CONTACT') tb13 " ;
  $stSql .= "   ON tb13.person00id = p0.person00id " ;
  $stSql .= " LEFT JOIN (SELECT person00id, fieldvalue AS EMAIL FROM person01 WHERE fieldcode = 'EMAIL') tb14 " ;
  $stSql .= "   ON tb14.person00id = p0.person00id " ;
  $stSql .= " LEFT JOIN (SELECT person00id, fieldvalue AS ADDRESS FROM person01 WHERE fieldcode = 'ADDRESS') tb15 " ;
  $stSql .= "   ON tb15.person00id = p0.person00id " ;
  $stSql .= " LEFT JOIN (SELECT person00id, fieldvalue AS BIRTHDATE FROM person01 WHERE fieldcode = 'BIRTHDATE') tb16 " ;
  $stSql .= "   ON tb16.person00id = p0.person00id " ;
  $stSql .= " LEFT JOIN (SELECT person00id,lastname,firstname,middlename,nameex FROM person00) tb17 " ;
  $stSql .= "   ON tb17.person00id = p0.person00id " ;
  $stSql .= " WHERE p0.active = 1 " ;

  if ($stName != '') {
    $stSql .= " AND (firstname LIKE '%". $stName ."%' OR lastname LIKE '%". $stName ."%' OR middlename LIKE '%". $stName ."%' )" ;
  }
  
  if ($stIDNO != '') {
    $stSql .= " AND p0.schoolidno  = '". $stIDNO ."' " ;
  }

  $res = mysqli_query($conn,$stSql);
  if (mysqli_num_rows($res) > 0) {
    while ($retval = mysqli_fetch_array($res)) {
      $nPerson00id   =  $retval['person00id'];
      $nSchoolidno   =  $retval['schoolidno'];
      $stLastname    =  $retval['lastname'];
      $stFirstname   =  $retval['firstname'];
      $stMiddlename  =  $retval['middlename'];
      $stNameex      =  $retval['nameex'];
      $stCourse      =  $retval['COURSE'];
      $stYear        =  $retval['YEAR'];
      $stMajor       =  $retval['MAJOR'];
      $stDateenrolled=  $retval['DATEENROLLED'];
      $stEntrytype   =  $retval['ENTRYTYPE'];
      $stStatus      =  $retval['STATUS'];
      $nAge          =  $retval['AGE'];
      $stGender      =  $retval['GENDER'];
      $stHeight      =  $retval['HEIGHT'];
      $stWeight      =  $retval['WEIGHT'];
      $stCivilstatus =  $retval['CIVILSTATUS'];
      $stReligion    =  $retval['RELIGION'];
      $stContact     =  $retval['CONTACT'];
      $stEmail       =  $retval['EMAIL'];
      $stAddress     =  $retval['ADDRESS'];
      $dBirthdate    =  $retval['BIRTHDATE'];

      if ($stStatus == 'REG') {
        $stStatus = "Regular";
      }
      else {
        $stStatus = "Iregular";
      }

      $arrayLooper = array(
        "person00id" => $nPerson00id ,
        "lastname" => $stLastname ,
        "firstname" => $stFirstname ,
        "middlename" => $stMiddlename ,
        "nameex" => $stNameex ,
        "course" => $stCourse ,
        "year" => $stYear ,
        "major" => $stMajor ,
        "dateenrolled" => $stDateenrolled ,
        "entrytype" => $stEntrytype ,
        "status" => $stStatus ,
        "age" => $nAge ,
        "gender" => $stGender ,
        "height" => $stHeight ,
        "weight" => $stWeight ,
        "civilstatus" => $stCivilstatus ,
        "religion" => $stReligion ,
        "contact" => $stContact ,
        "email" => $stEmail ,
        "address" => $stAddress ,
        "birthdate" => $dBirthdate ,
        "schoolidno" => $nSchoolidno 
      );

      array_push($arrayCollection,$arrayLooper);

    }

  }

  $retArray = array(
    "data" => $arrayCollection,
    "status" => "success" );


  print json_encode($retArray);

?>

