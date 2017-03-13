$(document).ready(function() {

  var app = {
    score1: 0,
    score2: 0
  }

  var $message = $('#message');
  var $selectEquipe1 = $('#selectEquipe1');
  var $joueursEquipe1 = $('div#joueursEquipe1');
  var $formButeurEquipe1 = $('div#formButeurEquipe1');
  var $listeButeurs1 = $('ul#listeButeurs1');
  var $ajouteButeur = $('#ajouteButeur');
  var $score1 = $('input#score1');

  // événements
  $ajouteButeur.click(function() {
    var $selectedOption = $('#selectJoueur option:selected');
    var joueurName = $selectedOption.text();
    var joueurId = $selectedOption.val();
    var li = '<li>' + joueurName;
    li += '<span class="glyphicon glyphicon-trash"></span>';
    li += '</li>';

    // ajout du buteur dans le DOM
    $(li).appendTo($listeButeurs1);
    app.score1++;
    $score1.val(app.score1);

  });

  $selectEquipe1.change(function() {
    var equipe_id = $(this).val();

    // nettoyage et remise à zéro
    app.score1 = 0;
    $score1.val(app.score1);
    $listeButeurs1.html('');

    if(equipe_id == 0) {
      // option "Choisir une équipe"
      $joueursEquipe1.html(''); // efface le contenu du div
      $formButeurEquipe1.hide();
    } else {
      $formButeurEquipe1.show();
      // choix d'une équipe => ajax
      var url = 'ajax.php?id=' + equipe_id;
      var promesse = $.get(url);
      var joueursCb = function(res) {
        // transforme la chaîne de caractères JSON en tableau JS
        var joueurs = JSON.parse(res);
        $joueursEquipe1.html(buildSelectJoueurs(joueurs));
      };
      promesse.then(joueursCb);
    }
  });

  $listeButeurs1.on('click', '.glyphicon-trash', function() {
    $(this).parent().remove(); // à partir du span on remonte au li
    app.score1--;
    $score1.val(app.score1);
  });


  // helper functions
  function buildSelectJoueurs(joueurs) {
    var select = '<select id="selectJoueur">';
    joueurs.forEach(function(joueur) {
      select += '<option value="'+ joueur.id +'">' + joueur.nom + '</option>';
    });
    select += '</select>';
    return select;
  }




});
