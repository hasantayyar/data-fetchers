<?php
require __DIR__.'/../libs/Process.php';
require __DIR__.'/../libs/ganon.php';
$base = "http://www.alexa.com/siteinfo/";

if(!isset($argv[1])){
	die('missing arg');
}
$link = $argv[1];
if(empty($link )){ echo "missing arg"; exit(0); }

fetch($link,$base);
function fetch($link,$base){
	$link = $base.$link;
	$html = file_get_dom($link);
	if(!empty($html)){
		$country_data = $html('a[href^="/topsites/countries/"]',0);
		$score = "";
		$score_data = $html('strong[class^="metricsUrl"]',0);
		if($country_data) {
			$score =!empty($score_data) ? str_replace(",","",$score_data->getPlainText()):NULL;
			echo $score."--".$country_data->getPlainText();
		 }
	}
}
