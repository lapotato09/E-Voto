<?php

	session_start();
	include '../../../includes/Conn.inc';

	// INIT
	$stAddress 			= '';
	$nAge 					= 0;
	$stBirthdate 		= '';
	$stCivilstatus 	= '';
	$stContact 			= '';
	$stCourse 			= '';
	$stDateenrolled = '';
	$stEmail 				= '';
	$stEntrytype 		= '';
	$stFirstname 		= '';
	$stGender 			= '';
	$stHeight 			= '';
	$stLastname 		= '';
	$stMajor 				= '';
	$stMiddlename 	= '';
	$stNameex 			= '';
	$ntPerson00id 	= 0;
	$stReligion			= '';
	$stSchoolidno 	= '';
	$stStatus 			= '';
	$stWeight 			= '';
	$stYear 				= '';

	// COLLECTION
	$retArray = array();

	$userdata = json_decode($_REQUEST['data'],true);
	$stAddress 			= $userdata['address'];
	$nAge 					= $userdata['age'];
	$stBirthdate 		= $userdata['ldbirthdate'];
	$stCivilstatus 	= $userdata['civilstatus'];
	$stContact 			= $userdata['contact'];
	$stCourse 			= $userdata['course'];
	$stDateenrolled = $userdata['lddateenrolled'];
	$stEmail 				= $userdata['email'];
	$stEntrytype 		= $userdata['entrytype'];
	$stFirstname 		= $userdata['firstname'];
	$stGender 			= $userdata['gender'];
	$stHeight 			= $userdata['height'];
	$stLastname 		= $userdata['lastname'];
	$stMajor 				= $userdata['major'];
	$stMiddlename 	= $userdata['middlename'];
	$stNameex 			= $userdata['nameex'];
	$nPerson00id 		= $userdata['person00id'];
	$stReligion			= $userdata['religion'];
	$stSchoolidno 	= $userdata['schoolidno'];
	$stStatus 			= $userdata['status'];
	$stWeight 			= $userdata['weight'];
	$stYear 				= $userdata['year'];

	$stsql = "";
	$stsql .= " CALL ev_PersonDetailsUpdate (";
	$stsql .= " 	'".$nPerson00id."', ";
	$stsql .= " 	'".$stLastname."', ";
	$stsql .= " 	'".$stFirstname."', ";
	$stsql .= " 	'".$stMiddlename."', ";
	$stsql .= " 	'".$stNameex."', ";
	$stsql .= " 	'".$nAge."', ";
	$stsql .= " 	'".$stAddress."', ";
	$stsql .= " 	'".$stBirthdate."', ";
	$stsql .= " 	'".$stCivilstatus."', ";
	$stsql .= " 	'".$stContact."', ";
	$stsql .= " 	'".$stCourse."', ";
	$stsql .= " 	'".$stDateenrolled."', ";
	$stsql .= " 	'".$stEmail."', ";
	$stsql .= " 	'".$stEntrytype."', ";
	$stsql .= " 	'".$stGender."', ";
	$stsql .= " 	'".$stHeight."', ";
	$stsql .= " 	'".$stMajor."', ";
	$stsql .= " 	'".$stReligion."', ";
	$stsql .= " 	'".$stSchoolidno."', ";
	$stsql .= " 	'".$stStatus."', ";
	$stsql .= " 	'".$stWeight."', ";
	$stsql .= " 	'".$stYear."' ) ";

	// EXECUTE
	try {
		mysqli_query($conn, $stsql);
		$retArray = array(
	  		"data" => null,
	  		"status" => "success" ); 

	} catch (Exception $e) {
		$retArray = array(
	  		"data" => 'Caught exception: '. $e->getMessage(),
	  		"status" => "error" ); 

	  print json_encode($retArray);
	  exit();
	}

	print json_encode($retArray);

?>


