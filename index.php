<?php
session_start();
if($_SESSION['username']='monoprix'){
  header('location:page.php');
}else{
if (isset($_POST['save'])) { // if save button on the form is clicked
   
    //more info
    $username =htmlspecialchars($_POST["username"]);
    $password =htmlspecialchars($_POST["password"]);
    
  if($username == 'monoprix' && $password == 'supcom'){
        $_SESSION['username']=$username;
        header('location:page.php');
    }
    
      
}  
            
}
?>


<!DOCTYPE html>
<html lang="en"><head>
    <meta http-equiv="Content-Type"  charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="project tuto with monoprix">
    <meta name="author" content="lamjed gaidi mohaned abid">
    <link rel="icon" href="img/lm.ico" type="image/x-icon">
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Dashboard for monoprix</title>
    <link rel="stylesheet" href="css/main.css">

  <body >
  <div class="signLogDiv">
  <form  action="index.php" method="post" enctype="multipart/form-data">
		
		<div class="form-group">
			<input type="text" name="username" class="form-control" id="" placeholder="username" required>
		</div>
		<div class="form-group">
			<input type="password" name="password" class="form-control" id="" placeholder="your password" required>
		</div>
		<button type="submit" name="save" class="btn btn-secondary">Submit</button>
    </form>
    </div>
 </body>
</html>