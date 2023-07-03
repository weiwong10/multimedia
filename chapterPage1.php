<?php
  session_start();
  $visitor =  $_SESSION['visitorID'];
  $languageID = $_GET['languageID'];
  include "connect.php";
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Side Navigation Bar</title>
	<link rel="stylesheet" href="chapterPage.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://kit.fontawesome.com/805d306191.js" crossorigin="anonymous"></script>
   
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

        <h1 class="heading">Lesson 1 (0 - 10)</h1>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
                $sql = "SELECT * FROM content WHERE languageid = '$languageID' LIMIT 11;";
                $result1 = mysqli_query($conn,$sql) or die(mysqli_error($conn));

                while ( $row = mysqli_fetch_assoc($result1)){

                    $imgsql = "SELECT IMAGE from content_image c, image i WHERE c.IMAGEID = i.IMAGEID AND CONTENTID = '" . $row['CONTENTID'] . "'";
                    $imgresult = mysqli_query($conn,$imgsql) or die(mysqli_error($conn));
                    $img = mysqli_fetch_assoc($imgresult);
            ?>

        <!----->
        
            <div class="col">
                <div class="card h-100">
                    <div class = "images">
                    <?php 
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($img['IMAGE']).'" class="card-img-top" style="width: 100%; height: 100%; object-fit: contain;"/>';
                    ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-center fs-2"><?php echo $row['CONTENTNAME']?></h5>
                        <p class="card-text fw-bold text-center fs-2"><?php echo $row['DESCRIPTION']?></p>
                    </div>
                    <div class="card-footer">
   
                        <?php
                            $sqlAudio = "SELECT * FROM audio WHERE CONTENTID = '" . $row['CONTENTID'] . "' ";
                            $resultAudio = mysqli_query($conn, $sqlAudio) or die(mysqli_error($conn));;

                            $audio = mysqli_fetch_assoc($resultAudio);

                        ?>

                        <audio controls>
                            <source src="<?php echo $audio['PATHFILE']?>"  type="audio/mpeg">
                        </audio>  
                    <!--
                            $sql = "SELECT AUDIO FROM audio WHERE contentid = '" . $row['CONTENTID'] . "' ";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // Fetch the result and store it in a variable
                                $row = mysqli_fetch_assoc($result);

                                // Output the MP3 file to the browser
                                header('Content-type: audio/mpeg');
                                echo $row['AUDIO'];

                                // Exit the script to prevent additional data from being sent
                                exit;
                            } else {
                                echo "No MP3 file found.";
                            }
                        <small class="text-muted">Last updated 3 mins ago</small>
                    -->
                    </div>
                </div>
            </div>
        

        <!----->

            <?php
                }
            ?>
        </div>

        <!----->

        <div class="card text-center" >
            <div class="card-header">
                Also Watch This Video:
            </div>
            <div class="card-body">
                <?php
                  $sqlVideo = "SELECT * FROM video WHERE LANGUAGEID = '" .$languageID. "' ";
                  $resultVideo = mysqli_query($conn, $sqlVideo) or die(mysqli_error($conn));;

                  $video = mysqli_fetch_assoc($resultVideo);                
                ?>

                <video controls src="<?php echo $video["PATHFILE"]?>" width="100%" height="auto"></video>
            </div>
            <div class="card-footer text-body-secondary">
                <!--2 days ago-->
            </div>
        </div>

        <!----->
        <!--
                $sql = "SELECT VIDEO FROM video WHERE LANGUAGEID ='$languageID' AND VIDEONAME='Chinese01'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

                // Output video
                header("Content-type: video/mp4");
                echo $row['VIDEO'];

        -->
        </div>

    </div>

   
</div>

</body>
</html>