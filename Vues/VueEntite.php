<?php
namespace crudP08\Vues;

require_once("../Entites/AbstractEntite.php");

use crudP08\Entites\AbstractEntite;

abstract class VueEntite extends AbstractVueRelation
{
  /**
   * getHTML4Entity
   *
   * @param  AbstractEntite $entite
   * @return string
   */
  public abstract function getHTML4Entity(AbstractEntite $entite = null): string;

  /**
   * getAllEntities
   *
   * @param  array $tabEntities
   * @return string
   */
  public abstract function getAllEntities(array $tabEntities): string;

  /**
   * getForme4Entity
   *
   * @param  AbstractEntite $entite
   * @return string
   */
  public abstract function getForme4Entity(AbstractEntite $entite = null): string;
}

?>