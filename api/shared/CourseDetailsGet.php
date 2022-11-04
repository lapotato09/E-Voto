<?php
  session_start();

  include '../../includes/Conn.inc';

  $retVal            = array();
  $courseCollection  = array();
  $majorCollection   = array();
  $sectionCollection = array();
  $yearCollection    = array();
  $retArray          = array();

  $nCourse01id = 0;
  $nCourse00id = 0;
  $stFieldcode = "";
  $stFieldname = "";
  $stFieldtype = "";
  $stFieldvalue = "";
  $dDatecreated = "";


  // Get course00
  $stSQL1 = "";
  $stSQL1 .= " SELECT * FROM course00 WHERE active = 1 " ;

  try {
    $retVal = mysqli_query($conn, $stSQL1);
    if (mysqli_num_rows($retVal) > 0) {
      while ($res = mysqli_fetch_array($retVal)) {
        $nCourse00id   = $res['course00id'];
        $stDegree      = $res['degree'];
        $stDegreecode  = $res['degreecode'];
        $stCourse      = $res['course'];
        $stCoursecode  = $res['coursecode'];
        $stDescription = $res['description'];
        $stCode        = $res['code'];

        $lData = array(
          "course00id" => $nCourse00id,
          "degree" => $stDegree,
          "degreecode" => $stDegreecode,
          "course" => $stCourse,
          "coursecode" => $stCoursecode,
          "description" => $stDescription,
          "code" => $stCode
        );

        array_push($courseCollection, $lData);

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


  // Get MAJOR on course01
  $stSQL1 = "";
  $stSQL1 .= "  SELECT  " ;
  $stSQL1 .= "    course01id, " ;
  $stSQL1 .= "     course00.course00id, " ;
  $stSQL1 .= "     fieldcode, " ;
  $stSQL1 .= "     fieldname, " ;
  $stSQL1 .= "     fieldtype, " ;
  $stSQL1 .= "     fieldvalue, " ;
  $stSQL1 .= "     course00.datecreated, " ;
  $stSQL1 .= "     code " ;
  $stSQL1 .= "  FROM course01  " ;
  $stSQL1 .= "  LEFT JOIN course00 ON  " ;
  $stSQL1 .= "    course00.course00id = course01.course00id " ;
  $stSQL1 .= "  WHERE fieldcode = 'MAJOR' " ;

  try {
    $retVal = mysqli_query($conn, $stSQL1);
    if (mysqli_num_rows($retVal) > 0) {
      while ($res = mysqli_fetch_array($retVal)) {
        $stCode      = $res['code'];
        $nCourse01id = $res['course01id'];
        $nCourse00id = $res['course00id'];
        $stFieldcode = $res['fieldcode'];
        $stFieldname = $res['fieldname'];
        $stFieldtype = $res['fieldtype'];
        $stFieldvalue = ucwords($res['fieldvalue']);
        $dDatecreated = $res['datecreated'];

        $lData = array(
          "course01id" => $nCourse01id,
          "course00id" => $nCourse00id,
          "fieldcode" => $stFieldcode,
          "fieldname" => $stFieldname,
          "fieldtype" => $stFieldtype,
          "fieldvalue" => $stFieldvalue,
          "datecreated" => $dDatecreated,
          "coursecode" => $stCode
        );

        array_push($majorCollection, $lData);

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


  // Get SECTION on course01
  $stSQL1 = "";
  $stSQL1 .= "  SELECT  " ;
  $stSQL1 .= "    course01id, " ;
  $stSQL1 .= "     course00.course00id, " ;
  $stSQL1 .= "     fieldcode, " ;
  $stSQL1 .= "     fieldname, " ;
  $stSQL1 .= "     fieldtype, " ;
  $stSQL1 .= "     fieldvalue, " ;
  $stSQL1 .= "     course00.datecreated, " ;
  $stSQL1 .= "     code " ;
  $stSQL1 .= "  FROM course01  " ;
  $stSQL1 .= "  LEFT JOIN course00 ON  " ;
  $stSQL1 .= "    course00.course00id = course01.course00id " ;
  $stSQL1 .= "  WHERE fieldcode = 'SECTION' " ;

  try {
    $retVal = mysqli_query($conn, $stSQL1);
    if (mysqli_num_rows($retVal) > 0) {
      while ($res = mysqli_fetch_array($retVal)) {
        $stCode      = $res['code'];
        $nCourse01id = $res['course01id'];
        $nCourse00id = $res['course00id'];
        $stFieldcode = $res['fieldcode'];
        $stFieldname = $res['fieldname'];
        $stFieldtype = $res['fieldtype'];
        $stFieldvalue = ucwords($res['fieldvalue']);
        $dDatecreated = $res['datecreated'];

        $lData = array(
          "course01id" => $nCourse01id,
          "course00id" => $nCourse00id,
          "fieldcode" => $stFieldcode,
          "fieldname" => $stFieldname,
          "fieldtype" => $stFieldtype,
          "fieldvalue" => $stFieldvalue,
          "datecreated" => $dDatecreated,
          "coursecode" => $stCode
        );

        array_push($sectionCollection, $lData);

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


  // Get YEAR on course01
  $stSQL1 = "";
  $stSQL1 .= "  SELECT  " ;
  $stSQL1 .= "    course01id, " ;
  $stSQL1 .= "     course00.course00id, " ;
  $stSQL1 .= "     fieldcode, " ;
  $stSQL1 .= "     fieldname, " ;
  $stSQL1 .= "     fieldtype, " ;
  $stSQL1 .= "     fieldvalue, " ;
  $stSQL1 .= "     course00.datecreated, " ;
  $stSQL1 .= "     code " ;
  $stSQL1 .= "  FROM course01  " ;
  $stSQL1 .= "  LEFT JOIN course00 ON  " ;
  $stSQL1 .= "    course00.course00id = course01.course00id " ;
  $stSQL1 .= "  WHERE fieldcode = 'YEAR' " ;

  try {
    $retVal = mysqli_query($conn, $stSQL1);
    if (mysqli_num_rows($retVal) > 0) {
      while ($res = mysqli_fetch_array($retVal)) {
        $stCode      = $res['code'];
        $nCourse01id = $res['course01id'];
        $nCourse00id = $res['course00id'];
        $stFieldcode = $res['fieldcode'];
        $stFieldname = $res['fieldname'];
        $stFieldtype = $res['fieldtype'];
        $stFieldvalue = ucwords($res['fieldvalue']);
        $dDatecreated = $res['datecreated'];

        $lData = array(
          "course01id" => $nCourse01id,
          "course00id" => $nCourse00id,
          "fieldcode" => $stFieldcode,
          "fieldname" => $stFieldname,
          "fieldtype" => $stFieldtype,
          "fieldvalue" => $stFieldvalue,
          "datecreated" => $dDatecreated,
          "coursecode" => $stCode
        );

        array_push($yearCollection, $lData);

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

  $data = array(
    "course" => $courseCollection,
    "major" => $majorCollection,
    "section" => $sectionCollection,
    "year" => $yearCollection
  );

  $retArray = array(
    "data" => $data,
    "status" => "success"
  );  

  print json_encode($retArray);

?>