<?php
// connect to the database
include "db.php";


$shop_id = mysqli_real_escape_string($con,$_POST["input1"]);
$item_id = mysqli_real_escape_string($con,$_POST["input2"]);
$id_struct = mysqli_real_escape_string($con,$_POST["input3"]);
$category_id = mysqli_real_escape_string($con,$_POST["input4"]);
$starting_day = mysqli_real_escape_string($con,$_POST["input5"]);
$period = mysqli_real_escape_string($con,$_POST["input6"]);
$firstDate = date('Y-m-d',strtotime($starting_day));
$date = date_create($firstDate);
switch ($period) {
    case "1":
        
     date_add($date, date_interval_create_from_date_string('7 days'));
     $secondDate = date_format($date, 'Y-m-d');
      break;
    case "2":
        date_add($date, date_interval_create_from_date_string('14 days'));
        $secondDate = date_format($date, 'Y-m-d');
      break;
    case "3":
        date_add($date, date_interval_create_from_date_string('21 days'));
        $secondDate = date_format($date, 'Y-m-d');
      break;
    default:
       date_add($date, date_interval_create_from_date_string('28 days'));
       $secondDate = date_format($date, 'Y-m-d');
       break;
  }
//------------------------------------------------------------------------------
/*
$sql = "INSERT INTO data 
(Date, shop_id, item_id, item_category, id_struct, Price, item_cnt_day ) 
VALUES (?,?,?,?,?,?,?)";
   */
$sql = "select * from data where  shop_id ='$shop_id' AND item_id='$item_id' AND item_category='$category_id' AND id_struct='$id_struct' AND Date between '$firstDate' AND '$secondDate' ";
$result = mysqli_query($conn, $sql);
$mydata = array();
$i = 0;

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
           
           $mydata[$i]['x'] = strtotime($row["Date"]) * 1000;
           $mydata[$i]['y'] = $row["item_cnt_day"]*1;
           $i++;
    }
            $obj = (object) $mydata;
            echo json_encode($obj) ;
    
 } else {
  echo "errors";
 }
 mysqli_close($conn)
/*
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt,$sql);
mysqli_stmt_execute($stmt);
                 if(!mysqli_stmt_prepare($stmt,$sql)){
                     echo 'ko';
                 }else{
                 mysqli_stmt_bind_param($stmt,"sdddddd",$insert_data[':Date'],$insert_data[':shop_id'],$insert_data[':item_id'],$insert_data[':item_category'],$insert_data[':id_struct'],$insert_data[':Price'],$insert_data[':item_cnt_day']);

                 if (mysqli_stmt_execute($stmt)) {
                     echo "line  ".$i." uploaded successfully</br>";
              
//---------------------------------------------------------------------------*/      
  


?>