<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `information` WHERE CONCAT(`id`, `Name`, `Surname`, `PhoneNumber`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `information`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "capstone");
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
        
        <form action="homeSearch.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
            <input type="submit" name="search" value="Filter"><br><br>
            
            <table id=update3>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>

                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['Name'];?></td>
                    <td><?php echo $row['Surname'];?></td>
                    <td><?php echo $row['PhoneNumber'];?></td>


                </tr>

                <?php endwhile;?>

            </table>
        </form>
			<form>	<br>	<center><button id="but4" class="btn" onclick="form.action='home.php';"><i class="material-icons">home</i></button></center><br><br><br></form>


    </body>
</html>