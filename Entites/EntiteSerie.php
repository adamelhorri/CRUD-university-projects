<?php

class EntiteSerie extends AbstractEntite
{
  const TABLENAME = 'p08_series';
  static $COLNAMES = array('idSerie', 'nomSerie', 'langueSerie', 'debutSerie', 'finSerie', 'siteOfficiel', 'noteSerie', 'imageSerie', 'descriptionSerie', 'spinoff');
  static $COLTYPES = array('number', 'text', 'text', 'date', 'date', 'text', 'number', 'text', 'text', 'number');
  static $PK = array('idSerie');
  static $AUTOID = FALSE;
  static $FK = array();
  protected int $idSerie;
  protected string $nomSerie;
  protected string $langueSerie;
  protected mixed $debutSerie;
  protected mixed $finSerie;
  protected string $siteOfficiel;
  protected float $noteSerie;
  protected string $imageSerie;
  protected string $descriptionSerie;
  protected int $spinoff;


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
   * Get the value of nomSerie
   * 
   * @return string
   */
  public function getNomSerie(): string
  {
    return $this->nomSerie;
  }

  /**
   * Set the value of nomSerie
   *
   * @return  self
   */
  public function setNomSerie($nomSerie): self
  {
    $this->nomSerie = $nomSerie;

    return $this;
  }

  /**
   * Get the value of langueSerie
   * 
   * @return mixed
   */
  public function getLangueSerie(): mixed
  {
    return $this->langueSerie;
  }

  /**
   * Set the value of langueSerie
   *
   * @return  self
   */
  public function setLangueSerie($langueSerie): self
  {
    $this->langueSerie = $langueSerie;

    return $this;
  }

  /**
   * Get the value of finSerie
   * 
   * @return mixed
   */
  public function getFinSerie(): mixed
  {
    return $this->finSerie;
  }

  /**
   * Set the value of finSerie
   *
   * @return  self
   */
  public function setFinSerie($finSerie): self
  {
    $this->finSerie = $finSerie;

    return $this;
  }

  /**
   * Get the value of debutSerie
   * 
   * @return mixed
   */
  public function getDebutSerie(): mixed
  {
    return $this->debutSerie;
  }

  /**
   * Set the value of debutSerie
   *
   * @return  self
   */
  public function setDebutSerie($debutSerie): self
  {
    $this->debutSerie = $debutSerie;

    return $this;
  }

  /**
   * Get the value of siteOfficiel
   * 
   * @return string
   */
  public function getSiteOfficiel(): string
  {
    return $this->siteOfficiel;
  }

  /**
   * Set the value of siteOfficiel
   *
   * @return  self
   */
  public function setSiteOfficiel($siteOfficiel): self
  {
    $this->siteOfficiel = $siteOfficiel;

    return $this;
  }

  /**
   * Get the value of noteSerie
   * 
   * @return float
   */
  public function getNoteSerie(): float
  {
    return $this->noteSerie;
  }

  /**
   * Set the value of noteSerie
   *
   * @return  self
   */
  public function setNoteSerie($noteSerie): self
  {
    $this->noteSerie = $noteSerie;

    return $this;
  }

  /**
   * Get the value of imageSerie
   * 
   * @return string
   */
  public function getImageSerie(): string
  {
    return $this->imageSerie;
  }

  /**
   * Set the value of imageSerie
   *
   * @return  self
   */
  public function setImageSerie($imageSerie): self
  {
    $this->imageSerie = $imageSerie;

    return $this;
  }

  /**
   * Get the value of descriptionSerie
   * 
   * @return string
   */
  public function getDescriptionSerie(): string
  {
    return $this->descriptionSerie;
  }

  /**
   * Set the value of descriptionSerie
   *
   * @return  self
   */
  public function setDescriptionSerie($descriptionSerie): self
  {
    $this->descriptionSerie = $descriptionSerie;

    return $this;
  }

  /**
   * Get the value of spinoff
   * 
   * @return int
   */
  public function getSpinoff(): int
  {
    return $this->spinoff;
  }

  /**
   * Set the value of spinoff
   *
   * @return  self
   */
  public function setSpinoff($spinoff): self
  {
    $this->spinoff = $spinoff;

    return $this;
  }

  public function __toString(): string
  {
    return "object:EntiteSerie (" . $this->idSerie . ", " . $this->nomSerie . ", " . $this->langueSerie . ", " . $this->debutSerie . ", " . $this->finSerie . ", " . $this->siteOfficiel . ", " . $this->noteSerie . ", " . $this->imageSerie . ", " . $this->descriptionSerie . ", " . $this->spinoff . ")";
  }
}

?>