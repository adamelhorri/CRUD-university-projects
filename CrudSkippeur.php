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

session_start();

$myPDOSkippeur = new MyPDO('localhost', 'lerbi', 'root', '');
$myPDOSkippeur->setNomTable("Skippeur");
$vueSkippeur = new VueSkippeur();

$contenuPage = "";
$message = "";

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'read' :
           $skippeur = $myPDOSkippeur->get('Skippeur_id', $_GET['Skippeur_id']);
           $contenuPage .= $vueSkippeur->getHTML4Skippeur($skippeur);
           $_SESSION['etat'] = 'lecture';
            break;
        case 'create' :
            $nbSkippeur = $myPDOSkippeur->getNbSkippeur();
            $tabCreation = array(
                'Skippeur_id' => array(
                    'type'=>'number',
                    'default' => $nbSkippeur+1,
                ),
                'Skippeur_Nom' => array(
                    'type' => 'text',
                    'default' => '',
                ),
                'Skippeur_Prenom' => array(
                    'type' => 'text',
                    'default' => '',
                ),
                'Skipeur_DateNaissance' => array(
                    'type' => 'date',
                    'default' => '',
                ),
                'Skippeur_Sexe' => array(
                    'type' => 'text',
                    'default' => '',
                ),
            );
            $contenuPage .= $vueSkippeur->getFormulaire4Skippeur($tabCreation);
            $_SESSION['etat'] = 'creation';
            break;
        case 'update':
            $skippeur = $myPDOSkippeur->get('Skippeur_id', $_GET['Skippeur_id']);
            $tab = array(
                'Skippeur_id' => array(
                    'type'=>'number',
                    'default' => $skippeur->getSkippeurId()
                ),
                'Skippeur_Nom' => array(
                    'type' => 'text',
                    'default' => $skippeur->getSkippeurNom(),
                ),
                'Skippeur_Prenom' => array(
                    'type' => 'text',
                    'default' => $skippeur->getSkippeurPrenom(),
                ),
                'Skipeur_DateNaissance' => array(
                    'type' => 'date',
                    'default' => $skippeur->getSkipeurDateNaissance(),
                ),
                'Skippeur_Sexe' => array(
                    'type' => 'text',
                    'default' => $skippeur->getSkippeurSexe(),
                ),
            );
            $contenuPage .= $vueSkippeur->getFormulaire4Skippeur($tab);
            $_SESSION['etat'] = 'modification';
            break;
        case 'delete':
            $myPDOSkippeur->delete(array('Skippeur_id'=>$_GET['Skippeur_id']));
            $_SESSION['etat'] = 'suppression';
            break;
        case 'afficher' :
            echo "hahaha";
            $_SESSION['etat'] = 'afficheTable';
            break;
        default:
            $message .= "<p>Action " . $_GET['action'] . " non implémentée.</p>\n";
    }
}else
    if (isset($_SESSION['etat'])){
        switch ($_SESSION['etat']){
            case 'creation':
                $tabCreationInfo = array(
                    'Skippeur_id' => $_GET['Skippeur_id'],
                    'Skippeur_Nom' => $_GET['Skippeur_Nom'],
                    'Skippeur_Prenom' => $_GET['Skippeur_Prenom'],
                    'Skipeur_DateNaissance' => $_GET['Skipeur_DateNaissance'],
                    'Skippeur_Sexe' => $_GET['Skippeur_Sexe'],
                );
                $myPDOSkippeur->insert($tabCreationInfo);
                $_SESSION['etat'] = 'créé';
                break;
            case 'modification' :
                $tabinfo = array(
                    'Skippeur_id' => $_GET['Skippeur_id'],
                    'Skippeur_Nom' => $_GET['Skippeur_Nom'],
                    'Skippeur_Prenom' => $_GET['Skippeur_Prenom'],
                    'Skipeur_DateNaissance' => $_GET['Skipeur_DateNaissance'],
                    'Skippeur_Sexe' => $_GET['Skippeur_Sexe'],
                );
                $myPDOSkippeur->update('Skippeur_id', $tabinfo);
                $_SESSION['etat'] = 'afficheTable';
                break;
            case 'suppression' :
                $_SESSION['etat'] = 'afficheTable';
                break;
            case 'afficheTable' :

                break;
            case 'créé':
            case 'modifié':
            case 'supprimé':
            default:
                 $_SESSION['etat'] = 'neutre';
        }
    }



echo getDebutHTML();

    $nbSkippeur = $myPDOSkippeur->getNbSkippeur();
    $contenuPage .="<p><a href='?action=create'>Créer livre ";
    $contenuPage .= $vueSkippeur->getAllSkippeur($myPDOSkippeur->getAll());
    $contenuPage .= $nbSkippeur+1;
    $contenuPage .= "</a> </p>";
    $contenuPage .= "<a href='Accueil.php?action=initialiser'>Accueil</a>";
echo $_SESSION['etat'];
echo $contenuPage;
echo getFinHTML();
?>
