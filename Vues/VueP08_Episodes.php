<?php
namespace crudP08\Vues;

require_once("../php-crud/Entites/EntiteP08_Episodes.php");
require_once("../php-crud/Entites/AbstractEntite.php");
require_once("VueEntite.php");

use crudP08\Entites\AbstractEntite;
use crudP08\Entites\EntiteP08_Episodes;
use crudP08\Vues\VueEntite;

class VueP08_Episodes extends VueEntite
{
/**
   * getHTML4Entity
   *
   * @param AbstractEntite|null $entite
   * @return string
   */
  public function getHTML4Entity(string $select4FK = null, AbstractEntite $entite = null): string
  {
    if ($entite instanceof EntiteP08_Episodes) {
      $ch = "";
      $ch .= $this->getDebutHTML();
      $ch = "<table width='700'>
              <tr>
                <th>Id : </th>
                <td>" . $entite->getIdEpisode() . "</td>
              </tr>
              <tr>
                <th>Nom : </th>
                <td>" . $entite->getNomEpisode() . "</td>
              </tr>
              <tr>
                <th>Numéro : </th>
                <td>" . $entite->getnumEpisode() . "</td>
              </tr>
              <tr>
                <th>Date de diffusion : </th>
                <td>" . $entite->getDateDiffusionEpisode() . "</td>
              </tr>
              <tr>
                <th>Note : </th>
                <td>" . $entite->getNoteEpisode() . "</td>
              </tr>
              <tr>
                <th>Note : </th>
                <td>" . $entite->getNoteEpisode() . "</td>
              </tr>
              <tr>
                <th>Description : </th>
                <td>" . $entite->getDescriptionEpisode() . "</td>
              </tr>
              <tr>
                <th>Durée : </th>
                <td>" . $entite->getDureeEpisode() . "</td>
              </tr>
              <tr>
                <th>Saison : </th>
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
    foreach ($tabEntities as $episode) {
      if ($serie instanceof EntiteP08_Episodes) {
        $ch .= '<li>' . $episode->getIdEpisode() . ' ';
        $ch .= $episode->getNomEpisode() . ' ';
        $ch .= $episode->getnumEpisode() . ' ';
        $ch .= $episode->getDateDiffusionEpisode() . ' ';
        $ch .= $episode->getNoteEpisode() . ' ';
        $ch .= '<a href="controleur.php?action=modifierEntite&idSerie=' . $serie->getIdEpisode() . '">Modifier</a> ';
        $ch .= '<a href="controleur.php?action=supprimerEntite&idSerie=' . $serie->getIdEpisode() . '">Supprimer</a> ';
        $ch .= '</li>';
      }
    }
    $ch .= '</ul>';
    return $ch . $this->getFinHTML();
  }
}

?>