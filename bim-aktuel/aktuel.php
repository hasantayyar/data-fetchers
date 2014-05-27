<?php
require __DIR__.'/../libs/Process.php';
require __DIR__.'/../libs/ganon.php';
	$link = "http://www.bim.com.tr/Categories/100/aktuel_urunler.aspx";
	$html = file_get_dom($link);
	if(!empty($html)){
		foreach($html('td[class="kaktuel-tablo2-icerik2"]') as $p){
			$a = $p('span[class="au-tablo10-baslik1"] a',0);
			$items[] = $a->getInnerText();			
		}

		foreach($html('td[class="kaktuel-tablo2-icerik2"]') as $p){
			$a =  $p('td[class="fiyat3-tablo1-fiyat2"] div',0);
			$prices[] = $a->getInnerText();			
		}

		foreach($html('td[class="kaktuel-tablo2-icerik2"]') as $p){
			$a = $p('td[class="fiyat3-tablo1-kurus2"] div',0);
			$pricesFraction[] = $a->getInnerText();			
		}
	
	}



echo "Bilgi : ".$link."\n\n";

for($i=0;$i<count($items);++$i){
	echo $items[$i]."\t\t".$prices[$i].$pricesFraction[$i]."\n";
}
