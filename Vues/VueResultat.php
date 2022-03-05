<?php

use EntitesTransat\EntiteResultat;

class VueResultat{

    /**
     * production d'un string contenant un tableau HTML représentant un Resultat
     * @param EntiteResultat $resultat
     * @return string
     */
    public function getHTML4Entity(EntiteResultat $resultat ) :string{
        $res = "<table border='1'>
        <tr><th>Skipper_id</th>
            <th>Course_id</th>
            <th>Duo_id</th>
            <th>Classement</th>
            <th>TempsCourse</th>
        </tr>";
        $res.= "<tr><td>".$resultat->getSkipperId() . "</td>\n";
        $res.= "<td>".$resultat->getCourseId() . "</td>\n";
        $res.= "<td>".$resultat->getDuoId() . "</td>\n";
        $res.= "<td>".$resultat->getClassement() . "</td>\n";
        $res.= "<td>".$resultat->getTempsCourse() . "</td>\n";
        $res .= "</tr></table>\n";
        return $res;
    }

    /**
     * production d'une string contenant un formulaire HTML
     * destiné à saisir ou à modifier un resultat existant
     * @param array $assoc
     * @return string
     */
    public function getForm4Entity(array $assoc, string $action): string
    {
        $ch = "<form class='box' action='?' method='GET'>\n";
        foreach ($assoc as $col => $val) {
            if (is_array($val)) {
                $ch .= "$col : <div class='field'> <input class='input is-rounded' placeholder='$col'  name='$col' type='".$val['type']
                    ."' value='".$val['default']."' />\n </div>";
            }
            else
                $ch .= "$col : <div class='field'> <input  class='input is-rounded' placeholder='$col' type='$val' name='$col' />\n </div>";
        }
        $ch .= "<input class='button is-info is-rounded' type='submit' name='action' value='$action'/>\n";


        return $ch."</form>\n";
    }



    /**
     * production d'une string contenant une liste HTML représentant un ensemble de Skippeurs
     * et permettant de les modifier ou de les supprimer grace à un lien hypertexte
     * @param array $tabEntiteResultat
     * @return string
     */
    public function getAllEntities(array $tabEntiteResultat): string
    {

        $res = "<div class='columns is-centered'> <div class='column is-half'>  <table class='table is-striped is-hoverable is-fullwidth' border='1'>\n";
        $res.= "<tr>
        <th align='center'>Skipper_id</th> <th align='center'>Course_id</th> <th align='center'>Duo_id</th> <th align='center'>Classement</th> <th align='center'>TempsCourse</th><th></th><th></th>
        </tr>";
        foreach ($tabEntiteResultat as $resultat){
            $res .= "<tr>\n";
            if ($resultat instanceof EntiteResultat){
                $res.= "<td align='center' >".$resultat->getSkipperId()."</td>";
                $res.= "<td align='center' >".$resultat->getCourseId()."</td>";
                $res.= "<td align='center' >".$resultat->getDuoId()."</td>";
                $res.= "<td align='center' >".$resultat->getClassement()."</td>";
                $res.= "<td align='center' >".$resultat->getTempsCourse()."</td>";
                $res.= "<td align='center' >"."<a href='?action=update&Skipper_id=".$resultat->getSkipperId()."&Course_id=".$resultat->getCourseId()."'>Modifier</a>"."</td>";
                $res.= "<td align='center' >"."<a href='?action=delete&Skipper_id=".$resultat->getSkipperId()."&Course_id=".$resultat->getCourseId()."'>Supprimer</a>"."</td>";
            }
            $res.= "</tr>";
        }
        $res .= "</table> </div></div> ";
        return $res;
    }


}