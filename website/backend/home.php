<html>
<head>
<link rel="stylesheet" href="table.css">
<link rel="stylesheet" href="buttons.css">


<meta name='viewport' content='width=device-width, initial-scale=1'>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</head>
<body>
<form method="post" name="form">

<center>
<h1>WELCOME ADMIN</h1><br><br>
<table id="customers" border="2">
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
</center>
<br><button id= "but1" class="btn" onclick="form.action='index1.php';"><i class='fas fa-user-plus'></i> Insert</button><br><br><br><br>
<button id= "but2" class="btn" onclick="form.action='edit1.php';"><i class='fas fa-user-edit'></i> Update</button><br><br><br><br>
<button id= "but3" class="btn" onclick="form.action='delete1.php';"><i class="fas fa-trash"></i> Delete</button>
<p><a href="logout.php">Logout</a></p>

  <div class="vl"></div>

</form>
</body>
</html>