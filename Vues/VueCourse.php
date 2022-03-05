<?php

use EntitesTransat\EntiteCourse;

class VueCourse
{

    /**
     * production d'un string contenant un tableau HTML représentant une course
     * @param EntiteCourse $course
     * @return string
     */
    public function getHTML4Entity(EntiteCourse $course ) :string{

        $res = "<table border='1'>
        <tr><th>Course_id</th>
            <th>Course_Edition</th>
            <th>Course_Destination</th>
        </tr>";
        $res.= "<tr><td>".$course->getCourseid() . "</td>\n";
        $res.= "<td>".$course->getCourseEdition() . "</td>\n";
        $res.= "<td>".$course->getCourseDestination() . "</td>\n";
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
                $ch .= "$col : <div class='field'>  <input class='input is-rounded' placeholder='$col'  name='$col' type='".$val['type']
                    ."' value='".$val['default']."' />\n </div>";
            }
            else
                $ch .= "$col :<div class='field'>  <input class='input is-rounded' placeholder='$col' type='$val' name='$col' />\n </div>";
        }
        $ch .= "<input class='button is-info is-rounded'  type='submit' name='action' value='$action'/>\n";


        return $ch."</form>\n";
    }


    /**
     * production d'une string contenant une liste HTML représentant un ensemble de course
     * et permettant de les modifier ou de les supprimer grace à un lien hypertexte
     * @param array $tabEntiteCourse
     * @return string
     */
    public function getAllEntities(array $tabEntiteCourse): string
    {

        $res = "<div class='columns is-centered'> <div class='column is-half'> <table class='table is-striped is-hoverable is-fullwidth' border='1'>\n";
        $res.= "<tr>
        <th>Course_id</th> <th>Course_Edition</th> <th>Course_Destination</th> <th></th> <th></th> 
        </tr>";
        foreach ($tabEntiteCourse as $course){
            $res .= "<tr>\n";
            if ($course instanceof EntiteCourse){
                $res.= "<td align='center' >".$course->getCourseid()."</td>";
                $res.= "<td align='center' >".$course->getCourseEdition()."</td>";
                $res.= "<td align='center' >".$course->getCourseDestination()."</td>";
                $res.= "<td align='center' >"."<a href='?action=update&Course_id=".$course->getCourseid()."'>Modifier</a>"."</td>";
                $res.= "<td align='center' >"."<a href='?action=delete&Course_id=".$course->getCourseid()."'>Supprimer</a>"."</td>";
            }
            $res.= "</tr>";
        }
        $res .= "</table> </div></div> ";
        return $res;
    }

}