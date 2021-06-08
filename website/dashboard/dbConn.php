<?php

$db = mysqli_connect("localhost","root","","capstone");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}

?>