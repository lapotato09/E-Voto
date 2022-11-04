<?php
	session_start();

	include '../../../includes/Conn.inc';
	$aRetval = array();
	$bWithChanges = false;

	$stUserData = json_decode($_REQUEST['data'], true);
	$aOld = $stUserData['olddata'];
	$aNew = $stUserData['newdata'];
	$nCourse00id	 = $aOld['data']['nCourse00id'];

	// UPDATE COURSE00
	$courseDiff = array_diff($aOld['data'], $aNew['data']);
	$ctr = 0;
	$stSQL1 = "";
	$stSQL1 .= " UPDATE course00 SET ";
	foreach ($courseDiff as $key => $value) {
		$ctr += 1;
		$bWithChanges = true;

		$stSQL1 .= " ". $key ." = '".  $aNew['data'][$key] ."' ";

		if ($ctr != count($courseDiff)) {
			$stSQL1 .= ", ";
		}
		else {
			$stSQL1 .= " , code = '". strtoupper($aNew['data']['degreecode']) . strtoupper($aNew['data']['coursecode']) ."' ";
			$stSQL1 .= " WHERE course00id = " .$nCourse00id;

			try {
				mysqli_query($conn, $stSQL1);
			} catch (Exception $e) {
				$aRetval = array(
					"data" => null,
					"status" => "error",
					"message" => "Caught Exception" .$e-> getMessage()
				);

				print json_encode($aRetval);
				exit();
			}

		}
	}

	$nFlag = $stUserData['major'];
	if ($nFlag == 1) {
		// UPDATE COURSE01
		$stSQL1 = "";
		$stSQL1 .= " DELETE FROM course01 WHERE fieldcode = 'MAJOR' AND course00id = ".$nCourse00id;

		try {
			mysqli_query($conn, $stSQL1);
		} catch (Exception $e) {
			$aRetval = array(
				"data" => null,
				"status" => "error",
				"message" => "Caught Exception" .$e-> getMessage()
			);

			print json_encode($aRetval);
			exit();
		}

		foreach ($aNew['MajorEntry'] as $key => $value) {
			if ($value['fieldvalue'] != '') {
				$stSQL1 = "";
				$stSQL1 .= " INSERT course01(course00id, fieldcode, fieldname, fieldtype, fieldvalue, datecreated) ";
				$stSQL1 .= " VALUES(".$nCourse00id.", 'MAJOR', '". strtoupper($value['fieldname']) ."', 'VARCHAR', '". ucwords($value['fieldvalue']) ."', NOW()) ";

				try {
					mysqli_query($conn, $stSQL1);
				} catch (Exception $e) {
					$aRetval = array(
						"data" => null,
						"status" => "error",
						"message" => "Caught Exception" .$e-> getMessage()
					);

					print json_encode($aRetval);
					exit();
				}
			}
		}

	}


	$nFlag = $stUserData['year'];
	if ($nFlag == 1) {
		// UPDATE COURSE01 YEAR
		$stSQL1 = "";
		$stSQL1 .= " DELETE FROM course01 WHERE fieldcode = 'YEAR' AND course00id = ".$nCourse00id;

		try {
			mysqli_query($conn, $stSQL1);
		} catch (Exception $e) {
			$aRetval = array(
				"data" => null,
				"status" => "error",
				"message" => "Caught Exception" .$e-> getMessage()
			);

			print json_encode($aRetval);
			exit();
		}

		foreach ($aNew['YearLevelEntry'] as $key => $value) {
			if ($value['fieldvalue'] != '') {
				$stSQL1 = "";
				$stSQL1 .= " INSERT course01(course00id, fieldcode, fieldname, fieldtype, fieldvalue, datecreated) ";
				$stSQL1 .= " VALUES(".$nCourse00id.", 'YEAR', '". strtoupper($value['fieldname']) ."', 'VARCHAR', '". ucwords($value['fieldvalue']) ."', NOW()) ";

				try {
					mysqli_query($conn, $stSQL1);
				} catch (Exception $e) {
					$aRetval = array(
						"data" => null,
						"status" => "error",
						"message" => "Caught Exception" .$e-> getMessage()
					);

					print json_encode($aRetval);
					exit();
				}
			}
		}
	}


	$nFlag = $stUserData['section'];
	if ($nFlag == 1) {
		// UPDATE COURSE01 SECTION
		$stSQL1 = "";
		$stSQL1 .= " DELETE FROM course01 WHERE fieldcode = 'SECTION' AND course00id = ".$nCourse00id;

		try {
			mysqli_query($conn, $stSQL1);
		} catch (Exception $e) {
			$aRetval = array(
				"data" => null,
				"status" => "error",
				"message" => "Caught Exception" .$e-> getMessage()
			);

			print json_encode($aRetval);
			exit();
		}

		foreach ($aNew['SectionEntry'] as $key => $value) {
			if ($value['fieldvalue'] != '') {
				$stSQL1 = "";
				$stSQL1 .= " INSERT course01(course00id, fieldcode, fieldname, fieldtype, fieldvalue, datecreated) ";
				$stSQL1 .= " VALUES(".$nCourse00id.", 'SECTION', '". strtoupper($value['fieldname']) ."', 'VARCHAR', '". ucwords($value['fieldvalue']) ."', NOW()) ";

				try {
					mysqli_query($conn, $stSQL1);
				} catch (Exception $e) {
					$aRetval = array(
						"data" => null,
						"status" => "error",
						"message" => "Caught Exception" .$e-> getMessage()
					);

					print json_encode($aRetval);
					exit();
				}
			}
		}
	}


	$aRetval = array(
		"data" => null,
		"status" => "success"
	);
		
	print json_encode($aRetval);

?>
