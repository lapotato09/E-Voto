<?php
	session_start();

	include '../../../includes/Conn.inc';

	$retVal 				 	 = array();
	$majorCollection 	 = array();
	$sectionCollection = array();
	$yearCollection 	 = array();
	$retArray 			 	 = array();

	$paramCourse00id   = 0;

	$stUserData = json_decode($_REQUEST['data'], true);
	$paramCourse00id = $stUserData['nCourse00id'];

	$nCourse01id = 0;
	$nCourse00id = 0;
	$stFieldcode = "";
	$stFieldname = "";
	$stFieldtype = "";
	$stFieldvalue = "";
	$dDatecreated = "";

	// Get MAJOR on course01
	$stSQL1 = "";
	$stSQL1 .= " SELECT * FROM course01 WHERE fieldcode = 'MAJOR' AND course00id = ". $paramCourse00id;

	try {
		$retVal = mysqli_query($conn, $stSQL1);
		if (mysqli_num_rows($retVal) > 0) {
			while ($res = mysqli_fetch_array($retVal)) {
				$nCourse01id = $res['course01id'];
				$nCourse00id = $res['course00id'];
				$stFieldcode = $res['fieldcode'];
				$stFieldname = $res['fieldname'];
				$stFieldtype = $res['fieldtype'];
				$stFieldvalue = $res['fieldvalue'];
				$dDatecreated = $res['datecreated'];

				$lData = array(
					"course01id" => $nCourse01id,
					"course00id" => $nCourse00id,
					"fieldcode" => $stFieldcode,
					"fieldname" => $stFieldname,
					"fieldtype" => $stFieldtype,
					"fieldvalue" => $stFieldvalue,
					"datecreated" => $dDatecreated,
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
	$stSQL1 .= " SELECT * FROM course01 WHERE fieldcode = 'SECTION' AND course00id = ". $paramCourse00id;

	try {
		$retVal = mysqli_query($conn, $stSQL1);
		if (mysqli_num_rows($retVal) > 0) {
			while ($res = mysqli_fetch_array($retVal)) {
				$nCourse01id = $res['course01id'];
				$nCourse00id = $res['course00id'];
				$stFieldcode = $res['fieldcode'];
				$stFieldname = $res['fieldname'];
				$stFieldtype = $res['fieldtype'];
				$stFieldvalue = $res['fieldvalue'];
				$dDatecreated = $res['datecreated'];

				$lData = array(
					"course01id" => $nCourse01id,
					"course00id" => $nCourse00id,
					"fieldcode" => $stFieldcode,
					"fieldname" => $stFieldname,
					"fieldtype" => $stFieldtype,
					"fieldvalue" => $stFieldvalue,
					"datecreated" => $dDatecreated,
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
	$stSQL1 .= " SELECT * FROM course01 WHERE fieldcode = 'YEAR' AND course00id = ". $paramCourse00id;

	try {
		$retVal = mysqli_query($conn, $stSQL1);
		if (mysqli_num_rows($retVal) > 0) {
			while ($res = mysqli_fetch_array($retVal)) {
				$nCourse01id = $res['course01id'];
				$nCourse00id = $res['course00id'];
				$stFieldcode = $res['fieldcode'];
				$stFieldname = $res['fieldname'];
				$stFieldtype = $res['fieldtype'];
				$stFieldvalue = $res['fieldvalue'];
				$dDatecreated = $res['datecreated'];

				$lData = array(
					"course01id" => $nCourse01id,
					"course00id" => $nCourse00id,
					"fieldcode" => $stFieldcode,
					"fieldname" => $stFieldname,
					"fieldtype" => $stFieldtype,
					"fieldvalue" => $stFieldvalue,
					"datecreated" => $dDatecreated,
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


	$retArray = array(
		"major" => $majorCollection,
		"section" => $sectionCollection,
		"year" => $yearCollection,
		"status" => "success"
	);	

	print json_encode($retArray);

?>