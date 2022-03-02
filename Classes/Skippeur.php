<?php

/**
 * Class Skippeur qui traite les infomrations des skippeurs
 */
class Skippeur{

    protected $skippeur_id;
    protected $skippeur_nom;
    protected $skippeur_prenom;
    protected $skippeur_Date;
    protected $skippeur_sexe;


    /**
     * Skippeur constructor.
     * @param $skippeur_id
     * @param $skippeur_nom
     * @param $skippeur_prenom
     * @param $skippeur_Date
     * @param $skippeur_sexe
     */
    public function __construct($skippeur_id,$skippeur_nom,$skippeur_prenom,$skippeur_Date,$skippeur_sexe){
        $this->skippeur_id = $skippeur_id;
        $this->skippeur_nom = $skippeur_nom;
        $this->skippeur_prenom = $skippeur_prenom;
        $this->skippeur_Date = $skippeur_Date;
        $this->skippeur_sexe = $skippeur_sexe;
    }


    /**
     * @return mixed
     */
    public function getSkippeurId()
    {
        return $this->skippeur_id;
    }

    /**
     * @return mixed
     */
    public function getSkippeurDate()
    {
        return $this->skippeur_Date;
    }

    /**
     * @return mixed
     */
    public function getSkippeurNom()
    {
        return $this->skippeur_nom;
    }

    /**
     * @return mixed
     */
    public function getSkippeurPrenom()
    {
        return $this->skippeur_prenom;
    }

    /**
     * @return mixed
     */
    public function getSkippeurSexe()
    {
        return $this->skippeur_sexe;
    }

    /**
     * @param mixed $skippeur_id
     */
    public function setSkippeurId($skippeur_id)
    {
        $this->skippeur_id = $skippeur_id;
    }

    /**
     * @param mixed $skippeur_nom
     */
    public function setSkippeurNom($skippeur_nom)
    {
        $this->skippeur_nom = $skippeur_nom;
    }

    /**
     * @param mixed $skippeur_prenom
     */
    public function setSkippeurPrenom($skippeur_prenom)
    {
        $this->skippeur_prenom = $skippeur_prenom;
    }

    /**
     * @param mixed $skippeur_Date
     */
    public function setSkippeurDate($skippeur_Date)
    {
        $this->skippeur_Date = $skippeur_Date;
    }

    /**
     * @param mixed $skippeur_sexe
     */
    public function setSkippeurSexe($skippeur_sexe)
    {
        $this->skippeur_sexe = $skippeur_sexe;
    }


    /**
     * @return string
     */
    public function __toString(){
        $resultat = "Skippeur { ";
        $resultat.= "Skippeur_id : " . $this->skippeur_id  .  ", ";
        $resultat.= "Skippeur_nom : " . $this->skippeur_nom . ", ";
        $resultat.= "Skippeur_prenom : " . $this->skippeur_prenom . ", ";
        $resultat.= "Skippeur_Date : " . $this->skippeur_sexe . ", ";
        $resultat.= "Skippeur_sexe : " . $this->skippeur_sexe . "";
        $resultat.= "}";

        return $resultat;
    }

}