<?php
	session_start();
	include '../../includes/Conn.inc';

	$retArray = array();

	$nCandidacy00id = 0;
	$stAction = '';

	$userdata = json_decode($_REQUEST['data'], true);
	$nCandidacy00id = $userdata['candidacy00id'];
	$stAction = $userdata['action'];

	if ($stAction == 'WITHDRAW') {
		$stSql = "";
		$stSql .= "	UPDATE candidacy00 SET status = 'WITHDRAWN', actiondate = NOW() ";
		$stSql .= " WHERE is_active = 1 AND candidacy00id = '". $nCandidacy00id ."' ";

		try {
			mysqli_query($conn, $stSql);
		} catch (Exception $e) {
			$retArray = array(
				"data" => null,
				"message" => "Error occured when updating candidacy status.",
				"status" => "error"
			);

			print json_encode($retArray);
			exit();
		}
	}
	elseif ($stAction == 'CANCEL') {
		$stSql = "";
		$stSql .= "	UPDATE candidacy00 SET status = 'CANCELLED', actiondate = NOW() ";
		$stSql .= " WHERE is_active = 1 AND candidacy00id = '". $nCandidacy00id ."' ";

		try {
			mysqli_query($conn, $stSql);
		} catch (Exception $e) {
			$retArray = array(
				"data" => null,
				"message" => "Error occured when updating candidacy status.",
				"status" => "error"
			);

			print json_encode($retArray);
			exit();
		}
	}

	elseif ($stAction == 'DISAPPROVE') {
		$stSql = "";
		$stSql .= "	UPDATE candidacy00 SET status = 'DISAPPROVED', actiondate = NOW() ";
		$stSql .= " WHERE is_active = 1 AND candidacy00id = '". $nCandidacy00id ."' ";

		try {
			mysqli_query($conn, $stSql);
		} catch (Exception $e) {
			$retArray = array(
				"data" => null,
				"message" => "Error occured when updating candidacy status.",
				"status" => "error"
			);

			print json_encode($retArray);
			exit();
		}
	}

	$retArray = array(
		"data" => null,
		"message" => "Candidacy status successfully updated.",
		"status" => "success"
	);

	print json_encode($retArray);


?>