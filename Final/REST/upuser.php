<?PHP
include "config.php";

$userid = htmlspecialchars($_GET["userid"]);
$temperature = htmlspecialchars($_GET["temperature"]);
$device = htmlspecialchars($_GET["device"]);
$gate = htmlspecialchars($_GET["gate"]);

try
{ 
    if ($userid != "")
    {
        $sql = "UPDATE users SET temp = '$temperature', time = now(), device = '$device', gate = '$gate'  WHERE userid = '$userid'";
        if ($con->query($sql) === TRUE)
        {
            echo 1;
            include "log.php";
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