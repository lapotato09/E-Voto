<?php
  include 'includes/Conn.inc';
    
  if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
      $uri = 'https://';
  } else {
    $uri = 'http://';
  }
  $uri .= $_SERVER['HTTP_HOST'];
  $url = $_SERVER['REQUEST_URI'] ;

  // if ($url == '/' || $url == '' || $url == '/login/') {
  header('Location: '.$uri.'/login/');
  // }
  // elseif ($url == '/candidacy/filing/' ) {
  // 	header('Location: '.$uri.'/candidacy/filing/filing-tpl.php');
  // }


?>
