<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

class ClientapiController extends Controller
{
//    public function getApiResponse(){
//        //echo "yes";die;
//
//        $url = 'https://my.hostednumbers.com/api/v1.0/Mailbox/zZxCtpPZAt52mYfXzIhDqg2/CallDetails/?format=json&RequestType=Today';
//
//
// 		$client = new \GuzzleHttp\Client();
//        $res = $client->get('https://my.hostednumbers.com/api/v1.0/Mailbox/zZxCtpPZAt52mYfXzIhDqg2/CallDetails/?format=json&RequestType=Today', ['auth' =>  ['Mgmtusa', 'ninam314']]);
//        echo $res->getStatusCode(); // 200
//        echo $res->getBody(); die;	
//        echo '<pre>'; print_r($response); die; 
//
//
//
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//                //'Authorization: Bearer '.$access_token,
//                'Accept: application/json',
//                'Content-Type: application/json',
//        ));
//        curl_setopt($ch, CURLOPT_USERAGENT, 'sortitoutsi');
//        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
//
//        $json_response = curl_exec($ch);
//        $info = curl_getinfo($ch);
//        curl_close($ch);		
//
//
//
//
//        $postData = array(
//                'EnteredUserID' => 'Mgmtusa',
//                'password' => 'ninam314',
//                'testcookie' => '1'
//        );
//        $ch = curl_init();
//        curl_setopt_array($ch, array(
//                CURLOPT_URL => $url,
//                CURLOPT_RETURNTRANSFER => true,
//                CURLOPT_POST => true,
//                CURLOPT_POSTFIELDS => $postData,
//                CURLOPT_FOLLOWLOCATION => true
//        ));
//
//        $output = curl_exec($ch);
//        $info = curl_getinfo($ch);
//
//        echo '<pre>'; print_r($info); die;		
//    }
    
    public function passwordHash()
{
      try {
 
           $client = new GuzzleHttpClient();
 
           $apiRequest = $client->request('GET', 'https://my.hostednumbers.com/api/v1.0/Mailbox/zZxCtpPZAt52mYfXzIhDqg2/CallDetails/?format=json&RequestType=Today', [
                'query' => ['plain' => 'Ab1L853Z24N'],
               // 'auth' => ['John', 'password777'],       //If authentication required
               // 'debug' => true                                  //If needed to debug   
          ]);
 
          // echo $apiRequest->getStatusCode());
          // echo $apiRequest->getHeader('content-type'));
 
          $content = json_decode($apiRequest->getBody()->getContents());
 
      } catch (RequestException $re) {
          //For handling exception
      }
 }
}
