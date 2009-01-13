<?php
function html() {
	return <<< EOF
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta http-equiv="content-language" content="fr,en" />
	<link href="tagcloud.css" rel="stylesheet" type="text/css" />
	<title>TagCloud</title>
	</head>
	<body>
	<div id="header">
	<div id="logo"></div>
	</div>
	<div id="ligne"></div>
	<div id="conteneur">	
	<form name="tagcloud" action="CreaTagcloud.php" method="post" enctype="application/x-www-form-urlencoded">
	<table>
	<tr>
	<td><p class="titre">Veuillez entrer un flux RSS :</p>
	<span><input class="input" name="lien" type="text"/></span>
	</td>
	<tr>
	<td class="bloc"><input type="submit" class="form-button" name="envoyer" value="Envoyer"></td>
	</tr>
	</table>
	</form>
	</div>
	<div id="contenu">
	<p>TagCloud RSS</p>
	</div>
	<div id='footer'></div>
	</body>
	<html>
EOF;
}

echo html();
?>