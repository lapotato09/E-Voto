<?php

	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
  } else {
    $uri = 'http://';
  }
  $uri .= $_SERVER['HTTP_HOST'] ;
  $url = $_SERVER['REQUEST_URI'] ;
  $loc_location = $uri . $url;

  if ($url == '/candidacy/filing/' ) {
  	header('Location: '.$uri.'/candidacy/filing/filing-tpl.php');
  }

?>