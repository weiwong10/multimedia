<?php
	include 'connect.php';
  $languageID = $_GET['id'];
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {
  margin: 0;
  margin-top: 60px;
}

.navbar ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 20%;
  background-color: #333;
  position: fixed;
  height: 100%;
  overflow: hidden;
  padding-top: 60px;
}

.navbar li {
  margin: 0;
  padding: 0;
}

.navbar li a {
  display: block;
  color: #fff;
  text-align: center;
  padding: 16px;
  text-decoration: none;
}

.navbar li a.active {
  background-color: #04AA6D;
  color: white;
}

.navbar li a:hover:not(.active) {
  background-color: #ddd;
  color: #333;
}

.card{
     width: 20%;
     display: inline-block;
     box-shadow: 2px 2px 20px black;
     border-radius: 5px; 
     margin: 2%;
    }

.image img{
  width: 100%;
  border-top-right-radius: 5px;
  border-top-left-radius: 5px;
  

 
 }

.title{
 
  text-align: center;
  padding: 10px;
  
 }

h1{
  font-size: 20px;
 }

.des{
  padding: 3px;
  text-align: center;
 
  padding-top: 10px;
        border-bottom-right-radius: 5px;
  border-bottom-left-radius: 5px;
}
.button{
  margin-top: 40px;
  margin-bottom: 10px;
  background-color: white;
  border: 1px solid black;
  border-radius: 5px;
  padding:10px;
}

.button:hover{
  background-color: black;
  color: white;
  transition: .5s;
  cursor: pointer;
}

</style>
</head>
<body>
<div class="navbar">
<ul>
  <li><a class="active" href="#home">Home</a></li>
  <li><a href="#news">Assignment</a></li>
  <li><a href="#contact">Result</a></li>
  <li><a href="#about">Feedback</a></li>
</ul>
</div>

<div style="margin-left:20%;padding:1px 16px;height:1000px;">
  <h2>Please Choose Lessons you want to Learn:</h2>
  <br>
    <div class="card">
        <div class="des">
        <p>Chapter 1</p>
        <div class="button"><a href="chapterPage1.php?languageID=<?php echo $languageID ?>">Study Now</a></div>
        </div>
    </div>

    <div class="card">
        <div class="des">
        <p>Chapter 2</p>
        <div class="button"><a href="chapterPage2.php?languageID=<?php echo $languageID ?>">Study Now</a></div>
        </div>
    </div>

    <div class="card">
        <div class="des">
        <p>Chapter 3</p>
        <div class="button"><a href="chapterPage3.php?languageID=<?php echo $languageID ?>">Study Now</a></div>
        </div>
    </div>
</div>

</body>
</html>


