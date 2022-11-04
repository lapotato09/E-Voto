<?php
	session_start();

	include '../../../includes/Conn.inc';

	$retval_array = array();

	$nCandidacyID = 0;
	$stFieldcode = "";
	$stFieldvalue = "";
	$nLevel = 0;
	$nLimit = 0;
	$nctr = 0;	
	$stAction = "";

	$stUserData = json_decode($_REQUEST['data'], true);
	$stAction = $stUserData['action'];

	if ($stAction == 'SAVE') {
		try {
			$stSQL1 = "";
		 	$stSQL1 .= " DELETE FROM candidacysettings00 ";

		 	// echo $stSQL1;

		 	mysqli_query($conn, $stSQL1);


			foreach ($stUserData['data'] as $key => $value) {
				$stSQL1 = "";
				$stSQL1 .= " CALL ev_CandidacySettingsSave (" ;
				$stSQL1 .= " 	'".$stUserData['data'][$key]['candidacysettings00id']."', ";
				$stSQL1 .= " 	'".strtoupper($stUserData['data'][$key]['fieldcode'])."', ";
				$stSQL1 .= " 	'".strtoupper($stUserData['data'][$key]['fieldvalue'])."', ";
				$stSQL1 .= " 	'".$stUserData['data'][$key]['level']."' ) ";
				
				$retval = mysqli_query($conn, $stSQL1);

			}

			$retval_array = array(
				"data" => null,
				"message" => "Details successfully saved.",
				"status" => "success"
			);

		} catch (Exception $e) {
			$retval_array = array(
				"data" => null,
				"status" => "error"
			);		

			print json_encode($retval_array);
			exit();
		}

	}
	elseif ($stAction == 'DELETE') {
		$nCandidacyID = $stUserData['candidacysettings00id'];
	 	$stSQL1 = "";
	 	$stSQL1 .= " DELETE FROM candidacysettings00 WHERE candidacysettings00id = " .$nCandidacyID;

	 	// echo $stSQL1;

	 	mysqli_query($conn, $stSQL1);

	 	$retval_array = array(
			"data" => null,
			"message" => "Details successfully deleted.",
			"status" => "success"
		);

	}


	print json_encode($retval_array);

?>