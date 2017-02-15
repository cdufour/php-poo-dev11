<?php
require 'classes/Rencontre.php';

$rencontre = new Rencontre($_POST['rencontre']);
$rencontre->enregistrer();

// redirection vers la page d'accueil
header('location:index.php');

?>
