<?php
  session_start();
  $visitor =  $_SESSION['visitorID'];
  $languageID = $_GET['id'];
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
            <div class="container">
                <h1 class="heading">Lesson</h1>
                <div class="box-container">
                    <div class="box">
                        <div class="image">
                            <a href="chapterPage1.php?languageID=<?php echo $languageID?>">
                                <img src="image/studychap.jpg" alt="Description of the image" title="This is an example image">
                            </a>
                        </div>
                        <div class="content">
                            <h3>Lesson 1</h3>
                            <div class="icons">
                                <span><i class="fa-solid fa-book-open"></i>Numbers 0-10 </span>
                            </div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="image">
                            <a href="chapterPage2.php?languageID=<?php echo $languageID?>">
                                <img src="image/studychap.jpg" alt="Description of the image" title="This is an example image">
                            </a>                        </div>
                        <div class="content">
                            <h3>Lesson 2</h3>
                            <div class="icons">
                                <span> <i class="fa-solid fa-book-open"></i>Numbers 11-20</span>
                            </div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="image">
                            <a href="chapterPage3.php?languageID=<?php echo $languageID?>">
                                <img src="image/studychap.jpg" alt="Description of the image" title="This is an example image">
                            </a>                        </div>
                        <div class="content">
                            <h3>Lesson 3</h3>
                            <div class="icons">
                                <span> <i class="fa-solid fa-book-open"></i> Numbers 21-30</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>