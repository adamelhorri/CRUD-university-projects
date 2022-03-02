<?php

namespace EntitesTransat ;

class EntiteConduit {

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