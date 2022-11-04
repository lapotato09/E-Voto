<?php
	session_start();
	include '../../../includes/Conn.inc';

	// Variables
  $nAnnNo         = "";
	$stTitle 	     	= "";
	$stSubject   		= "";
	$stContent 	   	= "";
	$stActive 		  = "";
	$stDateposted 	= "";
	$stDateUnposted = "";

	$retArray 		 = array();
	$arrCollection = array();

	$sql_query = "";
	$sql_query .= "SELECT * FROM announcement00";

	$result = mysqli_query($conn, $sql_query);
	if (mysqli_num_rows($result) > 0) {
	 	while ($res = mysqli_fetch_array($result)) {
      $nAnnNo         = $res['ann00id'];
			$stTitle 		  	= $res['title'];
			$stSubject 			= $res['subject'];
			$stContent 			= $res['content'];
			$stActive 			= $res['active'];
			$stDateposted 	= $res['dateposted'];
			$stDateUnposted = $res['dateunposted'];

			// Push to array
			$arrLooper = array(
								'ann00id' => $nAnnNo,
								'title' => $stTitle,
								'subject' => $stSubject,
								'content' => $stContent,
								'active' => $stActive,
								'dateposted' => $stDateposted,
								'dateunposted' => $stDateUnposted );

			array_push($arrCollection, $arrLooper);
	 	}
	}

	mysqli_free_result($result);

	// return

	$retArray = array(
						"data" => $arrCollection,
						"status" => "success" );

	print json_encode($retArray);
	

?>