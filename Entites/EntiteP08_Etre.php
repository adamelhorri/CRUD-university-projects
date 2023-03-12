<?php

namespace crudP08\Entites;

class EntiteP08_Etre extends AbstractEntite
{
    const  TABLENAME = 'P08_Etre';
    static $COLNAMES = array('idSerie', 'idGenre');
    static $COLTYPES = array('number', 'number');
    static $PK = array();
    static $AUTOID = FALSE;
    static $FK = array('idSerie', 'idGenre');

    protected int $idSerie;
    protected int $idGenre;


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
     * Get the value of idGenre
     *
     * @return int
     */
    public function getIdGenre(): string
    {
        return $this->idGenre;
    }

    /**
     * Set the value of idGenre
     *
     * @return  self
     */
    public function setIdGenre($idGenre): self
    {
        $this->idGenre = $idGenre;

        return $this;
    }


    public function __toString(): string
    {
        return "object:EntiteP08_Role (" . $this->idSerie . ", " . $this->idGenre . ")";
    }
}

?>