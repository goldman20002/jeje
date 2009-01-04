<?php
function html() {
	return <<< EOF
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta http-equiv="content-language" content="fr,en" />
	<title>TagCloud</title>
	</head>
	<body>
	<form name="tagcloud" action="CreaTagcloud.php" method="post" enctype="application/x-www-form-urlencoded">
	<table border="0" cellspacing="2" cellpadding="3" width="230px" height="200px">
	<tr>
	<td><p class="titre">Veuillez entrer un flux RSS :</p>
	<span><input class="input" name="lien" type="text"/></span>
	</td>
	<tr>
	<td class="bloc"><input type="submit" class="form-button" name="envoyer" value="Envoyer"></td>
	</tr>
	</table>
	</form>
	</body>
	<html>
EOF;
}

echo html();
?>