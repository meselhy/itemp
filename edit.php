
<?php

include "dbConn.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$qry = mysqli_query($db,"select * from information where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
	$id = $_POST['id'];
    $Name = $_POST['Name'];
    $Surname = $_POST['Surname'];
	$PhoneNumber = $_POST['PhoneNumber'];
    $Temperature = $_POST['Temperature'];
	$Username = $_POST['Username'];
    $Password = $_POST['Password'];



	
    $edit = mysqli_query($db,"update information set Name='$Name', Surname='$Surname', PhoneNumber='$PhoneNumber', Temperature='$Temperature',Username='Username', Password='$Password' where id='$id'");
	
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
<head>
  	<link rel="stylesheet" href="table.css">
</head>
<center><h1> Click the "Update" button to save your changes </h1></center>
<center><table id="update2" border="2">
  <tr>
    <th>id</th>
    <th>Name</th>
    <th>Surname</th>
	<th>PhoneNumber</th>
	<th>Temperature</th>
	<th>Username</th>
	<th>Password</th>
    <th><p style="color:black">UPDATE</p></th>
</tr>
</center>

<form method="POST"><tr>
   <td><input type="text" name="Name" value="<?php echo $data['id'] ?>" placeholder="Enter your Name" Required></td>
  <td><input type="text" name="Name" value="<?php echo $data['Name'] ?>" placeholder="Enter your Name" Required></td>
  <td><input type="text" name="Surname" value="<?php echo $data['Surname'] ?>" placeholder="Enter your Surname" Required></td>
  <td><input type="text" name="PhoneNumber" value="<?php echo $data['PhoneNumber'] ?>" placeholder="Enter your PhoneNumber" Required></td>
  <td><input type="text" name="Temperature" value="<?php echo $data['Temperature'] ?>" placeholder="Enter your Temperature" Required></td>
  <td><input type="text" name="Username" value="<?php echo $data['Username'] ?>" placeholder="Enter your Username" Required></td>
  <td><input type="text" name="Password" value="<?php echo $data['Password'] ?>" placeholder="Enter your Password" Required></td>
  <td><input type="submit" name="update" value="Update"></td>

</tr>

</form>
