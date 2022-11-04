<?php
	session_start();

	include '../../../includes/Conn.inc';

	// RETURN ARRAY
	$retval_array = array();

	// LOCALS 
	$st_Org_name = "";
	$st_Org_description = "";
	$st_Org_founded = "";
	$st_Org_foundedby = "";

	$userdata = json_decode($_REQUEST['data'], true);
	$st_Org_name 				= $userdata['orgname'];
	$st_Org_description = $userdata['orgdesc'];
	$st_Org_founded 		= $userdata['orgdatefounded'];
	$st_Org_foundedby 	= $userdata['orgfounder'];

	// INSERTING DTA TO TABLES
	$stsql1 = "";
	$stsql1 .= " INSERT organization00 (orgname, orgdesc, active, createdby, datecreated, datefounded, foundedby)";
	$stsql1 .= " VALUES ('". $st_Org_name ."', '". $st_Org_description ."', '1', '0', now(),'". $st_Org_founded ."', '". $st_Org_foundedby ."')";

	// EXECUTE
	try {
		mysqli_query($conn, $stsql1);
	} catch (Exception $e) {
		$retval_array = array(
			"data" => 'Caught exception: '. $e->getMessage(),
			"status" => "error"
		);

		print json_encode($retval_array);
		exit();
	}

	$retval_array = array(
		"data" => null,
		"status" => "success"
	);

	print json_encode($retval_array);

?>