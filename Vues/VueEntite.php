<?php
namespace crudP08\Vues;

require_once("../php-crud/Entites/AbstractEntite.php");
require_once("AbstractVueRelation.php");

use crudP08\Entites\AbstractEntite;
use crudP08\Vues\AbstractVueRelation;

abstract class VueEntite extends AbstractVueRelation
{
  /**
   * getHTML4Entity
   *
   * @param  AbstractEntite $entite
   * @return string
   */
  public abstract function getHTML4Entity(string $select4FK = null, AbstractEntite $entite = null): string;

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
   * @param AbstractEntite|null $entite
   * @return string
   */
  public function getForme4Entity(array $assoc = null, string $select4FK = null, AbstractEntite $entite = null, int $id, string $fk = null): string
  {
    if (is_null($entite)) {
      $ch = "";
      $ch .= $this->getDebutHTML();
      $ch = '<form action="" method="GET">';
      $cpt = 0;
      foreach($assoc as $key => $value){
        if($cpt == 0 && $fk != 'idPersonne'){
          $ch .= $key . ' <input type="number" name="' . $key . '" value="' . $id . '" readonly><br>';
          $cpt++;
        }
        else{
          if($key == $fk)
            $ch .= $key . ' ' . $select4FK . '</br>';
          else if($value == 'textarea')
            $ch .= $key . '<textarea name="' . $key . '"></textarea><br>';
          else if($value == 'boolean'){
            $ch .= $key . '<select name="' . $key . '">
                      <option value="true">True</option>
                      <option value="false">False</option>
                    </select><br>';
          }
          else
            $ch .= $key . ' <input type="' . $value . '" name="' . $key . '"><br>';
        }
      }
      $ch .= "<button name='action' value='insererEntite'>Insérer</button>";
      $ch .= "</form>";
      return $ch . $this->getFinHTML();
    }
    if ($entite instanceof AbstractEntite) {
      $ch = "";
      $ch .= $this->getDebutHTML();
      $ch = '<form action="" method="GET">';
      $cpt = 0;
      foreach($assoc as $key => $value){
        if($cpt == 0 && $fk != 'idPersonne'){
          $ch .= $key . ' <input type="number" name="' . $key . '" value="' . $id . '" readonly><br>';
          $cpt++;
        }
        else{
          if($key == $fk)
            $ch .= $key . ' ' . $select4FK . '<br>';
          else if($value == 'textarea')
            $ch .= $key . '<textarea name="' . $key . '">' . htmlspecialchars($entite->{'get' . ucfirst($key)}()) . '</textarea><br>';
          else if($value == 'boolean'){
            $ch .= $key . '<select name="' . $key . '">';
            if(htmlspecialchars($entite->{'get' . ucfirst($key)}())){
              $ch .= '<option value="true" selected>True</option>
              <option value="false">False</option>';
            }
            else{
              $ch .= '<option value="true">True</option>
              <option value="false" selected>False</option>';
            }
            $ch .= '</select><br>';
          }
          else
            $ch .= $key . ' <input type="' . $value . '" name="' . $key . '" value="' . htmlspecialchars($entite->{'get' . ucfirst($key)}()) . '"><br>';
        }
      }
      $ch .= "<button name='action' value='sauverEntite'>Sauvegarder</button>";
      $ch .= '</form>';
      return $ch . $this->getFinHTML();
    } else
      exit("Le paramètre d'entrée n'est pas valide");
  }
  }

?>