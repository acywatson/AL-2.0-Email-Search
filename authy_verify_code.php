<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//params
$pre_auth = $_POST['pre_auth'];
$code = $_POST['code'];
$nickname = $_POST['nickname'];

$headers = [
  'Authorization:'.$pre_auth,
  'X-API-Version: 2',
  //'content-type: application/x-www-form-urlencoded'
];

$body = [
  'verification_code' => $code,
  'device_nickname' => $nickname
];

$url = "https://api.avantlink.com/login/authy/verification/verify";

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

<h2>If you did this right, you should have a big boy auth in the object up above this.</h2>
<h2>C+P that bad boy into the correct field on <a href="search.php">search.php</a> and let's get this party started.</h2>
