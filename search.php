<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

if(isset($_POST['submitted'])){
$auth = $_POST['big_boy_auth'];
$search_term = trim($_POST['search_term']);

//set auth and search if you want to hardcode it each time.
//$auth = '06425ca2a9974a938c3b0207496f4e3f1ab38a9b;7cc2a3134bc8a4f8f4e893806140c59811ed4372;1495038277;e574512d-1faf-4687-8bba-05c84d636f87;PT30M';
//$search_term = "jsanders@avantlink.com";

//set headers
$headers = [
  'Authorization:'.$auth,
  'X-API-Version: 2'
];

for($i=0;$i<=344;$i++){

  $queryString = 'page='.$i;
  $url = "https://api.avantlink.com/users?".$queryString;

  $curl = curl_init(); //initialize curl

  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_URL, $url); //use the URL we built above
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //return the result instead of BOOL
  curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5); //Longer than 5?! Ain't nobody got time for dat.
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);  //Server 302s without this, so leave it.

  $result = curl_exec($curl); //execute our curl request
  //uncomment to output HTTP Status (for debugging, usually)
  //$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  curl_close($curl); //close curl sesh

  $set = json_decode($result); //output result
  if(isset($set->error)){
    echo $set->error;
    break;
  }
  $match;
  $match_email;
  if(isset($set->items)){
  $items = $set->items;
  foreach ($items as $item) {
    if ($item->email_address === $search_term){
      $match = $item->user_id;
      $match_email = $item->email_address;
    };
  }

    if(isset($match)){
      echo $match;
      echo "<br>";
      echo $match_email;
      break;
    }
  }
}

if(!isset($match)){echo "Not Found";};
//uncomment to output HTTP Status (for debugging, usually)
//echo "HTTP Status:".$http_status;
}
?>
<form action="#" method="POST">
  <input type="text" placeholder="Big Boy Auth" name="big_boy_auth" id="big_boy_auth" value="<?php if(isset($auth)){echo $auth;};?>">
  <input type="text" placeholder="Email to Search" name="search_term" id="search_term"/>
  <input type="hidden" name="submitted" value="true"/>
  <input type="submit" value="search"/>
</form>
