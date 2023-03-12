<?php
namespace crudP08\Vues;

require_once("../php-crud/Entites/EntiteP08_Series.php");
require_once("../php-crud/Entites/AbstractEntite.php");
require_once("VueEntite.php");

use crudP08\Entites\AbstractEntite;
use crudP08\Entites\EntiteP08_Series;
use crudP08\Vues\VueEntite;

class VueP08_Series extends VueEntite
{

  /**
   * getHTML4Entity
   *
   * @param AbstractEntite|null $entite
   * @return string
   */
  public function getHTML4Entity(AbstractEntite $entite = null): string
  {
    if ($entite instanceof EntiteP08_Series) {
      $ch = "";
      $ch .= $this->getDebutHTML();
      $ch = "<table width='700'>
              <tr>
                <img src='" . $entite->getImageSerie() . "' alt='Poster de la série' width='350'>
              </tr>
              <tr>
                <th>Id : </th>
                <td>" . $entite->getIdSerie() . "</td>
              </tr>
              <tr>
                <th>Nom : </th>
                <td>" . $entite->getNomSerie() . "</td>
              </tr>
              <tr>
                <th>Langue : </th>
                <td>" . $entite->getLangueSerie() . "</td>
              </tr>
              <tr>
                <th>Date du début : </th>
                <td>" . $entite->getDebutSerie() . "</td>
              </tr>
              <tr>
                <th>Date de la fin : </th>
                <td>" . $entite->getFinSerie() . "</td>
              </tr>
              <tr>
                <th>Site officiel : </th>
                <td>" . $entite->getSiteOfficiel() . "</td>
              </tr>
              <tr>
                <th>Note : </th>
                <td>" . $entite->getNoteSerie() . "</td>
              </tr>
              <tr>
                <th>Description : </th>
                <td>" . $entite->getDescriptionSerie() . "</td>
              </tr>
              <tr>
                <th>Spinoff : </th>
                <td>" . $entite->getSpinoff() != null ? $entite->getSpinoff() : '' . "</td>
              </tr>\n";
              $ch .= $this->getFinHTML();
      return $ch;
    } else
      exit("Le paramètre d'entrée n'est pas une instance de EntiteP08_Series");
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
    $ch = '<h1>Les Séries</h1>';
    $ch .= "<form action='' method='get'>
              <p>
                Choisir un numéro : <input type='number' name='idSerie' > 
                <button name='action' value='afficherEntite'>Afficher</button>
              </p>
            </form>";
    $ch .= '<p><a href="controleur.php?action=creerEntite">Créer une nouvelle série</a></p>';
    $ch .= '<ul>';
    foreach ($tabEntities as $serie) {
      if ($serie instanceof EntiteP08_Series) {
        $ch .= '<li>' . $serie->getIdSerie() . ' ';
        $ch .= $serie->getNomSerie() . ' ';
        $ch .= $serie->getDebutSerie() . ' ';
        $ch .= $serie->getFinSerie() . ' ';
        $ch .= $serie->getNoteSerie() . ' ';
        $ch .= '<a href="controleur.php?action=modifierEntite&idSerie=' . $serie->getIdSerie() . '">Modifier</a> ';
        $ch .= '<a href="controleur.php?action=supprimerEntite&idSerie=' . $serie->getIdSerie() . '">Supprimer</a> ';
        $ch .= '</li>';
      }
    }
    $ch .= $this->getFinHTML();
    return $ch . '</ul>';
  }
}

?>