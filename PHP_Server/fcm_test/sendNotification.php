﻿<?php
 function sendNotification($tokens, $message){
 $url = 'https://fcm.googleapis.com/fcm/send';
 $fields = array(
 'registration_ids' => $tokens,
 'data' => $message
 );
 $headers = array(
 'Authorization:key = SIZIN_KEY_DEGERINIZ',
 'Content-Type: application/json'
 );
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_POST, true);
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0); 
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 $result = curl_exec($ch); 
 if ($result === FALSE) {
 die('Curl failed: ' . curl_error($ch));
 }
 curl_close($ch);
 return $result;
 }
 
$conn = mysqli_connect("localhost","root","","fcm_test");
	$sql = " Select Token From users";
	$result = mysqli_query($conn,$sql);
	$tokens = array();
	if(mysqli_num_rows($result) > 0 ){
		while ($row = mysqli_fetch_assoc($result)) {
			$tokens[] = $row["Token"];
		}
	}
	mysqli_close($conn);
	$message = array("message" => " Merhaba! Bu bir test mesajıdır.");
	$message_status = sendNotification($tokens, $message);
	echo $message_status;
 
 ?>