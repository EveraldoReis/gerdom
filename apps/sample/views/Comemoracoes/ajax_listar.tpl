<?php 
$holidays_parsed = array();
foreach($holidays as $holiday){
    $holidays_parsed[$holiday->holiday_date] = $holiday;
}
echo json_encode($holidays_parsed); 
?>