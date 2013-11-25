<?php
require 'config.php';
$activejobs = array();

$html = file_get_dom($start_url);
if(!empty($html)){
  $elements = $html('table a');
  foreach($elements as $element){
      if(stristr($element->href,'/siirleri/')){
      	 $link = $base.$element->href;
      	 while(!check($activejobs)){ echo "wait too much jobs\n";sleep(15);}
      	 get_page($link,$activejobs);
      } 
  }
}


function get_page($link,&$activejobs){
	
	echo 'get = '.$link;
	$process = new Process("php ".__DIR__.'/fetch.php '.$link);
	echo ' pid : ' .$process->getPid();
	echo "\n";
	$activejobs[] = $process;
	
}

function check(&$activejobs){
	$maxjobs = 3;
	for($i=0;$i<count($activejobs);$i++){
		if(isset($activejobs[$i])){
			$job = $activejobs[$i];
			if(!$job->status()){
				unset($activejobs[$i]);
			}
		}
	}
	$activejobs = array_values($activejobs); // reindex
	return !(count($activejobs)>$maxjobs);
}
