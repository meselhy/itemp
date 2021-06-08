<!DOCTYPE html>
<html lang="en">

<head>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"></head>
<link rel="stylesheet" href="buttons.css">
<link rel="stylesheet" href="table.css">

	<title>GFG- Store Data</title>
</head>

<body>
	 <link rel="stylesheet" href="buttons.css">

		<form action="insert.php" method="post">


	<center>
<h2 > Enter the information of the new user and click "Submit" button to save</h2>


			<center>
<table id="update4" border="2" >
  <tr>
      <th>id</th>
    <th>Name</th>
    <th>Surname</th>
	<th>PhoneNumber</th>
	<th>Temperature</th>
	<th>Username</th>
	<th>Password</th>
    <th><p style="color:black">Submit</p></th>
	

  </tr>
</center>
<tr>
  <td><input type="text" name="id"  placeholder="Enter the id" Required></td>
  <td><input type="text" name="Name"  placeholder="Enter the Full Name" Required></td>
  <td><input type="text" name="Surname"  placeholder="Enter the Surname" Required></td>
  <td><input type="number" name="PhoneNumber"  placeholder="Enter the Phone Number" Required></td>
  <td><input type="number" name="Temperature"  placeholder="Enter the Temperature" Required></td>
  <td><input type="text" name="Username"  placeholder="Enter the Username" Required></td>
  <td><input type="text" name="Password" placeholder="Enter the Password" Required></td>
  <td><input type="submit" value="Submit"></td>


  
</tr></table>



			
	</center>

		</form>

</body>

</html>
			 					<form><br><br><center><button id="but5" class="btn" onclick="form.action='home.php';"><i class="material-icons">home</i></button></center></form>
