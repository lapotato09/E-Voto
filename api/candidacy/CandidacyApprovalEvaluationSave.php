<?php
	session_start();
	include '../../includes/Conn.inc';

	$retArray = array();

	$nCandidacy00id = 0;
	$stParamStatus = "";

	$userdata = json_decode($_REQUEST['data'], true);
	$nCandidacy00id = $userdata['candidacy00id'];
	$stParamStatus = $userdata['status'];


	$stSql = "";

	if ($stParamStatus == 'FOR_EVALUATION') {
		$stSql .= " UPDATE candidacy00 SET status = 'FOR_APPROVAL', ";
	}
	elseif ($stParamStatus == 'FOR_APPROVAL') {
		$stSql .= " UPDATE candidacy00 SET status = 'APPROVED', ";
	}

	$stSql .= " actiondate = NOW() ";
	$stSql .= " WHERE candidacy00id = '". $nCandidacy00id ."' AND is_active = 1";

	try {
		mysqli_query($conn, $stSql);
		$retArray = array(
			"data" => null,
			"status" => "success"
		);

	} catch (Exception $e) {
		$retArray = array(
			"status" => "error",
			"data" => "Caught Exception" . $e->getMessage()
		);

		print json_encode($retArray);
		exit();
	}

	print json_encode($retArray);


?>