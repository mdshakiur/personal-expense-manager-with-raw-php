<?php
$current_date = date("Y-m-d");

$date1=date_create("2013-03-15");
$date2=date_create("$current_date");
$diff=date_diff($date1,$date2);
echo $diff = $diff->format("%R%a");
echo"<br>";
echo $diff = (int)$diff;


?>
