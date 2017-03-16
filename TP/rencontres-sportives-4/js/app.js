$(document).ready(function() {

  var app = {
    score1: 0,
    score2: 0,
    equipe1_select: null,
    equipe2_select: null,
    url_serveur: 'ajax.php',
    messageSuccess: {
      equipeAjoutee: 'Equipe ajoutée avec succès'
    },
    messageErreur: {
      equipeAjoutee: 'La tentative d\'enregistrement a échoué'
    }
  }

  // equipe 1
  var $selectEquipe1 = $('#selectEquipe1');
  var $joueursEquipe1 = $('div#joueursEquipe1');
  var $formButeurEquipe1 = $('div#formButeurEquipe1');
  var $listeButeurs1 = $('ul#listeButeurs1');
  var $ajouteButeur1 = $('button#ajouteButeur1');
  var $score1 = $('input#score1');
  var $minuteBut1 = $('input#minuteBut1');

  // equipe 2
  var $selectEquipe2 = $('#selectEquipe2');
  var $joueursEquipe2 = $('div#joueursEquipe2');
  var $formButeurEquipe2 = $('div#formButeurEquipe2');
  var $listeButeurs2 = $('ul#listeButeurs2');
  var $ajouteButeur2 = $('button#ajouteButeur2');
  var $score2 = $('input#score2');
  var $minuteBut2 = $('input#minuteBut2');

  $('#datepicker').flatpickr({
    enableTime: true
  });

  var $formAjouteEquipe = $('div#formAjouteEquipe');

  // *************** événements *************
  $ajouteButeur1.click(function() {
    var $selectedOption = $('#selectJoueur1 option:selected');
    var joueurName = $selectedOption.text();
    var joueurId = $selectedOption.val();
    var li = '<li>';
    li += '<span>'+ $minuteBut1.val() +'\' </span>';
    li += '<span>'+ joueurName +'</span>';
    li += '<span class="glyphicon glyphicon-trash"></span>';
    li += '<input type="hidden" name="buteurs1[]" value="'+ joueurId +'"/>';
    li += '<input type="hidden" name="minutes1[]" value="'+ $minuteBut1.val() +'"/>';
    li += '</li>';

    // ajout du buteur dans le DOM
    $(li).appendTo($listeButeurs1);
    app.score1++;
    $score1.val(app.score1);
  });

  $ajouteButeur2.click(function() {
    var $selectedOption = $('#selectJoueur2 option:selected');
    var joueurName = $selectedOption.text();
    var joueurId = $selectedOption.val();
    var li = '<li>';
    li += '<span>'+ $minuteBut2.val() +'\' </span>';
    li += '<span>'+ joueurName +'</span>';
    li += '<span class="glyphicon glyphicon-trash"></span>';
    li += '<input type="hidden" name="buteurs2[]" value="'+ joueurId +'"/>';
    li += '<input type="hidden" name="minutes2[]" value="'+ $minuteBut2.val() +'"/>';
    li += '</li>';

    // ajout du buteur dans le DOM
    $(li).appendTo($listeButeurs2);
    app.score2++;
    $score2.val(app.score2);
  });

  $selectEquipe1.change(function() {
    var equipe_id = $(this).val();

    // nettoyage et remise à zéro
    app.score1 = 0;
    $score1.val(app.score1);
    $listeButeurs1.html('');

    if (app.equipe1_select)
      $selectEquipe2.children('option[value='+app.equipe1_select+']').show();

    if(equipe_id == 0) {
      // option "Choisir une équipe"
      $joueursEquipe1.html(''); // efface le contenu du div
      $formButeurEquipe1.hide();
    } else {

      $selectEquipe2.children('option[value='+equipe_id+']').hide();
      app.equipe1_select = equipe_id;

      $formButeurEquipe1.show();
      // choix d'une équipe => ajax
      var url = app.url_serveur + '?id=' + equipe_id;
      var promesse = $.get(url);
      var joueursCb = function(res) {
        // transforme la chaîne de caractères JSON en tableau JS
        var joueurs = JSON.parse(res);
        $joueursEquipe1.html(buildSelectJoueurs(joueurs, 1));
      };
      promesse.then(joueursCb);
    }
  });

  $selectEquipe2.change(function() {
    var equipe_id = $(this).val();

    // nettoyage et remise à zéro
    app.score2 = 0;
    $score2.val(app.score2);
    $listeButeurs2.html('');

    if (app.equipe2_select)
      $selectEquipe1.children('option[value='+app.equipe2_select+']').show();

    if(equipe_id == 0) {
      // option "Choisir une équipe"
      $joueursEquipe2.html(''); // efface le contenu du div
      $formButeurEquipe2.hide();
    } else {
      $selectEquipe1.children('option[value='+equipe_id+']').hide();
      app.equipe2_select = equipe_id;

      $formButeurEquipe2.show();
      // choix d'une équipe => ajax
      var url = app.url_serveur + '?id=' + equipe_id;
      var promesse = $.get(url);
      var joueursCb = function(res) {
        // transforme la chaîne de caractères JSON en tableau JS
        var joueurs = JSON.parse(res);
        $joueursEquipe2.html(buildSelectJoueurs(joueurs, 2));
      };
      promesse.then(joueursCb);
    }
  });

  $listeButeurs1.on('click', '.glyphicon-trash', function() {
    $(this).parent().remove(); // à partir du span on remonte au li
    app.score1--;
    $score1.val(app.score1);
  });

  $listeButeurs2.on('click', '.glyphicon-trash', function() {
    $(this).parent().remove(); // à partir du span on remonte au li
    app.score2--;
    $score2.val(app.score2);
  });

  $('form').submit(function() {
    // code éxécuté côté clien juste avant l'envoi des données au serveur
    $('input#score1Hidden').val(app.score1);
    $('input#score2Hidden').val(app.score2);
  });

  $('.resultat')
    .mouseenter(function() {
      $(this).parent().find('div.buteurs').show(150);
    })
    .mouseleave(function() {
      $(this).parent().find('div.buteurs').hide(150);
  });

  $('button#afficheFormEquipe').click(function() {
    $('div#formAjouteEquipe').toggle();
  });

  $('button#ajouteEquipe').click(function() {
    // récupérer les valeurs des champs de l'équipe
    var equipe = {
      nom: $formAjouteEquipe.find('input#equipeNom').val(),
      logo: $formAjouteEquipe.find('input#equipeLogo').val(),
      annee_de_creation: $formAjouteEquipe.find('input#equipeCreation').val()
    };

    var successCb = function(res) {
      var reponse_serveur = JSON.parse(res);
      console.log(reponse_serveur.id);
      // afficher un message de succès
      $formAjouteEquipe.find('div#messageAjax')
      .removeClass('error')
      .addClass('success')
      .html(app.messageSuccess.equipeAjoutee)
      .delay(8000)
      .fadeOut(3000);

      // mettre à jour les menus de sélection des équipes
      var option = '<option value="'+ reponse_serveur.id +'">'+ equipe.nom +'</option>'
      $selectEquipe1.append(option);
      $selectEquipe2.append(option);
    }

    var errorCb = function(res) {
      $formAjouteEquipe.find('div#messageAjax')
      .removeClass('success')
      .addClass('error')
      .html(app.messageErreur.equipeAjoutee)
      .delay(8000)
      .fadeOut(3000);
    }

    $.ajax({
      type: 'POST',
      url: app.url_serveur,
      data: {equipe: equipe},
      success: successCb,
      error: errorCb
    });

  });


  //******************************************************

  // helper functions
  function buildSelectJoueurs(joueurs, id) {
    var select = '<select id="selectJoueur'+id+'">';
    joueurs.forEach(function(joueur) {
      select += '<option value="'+ joueur.id +'">' + joueur.nom + '</option>';
    });
    select += '</select>';
    return select;
  }


});
