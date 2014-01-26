<?php
	$api_key = "AIzaSyBiitiGBt5uHgaRUq4CNSdSaQpzvUqo7SQ";
	$registrationIDs = array("APA91bEWOejafg3xen1xJngBJhcwwmpMw7lUBNJA9ZVErodMMBkGDQQDmqjbxFdvZqG-bcPPC-dVA67GtIaXgn22DhPavdF9kjzyXLpiLBUHsns1vOoiLfmV7kIMGb5UZF6THTNMXslzsw7TcSX55FFk2nbPgyDeZA");
	$message = "congratulations";
	$url = 'https://android.googleapis.com/gcm/send';
	$fields = array(
                'registration_ids'  => $registrationIDs,
                'data'              => array( "message" => $message ),
                );

	$headers = array(
					'Authorization: key=' . $api_key,
					'Content-Type: application/json');

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$result = curl_exec($ch);
	curl_close($ch);
?>