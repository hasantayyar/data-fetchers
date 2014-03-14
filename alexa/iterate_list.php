<?php
$list_str = file_get_contents("top.tmp.csv");
$array_list = str_getcsv($list_str,"\n");

foreach($array_list as $site){
	echo  "getting ".$site."\n ";
	try
        {
            $m = new Mongo(); // connect
            $db = $m->selectDB("alexa");
        }
        catch ( MongoConnectionException $e )
        {
            echo 'db error';
            exit();
        }

	$data = exec("php fetch.php ".$site);
	$data_array = explode("--",$data);
	print_r($data_array);
	if($data_array){
		$score = $data_array[0];
		$country = $data_array[1];
		echo $country."\t".$score."\n";
		$db->site->insert(array("site"=>str_replace('\t',"",trim($site)),"country"=>$country,"score"=>$score));
	}
}
