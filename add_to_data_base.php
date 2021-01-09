<?php
// connect to the database
include "db.php";
//import.php

include 'vendor/autoload.php';

if($_FILES["myfile"]["name"])
{
    echo 'File detected</br>';
 $allowed_extension = array('xls', 'csv', 'xlsx');
 $file_array = explode(".", $_FILES["myfile"]["name"]);
 $file_extension = end($file_array);
echo 'File extension is : '.$file_extension."</br>";
 if(in_array($file_extension, $allowed_extension))
 {
  $file_name = time() . '.' . $file_extension;
  move_uploaded_file($_FILES['myfile']['tmp_name'], $file_name);
  $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
  $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

  $spreadsheet = $reader->load($file_name);

  unlink($file_name);

  $data = $spreadsheet->getActiveSheet()->toArray();
  echo 'File size is (number of lines) : '.sizeof($data)."</br>";
  for($i=1 ;$i<sizeof($data);$i++)
  {
   $insert_data = array(
    ':Date'  => date('Y-m-d',strtotime($data[$i][0])),
    ':shop_id'  => $data[$i][1],
    ':item_id'  => $data[$i][2],
    ':item_category'  => $data[$i][3],
    ':id_struct'  => $data[$i][4],
    ':Price'  => $data[$i][5],
    ':item_cnt_day'  => $data[$i][6]
    
   );
/*
print_r($insert_data); 
echo '</br>';
}}} 

echo sizeof($data);
}}
*/
   $sql = "INSERT INTO data 
   (Date, shop_id, item_id, item_category, id_struct, Price, item_cnt_day ) 
   VALUES (?,?,?,?,?,?,?)";
   
   $stmt = mysqli_stmt_init($conn);
   
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        echo 'ko';
                    }else{
                    mysqli_stmt_bind_param($stmt,"sdddddd",$insert_data[':Date'],$insert_data[':shop_id'],$insert_data[':item_id'],$insert_data[':item_category'],$insert_data[':id_struct'],$insert_data[':Price'],$insert_data[':item_cnt_day']);

                    if (mysqli_stmt_execute($stmt)) {
                        echo "line  ".$i." uploaded successfully</br>";
                    
                    
                    }else {
                        echo 'erreur';

                    } 
                    }
  }
  $message = '<div class="alert alert-success">Data Imported Successfully</div>';

 }
 else
 {
  $message = '<div class="alert alert-danger">Only .xls .csv or .xlsx file allowed</div>';
 }
}
else
{
 $message = '<div class="alert alert-danger">Please Select File</div>';
}

echo $message;
echo "<a href='page.php'>go back</a>";
?>



