<?php
/* ===============
  INITIALISATION
=============== */
 
/* Démarrage d'une session qui va nous permettre de stocker la valeur à recopier. */
session_start(); // session_start() se place toujours avant toute sortie vers la page web
 
/* Chemin absolu vers le dossier */
if ( !defined('ABSPATH') ) define('ABSPATH', dirname(__FILE__) . '/');
 
/*
Création d'une fonction pour générer la chaîne aléatoire à recopier (sans cryptage) :
- strlen() retourne la taille de la chaine en paramètre
- mt_rand(a, b) génère un nombre aléatoire entre a et b compris : cette fonction est plus rapide que rand() de la bibliothèque standard
- $chars{0} retourne le premier caractère de la chaîne $chars, $chars{1} le deuxième ...
*/
function getCode($length) {
  $chars = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ'; // Certains caractères ont été enlevés car ils prêtent à confusion
  $rand_str = '';
  for ($i=0; $i<$length; $i++) {
    $rand_str .= $chars{ mt_rand( 0, strlen($chars)-1 ) };
  }
  return $rand_str;
}
 
/* Stockage de la chaîne aléatoire de 5 caractères obtenue */
$theCode = getCode(5);
 
/* Cryptage de la chaine avec md5() avant de la stocker dans la variable de session $_SESSION['captcha'] de la session en cours.
C'est à cette variable qu'on va comparer le code entré par l'utilsateur dans le formulaire. */
$_SESSION['captcha'] = md5($theCode);
 
/* Afin de traiter les caractères séparément, on les stocke un par un dans des variables. */
$char1 = substr($theCode,0,1);
$char2 = substr($theCode,1,1);
$char3 = substr($theCode,2,1);
$char4 = substr($theCode,3,1);
$char5 = substr($theCode,4,1);
 
/*
glob() retourne un tableau répertoriant les fichiers du dossier 'fonts', ayant l'extension .ttf ( pas .TTF ! ).
Vous pouvez donc ajouter autant de polices TrueType que vous désirez, en veillant à les renommer.
*/
$fonts = glob('fonts/*.ttf');
 
 
/* ====================
  TRAITEMENT DE L'IMAGE
==================== */
 
/*
imagecreatefrompng() crée une nouvelle image à partir d'un fichier PNG.
Cette nouvelle $image va être ensuite modifiée avant l'affichage.
 */
$image = imagecreatefrompng('captcha.png');
 
/*
imagecolorallocate() retourne un identifiant de couleur.
On définit les couleurs RVB qu'on va utiliser pour nos polices et on les stocke dans le tableau $colors[].
Vous pouvez ajouter autant de couleurs que vous voulez.
*/
$colors=array (	imagecolorallocate($image, 131,154,255),
                imagecolorallocate($image,  89,186,255),
                imagecolorallocate($image, 155,190,214),
                imagecolorallocate($image, 255,128,234),
                imagecolorallocate($image, 255,123,123) );
 
/* Création d'une petite fonction qui retourne une VALEUR aléatoire du tableau reçu en paramètre. */
function random($tab) {
  return $tab[array_rand($tab)];
}
 
/*
Mise en forme de chacun des caractères et placement sur l'image.
imagettftext(image, taille police, inclinaison, coordonnée X, coordonnée Y, couleur, police, texte) écrit le texte sur l'image.
*/
imagettftext($image, 28, -10,   0, 37, random($colors), ABSPATH .'/'. random($fonts), $char1);
imagettftext($image, 28,  20,  37, 37, random($colors), ABSPATH .'/'. random($fonts), $char2);
imagettftext($image, 28, -35,  55, 37, random($colors), ABSPATH .'/'. random($fonts), $char3);
imagettftext($image, 28,  25, 100, 37, random($colors), ABSPATH .'/'. random($fonts), $char4);
imagettftext($image, 28, -15, 120, 37, random($colors), ABSPATH .'/'. random($fonts), $char5);
 
 
/* =========================
  FIN => ENVOI DE L'IMAGE
========================= */
 
/*
Comme c'est le fichier captcha.php et non captcha.png qui va être appelé,
on envoie un en-tête HTTP au navigateur via header() pour lui indiquer
que captcha.php est bien une image au format PNG.
*/
header('Content-Type: image/png');
 
/* .. et on envoie notre image PNG au navigateur. */
imagepng($image);
 
/* L'image ayant été envoyée, on libère toute la mémoire qui lui est associée via imagedestroy(). */
imagedestroy($image);
?>