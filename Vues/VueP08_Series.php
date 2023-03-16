<?php
namespace crudP08\Vues;

require_once("../php-crud/Entites/EntiteP08_Series.php");
require_once("../php-crud/Entites/AbstractEntite.php");
require_once("VueEntite.php");
require_once("AbstractVueRelation.php");

use crudP08\Entites\AbstractEntite;
use crudP08\Entites\EntiteP08_Series;
use crudP08\Vues\VueEntite;
use crudP08\Vues\AbstractVueRelation;

class VueP08_Series extends VueEntite
{

  /**
   * getHTML4Entity
   *
   * @param AbstractEntite|null $entite
   * @return string
   */
  public function getHTML4Entity(string $select4FK = null, AbstractEntite $entite = null): string
  {
    if ($entite instanceof EntiteP08_Series) {
      $ch = "";
      $ch .= $this->getDebutHTML();
      $ch .= "<link rel='stylesheet' href='./css/global.css' />";
      $ch .= AbstractVueRelation::getListe();
      $ch .= "<table>
              <tr>
                <th>Id : </th>
                <td>" . $entite->getIdSerie() . "</td>
              </tr>
              <tr>
                <th>Poster : </th>
                <td><img src='" . $entite->getImageSerie() . "'></td>
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
                <th>Spinoff de : </th>
                <td>" . $select4FK . "</td>
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
  public function getAllEntities(array $tabEntities, string $pages): string
  {
    $ch = "";
    $ch .= $this->getDebutHTML();
    $ch .= "<link rel='stylesheet' href='./css/global.css' />";
    $ch .= AbstractVueRelation::getListe();
    $ch .= '<h1>Les Séries</h1>';
    $ch .= '<p><a class="ajouter" href="controleur.php?action=creerEntite">Créer une nouvelle série <img src="./images/icon-add.svg" class="white"></a></p>';
    $ch .= '<ul class="affichage">';
    foreach ($tabEntities as $serie) {
      if ($serie instanceof EntiteP08_Series) {
        $ch .= '<li class="card-image" style="background-image: url(' . $serie->getImageSerie() . ')">
          <a href="'.$_SERVER['PHP_SELF'].'?action=afficherEntite&idSerie=' . $serie->getIdSerie() . '"></a>
          <div class="info">
            <p class="nom">' . $serie->getNomSerie() . '</p>
            <p class="note">' . $serie->getNoteSerie() . '</p>
          </div>
          <div class="actions">
            <a href="controleur.php?action=modifierEntite&idSerie=' . $serie->getIdSerie() . '"><img src="./images/icon-edit.svg"></a>
            <a href="controleur.php?action=supprimerEntite&idSerie=' . $serie->getIdSerie() . '"><img src="./images/icon-delete.svg"></a>
          </div>
        </li>';
      }
    }
    $ch .= '</ul>';
    $ch .= $pages;
    return $ch . $this->getFinHTML();
  }
}

?>