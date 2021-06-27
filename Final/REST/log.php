<?PHP
include "config.php";

//$userid = htmlspecialchars($_GET["userid"]);
//$temperature = htmlspecialchars($_GET["temperature"]);

try
{ 
    if ($userid != "")
    {
        $sql = "SELECT * FROM users WHERE userid = '".$userid."';";
        $result = $con->query($sql);
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $fn = $row['first_name'];
    	        $ln = $row['last_name'];
            }
            $sql = "INSERT INTO log (userid, first_name, last_name, temp, device, gate, time, date) VALUES ('$userid','$fn','$ln','$temperature','$device','$gate', now(), DATE(now()) )";
            if ($con->query($sql) === TRUE)
            {
                echo 1;
            }
            else
            {
                echo "fail";
            }
            
        }
        else
        {
            echo "fetch fail";
        }
    }
    else
    {
        echo "empty";
    }
}
catch(Exception $e)
{
	echo $e;
}

$con->close();
?>