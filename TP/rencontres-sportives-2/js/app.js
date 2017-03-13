$(document).ready(function() {

  var $message = $('#message');
  var $selectEquipe1 = $('#selectEquipe1');
  var $joueursEquipe1 = $('div#joueursEquipe1');

  $('#ajouteButeur').click(function() {
    if ($selectEquipe1.val() == 0) {
      $message.text('Sélectionne une équipe !')
    } else {
      var equipe_id = $selectEquipe1.val();
      // requête ajax pour récupérer les joueurs de l'équipe sélectionnée
      console.log(equipe_id);
      var url = 'ajax.php';
      $.get(url, function() {

      });

    }

  });

  $selectEquipe1.change(function() {
    var equipe_id = $(this).val();
    if(equipe_id == 0) {
      // option "Choisir une équipe"
      $joueursEquipe1.html(''); // efface le contenu du div

    } else {
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

  // helper functions
  function buildSelectJoueurs(joueurs) {
    console.log(typeof joueurs);
    var select = '<select id="selectJoueur">';
    joueurs.forEach(function(joueur) {
      select += '<option value="'+ joueur.id +'">' + joueur.nom + '</option>';
    });
    select += '</select>';
    return select;
  }

});
