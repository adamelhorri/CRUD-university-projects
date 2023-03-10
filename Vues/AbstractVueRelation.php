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
<title>CRUD-Series-télévisées</title>
<link rel='stylesheet' href='global.css' />
</head>
<body> ";
  }

  /**
   *
   * @return string
   */
  public function getFintHTML(): string
  {
    return "
</body>
</html>\n";
    ;
  }

}

?>