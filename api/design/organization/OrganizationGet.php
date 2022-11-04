<?php

	session_start();

	include '../../../includes/Conn.inc';

	// RETURN ARRAY
	$retval_array = array();
	$looper = array();
	$array_collection = array();

	// LOCALS
	$stOrgName = "";
	$stOrgDesc = "";
	$lActive = "";
	$dDateFounded = "";
	$stFounder = "";
	$nOrgId00 = 0;

	// QUERY
	$stsql1 = "";
	$stsql1 .= " SELECT * from organization00";

	try {
		$res = mysqli_query($conn, $stsql1);
		if (mysqli_num_rows($res) > 0) {
			while ($retval = mysqli_fetch_array($res)) {
				$nOrgId00 = $retval['organization00id'];
				$stOrgName = $retval['orgname'];
				$stOrgDesc = $retval['orgdesc'];
				$lActive = $retval['active'];
				$dDateFounded = $retval['datefounded'];
				$stFounder = $retval['foundedby'];

				$looper = array(
					'id' => $nOrgId00,
					'orgname' => $stOrgName,
					'orgdesc' => $stOrgDesc,
					'active' => $lActive,
					'datefounded' => $dDateFounded,
					'foundedby' => $stFounder
				);

				array_push($array_collection, $looper);
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
		"data" => $array_collection,
		"status" => "success"
	);

	print json_encode($retval_array);

?>


