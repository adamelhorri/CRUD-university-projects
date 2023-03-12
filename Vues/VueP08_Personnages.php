<?php

namespace crudP08\Vues;

use crudP08\Entites\AbstractEntite;
use crudP08\Entites\EntiteP08_Personnages;

class VueP08_Personnages extends VueEntite
{

    public function getHTML4Entity(string $select4FK = null, AbstractEntite $entite = null): string
    {
        if ($entite instanceof EntiteP08_Personnages) {
            $ch = "<table width='700'>
              <tr>
                <img src='" . $entite->getImagePersonnage() . "' alt='Image de la personnage' width='350'>
              </tr>
              <tr>
                <th>Id : </th>
                <td>" . $entite->getIdPersonne() . $select4FK . "</td>
              </tr>
              <tr>
                <th>Nom : </th>
                <td>" . $entite->getNomPersonnage() . "</td>
              </tr>
              <tr>
                <th>Voice : </th>
                <td>" . $entite->getVoice() . "</td>
              </tr>\n";
            return $ch;
        } else
            exit("Le paramètre d'entré n'est pas une instance de EntiteP08_Personnages");
    }


    public function getAllEntities(array $tabEntities): string
    {
        $ch = '<h1>Les Personnages</h1>';
        $ch .= "<form action='action.php' method='get'>
              <p>
                Choisir un numéro : <input type='number' name='idPersonne' > 
                <button name='action' value='afficherEntite'>Afficher</button>
              </p>
            </form>";
        $ch .= '<p><a href="action.php?action=creerEntite">Ajouter un nouveau personnage</a></p>';
        $ch .= '<ul>';
        foreach ($tabEntities as $personnage) {
            if ($personnage instanceof EntiteP08_Personnages) {
                $ch .= '<li>' . $personnage->getIdPersonne() . ' ';
                $ch .= $personnage->getNomPersonne() . ' ';
                $ch .= '<a href="action.php?action=modifierEntite&idPersonne=' . $personnage->getIdPersonne() . '">Modifier</a> ';
                $ch .= '<a href="action.php?action=supprimerEntite&idPersonne=' . $personnage->getIdPersonne() . '">Supprimer</a> ';
                $ch .= '</li>';
            }
        }
        return $ch . '</ul>';
    }

}