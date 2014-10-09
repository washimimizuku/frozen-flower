<?
////////////////////////////////////////////////////////////////////////////////
// Nom : $Source: /vhosts/virtua/php/scripts/decode_access97_pwd.php,v $
// $Revision: 1.1 $ - $Date: 2005/04/08 15:46:19 $ - $Author: raphael $
// Auteur : Raphael Augustin - Virtua SA <raphael.augustin@virtua.ch>
// Client : Virtua SA
// Usage : Custom
// Brève description : Mise en situation PHP à l'attention des nouveaux candidats
//                     dev de Virtua.
// Dependances : n/a
////////////////////////////////////////////////////////////////////////////////

// Question 1 //////////////////////////////////////////////////////////////////
// Donnée : Rédiger le code qui permet d'afficher toutes les valeurs numériques ? (11, 12, 21, 22)

$ary['one']['one'] = 11;
$ary['one']['two'] = 12;
$ary['two']['one'] = 21;
$ary['two']['two'] = 22;

// Réponse 1

foreach ($ary as $key => $value) {
  foreach ($ary[$key] as $key2 => $value2) {
    echo ($ary[$key][$key2])."<br>\n";
    
  }
}

echo ("<br>\n");

// Question 2 //////////////////////////////////////////////////////////////////
// Donnée : Rédiger le code permettant d'altérner successivement deux couleurs (Exemple : 1ère ligne rouge, 2ème ligne blanc, 3ème ligne rouge et ainsi de suite)

// Réponse 2
for ($i = 1; $i < 6; $i++) {
  if ($i % 2) {
    echo("<font color=\"red\">text</font><br>\n");
  } else {
    echo("<font color=\"lime\">text</font><br>\n");
  }
}

echo ("<br>\n");

// Question 3 //////////////////////////////////////////////////////////////////
// Donnée : Rédigez le code permettant de d'utiliser la classe 'cls_third' pour
//          imprimer le texte 'Bonjour John Smith'.

class cls_third
{
  public $firstname = 'John';  
  public $name = 'Doe';

  public function mth_say_hello($pi_prefix = 'Hello ')
  {
    echo $pi_prefix . $this->firstname . ' ' . $this->name;
  }
}

// Réponse 3

$a = new cls_third();
$a->mth_say_hello('Bonjour ');
echo ("<br>\n");
echo ("<br>\n");

// Question 4 //////////////////////////////////////////////////////////////////
// Donnée : Dériver la classe (en choisissant le nom de votre choix) pour
//          y ajouter une propriété publique 'middle_name'

class cls_third2
{
  // member declaration
  public $firstname = 'John';  
  public $name = 'Doe';

  // method declaration
  public function mth_say_hello($pi_prefix = 'Hello ')
  {
    echo $pi_prefix . $this->firstname . ' ' . $this->name;
  }
}

// Réponse 4

class cls_third3 extends cls_third2 {
  public $middle_name = 'Silver';
}


// Question 5 //////////////////////////////////////////////////////////////////
// Donnée : Rédiger une fonction qui permet de recevoir en paramètre un texte 
//          et écrit ce dernier dans un fichier à la manière d'un log
//          avec mention de la date et de l'heure de l'entrée.
// Exemple de résultat souhaité : 
// [14.01.2007 - 14:25:32] xxxxxxxx
// [14.01.2007 - 14:26:22] yyyyyyyy
// [14.01.2007 - 14:28:01] zzzzzzzz

// Réponse 5

function logx ($text) {
  $fh = fopen('test.log', 'w+');
  
  fwrite($fh, '['.date("d.m.Y H:M:S")."] $text");

  fclose ($fh);
}

logx('Virtua');

?>
