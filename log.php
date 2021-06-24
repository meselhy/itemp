<?php

$db = mysqli_connect("localhost","root","","log");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}
$t=date('h:i');
echo $t;

$sql = "INSERT INTO log (id, name, time,temp) VALUES ('1234','baraka','$t','36.4' )";

if(mysqli_query($db, $sql)){
			echo "<h2>The new  data was stored successfully in the database </h2>";
				

			
		} else{
			echo "ERROR: Hush! Sorry $sql. "
				. mysqli_error($db);
		}
		



mysqli_close($db);







?>