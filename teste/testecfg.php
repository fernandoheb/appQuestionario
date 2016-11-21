<?php
$url = "./questionario.cfg ";
echo $url ."<br>";
$contents = file_get_contents($url); 
echo $contents;
$contents = utf8_encode($contents); 
$results = json_decode($contents, true); 
//json_decode ( string $json [, bool $assoc ] )


echo $results;


echo "<br>username ". $results['DB_USERNAME'];
?>

