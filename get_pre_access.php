<?php
$email_address = trim($_POST['email_address']);
$password = trim($_POST['password']);
$device_id = '';
$token = '6b7998db49cfe3e3e83aaa5a3a88d4b2d34e92c7;e7cd433a66cf708fdc723fce42e50a0c4088d3e6;1493392689;e574512d-1faf-4687-8bba-05c84d636f87;P100Y';
  
$headers = [
  'Authorization:'.$token,
  'X-API-Version: 2'
  //'content-type: application/x-www-form-urlencoded'
];

$body = [
  'email_address' => $email_address,
  'password' => $password
  //'user_device_id' => $device_id
];

$url = "https://api.avantlink.com/login";

//Uncomment to Debug URL
//var_dump($url);
var_dump($body);
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
?>

<form action="authy_send_code.php" method="POST">
  <input type="text" placeholder="put your pre-auth here" name="pre_auth" id="pre_auth"/>
  <input type="text" placeholder="put your user id here" name="user_id" id="user_id"/>
  <input type="submit" value="submit" name="get_code_submit">
</form>
