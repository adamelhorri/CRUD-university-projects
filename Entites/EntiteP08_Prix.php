<?php
namespace crudP08\Entites;

require_once("AbstractEntite.php");

use crudP08\Entites\AbstractEntite;

class EntiteP08_Prix extends AbstractEntite
{
  const TABLENAME = 'P08_Prix';
  static $COLNAMES = array('idPrix', 'nomPrix', 'categoriePrix');
  static $COLTYPES = array('number', 'text', 'text');
  static $PK = array('idPrix');
  static $AUTOID = FALSE;
  static $FK = array();
  protected int $idPrix;
  protected string $nomPrix;
  protected string $categoriePrix;


  /**
   * Get the value of idPrix
   *
   * @return int
   */
  public function getIdPrix(): int
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
   * Get the value of nomPrix
   *
   * @return string
   */
  public function getNomPrix(): string
  {
    return $this->nomPrix;
  }

  /**
   * Set the value of nomPrix
   *
   * @return  self
   */
  public function setNomPrix($nomPrix): self
  {
    $this->nomPrix = $nomPrix;

    return $this;
  }
  /**
   * Get the value of categoriePrix
   *
   * @return string
   */
  public function getCategoriePrix(): string
  {
    return $this->categoriePrix;
  }

  /**
   * Set the value of categoriePrix
   *
   * @return  self
   */
  public function setCategoriePrix($categoriePrix): self
  {
    $this->categoriePrix = $categoriePrix;

    return $this;
  }

  public function __toString(): string
  {
    return "object:EntiteP08_Prix (" . $this->idPrix . ", " . $this->nomPrix . ", " . $this->categoriePrix . ")";
  }
}

?>