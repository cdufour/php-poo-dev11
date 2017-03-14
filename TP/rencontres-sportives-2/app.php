<?php
require 'classes/Rencontre.php';
require 'classes/Equipe.php';
require 'classes/Joueur.php';
require 'classes/But.php';
require 'classes/DBM.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") { // formulaire posté
  //print_r($_POST['rencontre']);
  $rencontre = new Rencontre($_POST['rencontre']);
  $last_id = $rencontre->enregistrer();

  // enregistrement des buts
  if ($last_id != 0) {
    $rencontre->setId($last_id);
    $buteurs1 = $_POST['buteurs1'];
    $minutes1 = $_POST['minutes1'];

    for($i = 0; $i < sizeof($buteurs1); $i++) {
      $donnees = array(
        'rencontre' => $rencontre->getId(),
        'joueur' => $buteurs1[$i],
        'minute' => $minutes1[$i]
      );
      $but = new But($donnees);
      $but->enregistrer();
    }


  }


  // redirection vers la page d'accueil
  //header('location:index.php');
} else { // GET pour affichage de la fiche equipe

  switch ($_GET['action']) {
    case 'delete':
      $dbm = new DBM('Rencontre');
      $dbm->delete($_GET['id']);
      header('Location:index.php');

      break;
    case 'details':
      // requete en db pour obtenir l'équipe
      $dbm = new DBM('Equipe');
      $equipe = $dbm->findById($_GET['id']);

      // Fiche équipe
      echo '<h1>' . $equipe->getNom() . '</h1>';
      echo '<img src="'. $equipe->getLogo() .'" />';

      // afficher liste des joueurs
      $joueurs = $equipe->getJoueurs();
      foreach($joueurs as $j) {
        echo '<p>'.$j->getNom().'</p>';
      }
      break;
  }

}

?>
