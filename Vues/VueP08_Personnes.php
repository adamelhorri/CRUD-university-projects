<?php
namespace crudP08\Vues;

require_once("../php-crud/Entites/EntiteP08_Personnes.php");
require_once("../php-crud/Entites/AbstractEntite.php");
require_once("VueEntite.php");

use crudP08\Entites\AbstractEntite;
use crudP08\Entites\EntiteP08_Personnes;
use crudP08\Vues\VueEntite;

class VueP08_Personnes extends VueEntite
{

  public function getHTML4Entity(string $select4FK = null, AbstractEntite $entite = null): string
  {
    if ($entite instanceof EntiteP08_Personnes) {
      $ch = "";
      $ch .= $this->getDebutHTML();
      $ch = "<table width='700'>
              <tr>
                <img src='" . $entite->getImagePersonne() . "' alt='Image de la personne' width='350'>
              </tr>
              <tr>
                <th>Id : </th>
                <td>" . $entite->getIdPersonne() . "</td>
              </tr>
              <tr>
                <th>Nom : </th>
                <td>" . $entite->getNomPersonne() . "</td>
              </tr>
              <tr>
                <th>Pays : </th>
                <td>" . $entite->getPaysPersonne() . "</td>
              </tr>
              <tr>
                <th>Date de naissance : </th>
                <td>" . $entite->getDateNaissancePersonne() . "</td>
              </tr>
              <tr>
                <th>Date de décès : </th>
                <td>" . $entite->getDateDecesPersonne() . "</td>
              </tr>
              <tr>
                <th>Genre : </th>
                <td>" . $entite->getGenrePersonne() . "</td>
              </tr>
              <tr>
                <th>Fonction : </th>
                <td>" . $entite->getFonctionPersonne() . "</td>
              </tr>\n";
      $ch .= $this->getFinHTML();
      return $ch;
    } else
      exit("Le paramètre d'entrée n'est pas une instance de EntiteP08_Personnes");
  }


  public function getAllEntities(array $tabEntities): string
  {
    $ch = "";
    $ch .= $this->getDebutHTML();
    $ch = '<h1>Les Personnes</h1>';
    $ch .= "<form action='' method='get'>
              <p>
                Choisir un numéro : <input type='number' name='idPersonne' > 
                <button name='action' value='afficherEntite'>Afficher</button>
              </p>
            </form>";
    $ch .= '<p><a href="controleur.php?action=creerEntite">Ajouter une nouvelle personne</a></p>';
    $ch .= '<ul>';
    foreach ($tabEntities as $personne) {
      if ($personne instanceof EntiteP08_Personnes) {
        $ch .= '<li>' . $personne->getIdPersonne() . ' ';
        $ch .= $personne->getNomPersonne() . ' ';
        $ch .= $personne->getGenrePersonne() . ' ';
        $ch .= $personne->getDateNaissancePersonne() . ' ';
        $ch .= $personne->getFonctionPersonne() . ' ';
        $ch .= '<a href="controleur.php?action=modifierEntite&idPersonne=' . $personne->getIdPersonne() . '">Modifier</a> ';
        $ch .= '<a href="controleur.php?action=supprimerEntite&idPersonne=' . $personne->getIdPersonne() . '">Supprimer</a> ';
        $ch .= '</li>';
      }
    }
    $ch .= '</ul>';
    return $ch . $this->getFinHTML();
  }
}