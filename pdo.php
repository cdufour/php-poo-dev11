<?php

try {
  $db = new PDO('mysql:host=localhost;dbname=formation-php-poo;charset=utf8', 'root');
} catch(Exception $e) {
  //echo $e->getMessage();
  die('Erreur: ' . $e->getMessage());
}

// lecture et récupération des données
$reponse = $db->query('SELECT * FROM Equipe');

while ($equipe = $reponse->fetch(PDO::FETCH_OBJ)) {
  //echo '<p>'.$equipe['nom'].'</p>'; // correct si fetch() ou fetch(PDO::FETCH_ASSOC)
  echo '<p>'.$equipe->nom.'</p>';
}

// insertion de données
/*
$requete = "INSERT INTO Equipe (nom, logo, annee_de_creation) ";
$requete .= "VALUES ('Inter Milan','', '1906')";
*/
$team = array(
  'nom' => 'FC Porto',
  'logo' => '',
  'annee_de_creation' => 1906
);
/*
$requete = "INSERT INTO Equipe (nom, logo, annee_de_creation) ";
$requete .= "VALUES ('". $team['nom'] ."','". $team['logo'] ."','". $team['annee_de_creation'] ."')";
*/
$requete = $db->prepare(
  'INSERT INTO Equipe(nom, logo, annee_de_creation) VALUES(:nom, :logo, :annee_de_creation)');
$requete->bindValue(':nom', $team['nom']);
$requete->bindValue(':logo', $team['logo']);
$requete->bindValue(':annee_de_creation', $team['annee_de_creation']);
$requete->execute();

//$db->closeCursor(); // fin din traitement

?>
