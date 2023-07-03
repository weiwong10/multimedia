<?php
    session_start();
    include "connect.php";

    $visitor =  $_SESSION['visitorID'];
    $languageID = $_POST['languageID'];
    $questionID = $_POST['questionID'];
    $correctAnswer = $_POST['correctAnswer'];
    $answer = $_POST['answer'];
    $assid = $_POST['ASSID'];

    if (!isset($_SESSION['total'])) {
        $_SESSION['total'] = 0;
    } 
    elseif ($correctAnswer == $answer) {
        $_SESSION['total'] += 1;
    }

    mysqli_set_charset($conn, "utf8");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Side Navigation Bar</title>
	<link rel="stylesheet" href="quiz1.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://kit.fontawesome.com/805d306191.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="../css/quiz1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h2>Numbers</h2>
        <ul>
            <li><a href="languageHome.php?id=<?php echo $languageID?>"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="#"><i class="fa-solid fa-file-circle-question"></i>  Assessment</a></li>
            <li><a href="#"><i class="fas fa-address-card"></i>Result</a></li>
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

            
            <center><h1>Assessment 1</h1></center>
            <br>
            <center><h3>Level: Easy</h3></center>
            
            <div class="card mb-3">
            <?php
            
            $quizsql = "SELECT * FROM assessment a, questions q WHERE a.ASSID = q.assID AND q.assID = '$assid' AND LEVEL = 1 AND LanguageID = '$languageID' AND questionID > $questionID LIMIT 1;";
            $quizresult = mysqli_query($conn,$quizsql);
            
                if ($quizresult && mysqli_num_rows($quizresult)>0)
                {
                    while($row = mysqli_fetch_assoc($quizresult)) 
                    { ?>
                

                            <form action="quiz1_2.php" method="POST" >
                                <div class="card-body">
                                    
                                    <h5 class="card-title"> <?php echo $row['question'] ?></h5>
                                    
                                    <p class="card-text"> <?php echo '<input type ="hidden" name="correctAnswer" value = "'. $row["ans"] .'" '?></p>
                                    <p class="card-text"> <?php echo '<input type ="hidden" name="questionID" value = "'. $row["questionID"] .'" '?></p>
                                    <p class="card-text"> <?php echo '<input type ="hidden" name="ASSID" value = "'. $row["ASSID"] .'" '?></p>
                                    <p class="card-text"> <?php echo '<input type ="hidden" name="languageID" value = "'. $row["LanguageID"] .'" '?></p>
                                    <p class="card-text"> <?php echo '<input type ="radio" name="answer" value = "'. $row["first_choice"] .'" >'?>  <?php echo $row['first_choice'] ?></p>
                                    <p class="card-text"> <?php echo '<input type ="radio" name="answer" value = "'. $row["second_choice"] .'" >'?> <?php echo $row['second_choice'] ?></p>
                                    <p class="card-text"> <?php echo '<input type ="radio" name="answer" value = "'. $row["third_choice"] .'" >'?> <?php echo $row['third_choice'] ?></p>
                                    <p class="card-text"> <?php echo '<input type ="radio" name="answer" value = "'. $row["fourth_choice"] .'" >'?> <?php echo $row['fourth_choice'] ?></p>
                                    <button   name="submit" class="button btn1">Submit</button> 
                                    <p class="card-text"> <?php echo '<input type ="radio" name="answer" value = "'. $row["fourth_choice"] .'" >'?> <?php echo $_SESSION['totalMark'] ?></p> <br>

                                </div>
                            </form>

            
                <?php	} 
                }
                else{
                    
                    $sql1 = "SELECT * FROM assessment WHERE ASSID = $assid";
                    $result1 = mysqli_query($conn,$sql1);
                    
                    if($result1)
                    {
                        if(mysqli_num_rows($result1)>0)
                        {
                            $row = mysqli_fetch_array($result1);
                            $mark = $_SESSION['total'] / $row['ASSMARKS'] * 100;
                            
                            $query ="INSERT INTO assesmenttaken (VISITORID, ASSID, MARKS, ASSDATE) VALUES ('$visitor', '$assid', '{$_SESSION['total']}', NOW())";
                            $resu = mysqli_query($conn,$query);
                            
                            if($resu)
                            {
                                if($mark >= 80)
                                {
                                    echo "<script>alert('Congratulates. You get $mark%. You have passed the assessment!')</script>";
                                    echo"<meta http-equiv='refresh' content='0; url=result.php?id=5003'/>";
                                    $_SESSION['total'] = 0;
                                }
                                else if ($mark <80)
                                {
                                    echo "<script>alert('Sorry. You get $mark%. You have failed the assessment!')</script>";
                                    echo"<meta http-equiv='refresh' content='0; url=result.php?id=5003'/>";
                                    $_SESSION['total'] = 0;
                                }
                            }
                            
                        }
                    }
                }
                ?>

            </div>
        <!---->


        </div>
    </div>
</div>

</body>
</html>