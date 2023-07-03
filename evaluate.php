<?php
session_start();
include "connect.php";
mysqli_set_charset($con, "utf8");
if(isset($_SESSION["visitorID"]))
{
  $id= $_SESSION["visitorID"];
}
else
{
  header('Location: ../index.php');
}

$questionID = $_POST['questionID'];
$answer = $_POST['ans'];
$correctAnswer = $_POST['correctAnswer'];
$assid = $_POST['assid'];

  if (!isset($_SESSION['total'])) {
        $_SESSION['total'] = 0;
    } 
  if ($correctAnswer == $answer) {
        $_SESSION['total'] += 1;
    }

	
	
?>
<!DOCTYPE html>
<html>
<title>Plates of Joys</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" type="text/css" href="../css/quiz1.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<body>
	
	
<div class="w3-top">
      <div class="w3-bar w3-white w3-wide w3-padding w3-card">
        <a href="../home.php" class="w3-bar-item w3-button"><b>PLATES</b> of JOYS</a>
    <!-- Float links to the right. Hide them on small screens -->
          <div class="w3-right w3-hide-small">
              <a href="languageHome.php" class="w3-bar-item w3-button">Content</a>
              <!-- <a href="#about" class="w3-bar-item w3-button">About</a> -->
              <a href="index.php" class="w3-bar-item w3-button">Logout</a>
          </div>
	</div>
  </div>
	
	<center><h1>Assessment 1 <span class="qz"> / 测验1</span></h1></center>
	<br>
	<center><h3>Level: Easy</h3></center>
	
	<div class="card mb-3">
	<?php
	$ASSID = "ASSID"; 
    $quizsql = "SELECT * from questions WHERE ASSID = '".$ASSID."' AND questionID > $questionID LIMIT 1";
    $quizresult = mysqli_query($con,$quizsql);
	
		if ($quizresult && mysqli_num_rows($quizresult)>0)
		{
			while($row = mysqli_fetch_assoc($quizresult)) 
			{ ?>
		

					<form action="evaluate.php" method="POST" >
						<div class="card-body">
							
    						<h5 class="card-title"> <?php echo $row['question'] ?></h5>
							

							
    						<p class="card-text"> <?php echo '<input type ="hidden" name="correctAnswer" value = "'. $row["ans"] .'" '?></p>
							<p class="card-text"> <?php echo '<input type ="hidden" name="questionID" value = "'. $row["questionID"] .'" '?></p>
							<p class="card-text"> <?php echo '<input type ="hidden" name="assid" value = "'. $row["ASSID"] .'" '?></p>
							<p class="card-text"> <?php echo '<input type ="radio" name="ans" value = "'. $row["first_choice"] .'" >'?>  <?php echo $row['first_choice'] ?></p>
							<p class="card-text"> <?php echo '<input type ="radio" name="ans" value = "'. $row["second_choice"] .'" >'?> <?php echo $row['second_choice'] ?></p>
							<p class="card-text"> <?php echo '<input type ="radio" name="ans" value = "'. $row["third_choice"] .'" >'?> <?php echo $row['third_choice'] ?></p>
							<p class="card-text"> <?php echo '<input type ="radio" name="ans" value = "'. $row["fourth_choice"] .'" >'?> <?php echo $row['fourth_choice'] ?></p>
							<button   name="submit" class="button btn1">Submit</button> 
							
  						</div>
					</form>

	
		<?php	} 
	 	}
		else{
			
			$sql1 = "SELECT * FROM assessment WHERE ASSID = $ASSID";
			$result1 = mysqli_query($con,$sql1);
			
			if($result1)
			{
				if(mysqli_num_rows($result1)>0)
				{
					$row = mysqli_fetch_array($result1);
					$mark = $_SESSION['total'] / $row['ASSMARKS'] * 100;
					
					$query ="INSERT INTO assesmenttaken (VISITORID, ASSID, MARKS, ASSDATE) VALUES ('$id', '$ASSID', '$_SESSION[total]', NOW())";
					$resu = mysqli_query($con,$query);
					
					if($resu)
					{
						if($mark >= 80)
						{
							echo "<script>alert('Congratulates. You get $mark%. You have passed the assessment!')</script>";
							echo"<meta http-equiv='refresh' content='0; url=quiz.php?id=5003'/>";
						}
						else if ($mark <80)
						{
							echo "<script>alert('Sorry. You get $mark%. You have failed the assessment!')</script>";
							echo"<meta http-equiv='refresh' content='0; url=quiz.php?id=5003'/>";
						}
					}
					
				}
			}
		}
		?>

	</div>
	</body>
</html>
