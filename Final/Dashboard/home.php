<html>
<head>
<link rel="stylesheet" href="table.css">
<link rel="stylesheet" href="buttons.css">


<meta name='viewport' content='width=device-width, initial-scale=1'>
<script src="fontawsome.js"></script>
<link href="fontawesome.all-min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/solid.css">

</head>
<body>
<form method="post" name="form">

<center>
<h1>WELCOME ADMIN</h1><br><br
<div><button style="background-color: transparent;font-size: 22px;position: absolute;right: 16px;border: none;top:8px;color: #4CAF50;cursor: pointer;" class="btn" onclick="form.action='logout.php';"><i class="fas fa-sign-out-alt"></i>
</button></div>
<table id="customers" border="2">
  <tr>
    <th>userid</th>
    <th>first_name</th>
	<th>last_name</th>
	<th>temp</th>
	<th>device</th>
	<th>gate</th>
	<th>time</th>
	

  </tr>

</center>
<?php

include "dbConn.php"; // Using database connection file here

$records = mysqli_query($db,"select * from users"); // fetch data from database

while($data = mysqli_fetch_array($records))
{
?>

  <tr>
    <td><?php echo $data['userid']; ?></td>
    <td><?php echo $data['first_name']; ?></td>  
    <td><?php echo $data['last_name']; ?></td>
    <td><?php echo $data['temp']; ?></td>
    <td><?php echo $data['device']; ?></td>
    <td><?php echo $data['gate']; ?></td>
    <td><?php echo $data['time']; ?></td>
  </tr>	

<?php
}
?>
</table>
</center>
<br><button id= "but0" onclick="form.action='searchHome.php';"><i class="fas fa-search-plus"></i> Search</button><br><br><br><br>
<br><button id= "but1" class="btn" onclick="form.action='index1.php';"><i class='fas fa-user-plus'></i> Insert</button><br><br><br><br>
<button id= "but2" class="btn" onclick="form.action='edit1.php';"><i class='fas fa-user-edit'></i> Update</button><br><br><br><br>
<button id= "but3" class="btn" onclick="form.action='delete1.php';"><i class="fas fa-trash"></i> Delete</button>
<button id= "but32" class="btn" onclick="form.action='log.php';"><i class="fas fa-file-invoice"></i> Log</button>

<div class="vl"></div>

</form>
</body>
</html>