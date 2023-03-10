<?php 
namespace crudP08\Entites;

class EntiteP08_Genres extends AbstractEntite
{
  const TABLENAME = 'P08_Genres';
  static $COLNAMES = array('idGenre', 'libelleGenre');
  static $COLTYPES = array('number', 'text');
  static $PK = array('idGenre');
  static $AUTOID = FALSE;
  static $FK = array();
  protected int $idGenre;
  protected string $libelleGenre;

  /**
   * Get the value of idGenre
   * 
   * @return int
   */ 
  public function getIdGenre(): int
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

  /**
   * Get the value of libelleGenre
   * 
   * @return string
   */ 
  public function getLibelleGenre(): string
  {
    return $this->libelleGenre;
  }

  /**
   * Set the value of libelleGenre
   *
   * @return  self
   */ 
  public function setLibelleGenre($libelleGenre): self
  {
    $this->libelleGenre = $libelleGenre;

    return $this;
  }

  public function __toString(): string
  {
    return "object:EntiteP08_Genres (" . $this->idGenre . ", " . $this->libelleGenre . ")";
  }
}

?>