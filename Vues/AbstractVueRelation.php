<?php
namespace crudP08\Vues;

class AbstractVueRelation
{
  /**
   *
   * @return string
   */
  public function getDebutHTML(): string
  {
    return "<!DOCTYPE html>
        <html lang='fr'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'/>
<link rel='shortcut icon' href='favicon.png' type='image/x-icon' />
<title>Série télévisées</title>
</head>
<body> ";
  }

  /**
   *
   * @return string
   */
  public function getFinHTML(): string
  {
    return "
    </main>
    <script src='./js/listeTables.js'></script>
</body>
</html>\n";
    ;
  }

  public static function getListe(): string
  {
    return "<aside class='side-bar translate-100' id='side-bar'>
    <img src='./images/icon-arrow.svg' class='arrow' id='arrow'>
    <img src='./images/clip.png' alt='logo' id='logo' />
    <ul class='nav-bar'>
      <div class='tables'>
        <li class='table-link orange'>
          <a href='" . $_SERVER['PHP_SELF'] . "?action=selectionnerTable&table_name=P08_Series'>Séries</a>
        </li>
        <li class='table-link blue'>
          <a href='" . $_SERVER['PHP_SELF'] . "?action=selectionnerTable&table_name=P08_Saisons'>Saisons</a>
        </li>
        <li class='table-link red'>
          <a href='" . $_SERVER['PHP_SELF'] . "?action=selectionnerTable&table_name=P08_Episodes'>Episodes</a>
        </li>
        <li class='table-link green'>
          <a href='" . $_SERVER['PHP_SELF'] . "?action=selectionnerTable&table_name=P08_Personnes'>Personnes</a>
        </li>
        <li class='table-link orange'>
          <a href='" . $_SERVER['PHP_SELF'] . "?action=selectionnerTable&table_name=P08_Personnages'>Personnages</a>
        </li>
        <li class='table-link blue'>
          <a href='" . $_SERVER['PHP_SELF'] . "?action=selectionnerTable&table_name=P08_Genres'>Genres</a>
        </li>
        <li class='table-link red'>
          <a href='" . $_SERVER['PHP_SELF'] . "?action=selectionnerTable&table_name=P08_Prix'>Prix</a>
        </li>
        <li class='table-link green'>
          <a href='" . $_SERVER['PHP_SELF'] . "?action=selectionnerTable&table_name=AssociationSerie'>Associations série</a>
        </li>
      </div>
      <div class='accueil'>
        <a href='./index.html'>Accueil</a>
      </div>
    </ul>
    </aside>
    <main>";
  }

}
?>