<!DOCTYPE html>
<html>

<head>
	<title>Insert Page </title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<form method="post" name="form">

<body>
	<center>
		<?php

		// servername => localhost
		// username => root
		// password => empty
		// database name => capstone
		$conn = mysqli_connect("localhost", "gtconlin_rooot", "meselhy", "gtconlin_itemp");
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
		
		// Taking all 5 values from the form data(input)
		//$id = $_REQUEST['id'];
		$user_id = $_REQUEST['user_id'];
		$first_name = $_REQUEST['first_name'];
		$last_name = $_REQUEST['last_name'];


		
		// Performing insert query execution
		// here our table name is college
		$sql = "INSERT INTO users VALUES ('','$userid','$first_name','$last_name','', '', '','')";
		
		if(mysqli_query($conn, $sql)){
			echo "<h2>The new user's data was stored successfully in the database </h2>";
				

			
		} else{
			echo "ERROR: Hush! Sorry $sql. "
				. mysqli_error($conn);
		}
		
		// Close connection
		mysqli_close($conn);
		?>
	</center>
					<center><button class="btn" onclick="form.action='home.php';"><i class="material-icons">home</i></button><br><br><br></center>

</body>
</form>

</html>
