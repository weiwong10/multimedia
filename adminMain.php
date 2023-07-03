<?php
  session_start();
  $visitor =  $_SESSION['visitorID'];
  include "connect.php";
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Side Navigation Bar</title>
    <link rel="stylesheet" href="newtest.css">

	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://kit.fontawesome.com/805d306191.js" crossorigin="anonymous"></script>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h2>Admin</h2>
        <ul>
            <li><a href="adminMain.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="index.php"><i class="fas fa-blog"></i>Exit</a></li>
           <!--
            <li><a href="#"><i class="fas fa-address-book"></i>Contact</a></li>
            <li><a href="#"><i class="fas fa-map-pin"></i>Map</a></li>
            -->
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
            <div class="container">
                <h1 class="heading">All table</h1>
                <div class="box-container">
                    <?php
                        $sql = "SELECT TABLE_NAME
                        FROM information_schema.TABLES
                        WHERE TABLE_SCHEMA = 'multimedia';
                        ";
                        $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                        while ( $row = mysqli_fetch_assoc($result)){
                    ?>
                    <div class="box">
                        <div class="image">
                            <a href="adminDetail.php?tableName=<?php echo $row['TABLE_NAME']?>">
                                <img src="image/admin.jpg" alt="Description of the image" title="This is an example image">
                            </a>
                        </div>
                        <div class="content">
                            <h3><?php echo $row['TABLE_NAME']?></h3>
                            <div class="icons">
                                <!-- <span><i class="fa-solid fa-book-open"></i>Numbers 0-10 </span> -->
                            </div>
                        </div>
                    </div>

                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>