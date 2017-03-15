<?php
class Rencontre
{
  private $id;
  private $equipe1;
  private $equipe2;
  private $score1;
  private $score2;
  private $date;
  private $lieu;
  private $competition;

  private $db;

  // Constructeur
  public function __construct(array $donnees = [])
  {
    $this->setDb(new PDO('mysql:host=localhost;dbname=formation-php-poo;charset=utf8', 'root'));

    // hydratation: on fournit des valeurs aux propriétés
    if (!empty($donnees)) { // on hydrate que si le tableau des données n'est pas vide
      if (isset($donnees['id'])) $this->setId($donnees['id']);
      $this->setEquipe1($donnees['equipe1']);
      $this->setScore1($donnees['score1']);
      $this->setEquipe2($donnees['equipe2']);
      $this->setScore2($donnees['score2']);
      $this->setDate($donnees['date']);
      $this->setLieu($donnees['lieu']);
      $this->setCompetition($donnees['competition']);
    }

  }

  // fonction d'enregistrement en base de données
  public function enregistrer()
  {
    $requete = $this->db->prepare(
      'INSERT INTO Rencontre(equipe1, equipe2, score1, score2, date, lieu, competition)
      VALUES(:equipe1, :equipe2, :score1, :score2, :date, :lieu, :competition)');
    $requete->bindValue(':equipe1', $this->getEquipe1());
    $requete->bindValue(':equipe2', $this->getEquipe2());
    $requete->bindValue(':score1', $this->getScore1());
    $requete->bindValue(':score2', $this->getScore2());
    $requete->bindValue(':date', $this->getDate(null));
    $requete->bindValue(':lieu', $this->getLieu());
    $requete->bindValue(':competition', $this->getCompetition());
    $requete->execute();

    // renvoie l'id (AI) de la dernière ligne ajouté
    // renvoie 0 en cas de problème
    return $this->db->lastInsertId();
  }

  public function liste()
  {
    $rencontres = [];
    // $requete = 'SELECT * FROM Rencontre';

    /*
    $requete =
    'SELECT nom AS equipe1, equipe2, score1, score2, date, lieu, competition
    FROM equipe, rencontre WHERE equipe.id = rencontre.equipe1';
    */

    $requete =
    'SELECT rencontre.id, E1.nom AS equipe1, E2.nom As equipe2, score1, score2, date, lieu, C.nom AS competition
      FROM rencontre
        INNER JOIN equipe E1 ON rencontre.equipe1 = E1.id
        INNER JOIN equipe E2 ON rencontre.equipe2 = E2.id
        INNER JOIN competition C ON rencontre.competition = C.id';

    $reponse = $this->db->query($requete);
    while($donnees = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $rencontres[] = new Rencontre($donnees);
    }
    return $rencontres;
  }

  public function resultat($separateur)
  {
    return $this->getScore1() . $separateur . $this->getScore2();
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getEquipe1($retourneObjet = false)
  {
    if ($retourneObjet) {
      $requete = 'SELECT * FROM Equipe WHERE nom = :nom LIMIT 1';
      $prepare = $this->db->prepare($requete);
      $prepare->bindValue(':nom', $this->getEquipe1());
      $prepare->execute();

      $equipe = new Equipe($prepare->fetch());
      return $equipe;

    } else {
      return $this->equipe1; // renvoie une chaîne
    }

  }

  /**
   * Set the value of Equipe
   *
   * @param mixed equipe1
   *
   * @return self
   */
  public function setEquipe1($equipe1)
  {
      $this->equipe1 = $equipe1;

      return $this;
  }

  /**
   * Get the value of Equipe
   *
   * @return mixed
   */
  public function getEquipe2()
  {
      return $this->equipe2;
  }

  /**
   * Set the value of Equipe
   *
   * @param mixed equipe2
   *
   * @return self
   */
  public function setEquipe2($equipe2)
  {
      $this->equipe2 = $equipe2;

      return $this;
  }

  /**
   * Get the value of Score
   *
   * @return mixed
   */
  public function getScore1()
  {
      return $this->score1;
  }

  /**
   * Set the value of Score
   *
   * @param mixed score1
   *
   * @return self
   */
  public function setScore1($score1)
  {
      $this->score1 = $score1;

      return $this;
  }

  /**
   * Get the value of Score
   *
   * @return mixed
   */
  public function getScore2()
  {
      return $this->score2;
  }

  /**
   * Set the value of Score
   *
   * @param mixed score2
   *
   * @return self
   */
  public function setScore2($score2)
  {
      $this->score2 = $score2;

      return $this;
  }

  /**
   * Get the value of Date
   *
   * @return mixed
   */
  public function getDate($format = 'd/m/Y H:i')
  {
    if ($format == null) return $this->date;

    // formatage de la date via la classe DateTime
    $date = new DateTime($this->date);
    return $date->format($format);
  }

  /**
   * Set the value of Date
   *
   * @param mixed date
   *
   * @return self
   */
  public function setDate($date)
  {
      $this->date = $date;

      return $this;
  }

  /**
   * Get the value of Lieu
   *
   * @return mixed
   */
  public function getLieu()
  {
      return $this->lieu;
  }

  /**
   * Set the value of Lieu
   *
   * @param mixed lieu
   *
   * @return self
   */
  public function setLieu($lieu)
  {
      $this->lieu = $lieu;

      return $this;
  }

  /**
   * Get the value of Competition
   *
   * @return mixed
   */
  public function getCompetition()
  {
      return $this->competition;
  }

  /**
   * Set the value of Competition
   *
   * @param mixed competition
   *
   * @return self
   */
  public function setCompetition($competition)
  {
      $this->competition = $competition;

      return $this;
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
