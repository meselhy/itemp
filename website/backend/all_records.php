<!DOCTYPE html>
<html>
<head>
<head>
<link rel="stylesheet" href="table.css">
<link rel="stylesheet" href="buttons.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"></head>
</head>
  <title>Display all records from Database</title>
  	<link rel="stylesheet" href="table.css">

</head>
<body>
<form method="post" name="form">

<center>
<h1> These are the available users </h1>
</center>
<br>

<center>
<table id="update3" border="2">
  <tr>
    <th>id</th>
    <th>userid</th>
    <th>first_name</th>
	<th>last_name</th>
	<th>username</th>
	<th>password</th>
	<th>temp</th>
	

  </tr>
</center>
<?php

include "dbConn.php"; // Using database connection file here

$records = mysqli_query($db,"select * from users"); // fetch data from database

while($data = mysqli_fetch_array($records))
{
?>

  <tr>
    <td><?php echo $data['id']; ?></td>
    <td><?php echo $data['userid']; ?></td>
    <td><?php echo $data['first_name']; ?></td>  
    <td><?php echo $data['last_name']; ?></td>
    <td><?php echo $data['username']; ?></td>
    <td><?php echo $data['password']; ?></td> 
    <td><?php echo $data['temp']; ?></td>    
	

  </tr>	

<?php
}
?>
</table>
				<br>	<button id="but4" class="btn" onclick="form.action='home.php';"><i class="material-icons">home</i></button><br><br><br>

</body>
</form>



</html>