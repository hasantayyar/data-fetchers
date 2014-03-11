<?php
require __DIR__.'/../libs/Process.php';
require __DIR__.'/../libs/ganon.php';
$base = "http://www.alexa.com/siteinfo/";

if(!isset($argv[1])){
	die('missing arg');
}
$link = $argv[1];
echo "processing ".$link."\n";
if(empty($link )){ echo "missing arg"; exit(0); }

fetch($link,$base);

function fetch($link,$base){
	$link = $base.$link;
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
	$html = file_get_dom($link);
	if(!empty($html)){
		$country_data = $html('a[href^="/topsites/countries/"]',0);
		print_r($country_data->getPlainText());
		//$elements = $html('table a');
		//$db->poems->insert(array('link'=>$sublink));
	}
}
