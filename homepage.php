<?php
session_start();
$visitor =  $_SESSION['visitorID'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="png" href="images/icon/favicon.png">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Comaptible" content="IE=edge">
	<title>Numbers</title>
	<meta name="desciption" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="script.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://kit.fontawesome.com/805d306191.js" crossorigin="anonymous"></script>
    <script>
		$(window).on('scroll', function(){
  			if($(window).scrollTop()){
  			  $('nav').addClass('black');
 			 }else {
 		   $('nav').removeClass('black');
 		 }
		})
	</script>
</head>
<body>
	<?php include "connect.php";?>

	<header id="header">
		<div class="head-container">
			<div class="quote">
				<p>Welcome to Language Learning System for Numbers</p>
				<h5>Numbers are a crucial aspect of any language, used in everyday life for tasks such as counting, telling time, and making appointments. Most languages follow a pattern of cardinal and ordinal numbers, with specific vocabulary and grammar rules for quantities, fractions, decimals, and percentages. While learning numbers can be challenging, it is an essential skill for effective communication in a foreign language. With practice, anyone can master the basics of numbers and open up new opportunities for connection and understanding.
                </h5>
                        
                <div class="play">
                    <i class="fa-solid fa-book"></i><span><a href="#services_section">Learn Now</a></span>
				</div>
				<div class="play">
				<i class="fa-solid fa-power-off"></i></i><span><a href="logout.php">Logout</a></span>
                </div>
			</div>
			<div class="svg-image">
				<img src="image/number intro.jpg" alt="svg">
			</div>
		</div>

	</header>

    <div class="service-swipe">
		<div class="diffSection" id="services_section">
		<center><p style="font-size: 50px; padding: 100px; padding-bottom: 40px; color: #fff;">Please Choose Your Language:</p></center>
		</div>
		<a href="languageHome.php?id=3"><div class="s-card"><img src="image/eng.png"><p>English</p></div></a>
		<a href="languageHome.php?id=2"><div class="s-card"><img src="image/ketupat.png"><p>Bahasa Melayu</p></div></a>
		<a href="languageHome.php?id=1"><div class="s-card"><img src="image/chinese-lantern.png"><p>Chinese</p></div></a>
	</div>


</body>
</html>