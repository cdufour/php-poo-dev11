<?php
class Competition
{
  private $id;
  private $nom;

  public function __construct(array $donnees)
  {
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

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getNom()
  {
    return $this->nom;
  }

  public function setNom($nom)
  {
    $this->nom = $nom;
  }

}

?>
