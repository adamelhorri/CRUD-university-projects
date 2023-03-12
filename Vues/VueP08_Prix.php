<?php
namespace crudP08\Vues;

require_once("../php-crud/Entites/EntiteP08_Prix.php");
require_once("../php-crud/Entites/AbstractEntite.php");
require_once("VueEntite.php");

use crudP08\Entites\AbstractEntite;
use crudP08\Entites\EntiteP08_Prix;
use crudP08\Vues\VueEntite;

class VueP08_Prix extends VueEntite
{

  /**
   * getHTML4Entity
   *
   * @param AbstractEntite|null $entite
   * @return string
   */
  public function getHTML4Entity(AbstractEntite $entite = null): string
  {
    if ($entite instanceof EntiteP08_Prix) {
      $ch = "";
      $ch .= $this->getDebutHTML();
      $ch = "<table width='700'>
              <tr>
                <th>Id : </th>
                <td>" . $entite->getIdPrix() . "</td>
              </tr>
              <tr>
                <th>Nom : </th>
                <td>" . $entite->getNomPrix() . "</td>
              </tr>
              <tr>
                <th>Catégorie : </th>
                <td>" . $entite->getCategoriePrix() . "</td>
              </tr> \n";
      $ch .= $this->getFinHTML();
      return $ch;
    } else
      exit("Le paramètre d'entrée n'est pas une instance de EntiteP08_Prix");
  }

  /**
   * getAllEntities
   *
   * @param array $tabEntities
   * @return string
   */
  public function getAllEntities(array $tabEntities): string
  {
    $ch = "";
    $ch .= $this->getDebutHTML();
    $ch = '<h1>Les Prix</h1>';
    $ch .= "<form action='' method='get'>
              <p>
                Choisir un numéro : <input type='number' name='idPrix' > 
                <button name='action' value='afficherEntite'>Afficher</button>
              </p>
            </form>";
    $ch .= '<p><a href="controleur.php?action=creerEntite">Créer un nouveau prix</a></p>';
    $ch .= '<ul>';
    foreach ($tabEntities as $prix) {
      if ($prix instanceof EntiteP08_Prix) {
        $ch .= '<li>' . $prix->getIdPrix() . ' ';
        $ch .= $prix->getNomPrix() . ' ';
        $ch .= $prix->getCategoriePrix() . ' ';
        $ch .= '<a href="controleur.php?action=modifierEntite&idPrix=' . $prix->getIdPrix() . '">Modifier</a> ';
        $ch .= '<a href="controleur.php?action=supprimerEntite&idPrix=' . $prix->getIdPrix() . '">Supprimer</a> ';
        $ch .= '</li>';
      }
    }
    $ch .= $this->getFinHTML();
    return $ch . '</ul>';
  }
}

?>