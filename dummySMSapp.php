<!DOCTYPE html>
<html>
<head>
    <title>Http Request sending</title>
</head>
<body>
    <?php    
        $username = "john";
        $password = "Xc3ffs";
        $messagetype = "SMS:TEXT";
        $httpUrl = "https://127.0.0.1:9508/";
        $recipient = urlencode("+36201324567");
        $messagedata = urlencode("TestMessage");
 
        $sendString = $httpUrl."api?action=sendmessage"."&username="
                     .$username."&password="
                     .$password."&recipient=".$recipient."&messagetype="
                     .$messagetype."&messagedata=".$messagedata;
 
        echo '<p><b> Sending html request:</b> '.$sendString.'</p>';
        $aContext = array(
            'http' => array(
                'method'  => 'GET',
            ),
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
            )
        );
        $cxContext = stream_context_create($aContext);
        $response = file_get_contents($sendString, true, $cxContext);
 
        echo '<p><b> Http response received :</b> </p>';
        echo '<xmp>' . $response. '</xmp>';
    ?>
</body>
</html>