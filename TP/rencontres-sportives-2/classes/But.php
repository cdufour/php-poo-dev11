<?php
class But{
  private $id;
  private $rencontre;
  private $joueur;
  private $minute;
  private $db;

  public function __construct(array $donnees)
  {
    $this->setDb(new PDO('mysql:host=localhost;dbname=formation-php-poo;charset=utf8', 'root'));
    $this->hydrate($donnees);
  }

  public function hydrate($donnees)
  {
    foreach($donnees as $key => $value) {
      $method = 'set' . ucfirst($key);

      if (method_exists($this, $method)) {
        $this->$method($value);
      }
    }
  }


  public function enregistrer()
  {
    $requete = $this->db->prepare(
      'INSERT INTO But(rencontre, joueur, minute)
      VALUES(:rencontre, :joueur, :minute)');
    $requete->bindValue(':rencontre', $this->getRencontre());
    $requete->bindValue(':joueur', $this->getJoueur());
    $requete->bindValue(':minute', $this->getMinute());
    $requete->execute();
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getRencontre()
  {
    return $this->rencontre;
  }

  public function setRencontre($rencontre)
  {
    $this->rencontre = $rencontre;
  }

  public function getJoueur()
  {
    return $this->joueur;
  }

  public function setJoueur($joueur)
  {
    $this->joueur = $joueur;
  }

  public function getMinute()
  {
    return $this->minute;
  }

  public function setMinute($minute)
  {
    $this->minute = $minute;
  }

  public function getDb()
  {
    return $this->db;
  }

  public function setDb(PDO $db)
  {
    $this->db = $db;
  }

}

?>
