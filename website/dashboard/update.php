<?php

include "dbConn.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$del = mysqli_query($db,"insert information where id = '$id'"); // update query

if($del)
{
    mysqli_close($db); // Close connection
    header("location:all_records.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error inserting record"; // display error message if not delete
}
?>