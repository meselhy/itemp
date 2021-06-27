<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `users` WHERE CONCAT(`id`, `first_name`, `last_name`, `temp`, `device`, `gate`, `time`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `users`";
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
        <title>PHP HTML TABLE DATA SEARCH</title>
<link rel="stylesheet" href="table.css">
	 <link rel="stylesheet" href="buttons.css">

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"></head>


        <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        
        <form action="search.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
            <input type="submit" name="search" value="Filter"><br><br>
            
            <table id=update3>
                <tr>
                    <th>UserId</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Temp</th>
			<th>Device</th>
			<th>Gate</th>
			<th>Time</th>
					    <th><p style="color:black">EDIT</p></th>

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
                    <td> <p style="color:green"><button><a href='delete.php?id=<?php echo $row['id'];?>'>DELETE</button> </p></a></td>


                </tr>

                <?php endwhile;?>

            </table>
        </form>
			<form>	<br>	<center><button id="but4" class="btn" onclick="form.action='home.php';"><i class="material-icons">home</i></button></center><br><br><br></form>


    </body>
</html>