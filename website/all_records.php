<!DOCTYPE html>
<html>
<head>
  <title>Display all records from Database</title>
</head>
<body>

<h2>Employee Details</h2>

<table border="2">
  <tr>
    <td>ID</td>
    <td>Name</td>
    <td>Surname</td>
	<td>PhoneNumber</td>
	<td>Temperature</td>
	<td>Username</td>
    <td>Edit</td>
    <td>Delete</td>
  </tr>

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
    
		 
	
    <td><a href="edit.php?id=<?php echo $data['id']; ?>">Edit</a></td>
    <td><a href="delete.php?id=<?php echo $data['id']; ?>">Delete</a></td>
  </tr>	
<?php
}
?>
</table>

</body>
</html>