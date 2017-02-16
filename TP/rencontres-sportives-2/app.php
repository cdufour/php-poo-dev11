<?php
require 'classes/Rencontre.php';
require 'classes/Equipe.php';
require 'classes/Joueur.php';
require 'classes/DBM.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") { // formulaire posté
  $rencontre = new Rencontre($_POST['rencontre']);
  $rencontre->enregistrer();

  // redirection vers la page d'accueil
  header('location:index.php');
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
