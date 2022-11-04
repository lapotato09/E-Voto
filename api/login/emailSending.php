<?php
  include '../../includes/Conn.inc';

  $request = $_REQUEST['request'];
  echo $request;
  $userdata = json_decode($_REQUEST['data'], true);
  $email = $userdata['email'];
  echo $email;


  $to = "marsolee09@gmail.com";
  $subject = "Email Verification";
  $message = "Hello";
  $header = "From: sample@yahoo.com \r\n";
  $header .= "MIME-Version 1.0" . "\r\n";
  $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  mail($to, $subject, $message);

  // header('location: ');


?>