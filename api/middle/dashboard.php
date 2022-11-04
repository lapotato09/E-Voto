<?php
	// echo "hello";

  $action  = $_REQUEST['action'];
	// $request = $_REQUEST['request'];

  if ($action) {
    header("Location: ../dashboard/Announcement/AnnouncementGet.php");
  }
  // print_r($request);
?>