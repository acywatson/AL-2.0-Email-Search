<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//params
$pre_auth = $_POST['pre_auth'];
$user_id = $_POST['user_id'];

$headers = [
  'Authorization:'.$pre_auth,
  'X-API-Version: 2',
  //'content-type: application/x-www-form-urlencoded'
];

$body = [
  'send_method' => 'sms',
];

$url = "https://api.avantlink.com/authy/verification/".$user_id;

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
?>

<form action="authy_verify_code.php" method="POST">
  <input type="hidden" name="pre_auth" id="pre_auth" value="<?php echo $pre_auth; ?>"/>
  <input type="text" placeholder="put your verification code here" name="code" id="code"/>
  <input type="text" placeholder="name yo device (make it weird)" name="nickname" id="nickname"/>
  <input type="submit" value="submit" name="verify_code_submit">
</form>
