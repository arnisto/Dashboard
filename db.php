<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'monoprix');
$con = mysqli_connect('127.0.0.1', 'root', '', 'monoprix');
mysqli_set_charset($conn,"utf8");
mysqli_set_charset($con,"utf8");
if(!$conn){
    die ("connection failed:".mysqli_connect_error($conn));
}
if(!$con){
    die ("connection failed:".mysqli_connect_error($con));
}
?>