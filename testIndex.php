<?php
   include 'connect.php';
   $visitor =  $_SESSION['visitorID'];
   $languageID = $_GET['id'];
?>

<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Home Page</title>
      <link rel="stylesheet" href="mainStyle.css">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>

      <nav class="sidebar">
         <div class="text">
            Side Menu
         </div>
         <ul>
            <li class="active"><a href="#">Home</a></li>
         <!--
            <li>
               <a href="#" class="feat-btn">Chapter
               <span class="fas fa-caret-down first"></span>
               </a>
               <ul class="feat-show">
                  <li><a href="#">Chapter 1</a></li>
                  <li><a href="#">Chapter 2</a></li>
                  <li><a href="#">Chapter 3</a></li>
               </ul>
            </li>
         -->
            <li>
               <a href="#" class="serv-btn">Assignment
               <span class="fas fa-caret-down second"></span>
               </a>
               <ul class="serv-show">
                  <li><a href="#">Quiz 1</a></li>
                  <li><a href="#">Quiz 2</a></li>
                  <li><a href="#">Test</a></li>
               </ul>
            </li>
            <li><a href="#">Result</a></li>
            <li><a href="#">Feedback</a></li>
            
            <!--
            <li><a href="#">Shortcuts</a></li>
            <li><a href="#">Feedback</a></li>
            -->
         </ul>
      </nav>
      <div class="content">
         <div class="header">
            Learn Numbers Lessons
         </div>
         <p>
            Please choose your Lessons:
         </p>
                  <div class="card">
                     <div class="des">
                     <p>Chapter 1</p>
                     <div class="button"><a href="chapterPage.php?languageID=<?php echo $languageID ?>">Study Now</a></div>
                     </div>
                  </div>

                  <div class="card">
                     <div class="des">
                     <p>Chapter 2</p>
                     <div class="button"><a href="chapterPage.php?languageID=<?php echo $languageID ?>">Study Now</a></div>
                     </div>
                  </div>

                  <div class="card">
                     <div class="des">
                     <p>Chapter 3</p>
                     <div class="button"><a href="chapterPage.php?languageID=<?php echo $languageID ?>">Study Now</a></div>
                     </div>
                  </div>
      </div>



      
      <script>
           $('.feat-btn').click(function(){
             $('nav ul .feat-show').toggleClass("show");
             $('nav ul .first').toggleClass("rotate");
           });
           $('.serv-btn').click(function(){
             $('nav ul .serv-show').toggleClass("show1");
             $('nav ul .second').toggleClass("rotate");
           });
           $('nav ul li').click(function(){
             $(this).addClass("active").siblings().removeClass("active");
           });
      </script>
   </body>
</html>