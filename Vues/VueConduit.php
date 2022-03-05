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
        $ch = "<form class='box' action='?' method='GET'>\n";
        foreach ($assoc as $col => $val) {
            if (is_array($val)) {
                $ch .= "$col : <div class='field'> <input class='input is-rounded' placeholder='$col' name='$col' type='".$val['type']
                    ."' value='".$val['default']."' />\n </div>";
            }
            else
                $ch .= "$col : <div class='field'>  <input class='input is-rounded' placeholder='$col' type='$val' name='$col' />\n </div>";
        }
        $ch .= "<input class='button is-info is-rounded' type='submit' name='action' value='$action'/>\n";


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

        $res = "<div class='columns is-centered'><div class='column is-half'> <table  class='table is-striped is-hoverable is-fullwidth' border='1'>\n";
        $res.= "<tr>
       <th align='center'>Skipper_id</th> <th align='center'>Bateau_id</th> <th></th> 
        </tr>";
        foreach ($tabEntiteConduit as $conduit){
            $res .= "<tr>\n";
            if ($conduit instanceof EntiteConduit){
                $res.= "<td align='center' >".$conduit->getSkippeurId()."</td>";
                $res.= "<td align='center' >".$conduit->getBateauId()."</td>";
                $res.= "<td align='center' >"."<a href='?action=delete&Skippeur_id=".$conduit->getSkippeurId()."&Bateau_id=".$conduit->getBateauId()."'>Supprimer</a>"."</td>";
            }
            $res.= "</tr>";
        }
        $res .= "</table>";
        return $res;
    }

}