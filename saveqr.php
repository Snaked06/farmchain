<?php
$productname=urlencode($_POST['productname']);
$price=urlencode($_POST['price']);
$quantity=urlencode($_POST['quantity']);
$buyername=urlencode($_POST['buyername']);
$trans=urlencode($_POST['trans']);
$url="https://chart.apis.google.com/chart?cht=qr&chs=230x230&choe=UTF-8&chl=Product%20Name%20:".$productname."%20Product%20Price%20:".$price."%20Product%20Quantity%20:".$quantity."%20Buyer%20Name%20:".$buyername."%20Transaction%20ID%20:".$trans."";
file_put_contents("qrcode/".$trans.".jpg", file_get_contents($url)); 
?>