<?php
$searchTerm = "Silent";
$ch = curl_init("https://www.casa.gov.au/rpa-operator-certificate-holders");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$result = curl_exec($ch);
echo $result;
curl_close($ch);
?>