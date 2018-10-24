<?php
//initialize http request
$ch = curl_init();
//connecting to api
curl_setopt($ch, CURLOPT_URL, ("http://phisix-api2.appspot.com/stocks.json"));
//checking if it's connected
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
//end
curl_close($ch);
$result = json_decode($server_output);
$metadata = $result->{'stock'};
?>