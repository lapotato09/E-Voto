<?php
	session_start();
	include '../../includes/Conn.inc';

	$retArray = array();
	$arrayCollection = array();

	$nCandidacy00id = 0;
	$stStudNumber = "";
	$stLastName = "";
	$stMiddleName = "";
	$stFirstName = "";
	$stPosition = "";
	$stParamStatus = "";
	$stCourse = "";
	
	$userdata = json_decode($_REQUEST['data'], true);
	$stParamStatus = $userdata['status'];

	$stSql = "";
	$stSql .= " SELECT candidacy00.*, lastname, middlename, firstname, position, course FROM candidacy00  ";
	$stSql .= " LEFT JOIN (SELECT candidacy00id, fieldvalue AS lastname FROM candidacy01 WHERE fieldcode IN ('LASTNAME')) lname  ";
	$stSql .= " 	ON candidacy00.candidacy00id = lname.candidacy00id ";
	$stSql .= " LEFT JOIN (SELECT candidacy00id, fieldvalue AS firstname FROM candidacy01 WHERE fieldcode IN ('FIRSTNAME')) fname  ";
	$stSql .= " 	ON candidacy00.candidacy00id = fname.candidacy00id ";
	$stSql .= " LEFT JOIN (SELECT candidacy00id, fieldvalue AS middlename FROM candidacy01 WHERE fieldcode IN ('MIDDLENAME')) mname  ";
	$stSql .= " 	ON candidacy00.candidacy00id = mname.candidacy00id ";
	$stSql .= " LEFT JOIN (SELECT candidacy00id, fieldvalue AS position FROM candidacy01 WHERE fieldcode IN ('POSITION')) pos  ";
	$stSql .= " 	ON candidacy00.candidacy00id = pos.candidacy00id ";
	$stSql .= " LEFT JOIN (SELECT candidacy00id, fieldvalue AS course FROM candidacy01 WHERE fieldcode IN ('COURSE')) course  ";
	$stSql .= " 	ON candidacy00.candidacy00id = course.candidacy00id ";
	$stSql .= " WHERE is_active = 1 AND status = '". $stParamStatus ."' ";

	try {
		$retval = mysqli_query($conn, $stSql);
		if (mysqli_num_rows($retval) > 0) {
			while ($res = mysqli_fetch_array($retval)) {
				$nCandidacy00id = $res["candidacy00id"];
				$stStudNumber = $res["lrn"];
				$stLastName = $res["lastname"];
				$stFirstName = $res["firstname"];
				$stMiddleName = $res["middlename"];
				$stPosition = $res["position"];
				$stCourse = $res["course"];

				$res_data = array(
					"candidacy00id" => $nCandidacy00id,
					"studentnumber" => $stStudNumber,
					"lastname" => $stLastName,
					"firstname" => $stFirstName,
					"middlename" => $stMiddleName,
					"position" => $stPosition,
					"course" => $stCourse
				);

				array_push($arrayCollection, $res_data);

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