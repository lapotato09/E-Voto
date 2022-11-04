<?php
  session_start();

  include '../../includes/Conn.inc';

  $nRawvotes00id = 0;
  $stLastname = '';
  $retArray = array();
  $looper = array();

  $uIDNo = $_SESSION['loggeduser']['idno'];

  $stSQL1 = "";
  $stSQL1 .= " SELECT * FROM rawvotes00 ";
  $stSQL1 .= " WHERE idno = '". $uIDNo ."' ";

  try {
    $retval = mysqli_query($conn, $stSQL1);
    if (mysqli_num_rows($retval) > 0) {
      while ($res = mysqli_fetch_array($retval)) {
        $nRawvotes00id = $res['rawvotes00id'];
        $stLastname = $res['lastname'];

         $looper = array(
          'lastname' => $stLastname,
          'idno' => $uIDNo
        );

        array_push($retArray, $looper);
      }
    }

  } catch (Exception $e) {
    $retval_array = array(
      "data" => null,
      "status" => "error"
    );    

    print json_encode($retval_array);
    exit();
  }

  $retval_array = array(
    "data" => $retArray,
    "message" =>  $uIDNo. " has already voted.",
    "status" => "success"
  );    

  print json_encode($retval_array);

?>