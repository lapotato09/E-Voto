<?php
	session_start();
	include '../../../includes/Conn.inc'; 

	$stTitle	= '';
	$stSubject	= '';
	$stContent	= '';

  $retArray = array();
	
	$userdata = json_decode($_REQUEST['data'], true);

  $stTitle   = $userdata['title'];
  $stSubject = $userdata['subj'];
  $stContent = $userdata['content'];

	$sql_query = "";
  $sql_query .= "INSERT announcement00(title, subject, content, active, dateposted) ";
	$sql_query .= "VALUES('". $stTitle . "', '" . $stSubject . "', '" . $stContent . "', '1',now() )";

  // echo $sql_query;
  $res = mysqli_query($conn, $sql_query);

  $retArray = array(
            "data" => "null",
            "status" => "succes");


  print json_encode($retArray);

?>
