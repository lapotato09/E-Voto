<?php
	session_start();

	include '../../../includes/Conn.inc';

	$retVal 				 = array();
	$arrayCollection = array();
	$retArray 			 = array();

	$nCourse00id   = '';
	$stDegreeCode  = '';
	$stDegree 		 = '';
	$stCourseCode	 = '';
	$stCourse 		 = '';
	$stDescription = '';
	$stCode 			 = '';
	$bActive			 = 0;
	$stActive			 = 0;

	$stSQL1 = "";
	$stSQL1 .= " SELECT * FROM course00 ";

	try {
		$retVal = mysqli_query($conn, $stSQL1);
		if (mysqli_num_rows($retVal) > 0) {
			while ($res = mysqli_fetch_array($retVal)) {
				$nCourse00id   = $res['course00id'];
				$stDegreeCode  = $res['degreecode'];
				$stDegree 		 = $res['degree'];
				$stCourseCode	 = $res['coursecode'];
				$stCourse 		 = $res['course'];
				$stDescription = $res['description'];
				$stCode 			 = $res['code'];
				$bActive 			 = $res['active'];

				if ($bActive == 1) {
					$stActive = "Active";
				}
				else {
					$stActive = "Inactive";
				}

				$lData = array(
					"nCourse00id" => $nCourse00id,
					"degreecode" => $stDegreeCode,
					"degree" => $stDegree,
					"coursecode" => $stCourseCode,
					"course" => $stCourse,
					"description" => $stDescription,
					"code" => $stCode,
					"active" => $stActive
				);

				array_push($arrayCollection, $lData);

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
		"data" => $arrayCollection,
		"status" => "success"
	);	

	print json_encode($retArray);

?>