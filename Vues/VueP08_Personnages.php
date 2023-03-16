<?php
namespace crudP08\Vues;

require_once("../php-crud/Entites/EntiteP08_Personnes.php");
require_once("../php-crud/Entites/AbstractEntite.php");
require_once("VueEntite.php");

use crudP08\Entites\AbstractEntite;
use crudP08\Entites\EntiteP08_Personnages;
use crudP08\Vues\VueEntite;

class VueP08_Personnages extends VueEntite
{

  public function getHTML4Entity(string $select4FK = null, AbstractEntite $entite = null): string
  {
    if ($entite instanceof EntiteP08_Personnages) {
      $ch = "";
      $ch .= $this->getDebutHTML();
      $voice = $entite->getVoice() == 1 ? 'true' : 'false';
      $ch .= "<table width='700'>
              <tr>
                <th>Id : </th>
                <td>" . $select4FK . "</td>
              </tr>
              <tr>
                <th>Nom : </th>
                <td>" . $entite->getNomPersonnage() . "</td>
              </tr>
              <tr>
                <th>Voice : </th>
                <td>" . $voice . "</td>
              </tr>\n";
      return $ch . $this->getFinHTML();
    } else
      exit("Le paramètre d'entré n'est pas une instance de EntiteP08_Personnages");
  }


  public function getAllEntities(array $tabEntities, string $pages): string
  {
    $ch = "";
    $ch .= $this->getDebutHTML();
    $ch .= '<h1>Les Personnages</h1>';
    $ch .= "<form action='' method='get'>
              <p>
                Choisir un numéro : <input type='number' name='idPersonne' > 
                <button name='action' value='afficherEntite'>Afficher</button>
              </p>
            </form>";
    $ch .= '<p><a href="controleur.php?action=creerEntite">Ajouter un nouveau personnage</a></p>';
    $ch .= '<ul>';
    foreach ($tabEntities as $personnage) {
      if ($personnage instanceof EntiteP08_Personnages) {
        $ch .= '<li>' . $personnage->getIdPersonne() . ' ';
        $ch .= $personnage->getNomPersonnage() . ' ';
        $ch .= '<a href="controleur.php?action=modifierEntite&idPersonne=' . $personnage->getIdPersonne() . '">Modifier</a> ';
        $ch .= '<a href="controleur.php?action=supprimerEntite&idPersonne=' . $personnage->getIdPersonne() . '">Supprimer</a> ';
        $ch .= '</li>';
      }
    }
    $ch .= '</ul>';
    $ch .= $pages;
    return $ch . $this->getFinHTML();
  }

}