$(document).ready(function() {

  var $message = $('#message');
  var $selectEquipe1 = $('#selectEquipe1');

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

});
