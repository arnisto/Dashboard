<?php
session_start();
if (!isset($_SESSION['username'])){
    header('location:index.php');
}else{
 
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

  <body >
  <h1>LIST OF ERRORS YOU MAY MAKE</h1>
   <h2>FIRST OF ALL / FILL ALL THE INPUTS PLEASE</h2>
   <ol type="i">
        <li><b>shop_id :</b> should be a number</li>
        <li>item_id : should be a number</li>
        <li>id_struc : should be a number</li>
        <li>category_id : should be a number</li>
        <li>starting day : should be a string inder this forma : DD/MM/YY example : 01/01/2018</li>
        <li>period : just shoose a value</li>
   </ol>
 </body>
</html>


<?php } ?>