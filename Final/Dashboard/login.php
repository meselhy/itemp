<?php
//session_start();
include "config.php";

$uname = mysqli_real_escape_string($con,$_POST['username']);
$password = mysqli_real_escape_string($con,$_POST['password']);
$pass = hash('sha256', $password);

if ($uname != "" && $password != ""){

    $sql_query = "select count(*) as cntUser from staff where username='".$uname."' and password='".$pass."'";
    $result = mysqli_query($con,$sql_query);
    $row = mysqli_fetch_array($result);

    $count = $row['cntUser'];

    if($count > 0){
        //$_SESSION["name"] = $_POST["username"];
        //setcookie("username", "$uname", "");
        echo 1;
    }else{
        echo 0;
    }

}

$con->close();
?>