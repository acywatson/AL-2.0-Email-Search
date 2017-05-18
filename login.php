<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
if(isset($_POST['email_address'])){
$email = $_POST['email_address'];
$password = $_POST['password'];
$device_id = $_POST['device_id'];
};
//if you set these constants, they will override the above POSTED variables.
$pre_auth = '6b7998db49cfe3e3e83aaa5a3a88d4b2d34e92c7;e7cd433a66cf708fdc723fce42e50a0c4088d3e6;1493392689;e574512d-1faf-4687-8bba-05c84d636f87;P100Y';

$headers = [
  'Authorization:'.$pre_auth,
  'X-API-Version: 2',
  //'content-type: application/x-www-form-urlencoded'
];

$body = [
  'email_address' => $email,
  'password' => $password,
  'user_device_id' => $device_id
];

//for($i=0;$i<1;$i++){}
$i = 2;
//$queryString = 'page='.$i;
$url = "https://api.avantlink.com/login";

//Uncomment to Debug URL
var_dump($url);

$curl = curl_init(); //initialize curl
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
curl_setopt($curl, CURLOPT_URL, $url); //use the URL we built above
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //return the result instead of BOOL
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5); //Longer than 5?! Ain't nobody got time for dat.
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);  //Server 302s without this, so leave it.

$result = curl_exec($curl); //execute our curl request

//uncomment to output HTTP Status (for debugging, usually)
//$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl); //close curl sesh

echo $result; //output result
echo "<br>";

//uncomment to output HTTP Status (for debugging, usually)
//echo "HTTP Status:".$http_status;



?>
