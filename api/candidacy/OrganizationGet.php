<?php

	session_start();
	include '../../includes/Conn.inc';

	$retArray = array();
	$retval = array();
	$arrayCollection = array();

	$stOrgname = "";
	$stOrgDesc = "";
	$BActive = "";
	$stDateFounded = "";
	$stFoundedBy = "";

	$stSql = "";
	$stSql .= " SELECT * FROM organization00";

	try {
		$retval = mysqli_query($conn, $stSql);
		if (mysqli_num_rows($retval) > 0) {
			while ($res = mysqli_fetch_array($retval)) {
				# code...
				$stOrgname = $res['orgname'];
				$stOrgDesc = $res['orgdesc'];
				$BActive = $res['active'];
				$stDateFounded = $res['datefounded'];
				$stFoundedBy = $res['foundedby'];

				$arrayLooper = array(
					"orgname" => $stOrgname,
					"orgdesc" => $stOrgDesc,
					"active" => $BActive,
					"datefounded" => $stDateFounded,
					"foundedby" => $stFoundedBy
				);

				array_push($arrayCollection, $arrayLooper);
			}
		}
	} catch (Exception $e) {
		$retArray = array(
			"data" => null,
			"message" => "Caught Exception: ". $e->getMessage(),
			"status" => "error"
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
