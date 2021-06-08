<!DOCTYPE html>
<html>
<head>
  <title>Display all records from Database</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"></head>

  	<link rel="stylesheet" href="table.css">
	 <link rel="stylesheet" href="buttons.css">

<?php

include "dbConn.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$qry = mysqli_query($db,"select * from information where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $Name = $_POST['Name'];
    $Surname = $_POST['Surname'];
	$PhoneNumber = $_POST['PhoneNumber'];
  	$Temperature = $_POST['Temperature'];
  	$Username = $_POST['Username'];
	$Password = $_POST['Password'];


	
	
    $edit = mysqli_query($db,"update information set Name='$Name', Surname='$Surname', PhoneNumber='$PhoneNumber', Temperature='$Temperature', Username='$Username', Password='$Password' where id='$id'");
	
    if($edit)
    {
        mysqli_close($db); // Close connection
        header("location:all_records.php"); // redirects to all records page
        exit;
    }
    else
    {
        echo mysqli_error();
    }    	
}

?>


<center><h2>Click the "Update" button to save your changes</h2></center>

<br>

<form method="POST">
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

<tr>
  <td><input type="text" name="Name" value="<?php echo $data['Name'] ?>" placeholder="Enter the Full Name" Required></td>
  <td><input type="text" name="Surname" value="<?php echo $data['Surname'] ?>" placeholder="Enter the Surname" Required></td>
  <td><input type="number" name="PhoneNumber" value="<?php echo $data['PhoneNumber'] ?>" placeholder="Enter the Phone Number" Required></td>
  <td><input type="number" name="Temperature" value="<?php echo $data['Temperature'] ?>" placeholder="Enter the Temperature" Required></td>
  <td><input type="text" name="Username" value="<?php echo $data['Username'] ?>" placeholder="Enter the Username" Required></td>
  <td><input type="text" name="Password" value="<?php echo $data['Password'] ?>" placeholder="Enter the Password" Required></td>


  <td><input type="submit" name="update" value="Update"></td>
  
</tr></table>

</form>
  				<form> <center><br>	<button id="but4" class="btn" onclick="form.action='home.php';"><i class="material-icons">home</i></button><br><br><br></center></form>
