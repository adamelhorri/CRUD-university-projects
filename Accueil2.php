<?php

include "Connexion/MyPDO.php";
include "Vues/VueSkippeur.php";
include "Vues/VueBateau.php";
include "Vues/VueCourse.php";
include "Vues/VueResultat.php";
include "Vues/VueConduit.php";



function getDebutHTML(): string
{
    return "<!doctype html>
<html lang=\"fr\">
<head>
  <meta charset=\"utf-8\">
  <title>CRUD PHP</title>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css'>
    <!--  <link rel=\"stylesheet\" href=\"style.css\"> -->
    <!--  <script src=\"script.js\"></script> -->
</head>
<body>
";
}

function getMenu() : string {
    $resultat = "<div class='columns' style='background-color: #003976;'>
          <div class='column is-one-fifth'>
              <img src='https://www.studea-univ-lehavre.fr/resources/lea/logo_universite_le_havre-blanc.png' alt='Website Logo' style='max-height: 120px;'>
          </div>
          <div class='column'>
                <p class='title center has-text-white'> Transat Jaques Vabre 2022</p>
                <p class='subtitle has-text-light'>Réalisation d'un site CRUD</p>
          </div>
      </div>";
    return $resultat;
}

function getFinHTML(): string
{
    return "<!-- contenu -->
<footer class='footer'>
  <div class='content has-text-centered'>
    <p>
      © 2022 All rights reserved
    </p>
  </div>
</footer>
</body>
</html>
";
}

function getContent(): string{
    return "<img src='https://www.transatjacquesvabre.org/public/images/web1/edition/carte.jpg' alt='Course'></div></div>
          ";
}



function getSelectionTable() : string {
    $resultat = "<div class='columns is-centered'><div class='column is-half'>
                    <h1 class='title'>Accueil</h1> 
                    <form class='box' action='Accueil2.php' method='get'>\n";
    $resultat .= "<label class='label'>Choisissez La Table:</label>
            <div class='select is-info' >
           <select name='table_name'>\n
            <option value='Skippeur'>Skippeur</option>
            <option value='Bateau'>Bateau</option>
            <option value='Course'>Course</option>
            <option value='Resultat'>Resultat</option>
            <option value='Conduit'>Conduit</option>
            </select>
            </div>\n";
    $resultat .= " <input class='button is-info' type='submit' name='action' value='SelectionnerTable'/>";
    $resultat .= "</form>";
    return $resultat;
}


session_start();
$contenu = "";
$message = "";

$myPDO = new MyPDO('localhost', 'lerbi', 'root', '');

if (!isset($_GET['action'])){
    $_GET['action'] = "initialiser";
}

switch ($_GET['action']){
    case 'initialiser' :
        $_SESSION['etat'] = "Accueil";
        break;
    case 'SelectionnerTable' :
        $myPDO->setNomTable($_GET['table_name']);
        $_SESSION['table_name'] = $_GET['table_name'];
        $_SESSION['etat'] = 'afficheTable';
        break;
    case 'delete' :
        switch ($_SESSION['table_name']){
            case "Conduit": // cas des tables Avec clé primaire composé
            case "Resultat":
                $myPDO->setNomTable($_SESSION['table_name']);
                $keyName = array(
                    array_keys(array_diff_key($_GET, array('action'=>TRUE)))[0],
                    array_keys(array_diff_key($_GET, array('action'=>TRUE)))[1],
                );
                $myPDO->delete(array(
                    $keyName[0] => $_GET[$keyName[0]],
                    $keyName[1] => $_GET[$keyName[1]],
                ));

                break;
            default:
                $myPDO->setNomTable($_SESSION['table_name']);
                // récupération du nom de colonne dans le GET
                $keyName = array_keys(array_diff_key($_GET, array('action'=>TRUE)))[0];
                $myPDO->delete(array($keyName => $_GET[$keyName]));
                $message .= "<p>Entité ". $_GET[$keyName]." supprimée</p>\n";
                $_SESSION['etat'] = 'afficheTable';
                break;
        }
        break;
    case 'create': // construction du formulaire de création de l'entité
        $myPDO->setNomTable($_SESSION['table_name']);

        // Réflection pour récupérer la structure de l'entité
        $classeEntite = new ReflectionClass("\EntitesTransat\Entite".ucfirst($_SESSION['table_name']));
        $colNames = $classeEntite->getStaticPropertyValue("COLNAMES");
        $colTypes = $classeEntite->getStaticPropertyValue("COLTYPES");
        $paramForm = array_combine($colNames,$colTypes);

        if ($classeEntite->getStaticPropertyValue("AUTOID"))
            $paramForm = array_diff_key($paramForm, array($classeEntite->getStaticPropertyValue(("PK"))[0] => TRUE));




        // Réflection pour récupérer la bonne vue
        $classeVue = new ReflectionClass("Vue" . ucfirst($_SESSION['table_name']));
        $vue = $classeVue->newInstance();
        $contenu .= $vue->getForm4Entity($paramForm, "insérerEntité");

        $_SESSION['état'] = 'formulaireTable';
        break;
    case 'modifierEntité': // construction du formulaire de modification de l'entité
        $_SESSION['état'] = 'formulaireTable';
        break;
    case 'insérerEntité':  // validation du formulaire de création d'une entité
        $myPDO->setNomTable($_SESSION['table_name']);

        // Réflection pour récupérer la structure de l'entité
        $classeEntite = new ReflectionClass("\EntitesTransat\Entite".ucfirst($_SESSION['table_name']));
        $colNames = $classeEntite->getStaticPropertyValue("COLNAMES");
        $colTypes = $classeEntite->getStaticPropertyValue("COLTYPES");

        $paramInsert = array_diff_key($_GET, array('action'=>'insérerEntité'));
        if ($classeEntite->getStaticPropertyValue("AUTOID"))
            $paramInsert = array_merge(array($classeEntite->getStaticPropertyValue(("PK"))[0] => null), $paramInsert);

        $myPDO->insert($paramInsert);

        $_SESSION['état'] = 'afficheTable';
        break;
    case 'update':
        $myPDO->setNomTable($_SESSION['table_name']);

        // recuperer la classe correspondante
        $classeEntite = new ReflectionClass("\EntitesTransat\Entite".ucfirst($_SESSION['table_name']));
        $colTypes = $classeEntite->getStaticPropertyValue("COLTYPES");
        $colNames = $classeEntite->getStaticPropertyValue("COLNAMES");

        // recuperer la vue correspondante
        $classeVue = new ReflectionClass("Vue".ucfirst($_SESSION['table_name']));
        $vue  = $classeVue->newInstance();

        // Recuperer l'entité à modifier sous forme d'un tableau associatif
        $colId = $classeEntite->getStaticPropertyValue("PK");
        $entite = $myPDO->get($colId[0], $_GET[$colId[0]]);
        $tabEntites = $entite->getEntiteArray();


        // construction d'un tableau qui contient des tableaux sous forme :
        /*
         *  array(
                    'type'=>'leType',
                    'default' => 'valeurParDefault'
                ),

         */
        $tabValeurParDefaut = array();
        for ($i = 0 ; $i< count($colTypes) ;$i++ ){
            $type = $colTypes[$i];
            $valeur = $tabEntites[$colNames[$i]];
            array_push($tabValeurParDefaut, array('type'=>$type, 'default' => $valeur));
        }

        $tabUpdate = array_combine($colNames, $tabValeurParDefaut);
        $contenu .= $vue->getForm4Entity($tabUpdate, "save");

        break;
    case "save":
        $myPDO->setNomTable($_SESSION['table_name']);
        // Réflection pour récupérer la structure de l'entité
        $classeEntite = new ReflectionClass("\EntitesTransat\Entite".ucfirst($_SESSION['table_name']));

        $paramSave = array_diff_key($_GET, array('action'=>'save'));

        $colId = $classeEntite->getStaticPropertyValue("PK");
        $myPDO->update($colId[0], $paramSave);
        break;
    default :
        $message .= "<p>Action " . $_GET['action'] . " non implémentée.</p>\n";
        $_SESSION['etat'] = 'Accueil';
}

switch ($_SESSION['etat']){
    case 'Accueil':
        $contenu.= getSelectionTable();
        $contenu.= getContent();
        break;
    case 'afficheTable':
        $classeVue = new ReflectionClass("Vue".ucfirst($_SESSION['table_name']));
        $vue  = $classeVue->newInstance();
        $contenu .="<div class='columns'>
            <div class='column'></div>
            <div class='column'>
                <nav class='breadcrumb' aria-label='breadcrumbs'>
                    <ul>
                        <li><a href='Accueil2.php?action=initialiser'>Accueil</a></li>
                        <li>".$_SESSION['table_name']."</li>
                    </ul>
                </nav>
            </div>
            <div class='column'></div>
            <div class='column'> <a href='?action=create'><button class='button is-link is-light'>Inserer</button></a></div></div>
            ";
        //$contenu .= "<a href='Accueil2.php?action=initialiser'>Home</a><p><a href='?action=create'>Ajouter un skippeur</a>";
        $contenu.= $vue->getAllEntities($myPDO->getAll());
        break;
    case 'creation' :

        break;
}

echo getDebutHTML();
echo getMenu();
echo $contenu ;
echo getFinHTML();