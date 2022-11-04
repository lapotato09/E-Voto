<?php 
  session_start();

  include '../../includes/Conn.inc';

  // RETURN ARRAY
  $retval_array = array();
  $looper = array();
  $array_collection = array();

  // LOCALS
  $nCandidacy00id = 0;
  $stStatus = "";
  $stSchoolIDNO = "";
  $bActive = 0;

  // QUERY
  $stSQL2 = "";
  $stSQL2 .= "  SELECT ";
  $stSQL2 .= "    candidacy00.candidacy00id,  ";
  $stSQL2 .= "    COALESCE(STUDNUMBER.fieldvalue, '') AS idno, ";
  $stSQL2 .= "    COALESCE(FIRSTNAME.fieldvalue, '') AS firstname, ";
  $stSQL2 .= "    COALESCE(LASTNAME.fieldvalue, '') AS lastname, ";
  $stSQL2 .= "    COALESCE(MIDDLENAME.fieldvalue, '') AS middlename, "; 
  $stSQL2 .= "    COALESCE(COURSE.fieldvalue, '') AS course, ";
  $stSQL2 .= "    COALESCE(MAJOR.fieldvalue, '') AS major, ";
  $stSQL2 .= "    COALESCE(ACADYEAR.fieldvalue, '') AS acadyear, ";
  $stSQL2 .= "    COALESCE(GENDER.fieldvalue, '') AS gender, ";
  $stSQL2 .= "    COALESCE(AGE.fieldvalue, '') AS age, ";
  $stSQL2 .= "    COALESCE(STATUS.fieldvalue, '') AS status, ";
  $stSQL2 .= "    COALESCE(CONTACTNO.fieldvalue, '') AS contactno, ";
  $stSQL2 .= "    COALESCE(EMAIL.fieldvalue, '') AS email, ";
  $stSQL2 .= "    COALESCE(POSITION.fieldvalue, '') AS position, ";
  $stSQL2 .= "    COALESCE(PARTYLIST.fieldvalue, '') AS partylist, ";
  $stSQL2 .= "    COALESCE(YEAR.fieldvalue, '') AS year, ";
  $stSQL2 .= "    COALESCE(DATEFILED.fieldvalue, '') AS datefiled ";
  $stSQL2 .= "  FROM candidacy00  ";
  $stSQL2 .= "  LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'STUDNUMBER' ) STUDNUMBER ";
  $stSQL2 .= "    ON STUDNUMBER.candidacy00id = candidacy00.candidacy00id ";
  $stSQL2 .= "  LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'FIRSTNAME' ) FIRSTNAME ";
  $stSQL2 .= "    ON FIRSTNAME.candidacy00id = candidacy00.candidacy00id ";
  $stSQL2 .= "  LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'LASTNAME' ) LASTNAME ";
  $stSQL2 .= "    ON LASTNAME.candidacy00id = candidacy00.candidacy00id ";
  $stSQL2 .= "  LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'MIDDLENAME' ) MIDDLENAME ";
  $stSQL2 .= "    ON MIDDLENAME.candidacy00id = candidacy00.candidacy00id ";
  $stSQL2 .= "  LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'COURSE' ) COURSE ";
  $stSQL2 .= "    ON COURSE.candidacy00id = candidacy00.candidacy00id ";
  $stSQL2 .= "  LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'MAJOR' ) MAJOR ";
  $stSQL2 .= "    ON MAJOR.candidacy00id = candidacy00.candidacy00id ";
  $stSQL2 .= "  LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'ACADYEAR' ) ACADYEAR ";
  $stSQL2 .= "    ON ACADYEAR.candidacy00id = candidacy00.candidacy00id ";
  $stSQL2 .= "  LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'GENDER' ) GENDER ";
  $stSQL2 .= "    ON GENDER.candidacy00id = candidacy00.candidacy00id ";
  $stSQL2 .= "  LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'AGE' ) AGE ";
  $stSQL2 .= "    ON AGE.candidacy00id = candidacy00.candidacy00id ";
  $stSQL2 .= "  LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'STATUS' ) STATUS ";
  $stSQL2 .= "    ON STATUS.candidacy00id = candidacy00.candidacy00id ";
  $stSQL2 .= "  LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'CONTACTNO' ) CONTACTNO ";
  $stSQL2 .= "    ON CONTACTNO.candidacy00id = candidacy00.candidacy00id ";
  $stSQL2 .= "  LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'EMAIL' ) EMAIL ";
  $stSQL2 .= "    ON EMAIL.candidacy00id = candidacy00.candidacy00id ";
  $stSQL2 .= "  LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'POSITION' ) POSITION ";
  $stSQL2 .= "    ON POSITION.candidacy00id = candidacy00.candidacy00id ";
  $stSQL2 .= "  LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'PARTYLIST' ) PARTYLIST ";
  $stSQL2 .= "    ON PARTYLIST.candidacy00id = candidacy00.candidacy00id ";
  $stSQL2 .= "  LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'YEAR' ) YEAR ";
  $stSQL2 .= "    ON YEAR.candidacy00id = candidacy00.candidacy00id ";
  $stSQL2 .= "  LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'DATEFILED' ) DATEFILED ";
  $stSQL2 .= "    ON DATEFILED.candidacy00id = candidacy00.candidacy00id ";
  $stSQL2 .= "  WHERE is_active = 1 ";
  $stSQL2 .= "  AND status = 'APPROVED'";
  $stSQL2 .= "  ORDER BY POSITION.fieldvalue, LASTNAME.fieldvalue ";


  $ctr = 0;
  try {
    $retval2 = mysqli_query($conn, $stSQL2);
    if (mysqli_num_rows($retval2) > 0) {
      while ($res2 = mysqli_fetch_array($retval2)) {
        $stSchoolIDNO = $res2['idno'];
        $stFirstName  = $res2['firstname'];
        $stLastName   = $res2['lastname'];
        $stMiddleName = $res2['middlename'];
        $stCourse     = $res2['course'];
        $stMajor      = $res2['major'];
        $stAcadYear   = $res2['acadyear'];
        $stGender     = $res2['gender'];
        $nAge         = $res2['age'];
        $stRegular    = $res2['status'];
        $stContactNo  = $res2['contactno'];
        $stEmail      = $res2['email'];
        $stPosition   = $res2['position'];
        $stParty      = $res2['partylist'];
        $stYear       = $res2['year'];
        $dDateFiled   = $res2['datefiled'];

        if ($ctr == 0) {
          $ctr += 1;
          $lPos = $stPosition;
        }
        elseif ($lPos != $stPosition) {
          $ctr = 0;
          $ctr += 1;
          $lPos = $stPosition;
        }
        else {
          $ctr += 1;
        }

        $looper = array(
          "no" => $ctr,
          "idno" => $stSchoolIDNO,
          "firstname" => $stFirstName,
          "lastname" => $stLastName,
          "middlename" => $stMiddleName,
          "course" => $stCourse,
          "major" => $stMajor,
          "acadyear" => $stAcadYear,
          "gender" => $stGender,
          "age" => $nAge,
          "status" => $stRegular,
          "contactno" => $stContactNo,
          "email" => $stEmail,
          "position" => $stPosition,
          "partylist" => $stParty,
          "year" => $stYear,
          "datefiled" => $dDateFiled,
          "code" => str_replace('-','',str_replace(' ', '', $stSchoolIDNO.$stLastName))
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
    "data" => $array_collection,
    "status" => "success"
  );

  print json_encode($retval_array);

?>