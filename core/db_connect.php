<?php
session_start();

// Variablen aanmaken voor de databaseconnectie
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "admin";
$dbname = "webshop";

// Connectie instellen
$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Wanneer er een error optreed, geef een error en stop de code
if ($con -> connect_errno) {
    echo "Failed to connect to MySQL: " . $con -> connect_error;
    exit();
}

define("BASEURL","http://localhost:8001/webdev-base-webshop/");
define("BASEURL_CMS","http://localhost:8001/webdev-base-webshop/admin/");

function prettyDump ( $var ) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}