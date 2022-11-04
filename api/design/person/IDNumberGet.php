<?php
	session_start();
	include '../../../includes/Conn.inc';

	// PANG RETURN AN ARRAY

	$retArray = array();
	$arrayCollection = array();
	$arrayLooper = array();

	$stSchoolidno = '';
	$stSql = "";
	$stSql .= " SELECT schoolidno FROM masterlist00";
	$stSql .= " ORDER BY masterlist00id DESC" ;
	$stSql .= " LIMIT 1" ;

	try {
		$res = mysqli_query($conn,$stSql);
		if (mysqli_num_rows($res) > 0) {
			while ($retval = mysqli_fetch_array($res)) {
				$stSchoolidno = $retval['schoolidno'];

				$ArrayNumber = explode("-",$stSchoolidno);
				$cnt = count($ArrayNumber);
				$str_count = strlen($ArrayNumber[$cnt-1]);

				$current_number = intval($ArrayNumber[$cnt-1]) + 1;

				$str_paded = str_pad($current_number, $str_count, '0', STR_PAD_LEFT);
				$current_number = date('Y') .'-'. $str_paded;

				$arrayLooper = array(
					'schoolidno' => $current_number
				);

				array_push($arrayCollection, $arrayLooper);
			}
		}
		else {
			$str_count = 4;
			$current_number = 1;

			$str_paded = str_pad($current_number, $str_count, '0', STR_PAD_LEFT);
			$current_number = date('Y') .'-'. $str_paded;

			$arrayLooper = array(
				'schoolidno' => $current_number
			);

			array_push($arrayCollection, $arrayLooper);
		}
	} catch (Exception $e) {
		$retArray = array(
			"data" => null,
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

