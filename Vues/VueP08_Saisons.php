<?php
namespace crudP08\Vues;

require_once("../php-crud/Entites/EntiteP08_Saisons.php");
require_once("../php-crud/Entites/AbstractEntite.php");
require_once("VueEntite.php");

use crudP08\Entites\AbstractEntite;
use crudP08\Entites\EntiteP08_Saisons;
use crudP08\Vues\VueEntite;

class VueP08_Saisons extends VueEntite
{
/**
   * getHTML4Entity
   *
   * @param AbstractEntite|null $entite
   * @return string
   */
  public function getHTML4Entity(string $select4FK = null, AbstractEntite $entite = null): string
  {
    if ($entite instanceof EntiteP08_Saisons) {
      $ch = "";
      $ch .= $this->getDebutHTML();
      $ch = "<table width='700'>
              <tr>
                <th>Id : </th>
                <td>" . $entite->getIdSaison() . "</td>
              </tr>
              <tr>
                <th>Nom : </th>
                <td>" . $entite->getNomSaison() . "</td>
              </tr>
              <tr>
                <th>Numéro : </th>
                <td>" . $entite->getnumSaison() . "</td>
              </tr>
              <tr>
                <th>Date du début : </th>
                <td>" . $entite->getDebutSaison() . "</td>
              </tr>
              <tr>
                <th>Date de la fin: </th>
                <td>" . $entite->getFinSaison() . "</td>
              </tr>
              <tr>
                <th>Série : </th>
                <td>" . $select4FK . "</td>
              </tr>\n";
              $ch .= $this->getFinHTML();
      return $ch;
    } else
      exit("Le paramètre d'entrée n'est pas une instance de EntiteP08_Saisons");
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
    $ch = '<h1>Les Saisons</h1>';
    $ch .= "<form action='' method='get'>
              <p>
                Choisir un numéro : <input type='number' name='idSaison' > 
                <button name='action' value='afficherEntite'>Afficher</button>
              </p>
            </form>";
    $ch .= '<p><a href="controleur.php?action=creerEntite">Créer une nouvelle saison</a></p>';
    $ch .= '<ul>';
    foreach ($tabEntities as $saison) {
      if ($saison instanceof EntiteP08_Saisons) {
        $ch .= '<li>' . $saison->getIdSaison() . ' ';
        $ch .= $saison->getNomSaison() . ' ';
        $ch .= $saison->getnumSaison() . ' ';
        $ch .= $saison->getDebutSaison() . ' ';
        $ch .= $saison->getFinSaison() . ' ';
        $ch .= '<a href="controleur.php?action=modifierEntite&idSaison=' . $saison->getIdSaison() . '">Modifier</a> ';
        $ch .= '<a href="controleur.php?action=supprimerEntite&idSaison=' . $saison->getIdSaison() . '">Supprimer</a> ';
        $ch .= '</li>';
      }
    }
    $ch .= '</ul>';
    return $ch . $this->getFinHTML();
  }
}

?>