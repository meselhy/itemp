<?PHP

include "config.php";

$name = htmlspecialchars($_GET["username"]);
$temp = htmlspecialchars($_GET["temp"]);

$sql = "INSERT INTO guests (username, phone, temp) VALUES ('$name', '', '$temp')";

if ($con->query($sql) === TRUE) {
  echo 1;
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();

?>
