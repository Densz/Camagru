<?php

$file = date('Y-m-d-H-i-s');
$encodedData = str_replace(' ', '+', $_POST['contents']);
$decodedData = base64_decode($encodedData);
$fp = fopen('../copies/' . $file . '.jpg', 'w');
fwrite($fp, $decodedData);


?>
