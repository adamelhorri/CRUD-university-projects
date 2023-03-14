<?php
namespace crudP08;

session_start();

include("MyPDO.php");
include("connex.php");
require_once("Vues/VueP08_Series.php");
require_once("Vues/VueP08_Personnes.php");
require_once("Vues/VueP08_Prix.php");
require_once("Vues/VueP08_Genres.php");
require_once("Vues/VueP08_Episodes.php");
require_once("Vues/VueP08_Saisons.php");
require_once("Vues/VueP08_Personnages.php");
// require_once("Vues/VueP08_Etre.php");
// require_once("Vues/VueP08_Role.php");
// require_once("Vues/VueP08_Remporter.php");
require_once("Entites/EntiteP08_Series.php");
require_once("Entites/EntiteP08_Personnes.php");
require_once("Entites/EntiteP08_Prix.php");
require_once("Entites/EntiteP08_Genres.php");
require_once("Entites/EntiteP08_Episodes.php");
require_once("Entites/EntiteP08_Saisons.php");
require_once("Entites/EntiteP08_Personnages.php");
// require_once("Entites/EntiteP08_Etre.php");
// require_once("Entites/EntiteP08_Role.php");
// require_once("Entites/EntiteP08_Remporter.php");

require_once("Iterateurs/IterateurP08_Series.php");
require_once("Iterateurs/IterateurP08_Personnes.php");
require_once("Iterateurs/IterateurP08_Prix.php");
require_once("Iterateurs/IterateurP08_Genres.php");
require_once("Iterateurs/IterateurP08_Episodes.php");
require_once("Iterateurs/IterateurP08_Saisons.php");
require_once("Iterateurs/IterateurP08_Personnages.php");

use crudP08\MyPDO;
use \ReflectionClass;
use \LimitIterator;
use PDOException;

function getListeTables(): string
{
  return "<!DOCTYPE html>
  <html lang='fr'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'/>
<title>CRUD-Series-télévisées</title>
<link rel='stylesheet' href='global.css' />
</head>
<body> 
<form action='' method='GET'>
  <input type='hidden' name='action' value='selectionnerTable'>
  <select name='table_name'>
    <option disabled selected value=''>--- Sélectionnez une table ---</option>
    <option value='P08_Series'>Séries</option>
    <option value='P08_Saisons'>Saisons</option>
    <option value='P08_Episodes'>Episodes</option>
    <option value='P08_Personnes'>Personnes</option>
    <option value='P08_Personnages'>Personnages</option>
    <option value='P08_Genres'>Genres</option>
    <option value='P08_Prix'>Prix</option>
  </select>
  <button type='submit'>Sélectionner la table</button>
  </form>
  </body>
  </html>
  ";
}

// initialisation des variables $contenu et $message pour alimenter <body>
$contenu = "";
$message = "";
// initialisation du connecteur myPDO pour la connexion
// (sans nom de Table à renseigner selon le contexte)
$myPDO = new MyPDO('mysql', $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['password']);

if (!isset($_GET['action']))
  $_GET['action'] = "initialiser";

switch ($_GET['action']) {
  case 'initialiser':
    $_SESSION['état'] = 'Accueil';
    break;
  case 'selectionnerTable':
    if (@$_GET['table_name'] == '') {
      $_SESSION['état'] = 'Accueil';
      break;
    }
    $myPDO->setNomTable($_GET['table_name']);
    $_SESSION['état'] = 'afficheTable';
    $classeEntite = new ReflectionClass("crudP08\Entites\Entite" . ucfirst($_GET['table_name']));
    $_SESSION['cle'] = $classeEntite->getStaticPropertyValue(("PK"))[0];
    $_SESSION['table_name'] = $_GET['table_name'];
    break;
  case 'afficherEntite': // affihcer une entité
    $myPDO->setNomTable($_SESSION['table_name']);
    $classeEntite = new ReflectionClass("crudP08\Entites\Entite" . ucfirst($_SESSION['table_name']));
    $_SESSION['cle'] = $classeEntite->getStaticPropertyValue(("PK"))[0];
    $_SESSION['état'] = 'afficherEntite';
    if (count($classeEntite->getStaticPropertyValue(("FK"))) == 1)
      $_SESSION['fk'] = $classeEntite->getStaticPropertyValue(("FK"))[0];
    else if (isset($_SESSION['fk']))
      unset($_SESSION['fk']);
    break;
  case 'creerEntite': // construction du formulaire de création de l'entité
    $myPDO->setNomTable($_SESSION['table_name']);
    // Réflection pour récupérer la structure de l'entité
    $classeEntite = new ReflectionClass("crudP08\Entites\Entite" . ucfirst($_SESSION['table_name']));
    $colNames = $classeEntite->getStaticPropertyValue("COLNAMES");
    $colTypes = $classeEntite->getStaticPropertyValue("COLTYPES");
    $paramForm = array_combine($colNames, $colTypes);
    $id = $myPDO->getNextInt($classeEntite->getStaticPropertyValue(("PK"))[0]);
    $b = false;
    $fk = null;
    if (count($classeEntite->getStaticPropertyValue(("FK"))) == 1) {
      $b = true;
      $fk = $classeEntite->getStaticPropertyValue(("FK"))[0];
    }
    // $paramForm est un tableau associatif destiné à configurer le formulaire
    // Réflection pour récupérer la bonne vue
    $classeVue = new ReflectionClass("crudP08\Vues\Vue" . ucfirst($_SESSION['table_name']));
    $vue = $classeVue->newInstance();
    $contenu .= $vue->getForme4Entity($paramForm, $b ? $myPDO->getSelectFK($fk, null) : null, null, $id, $b ? $fk : null);
    $_SESSION['état'] = 'formulaireTable';
    break;
  case 'insererEntite': // validation du formulaire de création d'une entité
    $myPDO->setNomTable($_SESSION['table_name']);
    // Réflection pour récupérer la structure de l'entité
    $classeEntite = new ReflectionClass("crudP08\Entites\Entite" . ucfirst($_SESSION['table_name']));
    $colNames = $classeEntite->getStaticPropertyValue("COLNAMES");
    $colTypes = $classeEntite->getStaticPropertyValue("COLTYPES");
    $paramInsert = array_diff_key($_GET, array('action' => 'insererEntite'));
    try {
      $myPDO->insert($paramInsert);
      $colNameId = $classeEntite->getStaticPropertyValue(("PK"))[0];
      $entite = $myPDO->get($colNameId, $_GET[$colNameId]);
      $message .= "<p>Entité $entite crée</p>\n";
    } catch (PDOException $pdoe) {
      $_SESSION['état'] = 'afficheTable';
    }
    $_SESSION['état'] = 'afficheTable';
    break;
  case 'supprimerEntite':
    $myPDO->setNomTable($_SESSION['table_name']);
    // récupération du nom de colonne dans le GET
    $keyName = array_keys(array_diff_key($_GET, array('action' => TRUE)))[0];
    $myPDO->delete(array($keyName => $_GET[$keyName]));
    $message .= "<p>Entité " . $_GET[$keyName] . " supprimée</p>\n";
    $_SESSION['état'] = 'afficheTable';
    break;
  case 'modifierEntite':
    $myPDO->setNomTable($_SESSION['table_name']);
    // Réflection pour récupérer la structure de l'entité
    $classeEntite = new ReflectionClass("crudP08\Entites\Entite" . ucfirst($_SESSION['table_name']));
    $colNames = $classeEntite->getStaticPropertyValue("COLNAMES");
    $colTypes = $classeEntite->getStaticPropertyValue("COLTYPES");
    $paramForm = array_combine($colNames, $colTypes);
    $cle = $classeEntite->getStaticPropertyValue(("PK"))[0];
    $entite = $myPDO->get($cle, $_GET[$cle]);
    if ($entite == null) {
      $contenu .= 'Erreur 404 : l\'entité de la classe Entite' . $_SESSION['table_name'] . ' (id : ' . $_GET[$_SESSION['cle']] . ') n\'esxiste pas';
      break;
    }
    $b = false;
    $fk = null;
    if (count($classeEntite->getStaticPropertyValue(("FK"))) == 1) {
      $b = true;
      $fk = $classeEntite->getStaticPropertyValue(("FK"))[0];
    }
    // $paramForm est un tableau associatif destiné à configurer le formulaire
    // Réflection pour récupérer la bonne vue
    $classeVue = new ReflectionClass("crudP08\Vues\Vue" . ucfirst($_SESSION['table_name']));
    $vue = $classeVue->newInstance();
    $contenu .= $vue->getForme4Entity($paramForm, $b ? $myPDO->getSelectFK($fk, ($fk == 'spinoff' ? $entite->{'get' . $fk}() : $entite->{'get' . ucfirst($cle)}())) : null, $entite, $_GET[$cle], $b ? $fk : null);
    $_SESSION['état'] = 'formulaireTable';
    break;
  case 'sauverEntite': // validation  du formulaire de modification de l'entité
    $myPDO->setNomTable($_SESSION['table_name']);
    // Réflection pour récupérer la structure de l'entité
    $classeEntite = new ReflectionClass("crudP08\Entites\Entite" . ucfirst($_SESSION['table_name']));
    $colNames = $classeEntite->getStaticPropertyValue("COLNAMES");
    $colTypes = $classeEntite->getStaticPropertyValue("COLTYPES");
    $paramInsert = array_diff_key($_GET, array('action' => 'insérerEntite'));
    try {
      $myPDO->update($paramInsert);
      $cloNameId = $classeEntite->getStaticPropertyValue(("PK"))[0];
      $entite = $myPDO->get($cloNameId, $_GET[$cloNameId]);
      $message .= "<p>Entité $entite modifiée</p>\n";
    } catch (PDOException $pdoe) {
      $_SESSION['état'] = 'afficheTable';
    }
    $_SESSION['état'] = 'afficheTable';
    break;
  default:
    $message .= "<p>Action " . $_GET['action'] . " non implémentée.</p>\n";
    $_SESSION['état'] = 'Accueil';
}

switch ($_SESSION['état']) {
  case 'Accueil':
    $contenu .= getListeTables();
    break;
  case 'afficheTable':
    if (!isset($_SESSION['collection'])) {
      $_SESSION['debut'] = 1;
      $_SESSION['taillePage'] = 10;
    }
    if (isset($_GET['suivant'])) {
      $_SESSION['debut'] += $_GET['suivant'] * $_SESSION['taillePage'];
    }
    // echo "<p>**** " . count($_SESSION['collection']) . " ****</p>";
    // echo "<p>**** " . $_SESSION['debut'] . " -- " . $_SESSION['taillePage'] + $_SESSION['debut'] - 1 . " ****</p>";
    $iterateur = new ReflectionClass("crudP08\Iterateurs\Iterateur" . ucfirst($_SESSION['table_name']));
    $instance = $iterateur->newInstance();//& $_SESSION['collection'];

    $pageCourante = new LimitIterator($instance, $_SESSION['debut'] - 1, $_SESSION['taillePage']);

    $decalageFirst = 0;
    $decalageLast = (int) (($instance->nbInstances()) / $_SESSION['taillePage']);
    $decalagePrev = (isset($_GET['suivant'])) && $_GET['suivant'] > 0 ? $_GET['suivant'] - 1 : 0;
    $decalageNext = (isset($_GET['suivant'])) ? ($_GET['suivant'] < $decalageLast ? $_GET['suivant'] + 1 : $decalageLast) : 1;

    $urlFirst = $_SERVER['PHP_SELF'] . "?action=selectionnerTable&table_name=" . ucfirst($_SESSION['table_name']) . "&suivant=" . $decalageFirst;
    $urlPrev = $_SERVER['PHP_SELF'] . "?action=selectionnerTable&table_name=" . ucfirst($_SESSION['table_name']) . "&suivant=" . $decalagePrev;
    $urlNext = $_SERVER['PHP_SELF'] . "?action=selectionnerTable&table_name=" . ucfirst($_SESSION['table_name']) . "&suivant=" . $decalageNext;
    $urlLast = $_SERVER['PHP_SELF'] . "?action=selectionnerTable&table_name=" . ucfirst($_SESSION['table_name']) . "&suivant=" . $decalageLast;

    $ch = "<p><a href='$urlFirst'>First</a> <a href='$urlPrev'>prev</a> <a href='$urlNext'>next</a> <a href='$urlLast'>Last</a></p>";

    $classeVue = new ReflectionClass("crudP08\Vues\Vue" . ucfirst($_SESSION['table_name']));
    $vue = $classeVue->newInstance();
    $lesEntites = array();
    foreach ($pageCourante as $val)
      array_push($lesEntites, $myPDO->get($_SESSION['cle'], $pageCourante->key()));
    $contenu .= $vue->getAllEntities($lesEntites, $ch);
    break;
  case 'afficherEntite':
    $classeVue = new ReflectionClass("crudP08\Vues\Vue" . ucfirst($_SESSION['table_name']));
    $vue = $classeVue->newInstance();
    $entite = $myPDO->get($_SESSION['cle'], $_GET[$_SESSION['cle']]);
    if ($entite == null)
      $contenu .= 'Erreur 404 : l\'entité de la classe Entite' . $_SESSION['table_name'] . ' (id : ' . $_GET[$_SESSION['cle']] . ') n\'esxiste pas';
    else if (isset($_SESSION['fk']))
      $contenu .= $vue->getHTML4Entity($myPDO->getFK($_SESSION['fk'], $entite->{'get' . ucfirst($_SESSION['fk'])}()), $entite);
    else
      $contenu .= $vue->getHTML4Entity(null, $entite);
    break;
  case 'formulaireTable':
    break;
  default:
    $message .= "<p>état " . $_SESSION['état'] . " inconnu</p>\n";
    $_SESSION['état'] = 'Accueil';
}


// ajout d'un lien vers la page d'accueil
$contenu .= "<p><a href='index.php?action=initialiser'>Accueil</a></p>\n";

echo $message;
echo $contenu;

?>