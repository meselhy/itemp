<?php
session_start();//session starts here  

include_once('config.php');

function test_input($data) {
	
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$uname = mysqli_real_escape_string($con,$_POST['username']);
$password = mysqli_real_escape_string($con,$_POST['password']);
$pass = hash('sha256', $password);

if ($uname != "" && $password != ""){

    $sql_query = "select count(*) as cntUser from staff where username='".$uname."' and password='".$password."'";
    $result = mysqli_query($con,$sql_query);
    $row = mysqli_fetch_array($result);

    $count = $row['cntUser'];

    if($count > 0){
        echo "<script language='javascript'>";
			echo "alert('CORRECT')";
			echo "</script>";
			header("Location: http://itemp.ml/dashboard/home.php");
			die();
    }else{
            echo "<script language='javascript'>";
			echo "alert('WRONG INFORMATION')";
			echo "</script>";
			die();
    }
}
$con->close();

?>
