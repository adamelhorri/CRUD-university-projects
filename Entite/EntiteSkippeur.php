<?php

namespace EntitesTransat;
require_once "AbstractEntite.php";

/**
 * Class EntiteSkippeur qui traite les infomrations des skippeurs
 */
class EntiteSkippeur extends AbstractEntite {

    const TABLENAME = 'Skippeur';
    static $COLNAMES = array(
        'Skippeur_id',
        'Skippeur_Nom',
        'Skippeur_Prenom',
        'Skipeur_DateNaissance',
        'Skippeur_Sexe',
    );
    static $COLTYPES = array(
        'number',
        'text',
        'text',
        'date',
        'text'
    );
    static $PK = array('Skippeur_id');
    static $AUTOID = TRUE;
    static $FK = array();

    protected $Skippeur_id;
    protected $Skippeur_Nom;
    protected $Skippeur_Prenom;
    protected $Skipeur_DateNaissance;
    protected $Skippeur_Sexe;


    /**
     * renvoie un tableau associatif contient comme clé les noms des colonnes de la table
     * et comme valeur leurs valeur
     * @return array
     */
    public function getEntiteArray() : array{
        $tab = array(
            'Skippeur_id' => $this->getSkippeurId(),
            'Skippeur_Nom' => $this->getSkippeurNom(),
            'Skippeur_Prenom' => $this->getSkippeurPrenom(),
            'Skipeur_DateNaissance' => $this->getSkipeurDateNaissance(),
            'Skippeur_Sexe' => $this->getSkippeurSexe(),
        );
        return  $tab;
    }

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
     * @return bool
     */
    public function getPersistant(): bool
    {
        return $this->presistant;
    }

    /**
     * @param bool $persistant
     */
    public function setPersistant(bool $persistant): void
    {
        $this->presistant = presistant;
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