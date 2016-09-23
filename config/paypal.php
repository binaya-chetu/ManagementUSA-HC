<?php
return [
// set your paypal credential
// Below credentials are different for sandbox mode and live mode.
'client_id' => 'AbSIWAPEqSFO1neP4niMzrQBUqItbP19Tus7MHaKYTe1_hJfIdG2lmck6sD_ZA2urN3gxnNdttPYoVg8',
'secret' => 'EOWvhpvoow7YddyMcMDOR0_9JHeoyAjUF73vX6Fy0g0khab8cLH2N6laHfEj3YwoVaLQCk3haoqStlOm',

/**
* SDK configuration
*/
'settings' => array(
/**
* Available option 'sandbox' or 'live'
* Remember sandbox id and secret will be different than live
*/
'mode' => 'sandbox',

/**
* Specify the max request time in seconds
*/
'http.ConnectionTimeOut' => 30,

/**
* Whether want to log to a file
*/
'log.LogEnabled' => true,

/**
* Specify the file that want to write on
*/
'log.FileName' => '../storage/logs/paypal.log',

/**
* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
*
* Logging is most verbose in the 'FINE' level and decreases as you
* proceed towards ERROR
*/
'log.LogLevel' => 'FINE'
),
];