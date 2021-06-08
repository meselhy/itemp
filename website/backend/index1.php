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
    <th>userid</th>
    <th>first_name</th>
	<th>last_name</th>
	<th>username</th>
	<th>password</th>
	<th>temp</th>
    <th><p style="color:black">Submit</p></th>
	

  </tr>
</center>
<tr>
  <td><input type="number" name="id"  placeholder="Enter the id" Required></td>
  <td><input type="number" name="userid"  placeholder="Enter the user id" Required></td>
  <td><input type="text" name="first_name"  placeholder="Enter the first name" Required></td>
  <td><input type="text" name="last_name"  placeholder="Enter the last name" Required></td>
  <td><input type="text" name="username"  placeholder="Enter the Username" Required></td>
  <td><input type="text" name="password"  placeholder="Enter the password" Required></td>
  <td><input type="number" name="temp" placeholder="Enter the temperature" Required></td>
  <td><input type="submit" value="Submit"></td>


  
</tr></table>



			
	</center>

		</form>

</body>

</html>
			 					<form><br><br><center><button id="but5" class="btn" onclick="form.action='home.php';"><i class="material-icons">home</i></button></center></form>
