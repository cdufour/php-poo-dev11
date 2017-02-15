<?php
// bloc php pour chargement données
require 'classes/Rencontre.php';
require 'classes/Equipe.php';

$rencontre = new Rencontre([]);
$rencontres = $rencontre->liste();

$equipe = new Equipe([]);
$equipes = $equipe->liste();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>TP rencontres sportives</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body class="container">
    <h2>TP rencontres sportives</h2>

    <form action="app.php" method="post" class="well">
      <div class="row">
        <div class="form-group col-md-4">
          <label for="">Equipe recevant</label>
          <select name="rencontre[equipe1]" class="form-control">
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
          <input type="text" name="rencontre[competition]">
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
        </tr>
      </thead>
      <?php foreach($rencontres as $rencontre): ?>
        <tr>
          <td><?php echo $rencontre->getEquipe1() ?></td>
          <td><?php echo $rencontre->getEquipe2() ?></td>
          <td><?php echo $rencontre->resultat($separateur = '-') ?></td>
          <td><?php echo $rencontre->getLieu() ?></td>
          <td><?php echo $rencontre->getDate() ?></td>
          <td><?php echo $rencontre->getCompetition() ?></td>
        </tr>
      <?php endforeach ?>
    </table>
  </body>
</html>
