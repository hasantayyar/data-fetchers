<?php
require 'config.php';
if(!isset($argv[1])){
	die('missing arg');
}
$link = $argv[1];
echo "processing ".$link."\n";
if(empty($link )){die('empty arg');}

fetch($link,$base);

function fetch($link,$base){
	try 
	{
	    $m = new Mongo(); // connect
	    $db = $m->selectDB("poems");
	}
	catch ( MongoConnectionException $e ) 
	{
	    echo 'db error';
	    exit();
	}
	$html = file_get_dom($link);
	if(!empty($html)){
		// get next page
		$next = $html('a[title="Sonraki Sayfa"]',0);
		$next_page = count($next)>=1?$base.$next->href:null;
		$elements = $html('table a');
		foreach($elements as $element){
		  if(stristr($element->href,'-siiri/')){
		  	$sublink = $base.$element->href;
		  	echo "insert ".$sublink."\n";
			$db->poems->insert(array('link'=>$sublink));
		  } 
		}
		if($next_page){
			echo "next page : ".$next_page."\n";
			fetch($next_page,$base);
		}
	}
}
