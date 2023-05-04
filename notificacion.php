<?php

    $key = "AAAASddcX9Y:APA91bHl09cpTfdCnxEYxbKAqUrh09j0cUM1PU4nl5Vq_BLAyeLR511zh-JEPYLuVvjeAAwUFV7gjRWgkTT-15-xEemhSV-K_9OjdVwdrIx1wzNqV6KMTpPBqbPToBAXinY41T8ciabZ";
    
    $url = "https://fir-cloud-messenging-app-default-rtdb.firebaseio.com/tokens.json";
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);    
    $data = json_decode($response, true);    
    
    $datos = json_decode(file_get_contents('php://input'),true);    
    $message = strval($datos['ms']);            

    $title = "Notificacion";    
    $fcm = 'https://fcm.googleapis.com/fcm/send';        

    $headers = array(
        'Authorization:key=' .$key,
        'Content-Type:application/json'
    );

    foreach ($data as $token => $value) {
        $fields = array('to'=>$token,
            'notification'=>array('title'=>$title,'body'=>$message));
        $payload = json_encode($fields);

        echo $payload;

        $curl_session = curl_init();
        curl_setopt($curl_session, CURLOPT_URL, $fcm);
        curl_setopt($curl_session, CURLOPT_POST, true);
        curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_session, CURLOPT_IPRESOLVE, $payload);
        curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
        $result = curl_exec($curl_session);
        echo $result;
    }

?>