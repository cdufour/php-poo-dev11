<?php
  echo '<h1>Formation PHP POO</h1>';

  // approche procédurale
  function creeEquipe($nom, $logo, $annee_de_creation) {
    $equipe = array(
      'nom' => $nom,
      'logo' => $logo,
      'annee_de_creation' => $annee_de_creation
    );
    return $equipe;
  }

  //echo gettype($equipe);
  //echo $equipe['nom'];

  $psg        = creeEquipe('PSG', '', 1970);
  $juventus   = creeEquipe('Juventus', '', 1897);
  $arsenal    = creeEquipe('Arsenal', '', 1886);

  echo 'La Juve a été fondée en ' . $juventus['annee_de_creation'];

  // approche OO
  class Equipe {
    // propriétés/attributs
    private $nom = 'OL';
    public $logo;
    private $annee_de_creation;
    protected $entraineur;

    public function __set($name, $value) {
      //throw new Exception('Cant set!');
    }
    // méthodes
    public function getNom() {
      // getter = accesseur, accès en lecture

      // valable uniquement si on veut retourner une variable
      // locale (propre à la function)
      //return $nom;

      return $this->nom; // $this est une référence à la classe
    }

    public function setNom($nom) {
      // setter = mutateur, accès en écriture
      $this->nom = $nom;
    }

    public function getEntraineur() {
      return $this->entraineur;
    }

    public function setEntraineur($entraineur) {
      return $this->entraineur = $entraineur;
    }
  }

  class Joueur {
    private $nom;
    public function __construct($nom) {
      //echo '__construct() éxécutée !';
      $this->nom = $nom;
    }

    public function afficheNom() {
      echo $this->nom;
    }
  }

  class EquipeFoot extends Equipe {
    // l'héritage n'est ici pas justifié
  }

  class Sport {
    private $nom;
    private $nb_joueurs;
    private $est_olympique;

    public function getNom() {
      return $this->nom;
    }

    public function setNom($nom) {
      return $this->nom = $nom;
    }

    public function getNbJoueurs() {
      return $this->nb_joueurs;
    }

    public function setNbJoueurs($nb_joueurs) {
      return $this->nb_joueurs = $nb_joueurs;
    }

    public function getEstOlympique() {
      return $this->est_olympique;
    }

    public function setEstOlympique($est_olympique) {
      return $this->est_olympique = $est_olympique;
    }
  }

  $football = new Sport();
  $football->setNom('Football');
  $football->setNbJoueurs(11);
  $football->setEstOlympique(true);

  $handball = new Sport();
  $handball->setNom('handball');
  $handball->setNbJoueurs(6);
  $handball->setEstOlympique(true);

  $footFlorentin = new Sport();
  $footFlorentin->setNom('Foot florentin');
  $footFlorentin->setNbJoueurs(20);
  $footFlorentin->setEstOlympique(false);

  $sports = array($football, $handball, $footFlorentin);
  var_dump($sports);

  echo '<p>' . sizeof($sports) . '</p>';

  function afficheListeSports($sports, $estOlympique) {
    $listeHtml = '<ul>';

    for($i=0; $i<sizeof($sports); $i++) {
      $sport = $sports[$i];
      if ($sport->getEstOlympique() === $estOlympique) {
        $listeHtml .= '<li>' . $sport->getNom() . '</li>';
      }
    }

    $listeHtml .= '</ul>';
    echo $listeHtml;
  }

  afficheListeSports($sports, $estOlympique = true);

  afficheListeSports($sports, $estOlympique = false);

  // afficher la liste des sports olympiques (en utilisant balise ul)

  $chelsea = new EquipeFoot();
  $chelsea->setNom('Chelsea');
  echo '<p>' . $chelsea->getNom() . '</p>';

  $higuain = new Joueur('Gonzalo Higuain');
  $higuain->afficheNom();

  $realMadrid = new Equipe(); // objet instancié à partir de Equipe
  $cskMoscou = new Equipe();

  echo gettype($realMadrid);
  //echo $realMadrid->nom;
  //$realMadrid->nom = "Real de Madrid";
  //echo $realMadrid->nom;
  //echo $realMadrid->entraineur;
  //echo $realMadrid->test();
  echo $realMadrid->getNom();
  $realMadrid->setNom('Read de Madrid');
  echo $realMadrid->getNom();

  $cskMoscou->setEntraineur('Platini');
  echo $cskMoscou->getEntraineur();
  $cskMoscou->championnat = "Russie";

  $obj = new stdClass(); // stdClass = classe primive (vide) permettant
  // de créer un objet vide auquel on attribuera des propriétés de manière
  // dynamique
  echo '<p>'.gettype($obj).'</p>';
  $obj->couleur = "rouge";
  $obj->forme = "triangle";
  var_dump($obj);

?>
