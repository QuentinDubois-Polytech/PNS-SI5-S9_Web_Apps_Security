<?php
if (isset($_COOKIE["login"])) {
    $name = $_COOKIE["login"];
    $response = "Hello $name !";
} else {
    $response = "No Cookie set !";
}

header("Content-Type: text/plain");
echo $response;