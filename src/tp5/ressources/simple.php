<?php
session_start();

$response = "";

if (isset($_GET["csrf_token"]) && isset($_SESSION["csrf_token"]) && $_GET["csrf_token"] == $_SESSION["csrf_token"]) {
    $response .= "Token validation success !\n";
} else {
    $response .= "Token validation failed !\n";
}

if (isset($_COOKIE["login"])) {
    $name = $_COOKIE["login"];
    $response .= "Cookie received : login=$name\n";
} else {
    $response .= "No Cookie received : login\n";
}

header("Content-Type: text/plain");
echo $response;
