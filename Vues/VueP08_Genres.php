<?php
namespace crudP08\Vues;

require_once("../php-crud/Entites/EntiteP08_Genres.php");
require_once("../php-crud/Entites/AbstractEntite.php");
require_once("VueEntite.php");

use crudP08\Entites\AbstractEntite;
use crudP08\Entites\EntiteP08_Genres;
use crudP08\Vues\VueEntite;

class VueP08_Genres extends VueEntite
{

  /**
   * getHTML4Entity
   *
   * @param AbstractEntite|null $entite
   * @return string
   */
  public function getHTML4Entity(string $select4FK = null, AbstractEntite $entite = null): string
  {
    if ($entite instanceof EntiteP08_Genres) {
      $ch = "";
      $ch .= $this->getDebutHTML();
      $ch = "<table width='700'>
              <tr>
                <th>Id : </th>
                <td>" . $entite->getIdGenre() . "</td>
              </tr>
              <tr>
                <th>Libelle : </th>
                <td>" . $entite->getLibelleGenre() . "</td>
              </tr>
              \n";
      $ch .= $this->getFinHTML();
      return $ch;
    } else
      exit("Le paramètre d'entrée n'est pas une instance de EntiteP08_Genres");
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
    $ch = '<h1>Les Genre</h1>';
    $ch .= "<form action='' method='get'>
              <p>
                Choisir un numéro : <input type='number' name='idGenre' > 
                <button name='action' value='afficherEntite'>Afficher</button>
              </p>
            </form>";
    $ch .= '<p><a href="controleur.php?action=creerEntite">Créer un nouveau genre</a></p>';
    $ch .= '<ul>';
    foreach ($tabEntities as $genre) {
      if ($genre instanceof EntiteP08_Genres) {
        $ch .= '<li>' . $genre->getIdGenre() . ' ';
        $ch .= $genre->getLibelleGenre() . ' ';

        $ch .= '<a href="controleur.php?action=modifierEntite&idGenre=' . $genre->getIdGenre() . '">Modifier</a> ';
        $ch .= '<a href="controleur.php?action=supprimerEntite&idGenre=' . $genre->getIdGenre() . '">Supprimer</a> ';
        $ch .= '</li>';
      }
    }
    $ch .= '</ul>';
    return $ch . $this->getFinHTML();
  }
}

?>