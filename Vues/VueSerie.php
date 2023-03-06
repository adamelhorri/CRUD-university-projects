<?php

require_once("../Entite/EntiteSerie");
require_once("../Entite/AbstractEntite");

class VueSerie extends VueEntite
{

  /**
   * getHTML4Entity
   *
   * @param AbstractEntite|null $entite
   * @return string
   */
  public function getHTML4Entity(AbstractEntite $entite = null): string
  {
    if ($entite instanceof EntiteSerie) {
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
      return $ch;
    } else
      exit("Le paramètre d'entrée n'est pas une instance de EntiteSerie");
  }

  /**
   * getAllEntities
   *
   * @param array $tabEntities
   * @return string
   */
  public function getAllEntities(array $tabEntities): string
  {
    $ch = '<h1>Les Séries</h1>';
    $ch .= "<form action='action.php' method='get'>
              <p>
                Choisir un numéro : <input type='number' name='idSerie' > 
                <button name='action' value='afficherEntite'>Afficher</button>
              </p>
            </form>";
    $ch .= '<p><a href="action.php?action=creerEntite">Créer une nouvelle série</a></p>';
    $ch .= '<ul>';
    foreach ($tabEntities as $serie) {
      if ($serie instanceof EntiteSerie) {
        $ch .= '<li>' . $serie->getIdSerie() . ' ';
        $ch .= $serie->getNomSerie() . ' ';
        $ch .= $serie->getDebutSerie() . ' ';
        $ch .= $serie->getFinSerie() . ' ';
        $ch .= $serie->getNoteSerie() . ' ';
        $ch .= '<a href="action.php?action=modifierEntite&idSerie=' . $serie->getIdSerie() . '">Modifier</a> ';
        $ch .= '<a href="action.php?action=supprimerEntite&idSerie=' . $serie->getIdSerie() . '">Supprimer</a> ';
        $ch .= '</li>';
      }
    }
    return $ch . '</ul>';
  }

  /**
   * getForme4Entity
   *
   * @param AbstractEntite|null $entite
   * @return string
   */
  public function getForme4Entity(AbstractEntite $entite = null): string
  {
    if (is_null($entite)) {
      $ch = '<form action="action.php" method="GET">';
      $ch .= "Id <input type='number' name='idSerie'><br>";
      $ch .= "Nom <input type='text' name='nomSerie'><br>";
      $ch .= "Langue <input type='text' name='langueSerie'><br>";
      $ch .= "Date du début <input type='date' name='debutSerie'><br>";
      $ch .= "Date de la fin <input type='date' name='finSerie'><br>";
      $ch .= "Site Officiel <input type='text' name='siteOfficiel'><br>";
      $ch .= "Note <input type='number' name='noteSerie'><br>";
      $ch .= "Description <textarea name='descriptionSerie'></textarea><br>";
      $ch .= "Spinoff <input type='' name='spinoff'><br>";
      $ch .= '<input type="submit" name="action" value="sauverEntite"/>';
      return $ch . '</form>';
  }
  if ($entite instanceof EntiteSerie) {
      $ch = '<form action="action.php" method="GET">';
      $ch .= "Id <input type='number' name='idSerie' value='" . $entite->getIdSerie() . "'><br>";
      $ch .= "Nom <input type='text' name='nomSerie' value='" . htmlspecialchars($entite->getNomSerie()) . "'><br>";
      $ch .= "Langue <input type='text' name='langueSerie' value='" . htmlspecialchars($entite->getLangueSerie()) . "'><br>";
      $ch .= "Date du début <input type='date' name='debutSerie' valeur='" . $entite->getDebutSerie() . "'><br>";
      $ch .= "Date de la fin <input type='date' name='finSerie' valeur='" . $entite->getFinSerie() != null ? $entite->getFinSerie() : "" . "'><br>";
      $ch .= "Site Officiel <input type='text' name='siteOfficiel' valeur='" . htmlspecialchars($entite->getSiteOfficiel()) . "'><br>";
      $ch .= "Note <input type='number' name='noteSerie' valeur='" . $entite->getNoteSerie() . "'><br>";
      $ch .= "Description <textarea name='descriptionSerie'>" . htmlspecialchars($entite->getDescriptionSerie()) . "</textarea><br>";
      $ch .= "Spinoff <input type='' name='spinoff' valeur='" . $entite->getSpinoff() != null ? $entite->getSpinoff() : "" . "'><br>";
      $ch .= '<input type="submit" name="action" value="sauverEntite"/>';
      return $ch . '</form>';
  } else
      exit("Le paramètre d'entrée n'est pas une instance de EntiteSerie");
  }
}

?>