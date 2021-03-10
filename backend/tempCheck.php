<?php

$servername = "localhost";
$username = "gtconlin_rooot";
$password = "meselhy";
$dbname = "gtconlin_itemp";

$conn = new mysqli ($servername, $username, $password, $dbname);
if (mysqli_connect_errno ())
  {
    printf ("Connection failed: %s\n", mysqli_connect_error ());
    exit ();
  }

$sql = "SELECT * FROM users";
$result = mysqli_query ($conn, $sql);


while ($row = mysqli_fetch_array ($result))
  {
    	if($row['temp'] < 38){
    	    echo '<script>alert("Sorry! '.$row[username].'")</script>';
    	    header("Location: http://itemp.ml/index.html");
    	    die();
    	}
    	else if($row['temp'] > 38){
    	    echo '<script>alert("Sorry! '.$row[username].'")</script>';
    	    header("Location: http://itemp.ml/index.html");
    	    die();
    	}
    	else
    	    echo 'This is weird';
    	    die();
  }

$conn->close ();

?>
