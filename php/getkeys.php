<?php

if (file_exists('brocode.xml')) {
    $xml = simplexml_load_file('brocode.xml');
	/*foreach($xml->article as $art) {
		echo $art["keys"]."<br/>";
	}*/
	
	$keys = $xml->xpath('/brocode/article/@keys');
	foreach($keys as $k) {
		$arrK = split(",",$k);
		foreach ($arrK as $K){
			echo $K."<br/>";
		}
	}
   // print_r($xml);
} else {
    exit('Echec lors de l\'ouverture du fichier brocode.xml.');
}

?>