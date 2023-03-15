<?php
namespace crudP08\Vues;

require_once("AbstractVueRelation.php");

use crudP08\Vues\AbstractVueRelation;

class VueAssociationsP08_Serie extends AbstractVueRelation
{
  public function getHTML4Association(string $select4Serie, string $assoc, string $select4FK, string $ajouterAssoc): string
  {
    $ch = "";
    $ch .= $this->getDebutHTML();
    $ch .= '<h1>Association ' . $assoc . '</h1>';
    $ch .= '<form action="" method="GET">
              <input type="hidden" name="action" value="selectionnerTable">
              <input type="hidden" name="table_name" value="AssociationSerie">
              <button type="submit" name="Association" value="P08_Etre" ' . ($assoc == "Etre" ? "disabled" : "") . '>Genres</button>
              <button type="submit" name="Association" value="P08_Role" ' . ($assoc == "Role" ? "disabled" : "") . '>Personnes</button>
              <button type="submit" name="Association" value="P08_Remporter" ' . ($assoc == "Remporter" ? "disabled" : "") . '>Prix</button>
            </form>';
    $ch .= '<form action="" method="GET">';
    $ch .= 'Série : ' . $select4Serie . '<br>';
    $ch .= '<br>';
    $ch .= '</form>';
    $ch .= "<form action='' method='GET'><input type='hidden' name='action' value='ajouterAssoc'> ";
    $ch .= $ajouterAssoc;
    $ch .= "<input type='submit' value='Ajouter'></form><br>";
    $ch .= $select4FK;
    $ch .= $this->getFinHTML();
    return $ch;
  }
}
?>