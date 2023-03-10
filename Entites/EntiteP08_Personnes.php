<?php
namespace crudP08\Entites;

class EntiteP08_Personnes extends AbstractEntite
{
  const TABLENAME = 'P08_Personnes';
  static $COLNAMES = array('idPersonne', 'nomPersonne', 'paysPersonne', 'dateNaissancePersonne', 'dateDecesPersonne', 'genrePersonne', 'fonctionPersonne', 'imagePersonne');
  static $COLTYPES = array('number', 'text', 'text', 'date', 'date', 'text', 'text', 'text');
  static $PK = array('idPersonne');
  static $AUTOID = FALSE;
  static $FK = array();

  protected int $idPersonne;
  protected string $nomPersonne;
  protected string $paysPersonne;
  protected mixed $dateNaissancePersonne;
  protected mixed $dateDecesPersonne;
  protected string $genrePersonne;
  protected string $fonctionPersonne;
  protected string $imagePersonne;

  /**
   * Get the value of idPersonne
   *
   * @return int
   */
  public function getIdPersonne(): int
  {
    return $this->idPersonne;
  }

  /**
   * Set the value of idPersonne
   *
   * @return  self
   */
  public function setIdPersonne($idPersonne): self
  {
    $this->idPersonne = $idPersonne;

    return $this;
  }

  /**
   * Get the value of nomPersonne
   *
   * @return string
   */
  public function getNomPersonne(): string
  {
    return $this->nomPersonne;
  }

  /**
   * Set the value of nomPersonne
   *
   * @return  self
   */
  public function setNomPersonne($nomPersonne): self
  {
    $this->nomPersonne = $nomPersonne;

    return $this;
  }

  /**
   * Get the value of paysPersonne
   *
   * @return string
   */
  public function getPaysPersonne(): string
  {
    return $this->paysPersonne;
  }

  /**
   * Set the value of paysPersonne
   *
   * @return  self
   */
  public function setPaysPersonne($paysPersonne): self
  {
    $this->paysPersonne = $paysPersonne;

    return $this;
  }

  /**
   * Get the value of dateNaissancePersonne
   *
   * @return mixed
   */
  public function getDateNaissancePersonne(): mixed
  {
    return $this->dateNaissancePersonne;
  }

  /**
   * Set the value of dateNaissancePersonne
   *
   * @return  self
   */
  public function setDateNaissancePersonne($dateNaissancePersonne): self
  {
    $this->dateNaissancePersonne = $dateNaissancePersonne;

    return $this;
  }

  /**
   * Get the value of dateDecesPersonne
   *
   * @return mixed
   */
  public function getDateDecesPersonne(): mixed
  {
    return $this->dateDecesPersonne;
  }

  /**
   * Set the value of dateDecesPersonne
   *
   * @return  self
   */
  public function setDateDecesPersonne($dateDecesPersonne): self
  {
    $this->dateDecesPersonne = $dateDecesPersonne;

    return $this;
  }

  /**
   * Get the value of genrePersonne
   *
   * @return string
   */
  public function getGenrePersonne(): string
  {
    return $this->genrePersonne;
  }

  /**
   * Set the value of genrePersonne
   *
   * @return  self
   */
  public function setGenrePersonne($genrePersonne): self
  {
    $this->genrePersonne = $genrePersonne;

    return $this;
  }

  /**
   * Get the value of fonctionPersonne
   *
   * @return string
   */
  public function getFonctionPersonne(): string
  {
    return $this->fonctionPersonne;
  }

  /**
   * Set the value of fonctionPersonne
   *
   * @return  self
   */
  public function setFonctionPersonne($fonctionPersonne): self
  {
    $this->fonctionPersonne = $fonctionPersonne;

    return $this;
  }

  /**
   * Get the value of imagePersonne
   *
   * @return string
   */
  public function getImagePersonne(): string
  {
    return $this->imagePersonne;
  }

  /**
   * Set the value of imagePersonne
   *
   * @return  self
   */
  public function setImagePersonne($imagePersonne): self
  {
    $this->imagePersonne = $imagePersonne;

    return $this;
  }

  public function __toString(): string
  {
    return "object:EntiteP08_Personnes (" . $this->idPersonne . ", " . $this->nomPersonne . ", " . $this->paysPersonne . ", " . $this->dateNaissancePersonne . ", " . $this->dateDecesPersonne . ", " . $this->genrePersonne . ", " . $this->fonctionPersonne . ", " . $this->imagePersonne . ")";
  }
}
?>