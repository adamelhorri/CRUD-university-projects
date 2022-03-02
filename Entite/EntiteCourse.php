<?php
namespace EntitesTransat ;

/**
 * Class EntiteCourse traite les infomrations des courses
 */
class EntiteCourse{

    protected $Course_id;
    protected $Course_Edition;
    protected $Course_Destination;

    /**
     * @param mixed $Course_Destination
     */
    public function setCourseDestination($Course_Destination)
    {
        $this->Course_Destination = $Course_Destination;
    }

    /**
     * @param mixed $Course_Edition
     */
    public function setCourseEdition($Course_Edition)
    {
        $this->Course_Edition = $Course_Edition;
    }

    /**
     * @param mixed $Course_id
     */
    public function setCourseid($Course_id)
    {
        $this->Course_id = $Course_id;
    }

    /**
     * @return string
     */
    public function getCourseDestination() : string
    {
        return $this->Course_Destination;
    }

    /**
     * @return int
     */
    public function getCourseEdition() :int
    {
        return $this->Course_Edition;
    }

    /**
     * @return int
     */
    public function getCourseid() : int
    {
        return $this->Course_id;
    }


    /**
     * @return string
     */
    public function __toString(){
        $resultat = "EntiteCourse { ";
        $resultat.= "course_id : " . $this->Course_id  .  ", ";
        $resultat.= "course_Edition : " . $this->Course_Edition . ", ";
        $resultat.= "course_Destination : " . $this->Course_Destination . " ";
        $resultat.= "}";

        return $resultat;
    }
}