<?php 
  session_start();
  include '../../includes/Conn.inc';
  $nPopulationCount = 0;
  $nTotalVoted = 0;
  $nCount = 0;
  $nPercentage = 0;
  $nCoursePop = 0;
  $nCourseVote = 0;
  $stCourse = "";

  $localArray = array();
  $CourseSummary = array();
  $looper = array();


  // FOR TOTAL POPULATION
  $stSQL1 = "";
  $stSQL1 .= " SELECT ";
  $stSQL1 .= "    masterlist00.person00id, ";
  $stSQL1 .= "    masterlist00.schoolidno, ";
  $stSQL1 .= "    fieldcode,  ";
  $stSQL1 .= "    fieldvalue ";
  $stSQL1 .= " FROM masterlist00 ";
  $stSQL1 .= " LEFT JOIN (SELECT person00id, fieldcode, fieldvalue FROM person02 WHERE fieldcode = 'ENTRYTYPE' ) p02 ";
  $stSQL1 .= "   ON p02.person00id = masterlist00.person00id ";
  $stSQL1 .= " WHERE fieldvalue = 'student' AND active = 1 ";

  try {
    $retval = mysqli_query($conn, $stSQL1);
    if (mysqli_num_rows($retval) > 0) {
      while (mysqli_fetch_array($retval)) {
        $nPopulationCount += 1;
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


  // GET COUNT NG BUMOTO
  $stSQL1 = "";
  $stSQL1 .= " SELECT COUNT(*) AS total_voted FROM rawvotes00 WHERE is_active = 1" ;

  try {
    $retval = mysqli_query($conn, $stSQL1);
    if (mysqli_num_rows($retval) > 0) {
      $res = mysqli_fetch_array($retval);
      $nTotalVoted = $res['total_voted'];
    }    
  } catch (Exception $e) {
    $retval_array = array(
      "data" => null,
      "status" => "error"
    );    

    print json_encode($retval_array);
    exit();     
  }

 
  // GET DISTRIBUTION OF VOTES
  $stSQL1 = "";
  $stSQL1 .= " SELECT ";
  $stSQL1 .= "   fieldvalue, ";
  $stSQL1 .= "   COUNT(fieldvalue) AS count ";
  $stSQL1 .= " FROM rawvotes00 ";
  $stSQL1 .= " LEFT JOIN ( ";
  $stSQL1 .= "   SELECT  ";
  $stSQL1 .= "      masterlist00.person00id,  ";
  $stSQL1 .= "      masterlist00.schoolidno,  ";
  $stSQL1 .= "      fieldcode,   ";
  $stSQL1 .= "      fieldvalue  ";
  $stSQL1 .= "   FROM masterlist00  ";
  $stSQL1 .= "   LEFT JOIN (SELECT person00id, fieldcode, fieldvalue FROM person02 WHERE fieldcode = 'COURSE' ) p02  ";
  $stSQL1 .= "     ON p02.person00id = masterlist00.person00id  ";
  $stSQL1 .= "   WHERE active = 1  ";
  $stSQL1 .= " ) masterlist ";
  $stSQL1 .= "   ON masterlist.schoolidno = rawvotes00.idno ";
  $stSQL1 .= " WHERE is_active = 1 ";
  $stSQL1 .= " GROUP BY fieldvalue ";

  try {
    $retval = mysqli_query($conn, $stSQL1);
    if (mysqli_num_rows($retval) > 0) {
      while($res = mysqli_fetch_array($retval)) {
        $stCourse = $res['fieldvalue'];
        $nCount = $res['count'];
        $nPercentage = ($nCount / $nTotalVoted) * 100;

        $looper = array(
          'course' => $stCourse,
          'count' => $nCount,
          'percentage' => ($nCount / $nTotalVoted) * 100
          // 'percentage' => number_format($nPercentage, 2)
        );

        array_push($localArray, $looper);
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


  // GET SUMMARY
  $stSQL1 = "";
  $stSQL1 .= "  SELECT  " ;
  $stSQL1 .= "    population.fieldvalue AS course, " ;
  $stSQL1 .= "      COALESCE(total_population_count, 0) AS total_population_count, " ;
  $stSQL1 .= "      COALESCE(total_vote_count, 0) AS total_vote_count " ;
  $stSQL1 .= "  FROM ( " ;
  $stSQL1 .= "  SELECT  " ;
  $stSQL1 .= "       fieldvalue,  " ;
  $stSQL1 .= "       COUNT(fieldvalue) AS total_population_count " ;
  $stSQL1 .= "    FROM masterlist00  " ;
  $stSQL1 .= "    LEFT JOIN (SELECT person00id, fieldcode, fieldvalue FROM person02 WHERE fieldcode = 'COURSE' ) p02  " ;
  $stSQL1 .= "      ON p02.person00id = masterlist00.person00id  " ;
  $stSQL1 .= "    WHERE active = 1   " ;
  $stSQL1 .= "    GROUP BY fieldvalue " ;
  $stSQL1 .= "    ) population " ;
  $stSQL1 .= "  LEFT JOIN ( " ;
  $stSQL1 .= "    SELECT " ;
  $stSQL1 .= "    fieldvalue, " ;
  $stSQL1 .= "    count(fieldvalue) AS total_vote_count " ;
  $stSQL1 .= "  FROM rawvotes00 " ;
  $stSQL1 .= "  LEFT JOIN ( " ;
  $stSQL1 .= "    SELECT  " ;
  $stSQL1 .= "       masterlist00.person00id,  " ;
  $stSQL1 .= "       masterlist00.schoolidno,  " ;
  $stSQL1 .= "       fieldcode,   " ;
  $stSQL1 .= "       fieldvalue  " ;
  $stSQL1 .= "    FROM masterlist00  " ;
  $stSQL1 .= "    LEFT JOIN (SELECT person00id, fieldcode, fieldvalue FROM person02 WHERE fieldcode = 'COURSE' ) p02  " ;
  $stSQL1 .= "      ON p02.person00id = masterlist00.person00id  " ;
  $stSQL1 .= "    WHERE active = 1  " ;
  $stSQL1 .= "  ) masterlist " ;
  $stSQL1 .= "    ON masterlist.schoolidno = rawvotes00.idno " ;
  $stSQL1 .= "  WHERE is_active = 1 " ;
  $stSQL1 .= "  GROUP BY fieldvalue " ;
  $stSQL1 .= "  ) count " ;
  $stSQL1 .= "    ON count.fieldvalue = population.fieldvalue " ;

  try {
    $retval = mysqli_query($conn, $stSQL1);
    if (mysqli_num_rows($retval) > 0) {
      while ($res = mysqli_fetch_array($retval)) {
        $stCourse = $res['course'];
        $nCoursePop = $res['total_population_count'];
        $nCourseVote = $res['total_vote_count'];

        $looper = array(
          "course" => $stCourse,
          "course_population" => $nCoursePop,
          "course_vote" => $nCourseVote, 
          "percentage" => ($nCourseVote / $nCoursePop) * 100
        );

        array_push($CourseSummary, $looper);
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
    "total_population" => $nPopulationCount,
    "total_voted" => $nTotalVoted,
    "distribution" => $localArray,
    "summary" => $CourseSummary,
    "status" => "success"
  );

  print json_encode($retval_array);

  // $object = (object) ['property' => 'sample']; --- creating object

?>