<?php

use EntitesTransat\EntiteSkippeur;
class VueSkippeur
{


    /**
     * production d'un string contenant un tableau HTML représentant un Skippeur
     * @param EntiteSkippeur $skippeur
     * @return string
     */
    public function getHTML4Entity(EntiteSkippeur $skippeur ) :string{
        $res = "<table border='1'>
        <tr><th>Skippeur_id</th>
            <th>Skippeur_Nom</th>
            <th>Skippeur_Prenom</th>
            <th>Skipeur_DateNaissance</th>
            <th>Skippeur_Sexe</th>
        </tr>";
        $res.= "<tr><td>".$skippeur->getSkippeurId() . "</td>\n";
        $res.= "<td>".$skippeur->getSkippeurNom() . "</td>\n";
        $res.= "<td>".$skippeur->getSkippeurPrenom() . "</td>\n";
        $res.= "<td>".$skippeur->getSkipeurDateNaissance() . "</td>\n";
        $res.= "<td>".$skippeur->getSkippeurSexe() . "</td>\n";
        $res .= "</tr></table>\n";
        return $res;
    }

    /**
     * production d'une string contenant un formulaire HTML
     * destiné à saisir ou à modifier un skippeur existant
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
     * @param array $tabEntiteSkippeur
     * @return string
     */
    public function getAllEntities(array $tabEntiteSkippeur): string
    {

        $res = "<table border='1'>\n";
        $res.= "<tr>
        <th>Skippeur_id</th> <th>Skippeur_Nom</th> <th>Skippeur_Prenom</th> <th>Skipeur_DateNaissance</th> <th>Skippeur_Sexe</th>
        </tr>";
        foreach ($tabEntiteSkippeur as $skippeur){
            $res .= "<tr>\n";
            if ($skippeur instanceof EntiteSkippeur){
                $res.= "<td>".$skippeur->getSkippeurId()."</td>";
                $res.= "<td>".$skippeur->getSkippeurNom()."</td>";
                $res.= "<td>".$skippeur->getSkippeurPrenom()."</td>";
                $res.= "<td>".$skippeur->getSkipeurDateNaissance()."</td>";
                $res.= "<td>".$skippeur->getSkippeurSexe()."</td>";
                $res.= "<td>"."<a href='?action=update&Skippeur_id=".$skippeur->getSkippeurId()."'>Modifier</a>"."</td>";
                $res.= "<td>"."<a href='?action=delete&Skippeur_id=".$skippeur->getSkippeurId()."'>Supprimer</a>"."</td>";
            }
            $res.= "</tr>";
        }
        $res .= "</table>";
        return $res;
    }





}