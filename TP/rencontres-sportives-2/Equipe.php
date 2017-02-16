<?php
class Equipe
{
  private $id;
  private $nom;
  private $logo;
  private $annee_de_creation;

  private $db;

  public function __construct(array $donnees)
  {
    $this->setDb(new PDO('mysql:host=localhost;dbname=formation-php-poo;charset=utf8', 'root'));

    // hydratation: on fournit des valeurs aux propriétés
    if (!empty($donnees)) { // on hydrate que si le tableau des données n'est pas vide
      $this->setId($donnees['id']);
      $this->setNom($donnees['nom']);
      $this->setLogo($donnees['logo']);
      $this->setAnneeDeCreation($donnees['annee_de_creation']);
    }
  }

  public function liste()
  {
    $equipes = [];
    $requete =
    'SELECT DISTINCT nom, id, logo, annee_de_creation
      FROM Equipe GROUP BY nom ORDER BY nom ASC';
    $reponse = $this->db->query($requete);
    while($donnees = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $equipes[] = new Equipe($donnees);
    }
    return $equipes;
  }

  /**
   * Get the value of Nom
   *
   * @return mixed
   */
  public function getNom()
  {
      return $this->nom;
  }

  /**
   * Set the value of Nom
   *
   * @param mixed nom
   *
   * @return self
   */
  public function setNom($nom)
  {
      $this->nom = $nom;

      return $this;
  }

  /**
   * Get the value of Logo
   *
   * @return mixed
   */
  public function getLogo()
  {
      return $this->logo;
  }

  /**
   * Set the value of Logo
   *
   * @param mixed logo
   *
   * @return self
   */
  public function setLogo($logo)
  {
      $this->logo = $logo;

      return $this;
  }

  /**
   * Get the value of Annee De Creation
   *
   * @return mixed
   */
  public function getAnneeDeCreation()
  {
      return $this->annee_de_creation;
  }

  /**
   * Set the value of Annee De Creation
   *
   * @param mixed annee_de_creation
   *
   * @return self
   */
  public function setAnneeDeCreation($annee_de_creation)
  {
      $this->annee_de_creation = $annee_de_creation;

      return $this;
  }

  /**
   * Get the value of Db
   *
   * @return mixed
   */
  public function getDb()
  {
      return $this->db;
  }

  /**
   * Set the value of Db
   *
   * @param mixed db
   *
   * @return self
   */
  public function setDb(PDO $db)
  {
      $this->db = $db;

      return $this;
  }


    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

}

?>
