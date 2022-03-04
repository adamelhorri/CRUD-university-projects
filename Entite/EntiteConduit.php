<?php

namespace EntitesTransat ;
require_once "AbstractEntite.php";

class EntiteConduit extends AbstractEntite {

    const TABLENAME = 'Course';
    static $COLNAMES = array(
        'Skipper_id',
        'Bateau_id',
    );
    static $COLTYPES = array(
        'number',
        'number',
    );
    static $PK = array('Skipper_id',"Bateau_id" );
    static $AUTOID = False;
    static $FK = array('Skipper_id',"Bateau_id" );

    protected $Skipper_id;
    protected $Bateau_id;



    /**
     * @return int
     */
    public function getSkippeurId() : int
    {
        return $this->Skipper_id;
    }

    /**
     * @return int
     */
    public function getBateauId() : int
    {
        return $this->Bateau_id;
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
        $resultat = "EntiteResultat { ";
        $resultat.= "skippeur_id : " . $this->Skipper_id  .  ", ";
        $resultat.= "bateau_id : " . $this->Bateau_id . ", ";
        $resultat.= "}";

        return $resultat;
    }
}