<?php

namespace crudP08\Entites;

require_once("AbstractEntite.php");

use crudP08\Entites\AbstractEntite;

class EntiteP08_Role extends AbstractEntite
{
  const TABLENAME = 'P08_Role';
  static $COLNAMES = array('idSerie', 'idPersonne');
  static $COLTYPES = array('number', 'number');
  static $PK = array();
  static $AUTOID = FALSE;
  static $FK = array('idSerie', 'idPersonne');

  protected int $idSerie;
  protected int $idPersonne;


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
   * Get the value of idPersonne
   *
   * @return int
   */
  public function getIdPersonne(): string
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


  public function __toString(): string
  {
    return "object:EntiteP08_Role (" . $this->idSerie . ", " . $this->idPersonne . ")";
  }
}

?>