<?php
  session_start();
  $visitor =  $_SESSION['visitorID'];
  $languageID = $_GET['id'];
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
        <h2>Numbers</h2>
        <ul>
            <li><a href="languageHome.php?id=<?php echo $languageID?>"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="quizHome.php?id=<?php echo $languageID?>"><i class="fa-solid fa-file-circle-question"></i>  Assessment</a></li>
            <li><a href="result.php?id=<?php echo $languageID?>"><i class="fas fa-address-card"></i>Result</a></li>
            <li><a href="feedback.php?id=<?php echo $languageID?>"><i class="fas fa-project-diagram"></i>Feedback</a></li>
            <li><a href="homepage.php"><i class="fas fa-blog"></i>Exit</a></li>
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

        <!--Put Your Code here, remember to check the link for css-->
        <center><h1>Result </h1></center>
        <br>

        <h2 style="text-align: left">Passed Exam</h2>
        <table class="table">
            <thead>
                <tr class="table-success">
                    <th class="table-success">Assessment Type</th>
                    <th class="table-success">Level</th>
                    <th class="table-success">Marks</th>
                    <th class="table-success">Done By</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $quizsql = "SELECT * FROM assessment a, assesmenttaken t WHERE a.ASSID = t.assID AND LanguageID = '$languageID' AND MARKS >= 80 AND visitorID = '$visitor'";
            $quizresult = mysqli_query($conn,$quizsql);

            while ($row = mysqli_fetch_assoc($quizresult)) {
            ?>
            <tr class="table-success">
                <td><?php echo $row['ASSTYPE']?></td>
                <td><?php echo $row['LEVEL']?></td>
                <td><?php echo $row['MARKS']?></td>
                <td><?php echo date('d-m-Y H:i', strtotime($row['ASSDATE'])); ?></td>
            </tr>
            <?php 
            }
            ?>
            </tbody>
        </table>


        <br>
        <h2 style="text-align: left">Failed Exam</h2>
        <table class="table">
            <thead>
                <tr class="table-danger">
                    <th>Assessment Type</th>
                    <th>Level</th>
                    <th>Marks</th>
                    <th>Done By</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $quizsql = "SELECT * FROM assessment a, assesmenttaken t WHERE a.ASSID = t.assID AND LanguageID = '$languageID' AND MARKS < 80 AND visitorID = '$visitor'";
            $quizresult = mysqli_query($conn,$quizsql);

            while ($row = mysqli_fetch_assoc($quizresult)) {
            ?>
            <tr class="table-danger">
                <td><?php echo $row['ASSTYPE']?></td>
                <td><?php echo $row['LEVEL']?></td>
                <td><?php echo $row['MARKS']?></td>
                <td><?php echo $row['ASSDATE']?></td>
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