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
  <title>appli crud</title>
    <!--  <link rel=\"stylesheet\" href=\"style.css\"> -->
    <!--  <script src=\"script.js\"></script> -->
</head>
<body>
";
}


function getFinHTML(): string
{
    return "<!-- contenu -->
</body>
</html>
";
}

function getSelectionTable() : string {
    $resultat = "<form action='Accueil2.php' method='get'>\n";
    $resultat .= "<select size='1' name='table_name'>\n
            <option value='Skippeur'>Skippeur</option>
            <option value='Bateau'>Bateau</option>
            <option value='Course'>Course</option>
            <option value='Resultat'>Resultat</option>
            <option value='Conduit'>Conduit</option>
            
     </select>\n";
    $resultat .= "<input type='submit' name='action' value='SelectionnerTable' />";
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
        $myPDO->setNomTable($_SESSION['table_name']);
        // récupération du nom de colonne dans le GET
        $keyName = array_keys(array_diff_key($_GET, array('action'=>TRUE)))[0];
        $myPDO->delete(array($keyName => $_GET[$keyName]));
        $message .= "<p>Entité ". $_GET[$keyName]." supprimée</p>\n";
        $_SESSION['etat'] = 'afficheTable';
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

        // valeur par défaut non géré ci-dessus
        //$contenu .= $vue->getForm4Entity(array('liv_num' => array('type' => 'number', 'default' => $nbEntites + 1), 'liv_titre' => 'text', 'liv_depotlegal' => 'date'), "insérerEntité");

        $_SESSION['état'] = 'formulaireTable';
        break;

    case 'modifierEntité': // construction du formulaire de modification de l'entité
        // ../..
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

    default :
        $message .= "<p>Action " . $_GET['action'] . " non implémentée.</p>\n";
        $_SESSION['etat'] = 'Accueil';
}

switch ($_SESSION['etat']){
    case 'Accueil':
        $contenu.= getSelectionTable();
        break;
    case 'afficheTable':
        $classeVue = new ReflectionClass("Vue".ucfirst($_SESSION['table_name']));
        $vue  = $classeVue->newInstance();
        $contenu .="<p><a href='?action=create'>Créer livre ";
        $contenu .= "</a> </p>";
        $contenu.= $vue->getAllEntities($myPDO->getAll());
        $contenu .= "<a href='Accueil2.php?action=initialiser'>Accueil</a>";
        break;
    case 'creation' :

        break;
}

echo getDebutHTML();
echo $contenu ;
echo getFinHTML();