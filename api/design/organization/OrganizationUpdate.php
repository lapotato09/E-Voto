<?php
	session_start();
	include '../../../includes/Conn.inc';

	$retArray = array();

	$stOrgName = '';
	$stOrgDesc = '';
	$stFoundedBy = '';
	$lActive = '';
	$nId00 = '';

	$userdata = json_decode($_REQUEST['data'], true);

	$nId00 = $userdata['id'];
	$stOrgName = $userdata['orgname'];
	$stOrgDesc = $userdata['orgdesc'];
	$stFoundedBy = $userdata['foundedby'];
	$lActive = $userdata['active'];


	$stSql = "";
	$stSql .= " UPDATE organization00 " ; 
	$stSql .= " SET orgname = '" . $stOrgName . "' , ";
	$stSql .= " orgdesc = '". $stOrgDesc ."', ";
	$stSql .= " foundedby = '". $stFoundedBy ."', ";
	$stSql .= " active = '". $lActive."' ";
	$stSql .= " WHERE organization00id = '". $nId00 . "' ";

	try {
		mysqli_query($conn, $stSql);
	} catch (Exception $e) {
		$retArray = array(
			"data" => "Caught Exception: ". $e->getMessage(),
			"status" => "error"
		);

		print json_encode($retArray);
		exit();
	}

	$retArray = array(
		"data" => null,
		"status" => "success"
	);

	print json_encode($retArray);

?>