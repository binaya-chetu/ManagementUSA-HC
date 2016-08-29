<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class ClientapiController extends Controller
{
    public function getApiResponse(){

		$url = 'cp2.nextiva.com';
		
		
/* 		$client = new \GuzzleHttp\Client();
		$res = $client->get('cp2.nextiva.com', ['auth' =>  ['amc201@nextiva.com', 'password']]);
		echo $res->getStatusCode(); // 200
		echo $res->getBody(); die;	
		echo '<pre>'; print_r($response); die; */
		
		
		
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //'Authorization: Bearer '.$access_token,
    'Accept: application/json',
    'Content-Type: application/json',
));
curl_setopt($ch, CURLOPT_USERAGENT, 'sortitoutsi');
curl_setopt($ch, CURLOPT_TIMEOUT, 3);

$json_response = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);		




$postData = array(
    'EnteredUserID' => 'amc201@nextiva.com',
    'password' => 'password',
    'testcookie' => '1'
);
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_FOLLOWLOCATION => true
));

$output = curl_exec($ch);
$info = curl_getinfo($ch);

echo '<pre>'; print_r($info); die;		
    }
}
