<?php
//ini_set('allow_url_fopen', On);
header("Content-type: image/svg+xml");
echo '<?xml version="1.0" encoding="UTF-8"?>
<svg width="30cm" height="20cm" viewBox="0 0 1024 768" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
'; 
///
//Récuperation du flux RSS de http://www.metalorgie.com
$xml = simplexml_load_file('http://www.metalorgie.com/metal/rss.php');

/*function html() {
	return <<< EOF
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Document sans nom</title>
		</head>
EOF;
}
echo html();*/

//Je ne prend que les titres des news, elles représentent en faite le contenu
//Je parse les éléments du flux RSS
$titre="";
foreach($xml->xpath('//item') as $item)
	{
	$titre.=$item->title;
	}

	$base = explode(" ", $titre);
	$pieces = str_replace("&nbsp;", "", $base);
	$nb=count($pieces);
	
	$counts = array_count_values($pieces);
	$result = array_unique($pieces);
		
	foreach ($counts as $nom => $valeurs) {
	$chiffre = $valeurs+"9";
	$x = rand(0, 1000);
	$y = rand(0, 600);
	echo'<g font-family="Verdana" font-size="'.$chiffre.'" >
	<text x="'.$x.'" y="'.$y.'" fill="blue" >'.$nom.'</text>
	</g>'; 
	}

echo '</svg>';




?>