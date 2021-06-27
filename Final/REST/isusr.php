<?php
include "config.php";

$userid = htmlspecialchars($_GET["userid"]);

try
{ 
    if ($userid != "")
    {
        $sql_query = "select count(*) as cntUser from users where userid='".$userid."'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);
        $count = $row['cntUser'];
        
        if($count > 0)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
    else
    {
        echo 0;
    }
}
catch(Exception $e)
{
	echo 0;
}

$con->close();
?>