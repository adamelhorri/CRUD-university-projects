<?php

require_once("../Entite/EntiteGenre");
require_once("../Entite/AbstractEntite");

class VueGenre extends VueEntite
{

    /**
     * getHTML4Entity
     *
     * @param AbstractEntite|null $entite
     * @return string
     */
    public function getHTML4Entity(AbstractEntite $entite = null): string
    {
        if ($entite instanceof EntiteGenre) {
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
            return $ch;
        } else
            exit("Le paramètre d'entrée n'est pas une instance de EntiteGenre");
    }

    /**
     * getAllEntities
     *
     * @param array $tabEntities
     * @return string
     */
    public function getAllEntities(array $tabEntities): string
    {
        $ch = '<h1>Les Genre</h1>';
        $ch .= "<form action='action.php' method='get'>
              <p>
                Choisir un numéro : <input type='number' name='idGenre' > 
                <button name='action' value='afficherEntite'>Afficher</button>
              </p>
            </form>";
        $ch .= '<p><a href="action.php?action=creerEntite">Créer un nouveau genre</a></p>';
        $ch .= '<ul>';
        foreach ($tabEntities as $genre) {
            if ($genre instanceof EntiteGenre) {
                $ch .= '<li>' . $genre->getIdGenre() . ' ';
                $ch .= $genre->getLibelleGenre() . ' ';

                $ch .= '<a href="action.php?action=modifierEntite&idGenre=' . $genre->getIdGenre() . '">Modifier</a> ';
                $ch .= '<a href="action.php?action=supprimerEntite&idGenre=' . $genre->getIdGenre() . '">Supprimer</a> ';
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
            $ch .= "Id <input type='number' name='idGenre'><br>";
            $ch .= "Libelle <input type='text' name='libelleGenre'><br>";

            $ch .= '<input type="submit" name="action" value="sauverEntite"/>';
            return $ch . '</form>';
        }
        if ($entite instanceof EntiteGenre) {
            $ch = '<form action="action.php" method="GET">';
            $ch .= "Id <input type='number' name='idGenre' value='" . $entite->getIdGenre() . "'><br>";
            $ch .= "Libelle <input type='text' name='libelleGenre' value='" . htmlspecialchars($entite->getLibelleGenre()) . "'><br>";

            $ch .= '<input type="submit" name="action" value="sauverEntite"/>';
            return $ch . '</form>';
        } else
            exit("Le paramètre d'entrée n'est pas une instance de EntiteGenre");
    }
}

?>