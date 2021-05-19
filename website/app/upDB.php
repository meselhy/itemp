<?PHP

include "config.php";

$name = htmlspecialchars($_GET["username"]);
$temp = htmlspecialchars($_GET["temp"]);

$sql = "UPDATE users SET temp= '$temp' WHERE username= '$name'";

if ($con->query($sql) === TRUE) {
  echo 1;
} else {
  echo "Error updating record: " . $con->error;
}

$con->close();

?>
