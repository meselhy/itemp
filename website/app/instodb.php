<?PHP

include "config.php";

$fname = htmlspecialchars($_GET["fullname"]);
$name = htmlspecialchars($_GET["phone"]);
$temp = htmlspecialchars($_GET["temp"]);

$sql = "INSERT INTO guests (fullname, phone, temp) VALUES ('$fname', '$name', '$temp')";

if ($con->query($sql) === TRUE) {
  echo 1;
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();

?>
