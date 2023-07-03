<?php
  session_start();
  $visitor =  $_SESSION['visitorID'];
  $languageID = $_GET['id'];
  include "connect.php";

  if(isset($_POST['send'])){
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    if(empty($rating)){
        echo "<script>alert('Rating cannot be empty');</script>";
        echo "<meta http-equiv='refresh' content='0; url=feedback.php?id=$languageID'/>";
    }
    else{
        $ratesql = "INSERT INTO feedback (VISITORID, LANGUAGEID, RATING, FEEDDATE, COMMENT) VALUES ('$visitor', '$languageID', '$rating', NOW(), '$comment')";
        $result1= mysqli_query($conn,$ratesql) or die(mysqli_error($conn));
        echo "<script>alert('Thanks for the feedback');</script>";
        echo "<meta http-equiv='refresh' content='0; url=feedback.php?id=$languageID'/>";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Side Navigation Bar</title>
	<link rel="stylesheet" href="feedback.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://kit.fontawesome.com/805d306191.js" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/4a0046fff5.js" crossorigin="anonymous"></script>


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

            <div class="comments-container">
                <h1>Comment about this course</h1>

                <ul id="comments-list" class="comments-list">
                    <?php
                        $sql = "SELECT visitorname, rating, comment, feeddate FROM feedback f, visitor v WHERE f.visitorid = v.visitorid AND languageid = '$languageID' ORDER BY FEEDDATE DESC;";
                        $result1 = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
                        while ( $row = mysqli_fetch_assoc($result1)){
                    
                    ?>
                        <li>
                            <div class="comment-main-level">
                                <!-- Avatar -->
                                <div class="comment-avatar"><img src="image/profilepic.png" alt=""></div>
                                <!-- Contenedor del Comentario -->
                                <div class="comment-box">
                                    <div class="comment-head">
                                        <h6 class="comment-name"><?php echo $row['visitorname']?></h6>
                                        <h6 class="comment-name by-author"> <?php echo $row['rating']?>/5</h6>
                                        <span><?php echo $row['feeddate']?></span>
                                        <i class="fa fa-reply"></i>
                                        <i class="fa fa-heart"></i>
                                    </div>
                                    <div class="comment-content">
                                        
                                        <?php echo $row['comment']?>
                                    </div>
                                </div>
                            </div>
                        </li>

                    <?php
                        }
                    ?>
                </ul>
            </div>
    
            
                    <div class="wrapper1">
                        <button class="feedback_btn send_btn">Send Your Feedback</button>
                        
                        <div class="modal_wrapper">
                            <div class="shadow close_btn"></div>
                            
                            <div class="modal">
                                <div class="close_btn">
                                    <i class="fa-solid fa-xmark"></i>
                                </div>
                                
                                <form action="" method="post">
                                    <div class="header">
                                        <h3>Give Feedback</h3>
                                        <p>What do you think of this software?</p>
                                        <div class="feedback_icons">
                                            <ul>
                                                <li>
                                                    <label onclick="document.getElementById('rating').value='1'">
                                                        <i class="fa-regular fa-face-smile"></i>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label onclick="document.getElementById('rating').value='2'">
                                                        <i class="fa-regular fa-face-smile"></i>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label onclick="document.getElementById('rating').value='3'">
                                                        <i class="fa-regular fa-face-smile"></i>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label onclick="document.getElementById('rating').value='4'">
                                                        <i class="fa-regular fa-face-smile"></i>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label onclick="document.getElementById('rating').value='5'">
                                                        <i class="fa-regular fa-face-smile"></i>
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="body">
                                        <p>Do you have any thoughts you'd like to share?</p>
                                        <textarea class="textarea" name="comment"></textarea>
                                        <input type="hidden" name="rating" id="rating" value="">
                                    </div>
                                    <div class="footer">
                                        <button class="send_btn" type="submit" name="send">Send</button>
                                        <button class="cancel_btn">cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                        <script type="text/javascript">
                        var feedback_btn = document.querySelector(".feedback_btn");
                        var wrapper = document.querySelector(".wrapper1");
                        var close_btns = document.querySelectorAll(".close_btn");
                        var li_items = document.querySelectorAll("ul li");

                        feedback_btn.addEventListener("click", function () {
                        wrapper.classList.add("active");
                        });

                        close_btns.forEach(function (btn) {
                        btn.addEventListener("click", function () {
                            wrapper.classList.remove("active");
                        });
                        });

                        li_items.forEach(function (item) {
                        item.addEventListener("click", function () {
                            li_items.forEach(function (item) {
                            item.classList.remove("active");
                            });

                            item.classList.add("active");
                        });
                        });

                        </script>

  
        </div>
    </div>

</div>

</body>
</html>