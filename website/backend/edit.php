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

$qry = mysqli_query($db,"select * from users where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $id = $_POST['id'];
    $userid = $_POST['userid'];
	$first_name = $_POST['first_name'];
  	$last_name = $_POST['last_name'];
  	$username = $_POST['username'];
	$password = $_POST['password'];
	$temp = $_POST['temp'];



	
	
    $edit = mysqli_query($db,"update users set id='$id', userid='$userid', first_name='$first_name', last_name='$last_name', username='$username', password='$password' where id='$id'");
	
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
    <th>id</th>
    <th>userid</th>
	<th>first_name</th>
	<th>last_name</th>
	<th>username</th>
	<th>password</th>
	<th>temp</th>

    <th><p style="color:black">EDIT</p></th>
	

  </tr>
</center>

<tr>
  <td><input type="mumber" name="id" value="<?php echo $data['id'] ?>" placeholder="Enter the id" Required></td>
  <td><input type="number" name="userid" value="<?php echo $data['userid'] ?>" placeholder="Enter the userid" Required></td>
  <td><input type="text" name="first_name" value="<?php echo $data['first_name'] ?>" placeholder="Enter the first_name" Required></td>
  <td><input type="text" name="last_name" value="<?php echo $data['last_name'] ?>" placeholder="Enter the last_name" Required></td>
  <td><input type="text" name="username" value="<?php echo $data['username'] ?>" placeholder="Enter the username" Required></td>
  <td><input type="text" name="password" value="<?php echo $data['password'] ?>" placeholder="Enter the password" Required></td>
  <td><input type="text" name="temp" value="<?php echo $data['temp'] ?>" placeholder="Enter the temp" Required></td>


  <td><input type="submit" name="update" value="Update"></td>
  
</tr></table>

</form>
  				<form> <center><br>	<button id="but4" class="btn" onclick="form.action='home.php';"><i class="material-icons">home</i></button><br><br><br></center></form>
