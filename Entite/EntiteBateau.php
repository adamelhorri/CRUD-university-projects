<?php

namespace EntitesTransat ;
/**
 * Class EntiteBateau qui traite les infomrations relatives aux bateaux
 */
class EntiteBateau{

    protected $Bateau_id;
    protected $Bateau_Nom;
    protected $Bateau_Anne;
    protected $Bateau_Longueur;
    protected $Bateau_Type;


    /**
     * @param int $Bateau_Anne
     */
    public function setBateauAnne(int $Bateau_Anne)
    {
        $this->Bateau_Anne = $Bateau_Anne;
    }

    /**
     * @param int $Bateau_id
     */
    public function setBateauId(int $Bateau_id)
    {
        $this->Bateau_id = $Bateau_id;
    }

    /**
     * @param float $Bateau_Longueur
     */
    public function setBateauLongueur(float $Bateau_Longueur)
    {
        $this->Bateau_Longueur = $Bateau_Longueur;
    }

    /**
     * @param string $Bateau_Nom
     */
    public function setBateauNom(string $Bateau_Nom)
    {
        $this->Bateau_Nom = $Bateau_Nom;
    }

    /**
     * @param string $Bateau_Type
     */
    public function setBateauType(string  $Bateau_Type)
    {
        $this->Bateau_Type = $Bateau_Type;
    }

    /**
     * @return int
     */
    public function getBateauAnne() : int
    {
        return $this->Bateau_Anne;
    }

    /**
     * @return int
     */
    public function getBateauId() : int
    {
        return $this->Bateau_id;
    }

    /**
     * @return float
     */
    public function getBateauLongueur() : float
    {
        return $this->Bateau_Longueur;
    }

    /**
     * @return string
     */
    public function getBateauNom() : string
    {
        return $this->Bateau_Nom;
    }

    /**
     * @return string
     */
    public function getBateauType() : string
    {
        return $this->Bateau_Type;
    }


    /**
     * @return string
     */
    public function __toString(){
        $resultat = "EntiteBateau { ";
        $resultat.= "Bateau_id : " . $this->Bateau_id  .  ", ";
        $resultat.= "Bateau_nom : " . $this->Bateau_Nom . ", ";
        $resultat.= "Bateau_Annee : " . $this->Bateau_Anne . ", ";
        $resultat.= "Bateau_Longueur : " . $this->Bateau_Longueur . ", ";
        $resultat.= "Bateau_Type : " . $this->Bateau_Type . "";
        $resultat.= "}";

        return $resultat;
    }

}