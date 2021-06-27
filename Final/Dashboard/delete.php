<?php

include "dbConn.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$del = mysqli_query($db,"delete from users where id = '$id'"); // delete query

if($del)
{
    mysqli_close($db); // Close connection
    echo "<script>alert('Deleted Successfully');window.location.replace('http://itemp.ml/dashboard/home.php');</script>";
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>