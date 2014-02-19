<?php
/* ===============
  INITIALISATION
=============== */
 
/* D�marrage d'une session qui va nous permettre de stocker la valeur � recopier. */
session_start(); // session_start() se place toujours avant toute sortie vers la page web
 
/* Chemin absolu vers le dossier */
if ( !defined('ABSPATH') ) define('ABSPATH', dirname(__FILE__) . '/');
 
/*
Cr�ation d'une fonction pour g�n�rer la cha�ne al�atoire � recopier (sans cryptage) :
- strlen() retourne la taille de la chaine en param�tre
- mt_rand(a, b) g�n�re un nombre al�atoire entre a et b compris : cette fonction est plus rapide que rand() de la biblioth�que standard
- $chars{0} retourne le premier caract�re de la cha�ne $chars, $chars{1} le deuxi�me ...
*/
function getCode($length) {
  $chars = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ'; // Certains caract�res ont �t� enlev�s car ils pr�tent � confusion
  $rand_str = '';
  for ($i=0; $i<$length; $i++) {
    $rand_str .= $chars{ mt_rand( 0, strlen($chars)-1 ) };
  }
  return $rand_str;
}
 
/* Stockage de la cha�ne al�atoire de 5 caract�res obtenue */
$theCode = getCode(5);
 
/* Cryptage de la chaine avec md5() avant de la stocker dans la variable de session $_SESSION['captcha'] de la session en cours.
C'est � cette variable qu'on va comparer le code entr� par l'utilsateur dans le formulaire. */
$_SESSION['captcha'] = md5($theCode);
 
/* Afin de traiter les caract�res s�par�ment, on les stocke un par un dans des variables. */
$char1 = substr($theCode,0,1);
$char2 = substr($theCode,1,1);
$char3 = substr($theCode,2,1);
$char4 = substr($theCode,3,1);
$char5 = substr($theCode,4,1);
 
/*
glob() retourne un tableau r�pertoriant les fichiers du dossier 'fonts', ayant l'extension .ttf ( pas .TTF ! ).
Vous pouvez donc ajouter autant de polices TrueType que vous d�sirez, en veillant � les renommer.
*/
$fonts = glob('fonts/*.ttf');
 
 
/* ====================
  TRAITEMENT DE L'IMAGE
==================== */
 
/*
imagecreatefrompng() cr�e une nouvelle image � partir d'un fichier PNG.
Cette nouvelle $image va �tre ensuite modifi�e avant l'affichage.
 */
$image = imagecreatefrompng('captcha.png');
 
/*
imagecolorallocate() retourne un identifiant de couleur.
On d�finit les couleurs RVB qu'on va utiliser pour nos polices et on les stocke dans le tableau $colors[].
Vous pouvez ajouter autant de couleurs que vous voulez.
*/
$colors=array (	imagecolorallocate($image, 131,154,255),
                imagecolorallocate($image,  89,186,255),
                imagecolorallocate($image, 155,190,214),
                imagecolorallocate($image, 255,128,234),
                imagecolorallocate($image, 255,123,123) );
 
/* Cr�ation d'une petite fonction qui retourne une VALEUR al�atoire du tableau re�u en param�tre. */
function random($tab) {
  return $tab[array_rand($tab)];
}
 
/*
Mise en forme de chacun des caract�res et placement sur l'image.
imagettftext(image, taille police, inclinaison, coordonn�e X, coordonn�e Y, couleur, police, texte) �crit le texte sur l'image.
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
Comme c'est le fichier captcha.php et non captcha.png qui va �tre appel�,
on envoie un en-t�te HTTP au navigateur via header() pour lui indiquer
que captcha.php est bien une image au format PNG.
*/
header('Content-Type: image/png');
 
/* .. et on envoie notre image PNG au navigateur. */
imagepng($image);
 
/* L'image ayant �t� envoy�e, on lib�re toute la m�moire qui lui est associ�e via imagedestroy(). */
imagedestroy($image);
?>