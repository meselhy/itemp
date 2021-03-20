<?php

include "dbConn.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$qry = mysqli_query($db,"select * from information where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $Name = $_POST['Name'];
    $Surname = $_POST['Surname'];
	
    $edit = mysqli_query($db,"update information set Name='$Name', Surname='$Surname' where id='$id'");
	
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

<h3>Update Data</h3>

<form method="POST">
  <input type="text" name="Name" value="<?php echo $data['Name'] ?>" placeholder="Enter your Name" Required>
  <input type="text" name="Surname" value="<?php echo $data['Surname'] ?>" placeholder="Enter your Surname" Required>
  <input type="submit" name="update" value="Update">
</form>