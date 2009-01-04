<?php

header("Content-type: image/svg+xml");
echo '<?xml version="1.0" encoding="UTF-8"?>';

/***********FONCTIONS********************/
//html 
function html() {
	return <<< EOF
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta http-equiv="content-language" content="fr,en" />
	<title>TagCloud</title>
	<style type="text/css">
	
	body {
		background:#000;
	}
	
	#tagcloud {
		width:600px;
		height:600px;
		margin-left:auto;
		margin-right:auto;
	}
	</style>
	
	</head>
	<body>	
EOF;
}

echo html();
function html_fin() {
	return <<< EOF
	</div>
	</body>
	</html>
EOF;
}

//fractionnement de la chaine en éléments
function fractionner($separateur,$chaine)
{
	$tab =array();
	$elem = strtok($chaine,$separateur);
	$tab[]=$elem;
	while($elem)
	{
		$elem = strtok($separateur);
		$tab[]=$elem;
	}
	return $tab;
}

//Affichage tableau
function print_tab($tab)
{
	foreach($tab as $indice => $valeur)
	{
		echo "[$indice] -> $valeur <br />";
	}
}

//filtre une liste d'éléments de 2 caractères
function filtrer1($tableau_elements)
{
	$tab = array();
	foreach($tableau_elements as $mot) 
	{
		//strlen calcule la taille d'une chaine
		if(strlen($mot)>=2) $tab[] = $mot;
	}
	return $tab;
	
}
/***********FONCTIONS********************/

///
//Récuperation du flux RSS de http://www.metalorgie.com
//$xml = simplexml_load_file('http://www.metalorgie.com/metal/rss.php');
$xml = simplexml_load_file($_POST['lien']);
//FREE bloque les appels externe, j'ai donc récuperer dans un fichier que je met sur le serveur, le contenu du RSS
//$xml = simplexml_load_file('metalorgie.xml');

//Je ne prend que les titres des news, elles reprï¿½sentent en faite le contenu
//Je parse les éléments du flux RSS
$titre="";
// 1 Lecture de la source
foreach($xml->xpath('//item') as $item)
	{
	$titre.=$item->title;
	$titre.=$item->description;
	}
	
//2 Mettre en miniscule
//$minuscule = strtolower($titre);

//3 fractionnement de la chaine en éléments
//$tableau_elements = explode(" ", $minuscule);
$separateur =" .; :!? ,- –—«»/’…()[]\n\t\r\x";
$pieces = str_replace("&nbsp;", " ", $titre);
$pieces = str_replace("&nbsp;", " ", $titre);
$tableau_elements = fractionner($separateur,$pieces);

// Filtrage des éléments
//On considère qu'un mot de plus de 2 caractères est intéressant.

$tableau_elements_filtrer = filtrer1($tableau_elements);

//Suppression des doublons
$nb=count($tableau_elements_filtrer);

//Compte le nombre de doublons par mot	
$counts = array_count_values($tableau_elements_filtrer);
//Dï¿½doublonne un tableau
$result = array_unique($tableau_elements_filtrer);

//Affichage
echo '<div id="tagcloud">';
echo '<svg width="20cm" height="20cm" viewBox="0 0 1024 768" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
';
foreach ($counts as $nom => $valeurs) {
	$chiffre = $valeurs*"8";
	$x = rand(0, 800);
	$y = rand(0, 600);
	echo'<g font-family="Verdana" font-size="'.$chiffre.'" >
	<text x="'.$x.'" y="'.$y.'" fill="blue" >'.$nom.'</text>
	</g>'; 
}

echo '</svg>';
echo html_fin();
?>