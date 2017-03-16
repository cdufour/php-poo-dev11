<?php

class MaClasse
{
  public $attribut1 = "Premier attribut public";
  public $attribut2 = "Deuxième attribut public";

  protected $attributProtege1 = "Premier attribut protégé";
  protected $attributProtege2 = "Deuxième attribut protégé";

  private $attributPrive1 = "Premier attribut privé";
  private $attributPrive2 = "Deuxième attribut privé";

  function listeAttributs()
  {
    foreach($this as $attribut => $valeur) {
      echo '<strong>' . $attribut . '</strong> => ' . $valeur . '<br />';
    }
  }
}

class Enfant extends MaClasse
{
  function listeAttributs()
  {
    foreach($this as $attribut => $valeur) {
      echo '<strong>' . $attribut . '</strong> => ' . $valeur . '<br />';
    }
  }
}

$classe = new MaClasse();
$enfant = new Enfant();

echo '--- Liste des attributs depuis l\'intérieur de la classe principale ---<br />';
$classe->listeAttributs();

echo '--- Liste des attributs depuis l\'intérieur de la classe enfant ---<br />';
$enfant->listeAttributs();

echo '--- Liste des attributs depuis le script global (extérieur de la classe) ---<br />';
foreach($classe as $attribut => $valeur) {
  echo '<strong>' . $attribut . '</strong> => ' . $valeur . '<br />';
}

?>
