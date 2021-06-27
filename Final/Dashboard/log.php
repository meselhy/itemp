<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `log` WHERE CONCAT(`id`, `first_name`, `last_name`, `temp`, `device`, `gate`, `time`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `log`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "gtconlin_rooot", "meselhy", "gtconlin_itemp");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>View Log</title>
<link rel="stylesheet" href="table.css">
	 <link rel="stylesheet" href="buttons.css">

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"></head>
<script src="fontawsome.js"></script>
<link href="fontawesome.all-min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/solid.css">
<style>
    table,tr,th,td
    {
        border: 1px solid black;
    }
</style>
    </head>
    <body>
<form><button style="background-color: transparent;font-size: 22px;position: absolute;left: 16px;border: none;top:8px;color: #4CAF50;cursor: pointer;" class="btn" onclick="form.action='home.php';"><i class="fas fa-arrow-left"></i>
</button></form>
<form><button style="background-color: transparent;font-size: 22px;position: absolute;right: 16px;border: none;top:8px;color: #da4646;cursor: pointer;" class="btn" onclick="form.action='clear.php';"><i class="fas fa-broom"></i>
</button></form>
        <form action="homeSearch.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Search" style="
    position: absolute;
    left: 9px;
    top: 45px;
    width: 13pc;
    height: 22px;"><br><br>
            <input type="submit" name="search" value="&#xf002; Find" style="
    position: absolute;
    left: 246px;
    top: 45px;
    width: 70px;
    height: 27px;
    color: white;
    background-color: #4CAF50;
    border:none;
    font-family: 'Font Awesome 5 Free';
    font-weight: 800;"><br><br>
            
            <table id=update3>
                <tr>
                    <th>UserId</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Temp</th>
			        <th>Device</th>
			        <th>Gate</th>
			        <th>Time</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['userid'];?></td>
                    <td><?php echo $row['first_name'];?></td>
                    <td><?php echo $row['last_name'];?></td>
			        <td><?php echo $row['temp'];?></td>
			        <td><?php echo $row['device'];?></td>
			        <td><?php echo $row['gate'];?></td>
			        <td><?php echo $row['time'];?></td>

                </tr>
                <?php endwhile;?>
            </table>
    </body>
</html>