<?php 
$file="random.txt";
$ourClientNumber = file_get_contents($file);
$parameter = $_GET["randomvalue"];
if ($ourClientNumber==$parameter) { 
  echo "Here is the answer from the server";
} 
else
 { echo "XSRF DETECTED";}
?>
