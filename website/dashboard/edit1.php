<!DOCTYPE html>
<html>
<head>
  <title>Display all records from Database</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"></head>

  	<link rel="stylesheet" href="table.css">
	 <link rel="stylesheet" href="buttons.css">


</head>
<body>
<center>
<h1> Click the "EDIT" button to edit the details of the user</h1>
</center>
<br>

<center>
<table id="update" border="2">
  <tr>
    <th>Name</th>
    <th>Surname</th>
	<th>PhoneNumber</th>
	<th>Temperature</th>
	<th>Username</th>
	<th>Password</th>
    <th><p style="color:black">EDIT</p></th>
	

  </tr>
</center>
<?php

include "dbConn.php"; // Using database connection file here

$records = mysqli_query($db,"select * from information"); // fetch data from database

while($data = mysqli_fetch_array($records))
{
?>

  <tr>
    <td><?php echo $data['Name']; ?></td>
    <td><?php echo $data['Surname']; ?></td>  
    <td><?php echo $data['PhoneNumber']; ?></td>
    <td><?php echo $data['Temperature']; ?></td>
    <td><?php echo $data['Username']; ?></td> 
    <td><?php echo $data['Password']; ?></td>    
	
    <td><a href="edit.php?id=<?php echo $data['id']; ?>"><b><p style="color:green"><button>EDIT</button></P></a></td>

  </tr>	

<?php
}
?>
</table>
 
</body>
<form>
 
					<br><br><button id="but4" class="btn" onclick="form.action='home.php';"><i class="material-icons">home</i></button><br><br><br>

</form>
</html>