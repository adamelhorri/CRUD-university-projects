<?php

class EntiteEpisode extends AbstractEntite
{
    const TABLENAME = 'p08_episodes';
    static $COLNAMES = array('idEpisode', 'nomEpisode', 'numEpisode', 'dateDiffusionEpisode', 'noteEpisode', 'descriptionEpisode','dureeEpisode');
    static $COLTYPES = array('number', 'text', 'number', 'date', 'number', 'text','number');
    static $PK = array('idEpisode');
    static $AUTOID = FALSE;
    static $FK = array('idSaison');
    protected int $idEpisode;
    protected string $nomEpisode;
    protected int $numEpisode;
    protected mixed $dateDiffusionEpisode;
    protected mixed $noteEpisode;
    protected string $descriptionEpisode;
    protected int $dureeEpisode ;


    /**
     * Get the value of idEpisode
     *
     * @return int
     */
    public function getIdEpisode(): int
    {
        return $this->idEpisode;
    }

    /**
     * Set the value of idEpisode
     *
     * @return  self
     */
    public function setIdEpisode($idEpisode): self
    {
        $this->idEpisode = $idEpisode;

        return $this;
    }

    /**
     * Get the value of nomEpisode
     *
     * @return string
     */
    public function getNomEpisode(): string
    {
        return $this->nomEpisode;
    }

    /**
     * Set the value of nomEpisode
     *
     * @return  self
     */
    public function setNomEpisode($nomEpisode): self
    {
        $this->nomEpisode = $nomEpisode;

        return $this;
    }

    /**
     * Get the value of numEpisode
     *
     * @return int
     */
    public function getnumEpisode(): int
    {
        return $this->numEpisode;
    }

    /**
     * Set the value of numEpisode
     *
     * @return  self
     */
    public function setnumEpisode($numEpisode): self
    {
        $this->numEpisode = $numEpisode;

        return $this;
    }

    /**
     * Get the value of dateDiffusionEpisode
     *
     * @return mixed
     */
    public function getDateDiffusionEpisode(): mixed
    {
        return $this->dateDiffusionEpisode;
    }

    /**
     * Set the value of dateDiffusionEpisode
     *
     * @return  self
     */
    public function setDateDiffusionEpisode($dateDiffusionEpisode): self
    {
        $this->dateDiffusionEpisode = $dateDiffusionEpisode;

        return $this;
    }

    /**
     * Get the value of noteEpisode
     *
     * @return mixed
     */
    public function getNoteEpisode(): mixed
    {
        return $this->noteEpisode;
    }

    /**
     * Set the value of noteEpisode
     *
     * @return  self
     */
    public function setNoteEpisode($noteEpisode): self
    {
        $this->noteEpisode = $noteEpisode;

        return $this;
    }


    /**
     * Get the value of descriptionEpisode
     *
     * @return string
     */
    public function getDescriptionEpisode(): string
    {
        return $this->descriptionEpisode;
    }

    /**
     * Set the value of descriptionEpisode
     *
     * @return  self
     */
    public function setDescriptionEpisode($descriptionEpisode): self
    {
        $this->descriptionEpisode = $descriptionEpisode;

        return $this;
    }
    /**
     * Get the value of dureeEpisode
     *
     * @return int
     */
    public function getDureeEpisode(): int
    {
        return $this->dureeEpisode;
    }

    /**
     * Set the value of dureeEpisode
     *
     * @return  self
     */
    public function setDureeEpisode($dureeEpisode): self
    {
        $this->dureeEpisode = $dureeEpisode;

        return $this;
    }

    public function __toString(): string
    {
        return "object:EntiteEpisode (" . $this->idEpisode . ", " . $this->nomEpisode . ", " . $this->numEpisode . ", " . $this->dateDiffusionEpisode . ", " . $this->noteEpisode . ", "  . $this->descriptionEpisode .", " .$this->dureeEpisode. ")";
    }
}

?>