<?php
///

echo ("<?xml version='1.0' encoding='UTF-8'?>");

function CreaEnfant ($id=0, $niv=0) {
	
	$gen="";
	$nbEnfant = rand(2,4);
	$gen .= "<parent id='".$id."_".$niv."' >";
	for($i=0;$i<$nbEnfant;$i++){
		$gen .= "<enfant id='".$id."_".$niv."' />";
		if ($niv < 3) {
			$gen .= CreaEnfant($i, $niv+1);
		}	
		//$gen .= "</enfant>";
	}
	$gen .= "</parent>";	
	return $gen;
		
}

$xml = "<gen>";
$xml .= CreaEnfant();
$xml .= "</gen>";
$oXml = simplexml_load_string($xml);
echo $oXml;
?>