<?php
// bloc php pour chargement données
require 'classes/Rencontre.php';
require 'classes/Equipe.php';
require 'classes/Competition.php';
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
    <title>TP rencontres sportives</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
  </head>
  <body class="container">
    <h2>TP rencontres sportives</h2>

    <form action="app.php" method="post" class="well">
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
          <input type="text" name="rencontre[score1]" class="form-control">
        </div>
        <div class="form-group col-md-4">
          <label for="">Equipe reçue</label>
          <select name="rencontre[equipe2]" class="form-control">
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
          <input type="text" name="rencontre[score2]" class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="">Buteurs</label>
          <!-- usage sporadique d'un inline style -->
          <div id="joueursEquipe1"></div>
          <button
            style="display:none"
            id="ajouteButeur"
            type="button"
            class="btn btn-default btn-xs">Ajouter un buteur</button>
            <span id="message"></span>
        </div>
        <div class="form-group col-md-6">
          <label for="">Buteurs</label>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="">Date</label>
          <input type="text" name="rencontre[date]" placeholder="0000-00-00 00:00:00" class="form-control">
        </div>
        <div class="form-group col-md-6">
          <label for="">Lieu</label>
          <input type="text" name="rencontre[lieu]" class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
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
        <div class="form-group col-md-6">
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
              $equipe = $rencontre->getEquipe1($retourneObjet = true);
              echo '<a href="app.php?action=details&id='.$equipe->getId().'">' . $equipe->getNom() . '</a>';
            ?>
          </td>
          <td><?php echo $rencontre->getEquipe2() ?></td>
          <td><?php echo $rencontre->resultat($separateur = '-') ?></td>
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
    <script src="js/app.js"></script>
  </body>
</html>
