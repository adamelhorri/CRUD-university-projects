<?php

include "Connexion/MyPDO.php";
include "Vues/VueSkippeur.php";

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
    $resultat = "<form action='Accueil.php' method='get'>\n";
    $resultat .= "<select size='1' name='table_name'>\n
            <option value='Skippeur'>Skippeur</option>
            <option value='Bateau'>Bateau</option>
            <option value='Course'>Course</option>
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
    case 'afficherTable' :
        $_SESSION['etat'] = 'afficheTable';
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
        $contenu.= $vue->getAllSkippeur($myPDO->getAll());
        $contenu .= "<a href='Accueil.php?action=initialiser'>Accueil</a>";
        break;
    case 'creation' :

        break;
}

echo getDebutHTML();
echo $contenu ;
echo getFinHTML();