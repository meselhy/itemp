<?php

include "config.php";

try
{
    $sql= "TRUNCATE TABLE log";
    $statement = $con->prepare($sql);
    $statement->execute();
    header("Location: http://www.itemp.ml/dashboard/home.php");
}
catch(Exception $e)
{
    echo $e;
}

$con->close();
?>