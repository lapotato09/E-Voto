<?php

	session_start();
	include '../../includes/Conn.inc';

	// DECLARING VARIABLES
	$retArray 		  = array();
	$arrCollection  = array();
	$OrgCollection  = array();
	$ElecCollection = array();

	$stParYear 		= '';
	$stParStatus	= '';

	$nFormId 			= 0;
	$stStatus			= '';
	$stActiondate	= '';
	$stStudnumber	= '';
	$stFullName		= '';
	$stCourse			= '';
	$stMajor			= '';
	$stAcadyear		= '';
	$stPosition		= '';
	$stCurryear		= '';
	$stParty			= '';

	// USER DATA SEND BY THE USER
	$userdata = json_decode($_REQUEST['data'], true);
	$stFlag = $userdata['flag'];

	if ($stFlag == 'LOAD') {

		$stParYear 	 = $userdata['year'];
		$stParStatus = $userdata['status'];

		$retVal = '';
		if ($stParStatus === 'ALL') {
			$retVal = "AND cyear.fieldvalue = '". $stParYear . "' ";
		}
		else {
			$retVal = "AND status = '". $stParStatus ."' AND cyear.fieldvalue = '". $stParYear ."' ";
		}
		

		// Create Query
		$stSql = " ";
		$stSql .= "SELECT  ";
		$stSql .= "	candidacy00.candidacy00id, ";
		$stSql .= "	COALESCE(status, '') AS status, ";
		$stSql .= "	COALESCE(actiondate, '') AS actiondate, ";
		$stSql .= "	COALESCE(studnumber.fieldvalue, '') AS studnumber, ";
		$stSql .= "	COALESCE(firstname.fieldvalue, '') AS firstname, ";
		$stSql .= "	COALESCE(lastname.fieldvalue, '') AS lastname, ";
		$stSql .= "	COALESCE(middlename.fieldvalue, '') AS middlename, ";
		$stSql .= "	COALESCE(course.fieldvalue, '') AS course, ";
		$stSql .= "	COALESCE(major.fieldvalue, '') AS major, ";
		$stSql .= "	COALESCE(acadyear.fieldvalue, '') AS acadyear, ";
		$stSql .= "	COALESCE(position.fieldvalue, '') AS position, ";
		$stSql .= "	COALESCE(cyear.fieldvalue, '') AS curryear, ";
		$stSql .= "	COALESCE(party.fieldvalue, '') AS party ";
		$stSql .= "FROM candidacy00  ";
		$stSql .= "LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'STUDNUMBER') studnumber ";
		$stSql .= "	ON candidacy00.candidacy00id = studnumber.candidacy00id  ";
		$stSql .= "LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'FIRSTNAME') firstname ";
		$stSql .= "	ON candidacy00.candidacy00id = firstname.candidacy00id  ";
		$stSql .= "LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'LASTNAME') lastname ";
		$stSql .= "	ON candidacy00.candidacy00id = lastname.candidacy00id  ";
		$stSql .= "LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'MIDDLENAME') middlename ";
		$stSql .= "	ON candidacy00.candidacy00id = middlename.candidacy00id  ";
		$stSql .= "LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'COURSE') course ";
		$stSql .= "	ON candidacy00.candidacy00id = course.candidacy00id  ";
		$stSql .= "LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'MAJOR') major ";
		$stSql .= "	ON candidacy00.candidacy00id = major.candidacy00id  ";
		$stSql .= "LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'ACADYEAR') acadyear ";
		$stSql .= "	ON candidacy00.candidacy00id = acadyear.candidacy00id  ";
		$stSql .= "LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'POSITION') position ";
		$stSql .= "	ON candidacy00.candidacy00id = position.candidacy00id  ";
		$stSql .= "LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'YEAR') cyear ";
		$stSql .= "	ON candidacy00.candidacy00id = cyear.candidacy00id  ";
		$stSql .= "LEFT JOIN (SELECT candidacy00id, fieldvalue FROM candidacy01 WHERE fieldcode = 'PARTYLIST') party ";
		$stSql .= "	ON candidacy00.candidacy00id = party.candidacy00id  ";
		$stSql .= "WHERE actiondate IS NOT NULL AND studnumber.fieldvalue IS NOT NULL ";
		$stSql .= "AND is_active = 1 ";
		$stSql .= $retVal;

		// EXECUTE QUERY
		$result = mysqli_query($conn, $stSql);
		if (mysqli_num_rows($result) > 0) {
			while ($res = mysqli_fetch_array($result)) {
				# feth data...
				$nFormId 			= $res['candidacy00id'];
				$stStatus 		= $res['status'];
				$stActiondate = $res['actiondate'];
				$stStudnumber = $res['studnumber'];
				$stFullName		= $res['lastname'] .', '. $res['firstname'] .' '. $res['middlename'];
				$stCourse			= $res['course'];
				$stMajor			= $res['major'];
				$stPosition 	= $res['position'];
				$stCurryear 	= $res['curryear'];
				$stParty		 	= $res['party'];
				$stAcadyear 	= $res['acadyear'];

				// push to array 
				$arrayLooper = array(
					'candidacy00id' => $nFormId, 
					'status' => $stStatus, 
					'actiondate' => $stActiondate, 
					'studnumber' => $stStudnumber, 
					'fullname' => $stFullName, 
					'course' => $stCourse, 
					'major' => $stMajor, 
					'acadyear' => $stAcadyear, 
					'position' => $stPosition, 
					'year' => $stCurryear,
					'party' => $stParty
				);

				array_push($arrCollection, $arrayLooper);

			}
		}

		$retArray = array(
							"data" => $arrCollection,
							"status" => "success" );
	}
	elseif ($stFlag == 'DETAILS') {
		$nCandidacy00id = $userdata['candidacy00id'];
		$stOrgname = '';
		$stOrgYear = '';
		$stOrgPosition = '';
		$stElecAcc = '';
		$stElecYear = '';
		$stElecPos = '';
		$push = true;

		// CREATE query

		$stSql = "";
		$stSql .= " SELECT candidacy00.candidacy00id, status, actiondate, lrn, fieldcode, fieldname, fieldvalue ";
		$stSql .= " FROM candidacy00 ";
		$stSql .= " LEFT JOIN candidacy01 ";
		$stSql .= " ON candidacy00.candidacy00id = candidacy01.candidacy00id ";
		$stSql .= " WHERE candidacy00.candidacy00id = ".$nCandidacy00id." ";

		$stFlag = '';
		$OFlag = '1';
		$stElecFlag = '';
		$EFlag = '1';

		// exec query
		$result = mysqli_query($conn, $stSql);
		if (mysqli_num_rows($result) > 0) {
			while ($res = mysqli_fetch_array($result)) {
				$nFormId 			= $res['candidacy00id'];
				$stStatus 		= $res['status'];
				$stActiondate = $res['actiondate'];
				$stStudnumber = $res['lrn'];
				$stFieldcode	= $res['fieldcode'];
				$stFieldname	= $res['fieldname'];
				$stFieldvalue	= $res['fieldvalue'];

				// ORGNAME
				if (substr($stFieldcode,0,3) == 'ORG') {
					$stFlag = substr($stFieldcode,strlen($stFieldcode)-1, strlen($stFieldcode) );

					if ($stFlag != $OFlag) {
						if ($stOrgname != '') {
							$OrgLooper = array(
								'name' => $stOrgname,
								'year' => $stOrgYear,
								'position' => $stOrgPosition,
							);

							array_push($OrgCollection, $OrgLooper);
							$OFlag = $stFlag;
						}
					}

					if ($stFlag == $OFlag) {
						if (substr($stFieldcode,0,7) == 'ORGNAME') {
							$stOrgname = $stFieldvalue;
						}
						elseif (substr($stFieldcode,0,7) == 'ORGYEAR') {
							$stOrgYear = $stFieldvalue;
						}
						elseif (substr($stFieldcode,0,11) == 'ORGPOSITION') {
							$stOrgPosition = $stFieldvalue;
						}
					}	
				}			

				// ELEC
				if (substr($stFieldcode,0,4) == 'ELEC') {
					$stElecFlag = substr($stFieldcode,strlen($stFieldcode)-1, strlen($stFieldcode) );

					if ($stElecFlag != $EFlag) {
						if ($stElecPos != '') {
							$ElecLooper = array(
								'accomp' => $stElecAcc,
								'year' => $stElecYear,
								'position' => $stElecPos,
							);

							array_push($ElecCollection, $ElecLooper);
							$EFlag = $stElecFlag;
						}
					}

					if ($stElecFlag == $EFlag) {
						if (substr($stFieldcode,0,7) == 'ELECPOS') {
							$stElecPos = $stFieldvalue;
						}
						elseif (substr($stFieldcode,0,8) == 'ELECYEAR') {
							$stElecYear = $stFieldvalue;
						}
						elseif (substr($stFieldcode,0,7) == 'ELECACCOMPLISHMENT') {
							$stElecAcc = $stFieldvalue;
						}
					}	
				}		

				$arrayLooper = array(
					'formid' => $nFormId , 
					'status' => $stStatus , 
					'actiondate' => $stActiondate , 
					'studentno' => $stStudnumber , 
					'fieldcode' => $stFieldcode , 
					'fieldname' => $stFieldname , 
					'fieldvalue' => $stFieldvalue ,
				);

				array_push($arrCollection, $arrayLooper);
			}
		}

		if ($stOrgname != '') {
			$OrgLooper = array(
				'name' => $stOrgname,
				'year' => $stOrgYear,
				'position' => $stOrgPosition,
			);

			array_push($OrgCollection, $OrgLooper);
		}

		if ($stElecPos != '') {
			$ElecLooper = array(
				'accomp' => $stElecAcc,
				'year' => $stElecYear,
				'position' => $stElecPos,
			);

			array_push($ElecCollection, $ElecLooper);
		}

		$retArray = array(
				"data" => $arrCollection,
				"org" => $OrgCollection,
				"elec" => $ElecCollection,
				"status" => "success" );
	}

	print json_encode($retArray);

?>

