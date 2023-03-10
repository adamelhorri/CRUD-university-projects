<?php
namespace crudP08\Entites;

class EntiteP08_Personnages extends AbstractEntite
{
  const TABLENAME = 'P08_Personnages';
  static $COLNAMES = array('idPersonne', 'imagePersonnage', 'nomPersonnage', 'voice');
  static $COLTYPES = array('number', 'text', 'text', 'boolean');
  static $PK = array('idPersonne');
  static $AUTOID = FALSE;
  static $FK = array('idPersonne');

  protected int $idPersonne;
  protected string $imagePersonnage;
  protected string $nomPersonnage;
  protected bool $voice;

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
   * Get the value of imagePersonnage
   *
   * @return string
   */
  public function getImagePersonnage(): string
  {
    return $this->imagePersonnage;
  }

  /**
   * Set the value of imagePersonnage
   *
   * @return  self
   */
  public function setImagePersonnage($imagePersonnage): self
  {
    $this->imagePersonnage = $imagePersonnage;

    return $this;
  }

  /**
   * Get the value of nomPersonnage
   *
   * @return string
   */
  public function getNomPersonnage(): string
  {
    return $this->nomPersonnage;
  }

  /**
   * Set the value of nomPersonnage
   *
   * @return  self
   */
  public function setNomPersonnage($nomPersonnage): self
  {
    $this->nomPersonnage = $nomPersonnage;

    return $this;
  }

  /**
   * Get the value of voice
   *
   * @return string
   */
  public function getVoice(): string
  {
    return $this->voice;
  }

  /**
   * Set the value of voice
   *
   * @return  self
   */
  public function setVoice($voice): self
  {
    $this->voice = $voice;

    return $this;
  }


  public function __toString(): string
  {
    return "object:EntiteP08_Personnages (" . $this->idPersonne . ", " . $this->imagePersonnage . ", " . $this->nomPersonnage . ", " . $this->voice . ")";
  }


}

?>