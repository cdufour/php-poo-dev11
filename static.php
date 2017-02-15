<?php
define('VERSION', 1.2);
define('FORCE_FAIBLE', 2);
define('FORCE_MOYENNE', 5);

class Combattant{

  const FORCE_FAIBLE = 2;
  const FORCE_MOYENNE = 5;
  const FORCE_ELEVEE = 9;

  public function __construct($name, $force) {
    $this->name = $name;
    $this->force = $force;
    // A chaque instanciation, on incrémente le nombre de combattants
    // ce nombre est mémorisé au niveau de la classe elle-même
    self::$nb_combattant++;
  }

  private $name;
  private $force;
  public static $nb_combattant = 0; // propriété de classe comptant le nombre d'objets produits
  private static $devise = "Morituri te salutant";

  public function afficheName() {
    echo $this->name;
  }

  public static function getDevise() {
    return self::$devise;
  }

}

$fighter    = new Combattant('Luciano', FORCE_FAIBLE);
$fighter2   = new Combattant('Farid', Combattant::FORCE_ELEVEE);
$fighter3   = new Combattant('Edinson', Combattant::FORCE_FAIBLE);

echo '<p>Nombre de combattants sur le ring: ' . Combattant::$nb_combattant . '</p>';

//echo $figher->devise; // Erreur: on ne peut pas accéder à une propriété statique depuis un objet
//echo Combattant::$devise; // valable uniquement si $devise est publique
echo Combattant::getDevise();

$fighter->afficheName();





?>
