<?php
// bloc php pour chargement données
require 'classes/Rencontre.php';
require 'classes/Equipe.php';
require 'classes/Competition.php';
require 'classes/But.php';
require 'classes/Joueur.php';
require 'classes/DBM.php';

$rencontre = new Rencontre();
$rencontres = $rencontre->liste();

$equipe = new Equipe();
$equipes = $equipe->liste();

$dbm = new DBM('Competition');
$competitions = $dbm->findAll();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>TP rencontres sportives 4</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body class="container">
    <h2>TP rencontres sportives 4</h2>

    <button id="afficheFormEquipe" class="btn btn-default">
      Ajouter une équipe</button>

    <div id="formAjouteEquipe"
      style="display:none; margin:10px 0"
      class="well">
      <div class="row">
        <div class="form-group col-md-3">
          <label>Nom</label>
          <input id="equipeNom" type="text">
        </div>
        <div class="form-group col-md-3">
          <label>Logo</label>
          <input id="equipeLogo" type="text" placeholder="http://">
        </div>
        <div class="form-group col-md-3">
          <label>Année de création</label>
          <input id="equipeCreation" type="text">
        </div>
        <div class="form-group col-md-3">
          <button id="ajouteEquipe" class="btn btn-primary">Ajouter</button>
          <div id="messageAjax"></div>
        </div>
      </div>
    </div>

    <form action="app.php" method="post" class="well" style="margin: 10px 0">
      <div class="row">
        <div class="form-group col-md-4">
          <label for="">Equipe recevant</label>
          <select id="selectEquipe1" name="rencontre[equipe1]" class="form-control">
            <option value="0">Choisir une équipe</option>
            <?php foreach($equipes as $equipe): ?>
              <option value="<?php echo $equipe->getId() ?>">
                <?php echo $equipe->getNom() ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="">Score</label>
          <input
            id="score1"
            type="text"
            value="0"
            disabled
            class="form-control">
          <input
            id="score1Hidden"
            type="hidden"
            name="rencontre[score1]">
        </div>
        <div class="form-group col-md-4">
          <label for="">Equipe reçue</label>
          <select id="selectEquipe2" name="rencontre[equipe2]" class="form-control">
            <option value="0">Choisir une équipe</option>
            <?php foreach($equipes as $equipe): ?>
              <option value="<?php echo $equipe->getId() ?>">
                <?php echo $equipe->getNom() ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="">Score</label>
          <input
            id="score2"
            type="text"
            value="0"
            disabled
            class="form-control">
          <input
            id="score2Hidden"
            type="hidden"
            name="rencontre[score2]">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <ul id="listeButeurs1"></ul>
          <div id="formButeurEquipe1" style="display:none">
            <span>Buteur </span>
            <div id="joueursEquipe1" class="inline"></div>
            Minute <input id="minuteBut1" type="text" class="mini" />
            <button
              id="ajouteButeur1"
              type="button"
              class="btn btn-default btn-xs">Ajouter un buteur</button>
          </div>
        </div>
        <div class="form-group col-md-6">
          <ul id="listeButeurs2"></ul>
          <div id="formButeurEquipe2" style="display:none">
            <span>Buteur </span>
            <div id="joueursEquipe2" class="inline"></div>
            Minute <input id="minuteBut2" type="text" class="mini" />
            <button
              id="ajouteButeur2"
              type="button"
              class="btn btn-default btn-xs">Ajouter un buteur</button>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3">
          <label for="">Date</label>
          <input id="datepicker" type="text" name="rencontre[date]" class="form-control">
        </div>
        <div class="form-group col-md-3">
          <label for="">Lieu</label>
          <input type="text" name="rencontre[lieu]" class="form-control">
        </div>
        <div class="form-group col-md-3">
          <label for="">Compétition</label>
          <select name="rencontre[competition]" class="form-control">
            <option value="0">Choisir une compétition</option>
            <?php foreach($competitions as $c): ?>
              <option value="<?php echo $c->getId() ?>">
                <?php echo $c->getNom() ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group col-md-3">
          <button class="btn btn-primary">Enregistrer</button>
        </div>
      </div>
    </form>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Equipe recevant</th>
          <th>Equipe reçue</th>
          <th>Résultat</th>
          <th>Lieu</th>
          <th>Date</th>
          <th>Compétition</th>
          <th>Actions</th>
        </tr>
      </thead>
      <?php foreach($rencontres as $rencontre): ?>
        <tr>
          <td>
            <?php

              $dbm_but = new DBM('But');
              $buts = $dbm_but->findAllByColumn('rencontre', $rencontre->getId());

              $buteurs1 = '';
              $buteurs2 = '';

              foreach($buts as $but) {
                $dbm_joueur = new DBM('Joueur');
                $dbm_equipe = new DBM('Equipe');

                $joueur = $dbm_joueur->findById($but->getJoueur());
                $joueur_equipe = $dbm_equipe->findById($joueur->getEquipe());

                if($joueur_equipe->getNom() == $rencontre->getEquipe1())
                  $buteurs1 .= $but->getMinute() . ' \'' . $joueur->getNom() . '<br />';

                if($joueur_equipe->getNom() == $rencontre->getEquipe2())
                  $buteurs2 .= $but->getMinute() . ' \'' . $joueur->getNom() . '<br />';
              }

              $equipe = $rencontre->getEquipe1($retourneObjet = true);
              echo '<a href="app.php?action=details&id='.$equipe->getId().'">' . $equipe->getNom() . '</a>';
            ?>
          </td>
          <td><?php echo $rencontre->getEquipe2() ?></td>
          <td class="resultat">
            <?php
            $div = '<div class="buteurs">';
            $div .= '<div style="float:left; margin-right: 10px">' . $buteurs1 . '</div>';
            $div .= '<div>' . $buteurs2 . '</div>';
            $div .= '</div>';

            echo $div;
            echo $rencontre->resultat($separateur = '-')
            ?>
        </td>
          <td><?php echo $rencontre->getLieu() ?></td>
          <td><?php echo $rencontre->getDate() ?></td>
          <td><?php echo $rencontre->getCompetition() ?></td>
          <td>
            <?php
            echo '<a class="btn btn-danger btn-xs" href="app.php?action=delete&id='.$rencontre->getId().'">Supprimer</a>';
            ?>
          </td>
        </tr>
      <?php endforeach ?>
    </table>

    <script src="js/jquery.min.js"></script>
    <script src="https://unpkg.com/flatpickr"></script>
    <script src="js/app.js"></script>
  </body>
</html>
