<?php

namespace crudP08\Entites;

class EntiteP08_Remporter extends AbstractEntite
{
    const  TABLENAME = 'P08_Remporter';
    static $COLNAMES = array('idSerie', 'idPrix','annee');
    static $COLTYPES = array('number', 'number','number');
    static $PK = array();
    static $AUTOID = FALSE;
    static $FK = array('idSerie', 'idPrix','annee');

    protected int $idSerie;
    protected int $idPrix;
    protected int $annee;


    /**
     * Get the value of idSerie
     *
     * @return int
     */
    public function getIdSerie(): int
    {
        return $this->idSerie;
    }

    /**
     * Set the value of idSerie
     *
     * @return  self
     */
    public function setIdSerie($idSerie): self
    {
        $this->idSerie = $idSerie;

        return $this;
    }

    /**
     * Get the value of idPrix
     *
     * @return int
     */
    public function getIdPrix(): string
    {
        return $this->idPrix;
    }

    /**
     * Set the value of idPrix
     *
     * @return  self
     */
    public function setIdPrix($idPrix): self
    {
        $this->idPrix = $idPrix;

        return $this;
    }
    /**
     * Get the value of annee
     *
     * @return string
     */
    public function getNomPersonne(): string
    {
        return $this->annee;
    }

    /**
     * Set the value of annee
     *
     * @return  self
     */
    public function setNomPersonne($annee): self
    {
        $this->annee = $annee;

        return $this;
    }


    public function __toString(): string
    {
        return "object:EntiteP08_Role (" . $this->idSerie . ", " . $this->idPrix . ",".$this->annee.")";
    }
}

?>