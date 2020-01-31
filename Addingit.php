<?php
$obj = json_decode($_POST["myData"]);
if(!empty($obj->Productname) and !empty($obj->Buyername) and !empty($obj->price) and !empty($obj->quantity) and !empty($obj->TransactionId) )
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
  CURLOPT_URL => "http://localhost:5000/transactions/new",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"{\r\n\t\"productname\": \"".$obj->Productname."\",\r\n\t\"buyername\": \"".$obj->Buyername."\",\r\n\t\"price\": \"".$obj->price."\",\r\n\t\"quantity\": \"".$obj->quantity."\",\r\n\t\"TransactionId\": \"".$obj->TransactionId."\"\r\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json"
  ),
));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}
?>