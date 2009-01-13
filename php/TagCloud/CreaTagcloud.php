<?php

header("Content-type: image/svg+xml");
echo '<?xml version="1.0" encoding="utf-8"?>';

/***********FONCTIONS********************/
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
		if(strlen($mot)>2) $tab[] = $mot;
	}
	return $tab;
	
}

/***********FONCTIONS********************/

///
$xml = simplexml_load_file($_POST['lien']);
//FREE bloque les appels externe, j'ai donc récuperer dans un fichier que je met sur le serveur, le contenu du RSS
//$xml = simplexml_load_file('metalorgie.xml');

//Je parse les éléments du flux RSS
$titre="";
// Lecture de la source
foreach($xml->xpath('//item') as $item)
	{
	$titre.=$item->title;
	$titre.=$item->description;
	}
	
//$minuscule = strtolower($titre);

//Suppression des balises html, encodage des caractères,
$rss = strip_tags($titre);
$rss = utf8_decode($rss);
$rss = preg_replace('#[[:punct:]]#', " ",$rss);
$rss = utf8_encode($rss);
//$tableau_elements = explode(" ", $minuscule);
$accent = str_replace("com"," ",$rss);
$quot = str_replace("&quot"," ",$accent);
$amp = str_replace("&amp"," ",$quot);
$pieces = str_replace("&nbsp;", " ", $amp);
//Fractionnement de la chaine en éléments
$separateur =" .; :!? ,- –—«»/|’…()[]\n\t\r";
$tableau_elements = fractionner($separateur,$pieces);

// Filtrage des éléments
//On considère qu'un mot de plus de 2 caractères est intéressant.
$tableau_elements_filtrer = filtrer1($tableau_elements);

//Suppression des doublons
$nb=count($tableau_elements_filtrer);

//Compte le nombre de doublons par mot	
$counts = array_count_values($tableau_elements_filtrer);
//Dédoublonne un tableau
$result = array_unique($tableau_elements_filtrer);

//Affichage
echo '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">';
echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="svg" onload="f_initialisation();">';
echo '<title>Tagcloud</title>';
echo '<script type="text/javascript">
function f_initialisation() {
	var screen_x = screen.availWidth;
	var screen_y = screen.availHeight;
	var div = document.getElementById("svg");
	div.setAttribute("width",screen_x+"px");
	div.setAttribute("height",screen_y+"px");
}	
</script>';
echo '<g>';
$x=0;
$y=20;
foreach ($counts as $nom => $valeurs) {
	if ($valeurs>=2) {
	$chiffre = $valeurs+12;
	//Méthode de placement aléatoire
	/*$x = rand(0, 800);
	$y = rand(0, 600);*/
	//Méthode de placement classé
	$taille_mots=strlen($nom)*$chiffre;
	if ($x>1000){
	$y+=$chiffre+10;
	$x=0;
	}
	$x += $taille_mots+50;
	echo'<g font-family="Arial" font-size="'.$chiffre.'pt" >
	<text x="'.$x.'" y="'.$y.'" fill="blue" >'.$nom.'</text>
	</g>'; 
	}
}
echo '</g>';
echo '</svg>';

?>