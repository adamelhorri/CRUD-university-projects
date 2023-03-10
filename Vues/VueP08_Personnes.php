<?php
namespace crudP08\Vues;

require_once("EntiteP08_Personnes");
require_once("AbstractEntite");

use crudP08\Entites\AbstractEntite;
use crudP08\Entites\EntiteP08_Personnes;

class VueP08_Personnes extends VueEntite
{
    
    public function getHTML4Entity(AbstractEntite $entite = null): string
    {
        if ($entite instanceof EntiteP08_Personnes) {
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
            return $ch;
        } else
            exit("Le paramètre d'entrée n'est pas une instance de EntiteP08_Personnes");
    }


    public function getAllEntities(array $tabEntities): string
    {
        $ch = '<h1>Les Personnes</h1>';
        $ch .= "<form action='action.php' method='get'>
              <p>
                Choisir un numéro : <input type='number' name='idPersonne' > 
                <button name='action' value='afficherEntite'>Afficher</button>
              </p>
            </form>";
        $ch .= '<p><a href="action.php?action=creerEntite">Ajouter une nouvelle personne</a></p>';
        $ch .= '<ul>';
        foreach ($tabEntities as $personne) {
            if ($personne instanceof EntiteP08_Personnes) {
                $ch .= '<li>' . $personne->getIdPersonne() . ' ';
                $ch .= $personne->getNomPersonne() . ' ';
                $ch .= $personne->getGenrePersonne() . ' ';
                $ch .= $personne->getDateNaissancePersonne() . ' ';
                $ch .= $personne->getFonctionPersonne() . ' ';
                $ch .= '<a href="action.php?action=modifierEntite&idPersonne=' . $personne->getIdPersonne() . '">Modifier</a> ';
                $ch .= '<a href="action.php?action=supprimerEntite&idPersonne=' . $personne->getIdPersonne() . '">Supprimer</a> ';
                $ch .= '</li>';
            }
        }
        return $ch . '</ul>';
    }

    public function getForme4Entity(AbstractEntite $entite = null): string
    {
        if (is_null($entite)) {
            $ch = '<form action="action.php" method="GET">';
            $ch .= "Id <input type='number' name='idPersonne'><br>";
            $ch .= "Nom <input type='text' name='nomPersonne'><br>";
            $ch .= "Pays <input type='text' name='paysPersonne'><br>";
            $ch .= "Date de naissance <input type='date' name='dateNaissancePersonne'><br>";
            $ch .= "Date de décès <input type='date' name='dateDecesPersonne'><br>";
            $ch .= "Genre <input type='text' name='genrePersonne'><br>";
            $ch .= "Fonction <input type='text' name='fonctionPersonne'><br>";
            $ch .= '<input type="submit" name="action" value="sauverEntite"/>';
            return $ch . '</form>';
        }
        if ($entite instanceof EntiteP08_Personnes) {
            $ch = '<form action="action.php" method="GET">';
            $ch .= "Id <input type='number' name='idPersonne' value='" . $entite->getIdPersonne() . "'><br>";
            $ch .= "Nom <input type='text' name='nomPersonne' value='" . htmlspecialchars($entite->getNomPersonne()) . "'><br>";
            $ch .= "Pays <input type='text' name='paysPersonne' value='" . htmlspecialchars($entite->getPaysPersonne()) . "'><br>";
            $ch .= "Date de naissance <input type='date' name='dateNaissancePersonne' valeur='" . $entite->getDateNaissancePersonne() . "'><br>";
            $ch .= "Date de décès <input type='date' name='dateDecesPersonne' valeur='" . $entite->getDateDecesPersonne() != null ? $entite->getDateDecesPersonne() : "" . "'><br>";
            $ch .= "Genre <input type='text' name='genrePersonne' valeur='" . htmlspecialchars($entite->getGenrePersonne()) . "'><br>";
            $ch .= "Fonction <input type='text' name='fonctionPersonne' valeur='" . htmlspecialchars($entite->getFonctionPersonne()) . "'><br>";
            $ch .= '<input type="submit" name="action" value="sauverEntite"/>';
            return $ch . '</form>';
        } else
            exit("Le paramètre d'entrée n'est pas une instance de EntiteP08_Personnes");
    }
}