<?php

use EntitesTransat\EntiteConduit;

class VueConduit{

    /**
     * production d'un string contenant un tableau HTML représentant un enregistrement
     * @param EntiteConduit $conduit
     * @return string
     */
    public function getHTML4Entity(EntiteConduit $conduit ) :string{

        $res = "<table border='1'>
        <tr><th>Skipper_id</th>
            <th>Bateau_id</th>
        </tr>";
        $res.= "<tr><td>".$conduit->getSkippeurId() . "</td>\n";
        $res.= "<td>".$conduit->getBateauId() . "</td>\n";
        $res .= "</tr></table>\n";
        return $res;
    }

    /**
     * production d'une string contenant un formulaire HTML
     * destiné à saisir ou  à modifier
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
     * production d'une string contenant une liste HTML représentant un ensemble de course
     * et permettant de les modifier ou de les supprimer grace à un lien hypertexte
     * @param array $tabEntiteConduit
     * @return string
     */
    public function getAllEntities(array $tabEntiteConduit): string
    {

        $res = "<table border='1'>\n";
        $res.= "<tr>
       <th>Skipper_id</th> <th>Bateau_id</th> 
        </tr>";
        foreach ($tabEntiteConduit as $conduit){
            $res .= "<tr>\n";
            if ($conduit instanceof EntiteConduit){
                $res.= "<td>".$conduit->getSkippeurId()."</td>";
                $res.= "<td>".$conduit->getBateauId()."</td>";
                $res.= "<td>"."<a href='?action=update&Skippeur_id=".$conduit->getSkippeurId().".Bateau_id=".$conduit->getBateauId()."'>Modifier</a>"."</td>";
                $res.= "<td>"."<a href='?action=delete&Skippeur_id=".$conduit->getSkippeurId().".Bateau_id=".$conduit->getBateauId()."'>Supprimer</a>"."</td>";
            }
            $res.= "</tr>";
        }
        $res .= "</table>";
        return $res;
    }

}