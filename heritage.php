<?php
// Heritage

// le php n'autorise le multi-héritage
// une classe ne pas étrendre plus d'une salle classe
// ERREUR: class Fiston extends Papa, Maman

class Maman {
  public $metier = "Nageuse";
}

class Papa {
  public $metier = "Avocat";
  private $salaire = 120000;

  public function getSalaire()
  {
    return $this->salaire;
  }
}

class Fiston extends Papa {
  public function getSalaire()
  {
    return 'Pas encore de salaire';
  }
}


$p = new Papa();
$f = new Fiston();

echo $p->metier . '<br />';
echo $f->metier . '<br />';

echo $p->getSalaire() . '<br />';
echo $f->getSalaire() . '<br />';

?>
