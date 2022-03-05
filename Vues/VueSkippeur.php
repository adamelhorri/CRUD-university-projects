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
        $ch = "<form class='box' action='?' method='GET'>\n";
        foreach ($assoc as $col => $val) {
            if (is_array($val)) {
                $ch .= "$col : <div class='field'> <input class='input is-rounded' placeholder='$col' name='$col' type='".$val['type']
                    ."' value='".$val['default']."' />\n </div>";
            }
            else
                $ch .= "$col : <div class='field'> <input class='input is-rounded' placeholder='$col'  type='$val' name='$col' />\n </div>";
        }
        $ch .= "<input class='button is-info is-rounded' type='submit' name='action' value='$action'/>\n";


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

        $res = "<div class='columns is-centered'><div class='column is-half'><table class='table is-striped is-hoverable is-fullwidth' border='1'>\n";
        $res.= "<tr>
        <th>Skippeur_id</th> <th>Skippeur_Nom</th> <th>Skippeur_Prenom</th> <th>Skipeur_DateNaissance</th> <th>Skippeur_Sexe</th><th></th><th></th>
        </tr>";
        foreach ($tabEntiteSkippeur as $skippeur){
            $res .= "<tr>\n";
            if ($skippeur instanceof EntiteSkippeur){
                $res.= "<td align='center' >".$skippeur->getSkippeurId()."</td>";
                $res.= "<td align='center' >".$skippeur->getSkippeurNom()."</td>";
                $res.= "<td align='center' >".$skippeur->getSkippeurPrenom()."</td>";
                $res.= "<td align='center' >".$skippeur->getSkipeurDateNaissance()."</td>";
                $res.= "<td align='center' >".$skippeur->getSkippeurSexe()."</td>";
                $res.= "<td align='center' >"."<a href='?action=update&Skippeur_id=".$skippeur->getSkippeurId()."'>Modifier</a>"."</td>";
                $res.= "<td align='center' >"."<a href='?action=delete&Skippeur_id=".$skippeur->getSkippeurId()."'>Supprimer</a>"."</td>";
            }
            $res.= "</tr>";
        }
        $res .= "</table></div></div>";
        return $res;
    }





}