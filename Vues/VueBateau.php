<?php
use EntitesTransat\EntiteBateau;

class VueBateau
{

    /**
     * production d'un string contenant un tableau HTML représentant un Bateau
     * @param EntiteBateau $bateau
     * @return string
     */
    public function getHTML4Entity(EntiteBateau $bateau ) :string{

        $res = "<table border='1'>
        <tr><th>Bateau_id</th>
            <th>Bateau_Nom</th>
            <th>Bateau_Anne</th>
            <th>Bateau_Longueur</th>
            <th>Bateau_Type</th>
        </tr>";
        $res.= "<tr><td>".$bateau->getBateauId() . "</td>\n";
        $res.= "<td>".$bateau->getBateauNom() . "</td>\n";
        $res.= "<td>".$bateau->getBateauAnne() . "</td>\n";
        $res.= "<td>".$bateau->getBateauLongueur() . "</td>\n";
        $res.= "<td>".$bateau->getBateauType() . "</td>\n";
        $res .= "</tr></table>\n";
        return $res;
    }

    /**
     * production d'une string contenant un formulaire HTML
     * destiné à saisir  ou à modifier un Bateau existant
     * @param array $assoc
     * @return string
     */
    public function getForm4Entity(array $assoc, string $action ): string
    {
        $ch = "<form action='?' method='GET'>\n";
        foreach ($assoc as $col => $val) {
            if (is_array($val)) {
                $ch .= "$col : <input name='$col' type='".$val['type']
                    ."' value='".$val['default']."' />\n";
            }
            else
                $ch .= "$col : <input type='$val' name='$col' />\n";
        }
        $ch .= "<input type='submit' name='action' value='$action'/>\n";


        return $ch."</form>\n";
    }


    /**
     * production d'une string contenant une liste HTML représentant un ensemble de Bateaux
     * et permettant de les modifier ou de les supprimer grace à un lien hypertexte
     * @param array $tabEntiteBateau
     * @return string
     */
    public function getAllEntities(array $tabEntiteBateau): string
    {

        $res = "<table border='1'>\n";
        $res.= "<tr>
        <th>Bateau_id</th> <th>Bateau_Nom</th> <th>Bateau_Anne</th> <th>Bateau_Longueur</th> <th>Bateau_Type</th>
        </tr>";
        foreach ($tabEntiteBateau as $bateau){
            $res .= "<tr>\n";
            if ($bateau instanceof EntiteBateau){
                $res.= "<td>".$bateau->getBateauId()."</td>";
                $res.= "<td>".$bateau->getBateauNom()."</td>";
                $res.= "<td>".$bateau->getBateauAnne()."</td>";
                $res.= "<td>".$bateau->getBateauLongueur()."</td>";
                $res.= "<td>".$bateau->getBateauType()."</td>";
                $res.= "<td>"."<a href='?action=update&Bateau_id=".$bateau->getBateauId()."'>Modifier</a>"."</td>";
                $res.= "<td>"."<a href='?action=delete&Bateau_id=".$bateau->getBateauId()."'>Supprimer</a>"."</td>";
            }
            $res.= "</tr>";
        }
        $res .= "</table>";
        return $res;
    }
}