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
    <th>ID</th>
    <th>Name</th>
    <th>Surname</th>
	<th>PhoneNumber</th>
	<th>Temperature</th>
	<th>Username</th>
	<th>Password</th>
	

  </tr>
</center>
<?php

include "dbConn.php"; // Using database connection file here

$records = mysqli_query($db,"select * from information"); // fetch data from database

while($data = mysqli_fetch_array($records))
{
?>

  <tr>
    <td><?php echo $data['id']; ?></td>
    <td><?php echo $data['Name']; ?></td>
    <td><?php echo $data['Surname']; ?></td>  
    <td><?php echo $data['PhoneNumber']; ?></td>
    <td><?php echo $data['Temperature']; ?></td>
    <td><?php echo $data['Username']; ?></td> 
    <td><?php echo $data['Password']; ?></td>    
	

  </tr>	

<?php
}
?>
</table>
				<br>	<button id="but4" class="btn" onclick="form.action='home.php';"><i class="material-icons">home</i></button><br><br><br>

</body>
</form>



</html>