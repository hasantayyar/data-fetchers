<?php
$list_str = file_get_contents("top-1m.csv");
$array_list = str_getcsv($list_str,"\n");

foreach($array_list as $site){
	echo  "getting ".$site." ";
	$country = exec("php fetch.php ".$site);
	echo $country."\n";
}
