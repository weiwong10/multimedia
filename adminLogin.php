<?php
  include 'connect.php';
  session_start();

if(isset($_POST['btn_login']))
{
	function test_input($data) 
  {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }
	
		//Getting Post Values
		$visitorID = test_input($_POST['VISITORID']);

        if($visitorID == 1){
            $sql ="SELECT * FROM VISITOR WHERE VISITORID = '".$visitorID."' ";

            $result = mysqli_query($conn,$sql);
        
            if(mysqli_num_rows($result) > 0)
            {
                $row = mysqli_fetch_assoc($result);

                $_SESSION['visitorID'] = $row['VISITORID'];
                $_SESSION['visitorName'] = $row['VISITORNAME'];
                $_SESSION['organization'] = $row['ORGANIZATION'];
                $_SESSION['state'] = $row['STATE'];
                $_SESSION['IC'] = $row['IC'];
                $_SESSION['visitDate'] = $row['VISITDATE'];
                
                echo "<script>alert('Login Success!');</script>";
                echo"<meta http-equiv='refresh' content='0; url=adminMain.php'/>";
            }
        else
            {
                echo "<script>alert('Login Failure!');</script>";
                echo"<meta http-equiv='refresh' content='0; url=adminLogin.php'/>";
            }
    }else{
        echo "<script>alert('Login Failure!');</script>";
        echo"<meta http-equiv='refresh' content='0; url=adminLogin.php'/>"; 
    }
}
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<title>Admin Page</title>
</head>
<body>
	<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="#home" class="w3-bar-item w3-button"><b>Language Learning</b> (Numbers)</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
	<a href="index.php" class="w3-bar-item w3-button">Return</a>

    <!--  
	  <a href="#projects" class="w3-bar-item w3-button">Content</a>
      <a href="#about" class="w3-bar-item w3-button">About</a>
      <a href="#contact" class="w3-bar-item w3-button">Logout</a>
	-->
	</div>
  </div>
</div>
	
	<div class="container">
		
    <form action="" method="POST" class="login-email">
		
      <p align="center" class="login-text" style="font-size: 2rem; font-weight: 800;">Admin Login</p><br>
      

        <div class="input-group">
		  <label for="VISITORID">&nbsp;&nbsp; Admin ID :</label> <br><br>
          <input type="text" name="VISITORID"  placeholder="VisitorID" autofocus required/>
        </div>
		
		
		<br><br>
		
		<div class="input-group">
          <button name="btn_login" class="btn">Log in</button>
        </div>
		
	</form>		
	</div>
	
</body>
</html>