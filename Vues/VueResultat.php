<?php

use EntitesTransat\EntiteResultat;

class VueResultat{

    /**
     * production d'un string contenant un tableau HTML représentant un Resultat d'une course
     * @param EntiteResultat $resultat
     * @return string
     */
    public function getHTML4Entity(EntiteResultat $resultat ) :string{
        $res = "<table border='1'>
        <tr><th>Skippeur_id</th>
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
     * production d'une string contenant une liste HTML représentant un ensemble de Skippeurs
     * et permettant de les modifier ou de les supprimer grace à un lien hypertexte
     * @param array $tabEntiteResultat
     * @return string
     */
    public function getAllEntities(array $tabEntiteResultat): string
    {

        $res = "<table border='1'>\n";
        $res.= "<tr>
        <th>Skippeur_id</th> <th>Course_id</th> <th>Duo_id</th> <th>Classement</th> <th>TempsCourse</th>
        </tr>";
        foreach ($tabEntiteResultat as $resultat){
            $res .= "<tr>\n";
            if ($resultat instanceof EntiteResultat){
                $res.= "<td>".$resultat->getSkipperId()."</td>";
                $res.= "<td>".$resultat->getCourseId()."</td>";
                $res.= "<td>".$resultat->getDuoId()."</td>";
                $res.= "<td>".$resultat->getClassement()."</td>";
                $res.= "<td>".$resultat->getTempsCourse()."</td>";
                $res.= "<td>"."<a href='?action=update&Skippeur_id=".$resultat->getSkipperId().".Course_id=".$resultat->getCourseId()."'>Modifier</a>"."</td>";
                $res.= "<td>"."<a href='?action=delete&Skippeur_id=".$resultat->getSkipperId().".Course_id=".$resultat->getCourseId()."'>Supprimer</a>"."</td>";
            }
            $res.= "</tr>";
        }
        $res .= "</table>";
        return $res;
    }


}