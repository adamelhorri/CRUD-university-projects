<?php
namespace crudP08\Vues;

require_once("../Entites/EntiteP08_Prix.php");
require_once("../Entites/AbstractEntite.php");

use crudP08\Entites\AbstractEntite;
use crudP08\Entites\EntiteP08_Prix;

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
        $ch = '<h1>Les Prix</h1>';
        $ch .= "<form action='action.php' method='get'>
              <p>
                Choisir un numéro : <input type='number' name='idPrix' > 
                <button name='action' value='afficherEntite'>Afficher</button>
              </p>
            </form>";
        $ch .= '<p><a href="action.php?action=creerEntite">Créer un nouveau prix</a></p>';
        $ch .= '<ul>';
        foreach ($tabEntities as $prix) {
            if ($prix instanceof EntiteP08_Prix) {
                $ch .= '<li>' . $prix->getIdPrix() . ' ';
                $ch .= $prix->getNomPrix() . ' ';
                $ch .= $prix->getCategoriePrix() . ' ';
                $ch .= '<a href="action.php?action=modifierEntite&idPrix=' . $prix->getIdPrix() . '">Modifier</a> ';
                $ch .= '<a href="action.php?action=supprimerEntite&idPrix=' . $prix->getIdPrix() . '">Supprimer</a> ';
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
            $ch .= "Id <input type='number' name='idPrix'><br>";
            $ch .= "Nom <input type='text' name='nomPrix'><br>";
            $ch .= "Catégorie <input type='text' name='categoriePrix'><br>";
            $ch .= '<input type="submit" name="action" value="sauverEntite"/>';
            return $ch . '</form>';
        }
        if ($entite instanceof EntiteP08_Prix) {
            $ch = '<form action="action.php" method="GET">';
            $ch .= "Id <input type='number' name='idPrix' value='" . $entite->getIdPrix() . "'><br>";
            $ch .= "Nom <input type='text' name='nomPrix' value='" . htmlspecialchars($entite->getNomPrix()) . "'><br>";
            $ch .= "Catégorie <input type='text' name='categoriePrix' value='" . htmlspecialchars($entite->getCategoriePrix()) . "'><br>";
            $ch .= '<input type="submit" name="action" value="sauverEntite"/>';
            return $ch . '</form>';
        } else
            exit("Le paramètre d'entrée n'est pas une instance de EntiteP08_Prix");
    }
}

?>