Présentation du projet TagCloud.

# Introduction #

Cette page de wiki a pour ambition de vous présenter et de vous expliquer le fonctionnement de mon projet TagCloud. J'écrirai également quelques lignes sur les différents générateurs de TagCloud que j'ai pu déposer sur Delicious.

# Details #

Mon projet se divise en deux scripts.
L'un nommé "index.php" contient le formulaire de saisie de l'adresse RSS.
Tandis que l'autre "CreaTagcloud.php" contient le cœur de la génération du TagCloud. Nous détaillerons les fonctions un peu plus tard.

Une feuille de style CSS est attaché au tout pour une mise en page html propre.
Un fichier javascript "javascript.js" est également de la partie et regroupe les différentes fonctions du même langage que j'utilise dans mon code.

CreaTagcloud.php

---


Le script récupère l'adresse entré par l'internaute dans le champs de saisie. Le contenu de cette adresse est directement stocké dans une variable qui est transformée en objet XML grâce à la fonction "simplexml\_load\_file".

L'utilisation d'Xpath au sein du code php permet d'extraire les données issus des balises titre et description.

Ces chaines de caractères sont ensuite traitées. On leur applique notamment des fonctions de suppression de caractères html, d'encodage de caractères, de remplacement de caractères.

Il est ensuite important de fractionner ces chaînes en éléments séparés.
Deux fonctions entrent alors en jeu.

Les fonction "fractionner" et "filtrer1".
La fonction "fractionner" comme son nom l'indique fractionne les éléments en fonction d'éléments séparateur (espaces,;,. etc...).
La fonction "filtrer1" quand à elle filtre les mots et ne garde seulement ceux qui sont composés de plus de deux caractères afin d'éviter la répétition de mots tels que "le" "la" "ou". Il est à noter que les mots qui ne sont pas présents un minimum de 2 fois dans le contenu n'est pas affiché. Il n'est pas considérer comme étant un mots clé.
Tout cela est stocké dans un tableau.

Il convient ensuite de supprimer les doublons et de compter le nombre d'occurrence par mots.

Cela nous amène à l'affichage en svg.

A l'aide d'un "foreach", on parcours le tableau, à chaque tour de boucle un mot est envoyé dans un conteneur svg qui va permettre l'affichage. Cette affichage est régi par ses coordonnées qui sont soit aléatoires (on l'appellera le mode netart) soit rangés (les mots apparaissent les uns après les autres, on l'appellera le mode rangé), par sa taille qui est géré par le nombre d'occurrence du mot (plus le mot a d'occurrences plus il sera gros).

Ce qu'il reste à faire

---


Plusieurs modifications sont encore à apporter au générateur en lui même :

- Ajout de variations de couleurs dans les mots.
- Amélioration des coordonnées svg pour les éléments à l'affichage.
- Gestion d'une blacklist de mots.

Pour aller plus loin

---


- Créer une interface de personnalisation du TagCloud.