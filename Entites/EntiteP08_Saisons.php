<?php
namespace crudP08\Entites;

require_once("AbstractEntite.php");

use crudP08\Entites\AbstractEntite;

class EntiteP08_Saisons extends AbstractEntite
{
  const TABLENAME = 'P08_Saisons';
  static $COLNAMES = array('idSaison', 'idSerie', 'nomSaison', 'numSaison', 'debutSaison', 'finSaison', 'imageSaison');
  static $COLTYPES = array('number', 'number', 'text', 'text', 'date', 'date', 'text');
  static $PK = array('idSaison');
  static $AUTOID = FALSE;
  static $FK = array('idSerie');
  protected int $idSaison;
  protected int $idSerie;
  protected string $nomSaison;
  protected int $numSaison;
  protected mixed $debutSaison;
  protected mixed $finSaison;
  protected ?string $imageSaison;


  /**
   * Get the value of idSaison
   *
   * @return int
   */
  public function getIdSaison(): int
  {
    return $this->idSaison;
  }

  /**
   * Set the value of idSaison
   *
   * @return  self
   */
  public function setIdSaison($idSaison): self
  {
    $this->idSaison = $idSaison;

    return $this;
  }

  /**
   * Get the value of nomSaison
   *
   * @return string
   */
  public function getNomSaison(): string
  {
    return $this->nomSaison;
  }

  /**
   * Set the value of nomSaison
   *
   * @return  self
   */
  public function setNomSaison($nomSaison): self
  {
    $this->nomSaison = $nomSaison;

    return $this;
  }

  /**
   * Get the value of numSaison
   *
   * @return int
   */
  public function getnumSaison(): mixed
  {
    return $this->numSaison;
  }

  /**
   * Set the value of numSaison
   *
   * @return  self
   */
  public function setnumSaison($numSaison): self
  {
    $this->numSaison = $numSaison;

    return $this;
  }

  /**
   * Get the value of debutSaison
   *
   * @return mixed
   */
  public function getDebutSaison(): mixed
  {
    return $this->debutSaison;
  }

  /**
   * Set the value of debutSaison
   *
   * @return  self
   */
  public function setDebutSaison($debutSaison): self
  {
    $this->debutSaison = $debutSaison;

    return $this;
  }

  /**
   * Get the value of finSaison
   *
   * @return mixed
   */
  public function getFinSaison(): mixed
  {
    return $this->finSaison;
  }

  /**
   * Set the value of finSaison
   *
   * @return  self
   */
  public function setFinSaison($finSaison): self
  {
    $this->finSaison = $finSaison;

    return $this;
  }


  /**
   * Get the value of imageSaison
   *
   * @return string
   */
  public function getImageSaison(): ?string
  {
    return $this->imageSaison;
  }

  /**
   * Set the value of imageSaison
   *
   * @return  self
   */
  public function setImageSaison($imageSaison): self
  {
    $this->imageSaison = $imageSaison;

    return $this;
  }

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
  public function setIdSerie($idSerie)
  {
    $this->idSerie = $idSerie;

    return $this;
  }

  public function __toString(): string
  {
    return "object:EntiteP08_Saisons (" . $this->idSaison . ", " . $this->idSaison . ", " . $this->nomSaison . ", " . $this->numSaison . ", " . $this->debutSaison . ", " . $this->finSaison . ", " . $this->imageSaison . ")";
  }
}

?>