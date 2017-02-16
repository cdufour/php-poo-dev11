<?php
// Database Manager
class DBM{
  private $db;
  public $classname;

  public function __construct($classname)
  {
    $this->classname = $classname;
    $this->setDb(new PDO('mysql:host=localhost;dbname=formation-php-poo;charset=utf8', 'root'));
  }

  public function findAll()
  {
    $collection = [];

    $requete = "SELECT * FROM {$this->classname}";
    $resultat = $this->db->query($requete);

    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
      $collection[] = new $this->classname($donnees); // important : hydrater l'objet
    }

    return $collection; // retourne un tableau d'objets
  }

  public function findById($id)
  {
    $requete = "SELECT * FROM {$this->classname} WHERE id = :id LIMIT 1";
    $prepare = $this->db->prepare($requete);
    $prepare->bindValue(':id', $id);
    $prepare->execute();

    // hydratation de l'objet en passant au constructeur le retour sql "fetched"
    $objet = new $this->classname($prepare->fetch());
    return $objet;
  }

  public function delete($id)
  {
    $requete = "DELETE FROM {$this->classname} WHERE id = :id";
    $prepare = $this->db->prepare($requete);
    $prepare->bindValue(':id', $id);

    return $prepare->execute();
  }

  public function getDb()
  {
    return $db;
  }

  public function setDb(PDO $db)
  {
    $this->db = $db;
  }
}

?>
