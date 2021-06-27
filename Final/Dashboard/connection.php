<?php

$conn = "";

try {
	$servername = "localhost";
	$dbname = "gtconlin_itemp";
	$username = "gtconlin_rooot";
	$password = "meselhy";

	$conn = new PDO(
		"mysql:host=$servername; dbname=gtconlin_itemp",
		$username, $password
	);
	
$conn->setAttribute(PDO::ATTR_ERRMODE,
					PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

?>
