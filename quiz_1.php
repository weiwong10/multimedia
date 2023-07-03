<?php
  session_start();
  $visitor =  $_SESSION['visitorID'];
  $languageID = $_GET['languageID'];
  include "connect.php";

  if (isset($_POST['submit'])) {

        if(!isset($_POST['answer'])){
            echo "<script>alert('Please Answer All Questions!')</script>";
            echo "<meta http-equiv='refresh' content='0; url=quiz_1.php?languageID=$languageID'/>";
            exit;
        }

        $selectedAnswers = $_POST['answer']; // Get the user's selected answers

        // Check if all questions have been answered
        $totalQuestions = $_POST['databaseQuestion'];        // Total number of questions
        $answeredQuestions = array_filter($selectedAnswers); // Count the number of answered questions
    
        if (count($answeredQuestions) != $totalQuestions) {
            echo "<script>alert('Please Answer All Questions!')</script>";
            echo "<meta http-equiv='refresh' content='0; url=quiz_1.php?languageID=$languageID'/>";
            exit; // Exit the script to prevent further processing
        }


    $totalQuestions = count($selectedAnswers); // Total number of questions
    $totalMarks = 0;
    $x = 0;

    $query = "SELECT * FROM assessment a, questions q WHERE a.ASSID = q.assID AND LEVEL = 1 AND LanguageID = '$languageID' ORDER BY questionID ASC;";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)){

        $correctAnswer = $row['ans'];
              
        if ($selectedAnswers[$x] == $correctAnswer) {
            $totalMarks++;
        }

        $x++;
        $assid = $row['ASSID'];

    }


    $percentage = ($totalMarks / $totalQuestions) * 100; // Calculate the percentage

    $insert ="INSERT INTO assesmenttaken (VISITORID, ASSID, MARKS, ASSDATE) VALUES ('$visitor', '$assid', '$percentage', NOW())";
    $resultInsert = mysqli_query($conn,$insert);

    if ($percentage >= 80) {
        echo "<script>alert('Congratulations! You scored $percentage%. You have passed the assessment!')</script>";
        echo "<meta http-equiv='refresh' content='0; url=result.php?id=$languageID'/>";
    } else {
        echo "<script>alert('Sorry. You scored $percentage%. You have failed the assessment!')</script>";
        echo "<meta http-equiv='refresh' content='0; url=result.php?id=$languageID'/>";
    }

  }
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
            mysqli_set_charset($conn,"utf8");

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
            $quizsql = "SELECT * FROM assessment a, questions q WHERE a.ASSID = q.assID AND LEVEL = 1 AND LanguageID = '$languageID';";
            $quizresult = mysqli_query($conn,$quizsql);
            $databaseQuestion = mysqli_num_rows($quizresult);

            if ($quizresult && mysqli_num_rows($quizresult)>0) {
                ?>
                <form action="" method="POST">
                <?php
                $count = 0;
                while ($row = mysqli_fetch_assoc($quizresult)) {
                    ?>
                    <div class="card-body">
                    <h5 class="card-title"><?php echo ($count + 1) . '. ' . $row['question']; ?></h5>
                        <h6 class="card-text">
                            <input type="radio" name="answer[<?php echo $count; ?>]" value="<?php echo $row["first_choice"]; ?>">
                            <?php echo $row['first_choice']; ?>
                        </h6>
                        <h6 class="card-text">
                            <input type="radio" name="answer[<?php echo $count; ?>]" value="<?php echo $row["second_choice"]; ?>">
                            <?php echo $row['second_choice']; ?>
                        </h6>
                        <h6 class="card-text">
                            <input type="radio" name="answer[<?php echo $count; ?>]" value="<?php echo $row["third_choice"]; ?>">
                            <?php echo $row['third_choice']; ?>
                        </h6>
                        <h6 class="card-text">
                            <input type="radio" name="answer[<?php echo $count; ?>]" value="<?php echo $row["fourth_choice"]; ?>">
                            <?php echo $row['fourth_choice']; ?>
                        </h6>
                        <br>
                    </div>
                    <?php 
                    $count++;
                } 
                ?>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <input type="hidden" name="databaseQuestion" value="<?php echo $databaseQuestion?>">
                    <button name="submit"  class="btn btn-primary">Submit</button> 
                </div>
                </form>
                <?php
            } else {
                echo "No questions found.";
            }
        ?>
        </div>
        </div>
    </div>
</div>

</body>
</html>