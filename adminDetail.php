<?php
  session_start();
  $visitor =  $_SESSION['visitorID'];
  $tableName = $_GET['tableName'];
  include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
	<meta charset="UTF-8">
	<title>Side Navigation Bar</title>
	<link rel="stylesheet" href="quiz1.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://kit.fontawesome.com/805d306191.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">



</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h2>Admin</h2>
        <ul>
            <li><a href="adminMain.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="index.php"><i class="fas fa-blog"></i>Exit</a></li>
        </ul> 
    </div>

    <div class="main_content">
        <?php
            $sql = "SELECT * FROM visitor WHERE visitorid = '$visitor';";
            $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
            $row = mysqli_fetch_assoc($result);
        ?>

        <div class="header">Welcome! <?php echo $row['VISITORNAME']?></div>  
        <div class="info">

        <!--Put Your Code here, remember to check the link for css-->
        <center><h1>Details </h1></center>
        <br>

        <h2 style="text-align: left">Table Details</h2>
        <table class="table">
            <thead>
                <tr class="table-success">
                    <th class="table-success">Table Name</th>
                    <th class="table-success">Table Rows</th>
                    <th class="table-success">Date Length</th>
                    <th class="table-success">Index Length</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $quizsql = "SELECT table_name, table_rows, data_length, index_length
            FROM information_schema.tables
            WHERE table_schema = 'multimedia'
              AND table_name = '$tableName';
            ";

            $quizresult = mysqli_query($conn,$quizsql);

            while ($row = mysqli_fetch_assoc($quizresult)) {
            ?>
            <tr class="table-success">
                <td><?php echo $row['table_name']?></td>
                <td><?php echo $row['table_rows']?></td>
                <td><?php echo $row['data_length']?></td>
                <td><?php echo $row['index_length']?></td>
            </tr>
            <?php 
            }
            ?>
            </tbody>
        </table>


        </div>
    </div>
</div>

</body>
</html>