<?php

	session_start();
	include '../../includes/Conn.inc';

	//DECLARING VARIABLES
	$retArray = array();

	$stStudNumber 		= '';
	$stCourse 				= '';
	$stMajor 					= '';
	$stLastName 			= '';
	$stFirstName 			= '';
	$stMiddleName 		= '';
	$stGender 				= '';
	$nAge 						= 0;
	$stStatus 				= '';
	$stEmail	 				= '';
	$stContactNumber 	= '';
	$stPosition 			= '';
	$stParty 					= '';
	$stYear 					= '';
	$dDateFiled 			= '';
	$lstElect					= array();
	$lstOrg 					= array();
	$nCandidacy00id	  = 0;
	$stAcadYear				= '';
	$lWithRecords 		= false;

	// DECODE DATA SEND IN JSAPP
	$userdata = json_decode($_REQUEST['data'], true);

	$stStudNumber		 = $userdata['schoolidno'];
	$stCourse				 = $userdata['course'];
	$stMajor				 = $userdata['major'];
	$stAcadYear			 = $userdata['year'];
	$stLastName			 = $userdata['lastname'];
	$stFirstName		 = $userdata['firstname'];
	$stMiddleName		 = $userdata['middlename'];
	$stGender				 = $userdata['gender'];
	$nAge						 = $userdata['age'];
	$stStatus				 = $userdata['status'];
	$stContactNumber = $userdata['contact'];
	$stEmail				 = $userdata['email'];
	$stPosition			 = $userdata['position'];
	$stParty				 = $userdata['party'];
	$stYear				 	 = $userdata['candidacyyear'];
	$dDateFiled			 = date('Y-m-d H:i:s', strtotime($userdata['datefiled']));
	$lstOrg					 = $userdata['organization_lst'];
	$lstElect				 = $userdata['electoral'];

	$stSql = "";
	$stSql .= " SELECT candidacy00id FROM candidacy00 WHERE lrn = '". $stStudNumber ."' ";
	$stSql .= " AND is_active = 1 AND status NOT IN ('CANCELLED', 'WITHDRAWN', 'DISAPPROVED') ";

	$res = mysqli_query($conn, $stSql);

	if (mysqli_num_rows($res) > 0) {
		$lWithRecords = true;
	}

	if (!$lWithRecords) {
	
		// INSERT TO CANDIDACY00 TABLE
		$stSql = "";
		$stSql .= " INSERT candidacy00 (status,actiondate,datecreated,filedby,lrn,is_active)";
		$stSql .= " VALUES ('FOR_EVALUATION','". $dDateFiled ."',now(),'1', '" . $stStudNumber . "',1)";

	  // EXECUTE QUERY
	  $res = mysqli_query($conn, $stSql); 

	  $stSql = "";
	  $stSql .= " SELECT candidacy00id FROM candidacy00 ";
	  $stSql .= " WHERE is_active = 1 AND lrn = '". $stStudNumber ."' ";
	  $stSql .= " ORDER BY datecreated desc LIMIT 1 ";

	  $res = mysqli_query($conn, $stSql);
	  if (mysqli_num_rows($res) > 0 ) {
	  	while ($ret = mysqli_fetch_array($res)) {
	  		$nCandidacy00id = $ret['candidacy00id'];
	  	}
	  }

	  // INSERT CANDIDACY01 TABLE
	  $stSql = "" ;
	  $stSql .= " INSERT candidacy01(candidacy00id,fieldcode,fieldname,fieldvalue,datecreated)" ;
	  $stSql .= " VALUES " ;
	  $stSql .= " ('". $nCandidacy00id ."','STUDNUMBER', 'Student Number', '". $stStudNumber ."',now() )," ;
	  $stSql .= " ('". $nCandidacy00id ."','FIRSTNAME', 'First Name', '". strtoupper($stFirstName) ."',now() )," ;
	  $stSql .= " ('". $nCandidacy00id ."','LASTNAME', 'Last Name', '". strtoupper($stLastName) ."',now() )," ;
	  $stSql .= " ('". $nCandidacy00id ."','MIDDLENAME', 'Middle Name', '". strtoupper($stMiddleName) ."',now() )," ;
	  $stSql .= " ('". $nCandidacy00id ."','COURSE', 'Course', '". strtoupper($stCourse) ."',now() )," ;
	  $stSql .= " ('". $nCandidacy00id ."','MAJOR', 'Major', '". strtoupper($stMajor) ."',now() )," ;
	  $stSql .= " ('". $nCandidacy00id ."','ACADYEAR', 'Academic Year', '". strtoupper($stAcadYear) ."',now() )," ;
	  $stSql .= " ('". $nCandidacy00id ."','GENDER', 'Gender', '". strtoupper($stGender) ."',now() )," ;
	  $stSql .= " ('". $nCandidacy00id ."','AGE', 'Age', '". strtoupper($nAge) ."',now() )," ;
	  $stSql .= " ('". $nCandidacy00id ."','STATUS', 'Civil Status', '". strtoupper($stStatus) ."',now() )," ;
	  $stSql .= " ('". $nCandidacy00id ."','CONTACTNO', 'Contact Number', '". strtoupper($stContactNumber) ."',now() )," ;
	  $stSql .= " ('". $nCandidacy00id ."','EMAIL', 'Email', '". $stEmail ."',now() )," ;
	  $stSql .= " ('". $nCandidacy00id ."','POSITION', 'Candidacy Position', '". strtoupper($stPosition) ."',now() )," ;
	  $stSql .= " ('". $nCandidacy00id ."','PARTYLIST', 'Partylist', '". strtoupper($stParty) ."',now() )," ;
	  $stSql .= " ('". $nCandidacy00id ."','YEAR', 'Candidacy Year', '". strtoupper($stYear) ."',now() )," ;
	  $stSql .= " ('". $nCandidacy00id ."','DATEFILED', 'Filing date', '". strtoupper($dDateFiled) ."',now() )" ;


	  if (count($lstOrg) > 0) {
		  $ctr = 0;
		  foreach ($lstOrg as $org) {
		  	$ctr += 1;

				foreach ($org as $key => $value) {
					if (strtoupper($key) == 'ORGNAME') {
						$NAME = 'ORGNAME'. $ctr;
						$stSql .= ", ('". $nCandidacy00id ."','". $NAME ."','". $NAME ."', '". strtoupper($value) ."',now() )" ;
					}
					elseif (strtoupper($key) == 'ORGYEAR') {
						$NAME = 'ORGYEAR'. $ctr;
						$stSql .= ", ('". $nCandidacy00id ."','". $NAME ."','". $NAME ."', '". strtoupper($value) ."',now() )" ;
					}
					elseif (strtoupper($key) == 'ORGPOS') {
						$NAME = 'ORGPOSITION'. $ctr;
						$stSql .= ", ('". $nCandidacy00id ."','". $NAME ."','". $NAME ."', '". strtoupper($value) ."',now() )" ;
					}

				}
			};
		};


		if (count($lstElect) > 0) {
			$ctr = 0;
		  foreach ($lstElect as $elec) {
		  	$ctr += 1;

				foreach ($elec as $key => $value) {
					if (strtoupper($key) == 'ELECYEAR') {
						$NAME = 'ELECYEAR'. $ctr;
						$stSql .= ", ('". $nCandidacy00id ."','". $NAME ."','". $NAME ."', '". strtoupper($value) ."',now() )" ;
					}
					elseif (strtoupper($key) == 'ELECPOS') {
						$NAME = 'ELECPOS'. $ctr;
						$stSql .= ", ('". $nCandidacy00id ."','". $NAME ."','". $NAME ."', '". strtoupper($value) ."',now() )" ;
					}
					elseif (strtoupper($key) == 'ELECACCOMPLISHMENT') {
						$NAME = 'ELECACCOMPLISHMENT'. $ctr;
						$stSql .= ", ('". $nCandidacy00id ."','". $NAME ."','". $NAME ."', '". strtoupper($value) ."',now() )" ;
					}

				}
			};
		}

	  // EXECUTE QUERY
	  $res = mysqli_query($conn, $stSql); 
	}
	else {
		$retArray = array(
			"data" => null,
			"message" => "Person has a existing filed forms.",
			"status" => "error"
		);

		print json_encode($retArray);

		exit();
	}

  $retArray = array(
	  		"data" => null,
	  		"message" => "Your candidacy form is successfully saved and subject for approval.",
	  		"status" => "success" ); 

  print json_encode($retArray);

?>

