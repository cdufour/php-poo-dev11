<?php

interface Taxable
{
  const ISF = "Impôt de solidarité sur la fortune";

  // INDERDIT une interface ne propose que des comportements (méthodes)
  //public $test;
  public function imposer();
}

interface Punissable
{
  public function emprisonner($duree);
}

class Footballer implements Taxable, Punissable
{
  public function imposer(){
    echo 'Je suis imposé à 50%';
  }

  public function emprisonner($duree)
  {
    //
  }
}

class Mafioso implements Taxable, Punissable
{
  public function imposer(){
    echo 'Je bute la famille de celui qui me prend un centime';
  }
  public function emprisonner($duree){}
}

$lemina = new Footballer();
$corleone = new Mafioso();

$lemina->imposer();
echo '<br />';
$corleone->imposer();

// les constantes d'interface sont propagées aux classes qui les implémente
echo '<p>interface Taxable: ' . Taxable::ISF . '</p>';
echo '<p>classe Footballer: ' . Footballer::ISF . '</p>';
echo '<p>classe Mafioso: ' . Mafioso::ISF . '</p>';


?>
