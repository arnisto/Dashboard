<?php
$date = date_create('2000-01-01');
echo $date ;
echo '</br>' ;
date_add($date, date_interval_create_from_date_string('35 days'));
echo date_format($date, 'Y-m-d');
//_________________________test
?>