<?php
namespace crudP08\Entites;

abstract class AbstractEntite
{
  private bool $persistant;

  /**
   * Get the value of persistant
   *
   * @return boolean
   */
  public function getPersistant(): bool
  {
    return $this->persistant;
  }

  /**
   * Set the value of persistant
   *
   * @param boolean $persistant
   * @return self
   */
  public function setPersistant(bool $persistant): self
  {
    $this->persistant = $persistant;
    return $this;
  }
}

?>