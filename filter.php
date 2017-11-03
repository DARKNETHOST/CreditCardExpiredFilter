<?php
/*
Credit Card Expiration Filter
DARKNETHOST TEAM
September 2017
*/

set_time_limit(0);
$file = "data.txt";
$list =  preg_split('/\n|\r\n?/', file_get_contents(getcwd() . "/" . $file));

foreach($list as $cc){
  $expired = explode("|", $cc)[1];
  $month = substr($expired, 0, 2);
  $year = substr($expired, -2);
  
  $expires = \DateTime::createFromFormat('my', $month . $year);
  $now     = new \DateTime();

if ($expires < $now) {
    saveData($cc, 'cc-mati');
}else{
	saveData($cc, 'cc-urip');
}
}

function saveData($data, $nama){
  $myfile = fopen($nama . '.txt', 'a') or die("Unable to open file!");
  fwrite($myfile, $data . "\r\n");
  fclose($myfile);
}

?>
