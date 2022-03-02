<?php
namespace EntitesTransat ;

/**
 * Class EntiteResultat qui gere les informations relatives aux resultats des courses
 */
class EntiteResultat {

    protected $Skipper_id;
    protected $Course_id;
    protected $Duo_id;
    protected $Classement;
    protected $TempsCourse;


    /**
     * @return mixed
     */
    public function getTempsCourse()
    {
        return $this->TempsCourse;
    }

    /**
     * @return mixed
     */
    public function getDuoId()
    {
        return $this->Duo_id;
    }

    /**
     * @return mixed
     */
    public function getClassement()
    {
        return $this->Classement;
    }

    /**
     * @return mixed
     */
    public function getCourseId()
    {
        return $this->Course_id;
    }

    /**
     * @return mixed
     */
    public function getSkipperId()
    {
        return $this->Skipper_id;
    }

    /**
     * @param mixed $Classement
     */
    public function setClassement($Classement)
    {
        $this->Classement = $Classement;
    }

    /**
     * @param mixed $Course_id
     */
    public function setCourseId($Course_id)
    {
        $this->Course_id = $Course_id;
    }

    /**
     * @param mixed $Duo_id
     */
    public function setDuoId($Duo_id)
    {
        $this->Duo_id = $Duo_id;
    }

    /**
     * @param mixed $Skipper_id
     */
    public function setSkipperId($Skipper_id)
    {
        $this->Skipper_id = $Skipper_id;
    }

    /**
     * @param mixed $TempsCourse
     */
    public function setTempsCourse($TempsCourse)
    {
        $this->TempsCourse = $TempsCourse;
    }


    public function __toString(){
        $resultat = "EntiteResultat { ";
        $resultat.= "skippeur_id : " . $this->Skipper_id  .  ", ";
        $resultat.= "course_id : " . $this->Course_id . ", ";
        $resultat.= "duo_id : " . $this->Duo_id . " ";
        $resultat.= "classement : " . $this->Classement . " ";
        $resultat.= "tempsCourse : " . $this->TempsCourse . " ";
        $resultat.= "}";

        return $resultat;
    }
}