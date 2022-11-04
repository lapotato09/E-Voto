<?php 
  session_start();
  include '../../includes/Conn.inc';
  $nTriggerCount = 0;
  $nLimit = 0;

  $stSQL1 = "";
  $stSQL1 .= " DELETE FROM processed_votes00 ";

  mysqli_query($conn, $stSQL1);

  $stSQL1 = "";
  $stSQL1 .= " SELECT * FROM canvassing_process ";
  $stSQL1 .= " WHERE fieldcode = 'CLEANUP' ";

  $res = mysqli_query($conn, $stSQL1);
  if (mysqli_num_rows($res) > 0) {
    while ($ret = mysqli_fetch_array($res)) {
      $nTriggerCount = $ret['trigger_count'];
      $nLimit = $ret['limit'];

      if ($nTriggerCount >= $nLimit) {
        $retVal = array(
          "data" => null,
          "status" => "failed",
          "message" => "Operation failed. Exceed maximum limit."
        );

        print json_encode($retVal);
        exit();
      }
      else {
        $nTriggerCount += 1;
        $stSQL2 = "";
        $stSQL2 .= " UPDATE canvassing_process SET trigger_count = " .$nTriggerCount;
        $stSQL2 .= " WHERE fieldcode = 'CLEANUP' ";

        mysqli_query($conn, $stSQL2);
      }
    }
  }

  $retVal = array(
    "data" => null,
    "status" => "success",
    "message" => "Data cleaned up successfully."
  );

  print json_encode($retVal);

?>