<?php
include "config.php";

//$uname = mysqli_real_escape_string($con,$_POST['usernamee']);
$uname = htmlspecialchars($_GET["username"]);

if ($uname != ""){

    $sql_query = "select count(*) as cntUser from users where username='".$uname."'";
    $result = mysqli_query($con,$sql_query);
    $row = mysqli_fetch_array($result);
    $count = $row['cntUser'];
    if($count > 0){
        echo 1;
    }else{
        echo 0;
    }
}
$con->close();
?>
