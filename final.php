<?php

abstract class Animal
{

}

final class Felin extends Animal
{

}

// Erreur fatale. Il est interdit d'hériter d'une classe finale
// class Tigre extends Felin{}

class Insecte extends Animal
{
  final public function attaquer() {
    echo 'L\'insecte attaque<br />';
  }
}

class Fourmi extends Insecte
{
  // Erreur fatale. Il est interdit de réécrire une méthode
  // que la classe parente a définie comme finale
  public function attaquer() {
    echo 'La fourmi attaque<br />';
  }
}

$felin = new Felin();
$insecte = new Insecte();
//$fourmi = new Fourmi();

$insecte->attaquer();
//$fourmi->attaquer();

?>
