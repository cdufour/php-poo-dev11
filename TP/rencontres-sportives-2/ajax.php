<?php
require 'classes/Equipe.php';
require 'classes/Joueur.php';
require 'classes/DBM.php';

$id = $_GET['id'];
$dbm = new DBM('Equipe');
$joueurs = $dbm->findById($id)->getJoueurs();

//print_r($joueurs);
$joueurs_assoc = [];

// on transforme le tableau d'objets (de type joueur)
// on tableau de tableaux associatifs où chaque 'sous-tableau'
// représente un joueur
foreach($joueurs as $j) {
  $joueurs_assoc[] = array(
    'id' => $j->getId(),
    'nom' => $j->getNom()
  );
}
echo json_encode($joueurs_assoc);







?>
