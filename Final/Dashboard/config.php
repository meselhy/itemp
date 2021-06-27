<?php

$host = "localhost";
$username = "gtconlin_rooot";
$password = "meselhy";
$dbname = "gtconlin_itemp";

$con = new mysqli($host, $username, $password, $dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
?>