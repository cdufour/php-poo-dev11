<?php

abstract class Animal
{
  // On oblige la ou les classes héritières à implémenter la méthode
  abstract public function hurler();
}

class Felin extends Animal
{
  // implémentation de la méthode abstraite imposée par la classe parente
  public function hurler() {}
}

//$animal = new Animal(); // Erreur fatale
// il est interdit d'instancier une classe abstraite
$felin = new Felin();

?>
