<?php
	
	session_start();
	include '../../../includes/Conn.inc';

	// declaring variables
	$retArray			 = array();
	$stProcessName = '';
	$stSortOrder	 = '';
	$stFlag				 = '';
	$nProcessId		 = 0;

	// sinalo niya dito yung binato ko na data
	$userdata = json_decode($_REQUEST['data'], true);
	$stFlag		= $userdata['flag'];

	if (strtoupper($stFlag) == 'ADD') {
		$stProcessName  = $userdata['name'];
		$stSortOrder		= $userdata['sortorder'];
		
		// create query
		$stSql = ""; 
		$stSql .= " INSERT process00 (processname,`active`,posted,`order`) ";
		$stSql .= " VALUES ('". $stProcessName ."',0,0,'". $stSortOrder ."') ";

		// try to execute query
		try {
			$res = mysqli_query($conn, $stSql);
			$data = null;
		} catch (Exception $e) {
			$data = $e;
		}

		$retArray = array(
			'data' => $data,
			'status' => 'success'
		);
	}
	elseif (strtoupper($stFlag) == 'ACTIVATE') {

		$stSql = "";
		$stSql = "SELECT * FROM process00 WHERE active = 1 ";

		$res = mysqli_query($conn,$stSql);
		if (mysqli_num_rows($res) > 0) {
			$retArray = array(
				'data' => "Please post the active process before activate the others. ",
				'status' => "error"
				);

			print json_encode($retArray);
			exit();			
		}
		else { 

			$nProcessId = $userdata['processid'];
			$stSql = "";
			$stSql .= "SELECT datestarteffectivity, dateendeffectivity FROM process00 ";
			$stSql .= "WHERE process00id = '".$nProcessId."' ";
			$stSql .= "AND datestarteffectivity IS NOT NULL AND dateendeffectivity IS NOT NULL ";

			$res = mysqli_query($conn, $stSql);
			if (mysqli_num_rows($res) > 0) {
				$stSql = "";
				$stSql .= " UPDATE process00 SET datestarteffectivity = now(), ";
				// $stSql .= " dateendeffectivity = '2099-12-31 00:00:00', ";
				$stSql .= " active = 1 ";
				$stSql .= " WHERE process00id = ". $nProcessId ;

				// exec
				$res = mysqli_query($conn, $stSql);

				$retArray = array(
					'data' => "null",
					'status' => 'success'	);
			}
			else {
				$retArray = array(
					'data' => "Date start and date end for the process is not set. Please set the schedule before you activate the process! ",
					'status' => 'error'	);

				print json_encode($retArray);

				exit();
			}
		}

	}
	elseif (strtoupper($stFlag) == 'POSTING') {
		$nProcessId = $userdata['processid'];
		// $dateNow = date('Y-m-d H:i:s');

		$stSql = "";
		$stSql .= " UPDATE process00 ";
		$stSql .= " SET dateendeffectivity = now(), ";
		$stSql .= " active = 0, ";
		$stSql .= " posted = 1 ";
		$stSql .= " WHERE process00id = ". $nProcessId ;

		// exec
		$res = mysqli_query($conn, $stSql);

		$retArray = array(
			'data' => "null",
			'status' => 'success'	);

	}
	elseif (strtoupper($stFlag) == 'UPDATE') {
		$nProcessId = $userdata['processid'];
		// $dStartDate = date('Y-m-d H:i:s', strtotime($userdata['startdate']) );
		$dStartDate = $userdata['startdate'];
		$dEnddate		= $userdata['enddate'];

		$stSql = "";
		$stSql .= " UPDATE process00 SET ";
		$stSql .= " datestarteffectivity = '". $dStartDate ."', ";
		$stSql .= " dateendeffectivity = '". $dEnddate ."' ";
		$stSql .= " WHERE process00id = ". $nProcessId ;

		// exec
		$res = mysqli_query($conn, $stSql);

		$retArray = array(
			'data' => "null",
			'status' => 'success'	);
	}

	print json_encode($retArray);

?>