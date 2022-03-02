<?php
namespace EntitesTransat;
/**
 * Class EntiteSkippeur qui traite les infomrations des skippeurs
 */
class EntiteSkippeur{

    protected $Skippeur_id;
    protected $Skippeur_Nom;
    protected $Skippeur_Prenom;
    protected $Skipeur_DateNaissance;
    protected $Skippeur_Sexe;


    /**
     * @return int
     */
    public function getSkippeurId() : int
    {
        return $this->Skippeur_id;
    }

    /**
     * @return string
     */
    public function getSkippeurSexe() :string
    {
        return $this->Skippeur_Sexe;
    }

    /**
     * @return string
     */
    public function getSkippeurPrenom() : string
    {
        return $this->Skippeur_Prenom;
    }

    /**
     * @return string
     */
    public function getSkippeurNom() :string
    {
        return $this->Skippeur_Nom;
    }

    /**
     * @return mixed
     */
    public function getSkipeurDateNaissance()
    {
        return $this->Skipeur_DateNaissance;
    }

    /**
     * @return string
     */
    public function __toString(){
        $resultat = "EntiteSkippeur { ";
        $resultat.= "Skippeur_id : " . $this->Skippeur_id  .  ", ";
        $resultat.= "Skippeur_nom : " . $this->Skippeur_Nom . ", ";
        $resultat.= "Skippeur_prenom : " . $this->Skippeur_Prenom . ", ";
        $resultat.= "Skippeur_Date : " . $this->Skippeur_Sexe . ", ";
        $resultat.= "Skippeur_sexe : " . $this->Skippeur_Sexe . "";
        $resultat.= "}";

        return $resultat;
    }

}