// this code is to solve bootstrap modal switching bug
// $('.modal').on('shown.bs.modal', function (e) {
//   $("body").addClass("modal-open")
// });
/********************************************* */
var cookieSettings = new BootstrapCookieConsentSettings();

//table initialisation de l'echeancier
var tableInitial = 0;

//sauvegarde de la position de scroll
;
(function ($) {        
  /**
   * Store scroll position for and set it after reload
   *
   * @return {boolean} [loacalStorage is available]
   */
  $.fn.scrollPosReaload = function () {
    if (sessionStorage) {
      var posReader = sessionStorage["posStorage"];
      if (posReader) {
        $(window).scrollTop(posReader);
        sessionStorage.removeItem("posStorage");
      }
      $(this).click(function (e) {
        sessionStorage["posStorage"] = $(window).scrollTop();
      });
      return true;
    }
    return false;
  }

  /* ================================================== */
  $(document).ready(function () {
    // Feel free to set it for any element who trigger the reload
    //$('select').scrollPosReaload();
    $('#add, #add_enfant, .btnNumberAdd').scrollPosReaload();
  });

}(jQuery));
//superpossion des modals
$(document).on('show.bs.modal', '.modal', function () {
  var zIndex = 1040 + (10 * $('.modal:visible').length);
  $(this).css('z-index', zIndex);
  setTimeout(function() {
      //$('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
      $('.modal-backdrop').not('.modal-stack').css('z-index', 1).addClass('modal-stack');
  }, 0);
});

//affichage des onglets au clique
$('.nav-item .menu-link').on('click', function (event) {
  event.preventDefault()
  $('.navbar-nav').find('.menu-link').removeClass('active pb-0');
  $('.navbar-nav').find('div').removeClass('borderBottom');
  $(this).addClass('active pb-0');
  $(this).next().addClass('borderBottom');
})

//*************fonction menu mobile et autres fonction  executer au chargement de la page********* */
$(document).ready(function () {
  //action du menu mobile
  $(".hamburger i").click(function () {
    $(".trans_400").css("right", "0px");
  });
  $(".menu_close i").click(function () {
    $(".trans_400").css("right", "");
    
    //tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
    //comment the following line out to see page move on click
    $('a[data-bs-toggle-toggle="tooltip"]').click(function (e) {
      e.preventDefault()
    })
  });  
  // numero de telephone
  $('.contact_item').focusout(function () {
    //reinitialisation de la couleur du numero
    $(this).removeClass("orangenumber moovnumber mtnnumber");

    let regex = /^[\+]?[0-9]{2}?[0-9]{2}?[0-9]{6}$/; //regex de verification

    res = regex.test($(this).val().replace(/\s/g, ''));
    if (!res && $(this).val() !== "" && $(this).val() !==" ") {
      //message de remplacement du corps du message
      $('#saisieincompletes').find('.modal-body').html("Le numéro de téléphone <span class='fw-bold'>" + $(this).val() + "</span> n'est pas conforme. <br> Merci de renseigner un numéro valide. Ex: 01 02 03 04 05");
      $('#saisieincompletes').modal('show');
      $(this).hasClass('second_contact')? $(this).val(' ') : $(this).val('');
    }
    if (res && $(this).val() !== "") {
      //retrait des espaces dans le numero
      $(this).val($(this).val().replace(/\s/g, ''));
      var reseauType = $(this).val();
      let contactID = $(this).attr('id');
      //console.log(reseauType.substring(0,2));
      //if (reseauType !== "") {
      //} else {
      //  $(this).removeClass("orangenumber moovnumber mtnnumber");
      //}
      switch (reseauType.substring(0, 2)) {
        case '07':
          $(this).addClass("orangenumber");
          break;
        case '01':
          $(this).addClass("moovnumber");
          break;
        case '05':
          $(this).addClass('mtnnumber');
          break;
        default:
          $(this).removeClass("orangenumber moovnumber mtnnumber");
          break;
      }      
    }
  });
  $('.contact_item').blur(function () {
    $('.contact_item').trigger('focusout');
  })  
  //module ajout de numero supplementaire
  $('.addnumber input[type=checkbox]').change("click", function () {
    if ($(this).is(':checked')) {
      $(this).parent().parent().find('.zone_numero').removeClass('d-none');
    } else {
      $(this).parent().parent().find('.zone_numero').addClass('d-none');
    }
  });

  //bouton ajout de numero supplementaire
  $('.btnNumberAdd').on("click", function () {
    cpt = $(this).data("nberzone");
    cptcount = 0;
    if ($("." + cpt).length < 3 && !$(this).hasClass('lcontact')) {
      cptcount = $("." + cpt).length + 1;
      position = $("." + cpt).length - 1;
      let valuedata = $(this).data("nberzone");
      //$('#addingnumber').data("nberzone", valuedata);
      //$(".contactediv").eq(0).clone().insertAfter("div.contactediv:last")
      //$('#details1').find('.noteInformation').html('Ajouter le numéro d\'un autre reseau ?<br>');
      //$('#details1').modal('show');
      zone = '.' + valuedata;
      toadd = '<div class="col-lg-4 contact_name_col mt-3 ' + cpt + '">' +
        '<label class="text-dark" for="exampleInputEmail1">Numéro portable ' + cptcount + '</label><div class="input-group mb-3">' +
        '<input name="contact' + cptcount + '" id="contact' + cptcount + '" type="text" class="contact_input contact_item" placeholder="Contact" value=" " aria-label="" aria-describedby="basic-addon1" style="width: 86%;"><i class="btn text-primary align-self-center border border-0 p-0 btnNumberRemove material-icons align-middle fs-2" data-nberzone="' + cpt + '" data-bs-toggle="tooltip" data-bs-placement="top" title="retirer le autre numero" >&#xf230;</i></div><label class="text-danger fw-bold" id="contact_error"></label></div>';
      $(zone).eq(position).after(toadd);
    } else {
      //$(this).removeClass('btnNumberAdd');
    }
    reload_js('script/fonction.js');
  });
  //bouton ajout de numero supplementaire
  $('.btnNumberRemove').on("click", function () {
    $(this).parent().parent().remove();
    cpt = $(this).data("nberzone");
    cptcount = 0;
  });
  // de l'adresse email
  $('.email_item').focusout(function () {
    let regex = /^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9\\-]+([_|\.|-]­{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$/; //regex de verificetion
    res = regex.test($(this).val());

    if (!res && $(this).val() !== "") {
      //message de remplacement du corps du message
      $('#saisieincompletes').find('.modal-body').html("L'adresse email <span class='fw-bold'>" + $(this).val() + "</span> n'est pas conforme. <br> Merci de renseigner une adresse email valide. Ex: nom@site.com");
      $('#saisieincompletes').modal('show');
      $(this).val('');
    } else {
      $(this).val($(this).val().toLowerCase());
    }
  });
});

//controle de la date de naissance
$('.date_naissance_item').focusout(function () {
  userinput = $(this).val().substring(0, 10);
  var actuel = new Date().toISOString().slice(0, 10);
  if (userinput >= actuel) {
    //on vide la date car on ne peut pas etre nee aujourdhui et etre adherent principale
    if ($(this).hasClass('adulte_date')) {
      $(this).val('');
    } else {
      $(this).val(actuel);
    }
  } else {
    if ($(this).hasClass('adulte_date')) {
      var testage = verif_age_limite();
      if (testage !== 0) {
        $('#infos_age_limite').modal('show');
      }
      //$(this).val('');
    }
  }
});

//affichage du mot de passe
$('#showpassword').click(function () {
  if ($('#lpassword').attr("type") == 'text') {
    $('#lpassword').attr("type", "password")
  } else {
    $('#lpassword').attr("type", "text")
  }
});

//fonction nous contacter-----------------------------------------
$('#contacter_nous').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Nouveau message à ' + recipient)
  modal.find('.modal-body #recipient-name').val(recipient)
  if (getCookie('userinfo')!=='') {
    modal.find('.modal-body #nom_prenom').val(JSON.parse(getCookie('userinfo'))[0].nom + ' ' + JSON.parse(getCookie('userinfo'))[0].prenom);
    modal.find('.modal-body #telephone').val(JSON.parse(getCookie('userinfo'))[0].contact);
  }
  
})

//generation de commune au choix de la ville sur la liste
$(".ville_item").change(function () {
  //var selectedville = $(this).children("option:selected").val();
  chargecommune();
});

$('#rechercher').on("click", function () {
  selectedville = "";
  selectedcommune = "";
  if ($('#ville').val() !== 'abidjan') {
    //$('#choix_commune').attr('hidden',true);
    selectedville = selectedcommune = $('#ville').val();
    //$('#commune').val($('#commune')[0][1].value)
  } else {
    //$('#choix_commune').removeAttr('hidden');
    selectedcommune = $('#commune').val();
  }

  $.get("script/reseaux.json", function (data) {
    //console.log($('#ville').val()+" "+$('#commune').val().toUpperCase());
    //***parcours des communes */
    var listecentreSante1 = listecentreSante2 = listecentreSante3 = listecentreSante4 = listecentreSante5 = '';
    for (let i = c1 = c2 = c3 = c4 = c5 = 0; i < data.length; i++) {

      //? on compare la valeur de la commune a celle dans le systeme
      if (data[i]['commune'] == (selectedcommune).toUpperCase()) {
        //recuperation des noms de commune
        //console.log(data['commune'][i]['nom']);
        //***parcours des centres par communes */

        //cliniques
        if (data[i]['type'].includes('Soins ambulatoires')) {
          if (c1 % 2 == 0) {
            listecentreSante1 += '<div class="row" style="margin-top: 0.5% ;">';
          }
          listecentreSante1 += '<div class="col-sm-6"> <div class="card cardmod" href="#"><div class="card-block"><h5 class="card-title" style="font-weight: bolder;">' + data[i]['nom'].toUpperCase() + '</h5> <h6 class="card-subtitle text-muted">' + data[i]['type'] + '</h6><p class="card-text p-y-1"><i class="fa fa-phone spaceicone"></i>' + data[i]['contact'] + '</p><p class="card-text indicateur p-y-1"><i class="fa fa-street-view spaceicone"></i></i>' + data[i]['localisation'] + '.</p> </div> </div> </div>';
          //test de verification pour retour a la ligne apres chaque groupe de 2 iteration
          if (c1 % 2 == 1) {
            listecentreSante1 += '</div>';
          }
          c1++;
        }
        //?definition de nombres de centre trouver
        //pharmacies
        if (data[i]['type'].includes('Pharmacie')) {
          if (c2 % 2 == 0) {
            listecentreSante2 += '<div class="row" style="margin-top: 0.5% ;">';
          }
          listecentreSante2 += '<div class="col-sm-6"> <div class="card cardmod" href="#"><div class="card-block"><h5 class="card-title" style="font-weight: bolder;">' + data[i]['nom'].toUpperCase() + '</h5> <h6 class="card-subtitle text-muted">' + data[i]['type'] + '</h6><p class="card-text p-y-1"><i class="fa fa-phone spaceicone"></i>' + data[i]['contact'] + '.</p><p class="card-text indicateur p-y-1"><i class="fa fa-street-view spaceicone"></i></i>' + data[i]['localisation'] + '.</p> </div> </div> </div>';
          //test de verification pour retour a la ligne apres chaque groupe de 2 iteration

          if (c2 % 2 == 1) {
            listecentreSante2 += '</div>';
          }
          c2++;
        }
        //optiques
        if (data[i]['type'].includes('Opticiens')) {
          if (c3 % 2 == 0) {
            listecentreSante3 += '<div class="row" style="margin-top: 0.5% ;">';
          }
          listecentreSante3 += '<div class="col-sm-6"> <div class="card cardmod" href="#"><div class="card-block"><h5 class="card-title" style="font-weight: bolder;">' + data[i]['nom'].toUpperCase() + '</h5> <h6 class="card-subtitle text-muted">' + data[i]['type'] + '</h6><p class="card-text p-y-1"><i class="fa fa-phone spaceicone"></i>' + data[i]['contact'] + '.</p><p class="card-text indicateur p-y-1"><i class="fa fa-street-view spaceicone"></i></i>' + data[i]['localisation'] + '.</p> </div> </div> </div>';
          //test de verification pour retour a la ligne apres chaque groupe de 2 iteration

          if (c3 % 2 == 1) {
            listecentreSante3 += '</div>';
          }
          c3++;
        }
        //laboratoires et radiologies
        if (data[i]['type'].includes('Laboratoires') || data[i]['type'].includes('Radiologie')) {
          if (c4 % 2 == 0) {
            listecentreSante4 += '<div class="row" style="margin-top: 0.5% ;">';
          }
          listecentreSante4 += '<div class="col-sm-6"> <div class="card cardmod" href="#"><div class="card-block"><h5 class="card-title" style="font-weight: bolder;">' + data[i]['nom'].toUpperCase() + '</h5> <h6 class="card-subtitle text-muted">' + data[i]['type'] + '</h6><p class="card-text p-y-1"><i class="fa fa-phone spaceicone"></i>' + data[i]['contact'] + '.</p><p class="card-text indicateur p-y-1"><i class="fa fa-street-view spaceicone"></i></i>' + data[i]['localisation'] + '.</p> </div> </div> </div>';
          //test de verification pour retour a la ligne apres chaque groupe de 2 iteration

          if (c4 % 2 == 1) {
            listecentreSante4 += '</div>';
          }
          c4++;
        }
        //cabinets dentaires
        if (data[i]['type'].includes('Cabinets dentaires')) {
          if (c5 % 2 == 0) {
            listecentreSante5 += '<div class="row" style="margin-top: 0.5% ;">';
          }
          listecentreSante5 += '<div class="col-sm-6"> <div class="card cardmod" href="#"><div class="card-block"><h5 class="card-title" style="font-weight: bolder;">' + data[i]['nom'].toUpperCase() + '</h5> <h6 class="card-subtitle text-muted">' + data[i]['type'] + '</h6><p class="card-text p-y-1"><i class="fa fa-phone spaceicone"></i>' + data[i]['contact'] + '.</p><p class="card-text indicateur p-y-1"><i class="fa fa-street-view spaceicone"></i></i>' + data[i]['localisation'] + '.</p> </div> </div> </div>';
          //test de verification pour retour a la ligne apres chaque groupe de 2 iteration

          if (c5 % 2 == 1) {
            listecentreSante5 += '</div>';
          }
          c5++;
        }
      }
    }
    //$('#total_records').text(parseInt($('#total_centre_sante').text())+parseInt($('#total_pharmacie').text()))

    //? insertion des centres et pharmacies dans les onglets
    tab = [listecentreSante1, listecentreSante2, listecentreSante3, listecentreSante4, listecentreSante5];
    tabtitre = ["Cliniques", "Pharmacies", "Centres Optiques", "Laboratoires et Centres de Radiologie", "Cabinets dentaires"];
    //verification des centres vides
    for (let i = 0; i < tab.length; i++) {
      if (tab[i] !== '') {
        tab[i] = tab[i];
        $('#nav-tab .nav-item').eq(i).attr('hidden', false);
        //$('#nav-tabContent div').eq(i).attr('hidden', false);
      } else {
        $('#nav-tab .nav-item').eq(i).attr('hidden', true);
        //$('#nav-tabContent div').eq(i).attr('hidden', true);
      }
    }
    $('#nav-clinique').html(tab[0]);
    $('#nav-pharmacie').html(tab[1]);
    $('#nav-opticiens').html(tab[2]);
    $('#nav-lab_radio').html(tab[3]);
    $('#nav-cab_dantaire').html(tab[4]);

    $('#nav-tab .nav-item').eq(0).trigger('click')
  });
});

$('#valider_sante1').on("click", function () {
  currentTab = 1;
  nextPrev(1);
  if ($("#typeMembre").val() == "Evêques") {
    $('.option_pasteur_fidele').addClass('d-none');
    $('.option_eveques').removeClass('d-none');
  }
  //$("#nextBtn").removeAttr("onclick");
});

//affichage de l'acceptation d'adhesion
$("#adhere").change(function () {
  if ($("#adhere").is(':checked')) {
    $(".validation_r").show();
  } else {
    $(".validation_r").hide();
  }
});

//module pour les inscriptions et le login
$('.validation_l').on("click", function () {
  if (!validateForm('login')) {
    return false;
  } else {
    //...the form gets submitted:
    $(".login").submit();
    return false;
  }

});

$('.validation_r').on("click", function () {
  if (!validateForm('inscription')) {
    return false;
  } else {
    //...the form gets submitted:
    $(".inscription").submit();
    return false;
  }
});

//recuperation de code
$('.validation_recuperation').on("click", function () {
  if ($(this).data('name') == "recuperation") {
    $(".formRecuperation").submit();
    return false;
  }
  if ($(this).data('name') == "confirmation") {
    //control form avant envoie
    if (!validateForm('formRecuperation')) {
      return false;
    } else {
      //...the form gets submitted:
      $(".formRecuperation").submit();
      return false;
    }
  }

});

//envoie du formulaire
$(".inscription , .login , .formRecuperation").on("submit", function (e) {
  var typeform = $(this).attr('id');
  //$("#msg").html('<div class="alert alert-info"><i class="fa fa-spin fa-spinner"></i> Please wait...!</div>');
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: "script/login_register.php",
    data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
    contentType: false, // The content type used when sending data to the server.
    cache: false, // To unable request pages to be cached
    processData: false, // To send DOMDocument or non processed data file it is set to false

    success: function (response) {
      var jsonObjectConnect = JSON.parse(response);
      //mise en cookies
      setCookie('userinfo', response, 15);
      //inscription----------------------------------------------------------------------
      if (typeform == "formInscription") {
        //en cas d'erreur sur le mot de passe et ou sur l'email
        if (jsonObjectConnect.auth == 0) {
          $("#msg").html(
            '<div class="alert alert-info"><i class="fa fa-exclamation-triangle"></i> Il y a une erreur dans le login ou le mot de passe, ou email à déja été utilisé</div>'
          );
        }
        //en cas de validité des identifiants
        if (jsonObjectConnect.auth == 1) {
          //si inscription est pasteurs
          if (jsonObjectConnect[0].type_user == "Pasteurs, Pretres et Fideles") {
            choix("pasteursEtFideles", jsonObjectConnect);
            //modification de l'url
            window.history.pushState("", "", '/?register=true&produit=pasteursEtFideles');
          }
          //si inscription est eveques
          if (jsonObjectConnect[0].type_user == "Eveques") {
            choix("eveques", jsonObjectConnect);
            //modification de l'url
            window.history.pushState("", "", '/?register=true&produit=eveques');
          }
          //fermeture du modal
          $('#LoginModalCenter').modal('hide');
        }
      }
      //connexion----------------------------------------------------------------------
      if (typeform == "formLogin") {
        if (jsonObjectConnect.auth == 1) {
          //verification si le premier paiement n'est pas effectuer et n'est pas arriver à l'etape de paiement
          if (jsonObjectConnect[0].premiere_fois == 'oui' || JSON.parse(getCookie('CookiesUsersData')).stepZone!=='2') {
            //si individu pasteurs.......
            if (jsonObjectConnect[0].type_user == "Pasteurs, Pretres et Fideles") {
              choix("pasteursEtFideles", jsonObjectConnect);
              //modification de l'url
              window.history.pushState("", "", '?login=true&produit=pasteursEtFideles');
            }
            //si individu eveques........
            if (jsonObjectConnect[0].type_user == "Eveques") {
              choix("eveques", jsonObjectConnect);
              //modification de l'url
              window.history.pushState("", "", '?login=true&produit=eveques');
            }
          } 
          //sinon on le conduit vers la suite du paiement
            if (jsonObjectConnect[0].premiere_fois=='non' || JSON.parse(getCookie('CookiesUsersData')).stepZone=='2') {
              choix("suitePaie", jsonObjectConnect);
              //modification de l'url
              window.history.pushState("", "", '?login=true&produit=suitePaie');
          }
          //fermeture du modal
          $('#LoginModalCenter').modal('hide');
        } else {
          $("#msg2").html(
            '<div class="alert alert-info"><i class="fa fa-exclamation-triangle"></i> Il y a une erreur dans le login et ou le mot de passe.</div>'
          );
        }
      }
      //si recuperation des access oubliés
      if (typeform == "formRecuperation") {
        //si recuperation incorrecte
        if (jsonObjectConnect.auth == 0) {
          $("#msgrecuperation").html(
            '<div class="alert alert-info"><i class="fa fa-exclamation-triangle"></i> Il y a une erreur dans le email ce dernier n\'existe pas</div>'
          );
          $(".zonerecup").addClass('d-none');
        }
        //si recuperation correcte
        if (jsonObjectConnect.auth == 1 && jsonObjectConnect.pass == 1) {
          $("#msgrecuperation").html(
            '<div class="alert alert-info"><i class="fa fa-exclamation-triangle"></i> Un code de recuperation vous à été envoyé à l\'email indiqué, merci de le renseigner en dessous</div>'
          );
          $(".zonerecup").removeClass('d-none');
          $('.validation_recuperation').data('name', 'confirmation');

        }
        //si recuperation validé
        if (jsonObjectConnect.auth == 1 && jsonObjectConnect.email !== "") {
          //verification si la premier paiement n'est pas effectuer
          if (jsonObjectConnect[0].premiere_fois == 'oui') {
            if (jsonObjectConnect[0].type_user == "Pasteurs, Pretres et Fideles") {
              choix("pasteursEtFideles", jsonObjectConnect);
            }
            if (jsonObjectConnect[0].type_user == "Eveques") {
              choix("eveques", jsonObjectConnect);
            }
          } else {
            choix("suitePaie", jsonObjectConnect);

          }
          //fermeture du modal
          $('#recoverModal').modal('hide');
        }
      }
    },
    error: function (response) {
      console.log(response);
      //$("#msg").html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Il y a eu un problème.</div>');
    }
  });
});

/*********************selection de mode de paiement */
$('.methodePaiement').on("click", function () { //Clicking input radio
  var radioClickedName = $(this).attr('name');
  var radioClickedId = $(this).val();

  //affichage des champs de tableau offres
    $('.MontantCotisationZone').removeClass('d-none');
    if (radioClickedId == 'journalier') {
      $('.methodePaiement1').eq(0).prop("checked", true)
      $('.colmois, .colsemaine').addClass('d-none');
      $('.coljour, .colannuelle').removeClass('d-none');
      CalculDuMontantDeCotisation("0", ".coljour")
    }
    if (radioClickedId == 'hebdomadaire') {
      $('.methodePaiement1').eq(1).prop("checked", true)
      $('.colmois, .coljour').addClass('d-none');
      $('.colsemaine, .colannuelle').removeClass('d-none');
      CalculDuMontantDeCotisation("0", ".colsemaine")
    }
    if (radioClickedId == 'mensuel') {
      $('.methodePaiement1').eq(2).prop("checked", true)
      $('.coljour, .colsemaine').addClass('d-none');
      $('.colmois, .colannuelle').removeClass('d-none');
      CalculDuMontantDeCotisation("0", ".colmois")
    }
    if (radioClickedId == 'annuelle') {
      $('.methodePaiement1').eq(3).prop("checked", true)
      $('.colannuelle, .colfamille, .colindividuel').addClass('d-none');
      CalculDuMontantDeCotisation("0", ".colannuelle")
  }
  
  //affichage des champs de methode de paiement
  // if (radioClickedName == 'methodePaiement1') {
  //   if (radioClickedId == 'journalier1') {
  //     $('.methodePaiement').eq(0).prop("checked", true)
  //     $('.colmois, .colsemaine').addClass('d-none');
  //     $('.coljour, .colannuelle').removeClass('d-none');
  //     CalculDuMontantDeCotisation("0", ".coljour")
  //   }
  //   if (radioClickedId == 'hebdomadaire1') {
  //     $('.methodePaiement').eq(1).prop("checked", true)
  //     $('.colmois, .coljour').addClass('d-none');
  //     $('.colsemaine, .colannuelle').removeClass('d-none');
  //     CalculDuMontantDeCotisation("0", ".colsemaine")
  //   }
  //   if (radioClickedId == 'mensuel1') {
  //     $('.methodePaiement').eq(2).prop("checked", true)
  //     $('.coljour, .colsemaine').addClass('d-none');
  //     $('.colmois, .colannuelle').removeClass('d-none');
  //     CalculDuMontantDeCotisation("0", ".colmois")
  //   }
  //   if (radioClickedId == 'annuelle1') {
  //     $('.methodePaiement').eq(3).prop("checked", true)
  //     $('.colannuelle, .colfamille, .colindividuel').addClass('d-none');
  //     CalculDuMontantDeCotisation("0", ".colannuelle")
  //   }
  // }
  //action de paiement pour la suite des cotisation
    if (radioClickedId == 'journalier3') {

      $('.colmois, .colsemaine').addClass('d-none');
      $('.coljour, .colannuelle').removeClass('d-none');
      CalculDuMontantDeCotisation("3", ".coljour");
    }
    if (radioClickedId == 'hebdomadaire3') {

      $('.colmois, .coljour').addClass('d-none');
      $('.colsemaine, .colannuelle').removeClass('d-none');
      CalculDuMontantDeCotisation("3", ".colsemaine");
    }
    if (radioClickedId == 'mensuel3') {

      $('.coljour, .colsemaine').addClass('d-none');
      $('.colmois, .colannuelle').removeClass('d-none');
      CalculDuMontantDeCotisation("3", ".colmois");
    }
    if (radioClickedId == 'annuelle3') {
      $('.colannuelle, .colfamille, .colindividuel').addClass('d-none');
      CalculDuMontantDeCotisation("3", ".colannuelle");
  }

  if (radioClickedName === "methodePaiement") {
    //execution du calendrier de paiement
    calendrierDePaiement("Premier paiement");
    
  } else {
    //execution du calendrier de paiement
    //calendrierDePaiement("Paiement",);
    $('.droitadhesion, .couverturemaladie').addClass('d-none')
  }

});

//choix du produit
$(".opt_produit").click(function () {
  info_souscripteur2();
  //info_souscripteur(2);
});

/*********************au click sur le boutton paiement sante */
$("#paiement_sante").click(function () {
  if ($("#typeMembre").val() == "Evêques") {
    $('.option_pasteur_fidele').addClass('d-none');
    $('.option_eveques').removeClass('d-none');
  }
  if ($("#agree").is(':checked')) {

  }
  info_souscripteur2();
  calendrierDePaiement();
});

/****************************************/
//controle sur le nombre d'adulte et d'enfant
$("#nombre_enfant, #nombre_adulte").focusout(function () {
  let n_adulteLength = parseInt($("#field_sante .adfilA").length+$("#field_sante #adfil0").length);
  let n_enfantLength = parseInt($("#field_sante .adfilE").length);

  if ($(this).attr('id') == "nombre_enfant" && $(this).val() < 0) {
    $(this).val('3');
  }
  if ($(this).attr('id') == "nombre_adulte" && $(this).val() < 1) {
    $(this).val('2');
  }
  //cas de modification du nombre d'adulte apres ajout
  if ($(this).attr('id') == "nombre_adulte" && $(this).val() < n_adulteLength  ) {
    $(this).val(n_adulteLength);
  }
  //cas de modification du nombre d'enfant apres ajout
  if ($(this).attr('id') == "nombre_enfant" && n_enfantLength!==0  ) {
    $(this).val(n_adulteLength);
  }
});

//control sur la date des enfants
var last = '';
$(".enfant_date").focusout( function () {
  if(this.checkValidity()) {
    last = this.value;
  } else {
    this.value = last;
  }
});

/***********suite de paiement***********/
//$("#PaiemmentModal").click(function () {
$('#PaiemmentModal').on('shown.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var montanttp = button.data('montant') // Extract info from data-* attributes
  var methodetp = button.data('methode') // Extract info from data-* attributes
  console.log(methodetp);
  var info = "&partCotisation=" + montanttp + "&changementMethode=" + $("#flexSwitchCheckDefault")[0].checked + "&oldMethode=" + methodetp;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("PaiemmentModalBody").innerHTML = this.response;
      // Display the current tab      
      reload_js('script/fonction.js');
      //autoselection de la methode de paiemment
       setTimeout(function () {
         $('#' + methodetp.toLowerCase()+'3').trigger("click");
       }, 1000);


    }
  };
  xhttp.open("GET", "./script/loader.php?paie"+info, true);
  xhttp.send();
});

//ajout de ville non presente
$('.lieu_naissance_item').change(function () {
  //action dans le cas ous on n'est hors du pays
  if ($(this).val() == "A") {
    //console.log('Saisissez le nom de la ville');
    //mise à jour du titre du modal
    $('#exampleModalLongTitle').html('Saisi utilisateur : Lieu de naissance');
    $('#addingButton').data("nberzone", $(this).attr('id'));
    $('#details1').modal('show');
  }
});
//verification de ville non presente
$('#saisie_lieu_de_naissance_scd').focusout(function () {
  var testvaleur=$(this).val()
  var thevalue = testvaleur.charAt(0).toUpperCase() + testvaleur.slice(1);
  var exists = 0 != $('#'+$('#addingButton').data("nberzone")+' option[value=' + thevalue + ']').length;
  if (exists) {
    $('#saisie_lieu_de_naissance_scd_error').html('Ce lieu existe déja dans la liste !');
    $('#addingButton').attr('disabled', true);
  } else {
    $('#saisie_lieu_de_naissance_scd_error').html('');
    $('#addingButton').attr('disabled', false);
  }
});
//----------------------------------------------------------------------------------------------------

//generation des cookies de sauvegardes des donnees utilisateurs----
//fonction d'ajout de 
function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

//fonction de recuperation de cookie
function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

//fonction de verification de la presence du cookie
function checkCookie() {
  var RecuperationCookies = null;
  var RecuperationCookiesBeneficiaires = null;
  val = document.cookie.split(';')
    .map(cookie => cookie.split('='))
    .reduce((accumulator, [key, value]) => ({
      ...accumulator,
      [key.trim()]: decodeURIComponent(value)
    }), {});

  if (val.CookiesUsersData) {
    RecuperationCookies = JSON.parse(val.CookiesUsersData);
    currentTab = 0;
    //coloration des champs de contact
    $('.contact_item').trigger('focusout');
  }
  if (RecuperationCookies.opt_produit=="famille") {
    $('.opt_produit').eq(0).trigger('click');
  }
  if (RecuperationCookies !== null && RecuperationCookies.status !== "" && currentTab==0) {
    //on zappe le tableau du bareme
    $('#nextBtn').trigger("click");

    $('#scrpt_amgs_' + RecuperationCookies.status).trigger('click');
    // Restore form from string
      setTimeout(function(){
        stringToForm(val.CookiesUsersData, $("#form_souscrire_sante"));
        //coloration des champs de contact
        $('.contact_item').trigger('focusout');       
      },2000);
    //verification que le formulaire est bien rempli avant de passer à l'etape paiement si tout est bien rempli
    if (JSON.parse(getCookie('CookiesUsersData')).stepZone=="2" && validateForm('contact_form')==true) {
      setTimeout(function(){
        $('#valider_sante1').trigger("click");        
      },1000);      
    }
    
    
  }
}

//fonction de suppression de cookie
function delete_cookie(name) {
  document.cookie = name + '=; Path=/;  Domain=' + location.host + '; Expires=Thu, 01 Jan 1970 00:00:01 GMT; SameSite=None; Secure'
}

//function pour gerer les cookies
function gestionCookies(etat) {
  //definition du tableau
  data = formDataToObject(document.getElementById('form_souscrire_sante'));
  //on vide l'objet des cookies
  CookiesUsers = {};

  if (etat == 'save') {
    //assignation au cookies generaux
    setCookie('CookiesUsersData', JSON.stringify(data), 30);

    //assignation au cookies generaux nombre adultes et enfants
    let n_adulteLength = parseInt($("#field_sante .adfilA").length+$("#field_sante #adfil0").length);
    let n_enfantLength = parseInt($("#field_sante .adfilE").length);
    data_val = {
        "n_adulteLength": n_adulteLength,
        "n_enfantLength": n_enfantLength
      };
    setCookie('CookiesUsersDataBeneficiaires', JSON.stringify(data_val), 30);
  }
}

//fonction mise au format monetaire
function formatMonetaire(montant) {
  // body...
  return (new Intl.NumberFormat('fr-FR', {currency: 'XOF',style: 'currency'}).format(montant));
}

/********************************************* */

function getUrlParameter(name) {
  name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
  var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
  var results = regex.exec(location.search);
  return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};
window.onload = () => { 
  var jsonConnect;
  if (getCookie('userinfo')) {
    jsonConnect = JSON.parse(getCookie('userinfo'));
  }
  if (getUrlParameter('transaction_id')) {
    //var info="&transactionid="+getUrlParameter('transaction_id');
    immpressionFiche(getUrlParameter('transaction_id'));
    // var xhttp = new XMLHttpRequest();
    // xhttp.onreadystatechange = function() {
    //     if (this.readyState == 4 && this.status == 200) {
    //         document.getElementById("containerlog").innerHTML=this.response;
            
    //     }
    // };
    // xhttp.open("GET", "./script/loader.php?pageimpressionfiche"+info, true);
    // xhttp.send();
  }
  if (getUrlParameter('produit')) {
    choix(getUrlParameter('produit'), jsonConnect);
      //$('#myModal').modal('show');
  } 
};

//fonction ajout de numero
function addingnumber(params) {
  $('.addnumber input[type=checkbox]').each(function (index, element) {
    if ($(element).eq(index).is(':checked')) {
      console.log($(element).eq(index));
      cpt = index + 2;
      num = $(element).eq(index).parent().parent().find('.zone_numero').val();
      reseau = $(element).eq(index).val();
      zone = '.' + $('#addingnumber').data("nberzone");
      toadd = '<div class="col-lg-4 contact_name_col mt-3 addednumber">' +
        '<label class="text-dark" for="exampleInputEmail1">Numéro portable ' + cpt + '<span class="text-danger fw-bold">*</span></label>' +
        '<input name="contact" id="contact" type="number" class="contact_input contact_item" placeholder="Contact" value="' + num + '" aria-label="" aria-describedby="basic-addon1" data-nberzone="' + zone + '">' +
        '<label class="text-danger fw-bold" id="contact_error"></label></div>';
      $(zone).after(toadd);
    }
  })

};

function chargecommune() {
  $.get("script/villes.json", function(data){
	//console.log(data);
	//? chargemennt des communes apres selection des villes
	var listecommune="";
	for (let index = 0; index < data.length; index++) {
		for (let j = 0; j < data[index]['ville'].length; j++) {
			if (data[index]['ville'][j]['nom']==$('#ville').val().toLowerCase()) {
				for (let k = 0; k < data[index]['ville'][j]['commune'].length; k++) {
				//console.log(data[index]['ville'][j]['commune'][k]['nom']);
				listecommune+='<option class="Capitalize" value="'+data[index]['ville'][j]['commune'][k]['nom']+'">'+firstletteruppercase(data[index]['ville'][j]['commune'][k]['nom'])+'</option>';              
			}
		  } else {
			break
		  }
		}
	  }
	//console.log(listecommune);
	$('.commune_item').html('<option value="NA">Commune</option>'+listecommune);
	});
};

//*****************inscription des menbres */
function inscription(type,jetondepaiement,transaction_id,notifToken) {
  if (type == 'initial') {
    let jsonfield_santecontents = formDataToObject(document.getElementById('form_souscrire_sante'));    
    var info="&type="+type+"&jsonfield_santecontents="+JSON.stringify(jsonfield_santecontents);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          //console.log(this.response);
          GenerateurPaiement(jsonfield_santecontents);
        }
    };
    xhttp.open("GET", "./script/script.php?inscription" + info, true);
    xhttp.send();
  }
  if (type == 'update') {
    //return;
    info = "&type=" + type + "&payment_token=" + jetondepaiement + "&transaction_id=" + transaction_id + "&token_notification=" + notifToken;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.response);    
        }
    };
    xhttp.open("GET", "./script/script.php?inscription" + info, true);
    xhttp.send();
  }
  if (type == 'saveBeneficiaire') {
    let jsonfield_santecontents = formDataToObject(document.getElementById('form_souscrire_sante'));    
    var info="&type="+type+"&jsonfield_santecontents="+JSON.stringify(jsonfield_santecontents);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          //console.log(this.response);
        }
    };
    xhttp.open("GET", "./script/script.php?inscription" + info, true);
    xhttp.send();
  }
  if (type == 'saveEcheancier') {
    //console.log(tableData);
    var info = "&type=" + type + "&echeancier=" + JSON.stringify(tableData) + "&methode=" + $(".methodePaiement:checked").val();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          //console.log(this.response);
        }
    };
    xhttp.open("GET", "./script/script.php?inscription" + info, true);
    xhttp.send();
  }
}

//**formatage des numeros de telephone******************* */
function formatPhoneNumber(phoneNumberString) {
  var cleaned = ('' + phoneNumberString).replace(/\D/g, '');
  var match = cleaned.match(/^(1|)?(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/);
  if (match) {
    //var intlCode = (match[1] ? '+1 ' : '');
    return [ match[2], ' ', match[3], ' ', match[4], ' ', match[5], ' ', match[6]].join('');
  }
  return null;
}

//premiere lettre en majuscule
function firstletteruppercase(mot) {
  // mot = mot.toLowerCase().replace(/\b[a-z]/g, function(letter) {
  //    return letter.toUpperCase();
  // }); 
  return mot;
}

//***************fonction affichage des details*************
function details(paramets) {
  $('#details'+paramets).modal('show');
}

var j=0;
function verifierinput() {
  valid = true;
  var statut = document.getElementsByClassName('status');  
  if (statut[0].checked == false && statut[1].checked == false) {
    document.getElementById("saisieincompletestext").innerHTML='Merci de préciser si l\'adhérent fait partie du groupe de personnes à assurer' ;
    valid = false;
  }

  return valid; // return the valid status
}

var nombrepersone
function detailsouscription(params) {
  var nbreadulte=0;
  var nbrenfant=0;
  var Nombres = new Object();
  if ($('#opt_produit').val()=="individuel") { 
    nbreadulte=1;
    nbrenfant=0;
  } else {
    if ($('#option_type_famille').val()=="normal") {
        
        nbreadulte=parseInt($('#nombre_adulte').val());
        nbrenfant=parseInt($('#nombre_enfant').val());
    } else {
        nbreadulte=parseInt($('#nombre_personnel').val())+parseInt($('#nombre_conjoint').val());
        nbrenfant=parseInt($('#nombre_enfant_entreprise').val());
    } 
  }
  Nombres['nbreadulte'] = nbreadulte;
  Nombres['nbrenfant'] = nbrenfant;
  //console.log(Nombres);
  return Nombres;
}

function recapdevis(num) {
  if (num==0) {     
    recupformvalue("component_infos","infosante");
    nombrepersone = detailsouscription();
    recupformvalue("component_facturation", "devis");
    CalculDuMontantDeCotisation("0", ".colannuelle");
    //rechargement du js du tableau
    reload_js('assets/js/jquery.dataTables.min.js');

    //enregistrement des beneficiaires et de l'adherent principale
    inscription('saveBeneficiaire');
  }
  if (num==1) {
    inscription('initial');
  }
  //$('#payerButton').text($('#payerButton').text()+($('#primevalue').text()).replace('FCFA', 'XOF'));   
}

//calcule du montant partiel
var MontantPartiel;
function CalculDuMontantDeCotisation(params, methode) {
  var montantTotal;
  if (methode !== ".colannuelle") {
    if ($(".opt_produit:checked").val() == 'individuel') {
      MontantPartiel = parseInt($(methode).eq(1).text().replace(/\s/g, ''));
    } else {
      MontantPartiel = parseInt($(methode).eq(2).text().replace(/\s/g, ''));
    }
  } else {
    MontantPartiel = 0;
  }

  if (params == "0") {
    //ajout du montant à payer
    if ($(".methodePaiement:checked").val() !== "annuelle") {
      montantTotal = (parseInt($("#primevalue").text().replace(/\s/g, '')) / 12) * 2;
      $("#accordionExample").removeClass('d-none')
    } else {
      montantTotal = parseInt($("#primevalue").text().replace(/\s/g, ''));
      $("#accordionExample").addClass('d-none')
    }
  }
  if (params == "3") {
    //annulation des parametres pour preserver le calcul du montant total
    params = "0";
    diviseur = parseInt($(".methodePaiement:checked").data('dividenumber'));
    //ajout du montant à payer
    if ($(".methodePaiement:checked").val() !== "annuelle") {
      montantTotal = (parseInt($("#primevalue2").text().replace(/\s/g, '')) / diviseur);
      $("#accordionExample").removeClass('d-none')
    } else {
      montantTotal = parseInt($("#MontantCotisationZone0").val().replace(/\s/g, ''));
      $("#accordionExample").addClass('d-none')
    }
  }
  let newMontant = Math.ceil(montantTotal + parseInt($("#isPremierPaiement").val()) + parseInt(params.replace(/\s/g, '')));
  let newMontantFormate = formatMonetaire(newMontant);
  $("#MontantCotisationZone,#MontantCotisationZoneDuplication").val(newMontantFormate);
  // if ($(".methodePaiement:checked").val() == "annuelle") {
  //   $("#MontantCotisationZone0").val(newMontant);
  // }
  //insertion de la valeur initial à payer
  $("#MontantCotisationZone0").val(parseInt($("#primevalue").text().replace(/\s/g, '')));
  
}

//generation du calendrier de paiement
function getNextMonday(date = new Date()) {
  const dateCopy = new Date(date.getTime());

  const nextMonday = new Date(
    dateCopy.setDate(
      dateCopy.getDate() + ((7 - dateCopy.getDay() + 1) % 7 || 7),
    ),
  );

  return nextMonday;
}

//table de l'echeancier
var tableData = [];
function calendrierDePaiement(etatDePaiement) {

  let methodePaiementValue = $(".methodePaiement:checked").val();
  var cotisation=0;
  var MontantToPay = formatMonetaire(parseInt($("#MontantCotisationZone").val().replace(/\s/g, '')));
  var droitAdhesion = MontantRestant = MontantInitialFormater = 0;
  var nextPay = message1 = message2 = "";
  var msgText = etatDePaiement;
  var dval = '';
  tableData = [];
  
  let TabMethodePaiement = { "annuelle": '1', "mensuel": '12', "hebdomadaire": '52', "journalier": '365' };

  //methodePaiementValue=methodePaiement[index].value;
  var periodeDePaiement = TabMethodePaiement[methodePaiementValue];
  
  //calcule du montant restant  
  if (etatDePaiement == "Premier paiement") {
    MontantRestant = parseInt($("#primevalue").text().replace(/\s/g, '')) - parseInt($("#MontantCotisationZone").val().replace(/\s/g, '')) + parseInt($("#isPremierPaiement").val());
  } else {
    MontantRestant=parseInt($("#primevalue2").text().replace(/\s/g, ''));
  }
  var MontantRestantFormater=formatMonetaire(MontantRestant);
  
  
  //affectation de la variable du droit d'adhesion
  droitAdhesion = formatMonetaire(parseInt($("#isPremierPaiement").val()));

  //var MontantInitialFormater=($("#primevalue"))? (new Intl.NumberFormat('fr-FR', {currency: 'XOF',style: 'currency'}).format(parseInt($("#primevalue").text().replace(/\s/g, '')))) : (new Intl.NumberFormat('fr-FR', {currency: 'XOF',style: 'currency'}).format(parseInt($("#primevalue2").text().replace(/\s/g, '')))) ;

  MontantInitialFormater=$("#primevalue").length == 1 ? formatMonetaire(parseInt($("#primevalue").text().replace(/\s/g, ''))) : formatMonetaire(parseInt($("#primevalue2").text().replace(/\s/g, '')));

  // Create new Date instance
  var date = new Date();
  var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  //tableData = '<div class="row px-2"><div class="col-sm-6 col-lg-4 fs-6">Paiement N° 1 </div><div class="col-sm-6 fs-5 col-lg-8 text-start">' + date.toLocaleDateString("fr-FR", options) + '</div></div>';
  var rest = parseInt(MontantRestantFormater.replace(/\s/g, ''));
  var restFormat = formatMonetaire(rest);
  console.log(restFormat);
  var time = date.toLocaleDateString("fr-FR");
  dval = {
    "Période": "Paiement initial",
    "Date": time,
    "Cotisation": MontantToPay,
    "Reste": restFormat
  };
  tableData.push(dval);
  switch(methodePaiementValue) {
      case "journalier":
        // code block
        cotisation=parseInt($("#primevalue").text().replace(/\s/g, '')) / 365;
        date.setMonth(date.getMonth() + 1);
        date=new Date(date.getFullYear(),date.getMonth(), 1);            
        nextPay=date.toLocaleDateString("fr-FR", options)
        for (var i = 1; i <= parseInt(periodeDePaiement)-60; i++) { 
          rest -= cotisation;
          //test du reste à payer
          rest=(rest<0 ? 0 : rest);
          //mise en forma texte
          rest = formatMonetaire(rest);
          cotisation = formatMonetaire(cotisation);
          //insertion dans le tableau
          dval = {
            "Période": "Paiement N° " + (i + 1) ,
            "Date": date.toLocaleDateString("fr-FR"),
            "Cotisation": cotisation,
            "Reste": rest
          };
          tableData.push(dval);
          // Add a day
          date.setDate(date.getDate() + 1);
          //mise en forme numerique
          cotisation = parseInt(cotisation.replace(/\s/g, ''));
          rest = parseInt(rest.replace(/\s/g, ''));
        }
        break;
      case "hebdomadaire":
        // code block
        cotisation=parseInt($("#primevalue").text().replace(/\s/g, '')) / 52;
        date.setMonth(date.getMonth() + 1);
        date=new Date(date.getFullYear(),date.getMonth(), 1);
        nextPay=date.toLocaleDateString("fr-FR", options)
      for (var i = 1; i <= parseInt(periodeDePaiement) - 8; i++) {            
        rest -= cotisation;
        //test du reste à payer
        rest=(rest<0 ? 0 : rest);
        //mise en forma texte
        rest = formatMonetaire(rest);
        cotisation = formatMonetaire(cotisation);
        //insertion dans le tableau
        dval = {
          "Période": "Paiement N° " + (i + 1),
          "Date": date.toLocaleDateString("fr-FR"),
          "Cotisation": cotisation,
          "Reste": rest
        };
        tableData.push(dval);
        // Add a day
        date.setDate(date.getDate() + 7);
        //mise en forme numerique
        cotisation = parseInt(cotisation.replace(/\s/g, ''));
        rest = parseInt(rest.replace(/\s/g, ''));              
      }
        break;
      case "mensuel":
        // code block
        cotisation=parseInt($("#primevalue").text().replace(/\s/g, '')) / 12;
        date.setMonth(date.getMonth() + 1);
        date=getNextMonday(new Date(date.getFullYear(),date.getMonth(), 10));
        nextPay=date.toLocaleDateString("fr-FR", options)
        for (var i = 1; i <= parseInt(periodeDePaiement) - 2; i++) {
          rest -= cotisation;
          //test du reste à payer
          rest=(rest<0 ? 0 : rest);
          //mise en forma texte
          rest = formatMonetaire(rest);
          cotisation = formatMonetaire(cotisation);
          //insertion dans le tableau
          dval = {
            "Période": "Paiement N° " + (i + 1),
            "Date": date.toLocaleDateString("fr-FR"),
            "Cotisation": cotisation,
            "Reste": rest
          };
          tableData.push(dval);
          // Add a day
          date.setMonth(date.getMonth() + 1);
          //mise en forme numerique
          cotisation = parseInt(cotisation.replace(/\s/g, ''));
          rest = parseInt(rest.replace(/\s/g, ''));
        }
        break;
      default:
        msgText = etatDePaiement;
        nextPay=date.toLocaleDateString("fr-FR", options);
        dval = {
          "Période": "Paiement",
          "Date": date.toLocaleDateString("fr-FR"),
          "Cotisation": MontantToPay,
          "Reste": "0 FCFA"
        };
        tableData.push(dval);
  }


  cotisation=formatMonetaire(cotisation);

  if (nextPay!==(new Date().toLocaleDateString("fr-FR", options))) {
    message1 = '<p class="fs-6"> Votre prochain paiement est pour le <span class = "fw-bold fs-6">' + nextPay + '</span></p>';
  }
  if (methodePaiementValue !== "annuelle") {
      message2 = '<p class="fs-6"> Le montant de celui-ci est <span class = "fw-bold fs-6">' + MontantPartiel + '</span></p>';
  }
  //$("#msgText").text(msgText);
  //msgText == "Premier paiement" ? $("#msgText").text("1er Paiement") : $("#msgText").text(msgText);
  
  $("#calendriertext1").html('<div class="row px-2"><div class="col-sm-6 fs-6">Mode de paiement actuel : </div><div class="col-sm-6 fs-5 text-lg-end">' + $(".methodePaiement:checked").data('name') + '</div></div><div class="row px-2 couverturemaladie"><div class="col-sm-6 fs-6">Couverture maladie : </div><div class="col-sm-6 fs-5 text-lg-end">' + MontantInitialFormater + '</div></div><div class="row px-2 droitadhesion"><div class="col-sm-6 fs-6">Droit d\'adhésion : </div><div class="col-sm-6 fs-5 text-lg-end">' + droitAdhesion + '</div></div><div class="row px-2 d-none"><div class="col-sm-6 fs-6">Montant total à payer : </div><div class="col-sm-6 fs-5 text-lg-end">' + $("#MontantCotisationZone0").val() + '</div></div><hr><div class="row px-2 fw-bold"><div class="col-sm-6 fs-4">' + msgText + ' : </div><div class="col-sm-6 fs-4 text-lg-end">' + MontantToPay + '</div></div><div class="row px-2 d-none"><div class="col-sm-6 fs-6">Montant total restant : </div><div class="col-sm-6 fs-5 text-lg-end">' + MontantRestantFormater + '</div></div><div class="row px-2 d-none"><div class="col-sm-6 col-lg-9 ps-lg-0 fs-6">NB: Vous paierez pour chacun de vos prochains paiement le montant de : </div><div class="col-sm-6 col-lg-3 pe-lg-0 fs-5 text-lg-end">' + cotisation + '</div></div>');

  //$("#calendriertext2").html(tableData);
  
  if (tableInitial == 0) {
    $('#myTable').DataTable({
      data: tableData,
      columns: [
        {data: 'Période'},
        {data: 'Date'},
        {data: 'Cotisation'},
        {data: 'Reste'}
      ],
      "ordering": false,
      "searching": false,
      "lengthChange": false,
      "info": false,
    });
    //$('#myTable').DataTable().rows.add(tableData).draw();
    //setTimeout(DatatableFn, 2000);
    tableInitial += 1;
  } else {
    //$('#myTable').DataTable().clear().draw();
    $('#myTable').DataTable().clear().rows.add(tableData).draw();
  }
  //$('#calendrier').modal('show');
}

function DatatableFn(id) {
  //initialisation de le table
  $(id).DataTable({    
  "ordering": false,
  "searching": false,
  "lengthChange": false,
    "info": false,
  });
}

//GenerateurPaiement du montant partiel
function GenerateurPaiement(params) {
  var xhttp = new XMLHttpRequest();
  // console.log(params);
  var info = "&jsondata=" + JSON.stringify(params);
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var jsonObject= JSON.parse(this.response);
      //console.log(this.responseText);             
      if (jsonObject.code == 201) {
          notifToken = (jsonObject.notif_token) ? jsonObject.notif_token : 'none';
          //solution d'henoch verifier qu'une methode est cocher
          let test =($(".methodePaiement:checked").val()===undefined)
          if (!test) {
            //envoie de l'echancier selectionner
            //envoie du tableau de data
            //console.log(tableData);
            inscription('saveEcheancier');

            //inscription definitif
            //inscription('update', jsonObject.payment_token, jsonObject.transaction_id, notifToken);

            //redirection apres inscription confimer
          //location.replace(jsonObject.payment_url);
          }
        }
        if (jsonObject.code!=201) {
          console.log(jsonObject.code+" "+jsonObject.message);
        }
    }
  };
  xhttp.open("GET", "script/paiement.php?paieprocess" + info);
  xhttp.send();
}

/**********************affichage du champ du code recommandation */
function coderec(params) {
  if (params==0) {    
     $('#code_recomande').empty();
     $('.alert-invalidcoderec').prop("hidden",true);
  }
  if (params==1) {
    $('#code_recomande').append('<input type="text" class="contact_input toupper coderecomandeinput" name="coderecomandeinput" id="code_recomandeinput" onfocusout="verificationcr()" maxlength="5" placeholder="Code">')
  }
}

//********fonction de controle du code promotion********* */
function verificationcr(){
  
  $.get("script/code_recommandation.json", function(data){
    //console.log(data);
    var checker=0;
      for (let index = 0; index < data.length; index++) {
         if ($('.coderecomandeinput').val().toUpperCase()==data[index]['code']) {
           //console.log(data[index]['code']);
           checker++;             
        }
        //console.log($('#code_recomande'));        
      }
      if (checker!==1) {
         $('.coderecomandeinput').addClass('invalid');
         $('.alert-invalidcoderec').prop("hidden",false);
      }
      else{
        $('.coderecomandeinput').removeClass('invalid')
        $('.alert-invalidcoderec').prop("hidden",true);
      }
    });
}

/*********************************************************** */
//choix de l'offre
function choix(offre,informations) {
  //generation de l'id unique
  var info = offre;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("containerlog").innerHTML = this.response;
      if (offre=='suitePaie') {
        $(document).ready(function () {
          $('#containerlog').removeClass('col-lg-6').addClass('col-lg-7');
          $('.logout').removeClass('d-none');
        });
        setTimeout(function () {
          DatatableFn('#myTable2');
        }, 250);
      }
      // Display the current tab
      showTab(currentTab);
      reload_js('script/fonction.js');
      //affectation des variables
      $('#nom_souscripteur').val(informations[0].nom);
      $('#prenom_souscripteur').val(informations[0].prenom);
      $('#contact_souscripteur').val(informations[0].contact);
      $('#email_souscripteur').val(informations[0].email);
      $('.logout').removeClass('d-none');
      //recharge des informations saisie de l'utilisateur si les informations sont similaires
      if (JSON.parse(getCookie('CookiesUsersData')).email == informations[0].email) {        
        setTimeout(function(){checkCookie();},250);
      }
    }
  };
  xhttp.open("GET", "./script/loader.php?" + info, true);
  xhttp.send();
}

//!-****************************fonction de verification/controles *******************************
function validateForm(classduformulaire) {
  // This function deals with validation of the form fields
  var x, y, y2, i, valid = true;
  x = document.getElementsByClassName(classduformulaire);
  // y = x[currentTab].getElementsByTagName("input");
  // y2=x[currentTab].getElementsByTagName("select");
  y = $('.' + classduformulaire + ' input');
  y2 = $('.' + classduformulaire + ' select');
  //y2=$('.'+classduformulaire+' select');
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y.eq(i).val() == "" && y.eq(i).prop('type') !== 'search' && y[i].type !== "checkbox") {
      // add an "invalid" class to the field:
      //y[i].className += " invalid";
      y.eq(i).addClass("invalid");
      // and set the current valid status to false:
      valid = false;
    } else {
      y.eq(i).removeClass("invalid");
    }


  }
  // A loop that checks every select field in the current tab:
  for (i = 0; i < y2.length; i++) {
    // If a field is empty...
    if ($('#situation_M').val() == "Célibataire" && $('#typeMembre').val() == 'Evêques') {
      $('#situation_M').addClass("invalid");
      valid = false;
    }
    if (y2.eq(i).val() == "") {
      // add an "invalid" class to the field:
      //y2[i].className += " invalid";
      y2.eq(i).addClass("invalid");

      // and set the current valid status to false:
      valid = false;
    } else {
      y2.eq(i).removeClass("invalid");
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (!valid) {
    $('#saisieincompletes').find('.modal-body').html(' Merci de renseigner tous les champs soulignés en rouge !')
    $('#saisieincompletes').modal('show')
    //document.getElementsByClassName("step")[currentTab].className += " finish";

  }
  return valid; // return the valid status
}

//fonction de correction du stepper
function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step"), ind=document.getElementsByClassName("indicateur_etape");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //console.log(n);
  //... and adds the "active" class to the current step:
  if (n !==2) {
    x[n].className += " active";
    for (let index = 0; index < ind.length; index++) {
      ind[index].removeAttribute('hidden'); 
    }
  }else{
    for (let index = 0; index < ind.length; index++) {
      ind[index].setAttribute('hidden',''); 
    }
  } 
}

/**************************************************************** */
function info_souscripteur(num) {
  var cache_info=document.getElementById("field_sante");
  // let zonesouscripteur=document.getElementsByClassName("infosouscripteur1");
  // let x1=zonesouscripteur[0].children[0].children[0].children[1].value;//nom
  // let x2=zonesouscripteur[0].children[0].children[1].children[1].value;//prenom
  // let x3=zonesouscripteur[0].children[1].children[0].children[1].value;//contact
  // let x4=zonesouscripteur[0].children[1].children[1].children[1].value;//email
  let typecontrat=$('#option_type_famille').val();
  var info="&nom="+$('#nom_souscripteur').val()+"&prenom="+$('#prenom_souscripteur').val()+"&contact="+$('#contact_souscripteur').val()+"&email="+$('#email_souscripteur').val()+"&typecontrat="+typecontrat;
  if (num == 1) {
      var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            cache_info.innerHTML=this.response;
            reload_js('script/fonction.js');            
          }
      };
      xhttp.open("GET", "./script/loader.php?info_assurer"+info, true);
      xhttp.send();
  
  } else {
      //cache_info.innerHTML="";
      var info="&typecontrat="+typecontrat;
      var cache_info=document.getElementById("field_sante");
      var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              cache_info.innerHTML=this.response;
              reload_js('script/fonction.js');
          }
      };
      xhttp.open("GET", "./script/loader.php?info_assurer"+info, true);
      xhttp.send();
  }
  info_souscripteur2();
  
}

function info_souscripteur2() {
  let opt_produit = $(".opt_produit:checked").val();
  var cache_addPersCharge=$("#addPersCharge");

  if (opt_produit=="individuel") {
    for (let index = 4; index < 11; index++) {
      $("#option_type_famille").val('normal');
      $(".option_type_famille").attr('hidden',true);
      $(".famille_simple").attr('hidden',true);
      $(".famille_entreprise").attr('hidden',true);
      cache_addPersCharge[0].setAttribute('hidden', '');
    }
  } else {
    $(".option_type_famille").attr('hidden',false);
    $(".famille_simple").attr('hidden',false);

    if ($(".status:checked").val()) {
      cache_addPersCharge[0].removeAttribute('hidden');
    }
    else
    {
      cache_addPersCharge[0].setAttribute('hidden', '');
    }
  }
}

function info_souscripteur3() {
  var option_type_famille=$(".option_type_famille select").val();

  if (option_type_famille=="normal") {      
          $(".famille_entreprise").attr('hidden',true);
          $(".famille_simple").attr('hidden',false); 
  } else {
          $(".famille_simple").attr('hidden',true);
          $(".famille_entreprise").attr('hidden',false);
          //console.log(cache_info2.children[index]);   
  }   
}

//coche d'acceptation des conditions particulieres
function buttonupdate(num) {
  if (num==0) {
      document.getElementById("nextBtn").removeAttribute("data-target");
  }
  if (num==1) {
    if(document.getElementById("agree").checked) {
      document.getElementById("paiement_sante").removeAttribute("hidden");
    }
    else{
      document.getElementById("paiement_sante").setAttribute('hidden','');
    }
    
  }   
}

//------------fonction ajout et de retrait de personne---------------
function addPersCharge(num) {
  var cache_info=document.getElementById("field_sante");
  var cache_info2=document.getElementById("field_enfant");

  let n_enfant = parseInt($("#nombre_enfant").val());
  let n_adulte = parseInt($("#nombre_adulte").val());
  let n_adulteLength = parseInt($("#field_sante .adfilA").length+$("#field_sante #adfil0").length);
 
  if (num == 0 && n_adulte !== 0) {
      if ( n_adulteLength < n_adulte) {
        info="&type_adherent="+num+"&type_adherent_id="+document.getElementById("field_sante").lastElementChild.id
          var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  cache_info.lastElementChild.insertAdjacentHTML('afterend',this.response);
                  reload_js('script/fonction.js');
              }
          };
          xhttp.open("GET", "./script/loader.php?add_adherent"+info, true);
          xhttp.send();      
      }
      else {
        document.getElementById("saisieincompletestext").innerHTML = 'Merci d\'augmenter le nombre d\'adultes à couvrir';
        $('#saisieincompletes').modal('show')
      }
    }
  if (num == 1 && n_enfant !== 0 ) {
      if ($("#field_enfant .adfilE").length < n_enfant) {
        info="&type_adherent="+num+"&type_adherent_id="+(document.getElementById("field_enfant").lastElementChild?document.getElementById("field_enfant").lastElementChild.id:"efil0")
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            if (document.getElementById("field_enfant").lastElementChild) {
              cache_info2.lastElementChild.insertAdjacentHTML('afterend',this.response);
            } 
            else {
              cache_info2.innerHTML = this.response;
              reload_js('script/fonction.js');
            }                
          }            
        };
        xhttp.open("GET", "./script/loader.php?add_adherent"+info, true);
        xhttp.send();
      }
      else {
        document.getElementById("saisieincompletestext").innerHTML = 'Merci d\'augmenter le nombre d\'enfants à couvrir';
        $('#saisieincompletes').modal('show');
      }
    }
    else {
      document.getElementById("saisieincompletestext").innerHTML = 'Merci d\'augmenter le nombre d\'enfants à couvrir';
      $('#saisieincompletes').modal('show');
    }
}

function removePersCharge(num) {
  document.getElementById(num).remove();
}

//------------fonction de recuperation des valeurs du formulaire-----
function recupformvalue(num,num2) {
  let jsonfield_santecontents=formDataToObject(document.getElementById('form_souscrire_sante'));
  var info = "&jsonfield_santecontents=" + JSON.stringify(jsonfield_santecontents);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var message=this.response
        if (num == "component_infos") {
          Array.prototype.forEach.call(document.getElementsByClassName(num), function (el) {
            el.innerHTML = message;
          });                 
        }
        if (num == "component_facturation") {
              var partreponse=this.responseText;
              document.getElementById("modalheader").innerHTML=partreponse.split("//")[0];
              document.getElementById("component_facturation").innerHTML=partreponse.split("//")[1];
            }
            
        }
      };
      xhttp.open("GET", "./script/loader.php?"+num2+info, true);
      xhttp.send();     
}

//----------------------fonction de mise au format JSON-------------
function formDataToObject(elForm) {
  if (!elForm instanceof Element) return;
  var fields = elForm.querySelectorAll('input, select, textarea'),
    o = {};
  for (var i=0, imax=fields.length; i<imax; ++i) {
    var field = fields[i],
      sKey = field.name || field.id;
    if (field.type==='button' || field.type==='image' || field.type==='submit' || !sKey) continue;
    switch (field.type) {
      case 'checkbox':
        o[sKey] = +field.checked;
        break;
      case 'radio':
        if (o[sKey]===undefined) o[sKey] = '';
        if (field.checked) o[sKey] = field.value;
        break;
      case 'select-multiple':
        var a = [];
        for (var j=0, jmax=field.options.length; j<jmax; ++j) {
          if (field.options[j].selected) a.push(field.options[j].value);
        }
        o[sKey] = a;
        break;
      default:
        o[sKey] = field.value;
    }
  }
  //alert('Form data:\n\n' + JSON.stringify(o, null, 2));
  return o;
}

function stringToForm(formString, unfilledForm) {
  formObject = JSON.parse(formString);
  //console.log(formObject);
  //console.log(unfilledForm);
  unfilledForm.find("input, select, textarea").each(function() {
    if (this.name) {
        name = this.name;
        id = this.id;
        elem = $(this); 
        //console.log(name);
        //console.log(id);
        //console.log(elem);
        if (elem.attr("type") == "checkbox" || elem.attr("type") == "radio" ) {
            elem.prop("checked", formObject[id]);
            //elem.prop("checked", 'true');
        } else {
            elem.val(formObject[id]);
        }
    }
  });
}

//------------------------------------------------------------------
function contenuville(num) {
  var destination,destination2,source,choix,choix2,text
  if (num==1) {
    source=document.getElementById('ville');
    destination=document.getElementById('commune');
    destination2=document.getElementById('quartier');
    text="commune";

  }
  if (num==2) {
    source=document.getElementById('ville');
    destination=document.getElementById('quartier');
    choix2=document.getElementById('commune').options[document.getElementById('commune').selectedIndex].value;
    text="quartier";
  }
  
  choix=source.options[source.selectedIndex].value;
  var info="&choix="+choix+"&choix2="+choix2+"&num="+num
  var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (num==1) {
          destination.innerHTML='<option >Choix '+text+'</option>'+this.response;
          //destination2.innerHTML='<option >Choix quartier</option>'+this.response;
        } else {
          destination.innerHTML='<option >Choix '+text+'</option>'+this.response;
        }
          

      }
  };
  xhttp.open("GET", "./script/script.php?liste"+info, true);
  xhttp.send();
}

//fonction de verifiaction de l'age limite des adultes
function verif_age_limite(){
  //var birthday =document.getElementsByClassName("date_naissance_item");
  var n=0;
  for ( i = 0; i < document.getElementsByClassName("date_naissance_item").length; i++) {
    var userinput=document.getElementsByClassName("date_naissance_item")[i].value;
    var dob = new Date(userinput);
    var actuel = new Date().getFullYear();
    //extract year from date    
    var year = dob.getFullYear();
    
    //now calculate the age of the user
    var age = Math.abs(actuel-year);
    if (age>65) {
      n+=1;
    }else{n=0}
  }
  return n;
}

//fonction de selections des vues à afficher
function choixmodal() {
  var exclusion_item=document.getElementsByClassName("exclusion_item");
  var counter=0;
  var testage=verif_age_limite();
  for (i = 0; i < exclusion_item.length; i++) {
    if(exclusion_item[i].checked){
      counter++;
    }
  }
  //if (counter==0 && testage==0) 
  if (testage==0) {
    if (!validateForm("contact_form") || !verifierinput()) {
      $('#saisieincompletes').modal('show')
      return false; 
    }   
    recupformvalue("component_infos","infosante");
    $('#infos_sante').modal('toggle');
  } else {
    if (testage!==0) {
      // document.getElementById('text_exclusion').innerHTML="Un ou plusieurs de vos assurés ont atteint l'age limite pour soucrire à une assurance <sup>*</sup> ";
      // document.getElementById('text_exclusion2').innerHTML="";
      $('#infos_age_limite').modal('show');
      //console.log(testage);
    } else {
      // document.getElementById('text_exclusion').innerHTML="Un ou plusieurs de vos assurés souffrent d'une `maladie exclue` <sup>*</sup>  ";
      // document.getElementById('text_exclusion2').innerHTML="*</sup> Une maladie exclue est une maladie qui n'est pas assurée ;";
      $('#infos_maladies_exclusives').modal('show');
      //console.log("on eu");
    }
    
  }
      //console.log(counter);
}

//ajout de lieu de naissance supplementaires
function addlieu(params) {
  //recuperation de la valeur saisie
  valeur_saisi=$('#saisie_lieu_de_naissance_scd').val();
  //console.log(valeur_saisi);
  //mise de la premiere lettre en majuscule pour la valeur à afficher
  optionText = valeur_saisi.charAt(0).toUpperCase() + valeur_saisi.slice(1);
  //mise en minuscule de la valeur de l'option
  optionValue = valeur_saisi.charAt(0).toUpperCase() + valeur_saisi.slice(1);
  //insertion de la valeur dans l'option
  $('#'+$('#addingButton').data("nberzone")).append(new Option(optionText, optionValue));
  //nouveau trie de la liste
  selectrie($('#addingButton').data("nberzone"));
  //selection de l'element rajouter
  $('#'+$('#addingButton').data("nberzone")).val(optionValue).change();
}

//changement profession
function addprofession(params,params2) {
  $("#" + params2).val('');
  if ($("#"+params).val() == "Activités Religieuse") {
    $("#" + params2 +" .ordinaire").addClass('d-none');
    $("#" + params2 +" .Religieuse").removeClass('d-none');
  } else {
    $("#" + params2 +" .Religieuse").addClass('d-none');
    $("#" + params2 +" .ordinaire").removeClass('d-none');
  }

}

//fonction trie******************************
function selectrie(ElemtAtrie) {
  $('#' + ElemtAtrie).append($('#' + ElemtAtrie + ' option')
    .remove().sort(function (a, b) {
      var at = $(a).text(),
      bt = $(b).text();
      if (at !== "Hors du pays" && bt !== "Hors du pays" && at !== "Choix lieu de naissance" && bt !== "Choix lieu de naissance") {
        return (at > bt) ? 1 : ((at < bt) ? -1 : 0);
      }    
    }));
}

//envoie de mail
function sendmail2(typeDeMail){
	var info="&typeDeMail="+typeDeMail;
	var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            //reload_js('script/fonction.js');            
          }
      };
      xhttp.open("GET", "./script/notificationInscription.php?sendmail"+info, true);
      xhttp.send();
}

//fonction pour imprimer une demande----------------------------------------------------
function immpressionFiche(params) {
  var info="&transactionid="+params;
  var xhttp = new XMLHttpRequest();
  //var info="&varid="+num+"&vartype="+type;
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (!this.responseText.includes('Désolé') && this.responseText!=="") {
        $("#impressresult #espace").html(this.responseText);
        $("#impressionmodal").modal("show");
        $("#impressionmodal").find('.btnimpression, .convention').removeClass("d-none");
        // $("#impressionmodal").find('.convention').removeClass("d-none");
      }else {
        $("#impressionmodal").find('.btnimpression , .convention').addClass("d-none");
        // $("#impressionmodal").find('.convention').addClass("d-none");
      }
    }
  };   
  xhttp.open("GET", "./script/script.php?fiche"+info, true);
  xhttp.send()
}

//!-********************fonction pour Impression*******************************

function printElement(elem, append, delimiter) {
  
  var domClone = elem.cloneNode(true);

  var $printSection = document.getElementById("printSection");

  if (!$printSection) {
    var $printSection = document.createElement("div");
    $printSection.id = "printSection";
    //document.body.appendChild($printSection);
    $('body').after($printSection);
  }

  if (append !== true) {
    $printSection.innerHTML = "";
  } else if (append === true) {
    if (typeof (delimiter) === "string") {
      $printSection.innerHTML += delimiter;
    } else if (typeof (delimiter) === "object") {
      $printSection.appendChlid(delimiter);
    }
  }

  $printSection.appendChild(domClone);
}

function imprimer() {
  //document.title="Demande de "+type_demande+" "+info;
  printElement(document.getElementById("impressresult"));
  window.print();
}
//*********logout */
function logout(params) {
  origin = document.location.origin + document.location.pathname;
  window.location.replace(origin);  
}
/****** modification du 24/03/2022
 $('#rechercher').on("click", function () {
   //$('#total_centre_sante').text(0);
   //$('#total_pharmacie').text(0);
   selectedville = "";
   selectedcommune = "";
   if ($('#ville').val() !== 'abidjan') {
     //$('#choix_commune').attr('hidden',true);
     selectedville = selectedcommune = $('#ville').val();
     //$('#commune').val($('#commune')[0][1].value)
   } else {
     //$('#choix_commune').removeAttr('hidden');
     selectedcommune = $('#commune').val();
   }

   $.get("script/reseaux.json", function (data) {
     //console.log($('#ville').val()+" "+$('#commune').val().toUpperCase());
     //parcours des communes
     var listecentreSante1 = listecentreSante2 = listecentreSante3 = listecentreSante4 = listecentreSante5 = " ";
     for (let i = c1 = c2 = c3 = c4 = c5 = 0; i < data.length; i++) {

       //? on compare la valeur de la commune a celle dans le systeme
       if (data[i]['commune'] == (selectedcommune).toUpperCase()) {
         //recuperation des noms de commune
         //console.log(data['commune'][i]['nom']);
         //parcours des centres par communes

         if (data[i]['type'] == 'Soins ambulatoires') {
           if (c1 % 2 == 0) {
             listecentreSante1 += '<div class="row" style="margin-top: 0.5% ;">';
           }
           listecentreSante1 += '<div class="col-sm-6"> <div class="card cardmod" href="#"><div class="card-block"><h5 class="card-title" style="font-weight: bolder;">' + data[i]['nom'].toUpperCase() + '</h5> <h6 class="card-subtitle text-muted">' + data[i]['type'] + '</h6><p class="card-text p-y-1"><i class="fa fa-phone spaceicone"></i>' + data[i]['contact'] + '</p><p class="card-text indicateur p-y-1"><i class="fa fa-street-view spaceicone"></i></i>' + data[i]['localisation'] + '.</p> </div> </div> </div>';
           //test de verification pour retour a la ligne apres chaque groupe de 2 iteration
           if (c1 % 2 == 1) {
             listecentreSante1 += '</div>';
           }
           c1++;
         }
         //?definition de nombres de centre trouver

         if (data[i]['type'] == 'Opticiens') {
           if (c2 % 2 == 0) {
             listecentreSante2 += '<div class="row" style="margin-top: 0.5% ;">';
           }
           listecentreSante2 += '<div class="col-sm-6"> <div class="card cardmod" href="#"><div class="card-block"><h5 class="card-title" style="font-weight: bolder;">' + data[i]['nom'].toUpperCase() + '</h5> <h6 class="card-subtitle text-muted">' + data[i]['type'] + '</h6><p class="card-text p-y-1"><i class="fa fa-phone spaceicone"></i>' + data[i]['contact'] + '.</p><p class="card-text indicateur p-y-1"><i class="fa fa-street-view spaceicone"></i></i>' + data[i]['localisation'] + '.</p> </div> </div> </div>';
           //test de verification pour retour a la ligne apres chaque groupe de 2 iteration

           if (c2 % 2 == 1) {
             listecentreSante2 += '</div>';
           }
           c2++;
         }
         if (data[i]['type'] == 'Cabinets dentaires') {
           if (c3 % 2 == 0) {
             listecentreSante3 += '<div class="row" style="margin-top: 0.5% ;">';
           }
           listecentreSante3 += '<div class="col-sm-6"> <div class="card cardmod" href="#"><div class="card-block"><h5 class="card-title" style="font-weight: bolder;">' + data[i]['nom'].toUpperCase() + '</h5> <h6 class="card-subtitle text-muted">' + data[i]['type'] + '</h6><p class="card-text p-y-1"><i class="fa fa-phone spaceicone"></i>' + data[i]['contact'] + '.</p><p class="card-text indicateur p-y-1"><i class="fa fa-street-view spaceicone"></i></i>' + data[i]['localisation'] + '.</p> </div> </div> </div>';
           //test de verification pour retour a la ligne apres chaque groupe de 2 iteration

           if (c3 % 2 == 1) {
             listecentreSante3 += '</div>';
           }
           c3++;
         }
         if (data[i]['type'].includes('Laboratoires') || data[i]['type'].includes('Radiologie')) {
           if (c4 % 2 == 0) {
             listecentreSante4 += '<div class="row" style="margin-top: 0.5% ;">';
           }
           listecentreSante4 += '<div class="col-sm-6"> <div class="card cardmod" href="#"><div class="card-block"><h5 class="card-title" style="font-weight: bolder;">' + data[i]['nom'].toUpperCase() + '</h5> <h6 class="card-subtitle text-muted">' + data[i]['type'] + '</h6><p class="card-text p-y-1"><i class="fa fa-phone spaceicone"></i>' + data[i]['contact'] + '.</p><p class="card-text indicateur p-y-1"><i class="fa fa-street-view spaceicone"></i></i>' + data[i]['localisation'] + '.</p> </div> </div> </div>';
           //test de verification pour retour a la ligne apres chaque groupe de 2 iteration

           if (c4 % 2 == 1) {
             listecentreSante4 += '</div>';
           }
           c4++;
         }
         if (data[i]['type'] == 'Pharmacie') {
           if (c5 % 2 == 0) {
             listecentreSante5 += '<div class="row" style="margin-top: 0.5% ;">';
           }
           listecentreSante5 += '<div class="col-sm-6"> <div class="card cardmod" href="#"><div class="card-block"><h5 class="card-title" style="font-weight: bolder;">' + data[i]['nom'].toUpperCase() + '</h5> <h6 class="card-subtitle text-muted">' + data[i]['type'] + '</h6><p class="card-text p-y-1"><i class="fa fa-phone spaceicone"></i>' + data[i]['contact'] + '.</p><p class="card-text indicateur p-y-1"><i class="fa fa-street-view spaceicone"></i></i>' + data[i]['localisation'] + '.</p> </div> </div> </div>';
           //test de verification pour retour a la ligne apres chaque groupe de 2 iteration

           if (c5 % 2 == 1) {
             listecentreSante5 += '</div>';
           }
           c5++;
         }
       }
     }
     //$('#total_records').text(parseInt($('#total_centre_sante').text())+parseInt($('#total_pharmacie').text()))

     //? insertion des centres et pharmacies dans les onglets
     tab = [listecentreSante1, listecentreSante2, listecentreSante3, listecentreSante4, listecentreSante5];
     tabtitre = ["Cliniques", "Centres Optiques", "Cabinets dentaires", "Laboratoires et Centres de Radiologie", "Pharmacies"];
     //verification des centres vides
     for (let i = 0; i < tab.length; i++) {
       if (tab[i] !== " ") {
         tab[i] = tab[i];
       } else {
         tab[i] = '<p class="mention" style="text-align: center; color: #be1d2e; margin-top: 5%;">Les ' + tabtitre[i] + ' de cette zone sont en cours de conventionnement. </br> Merci de vérifier ultérieurement.</p>';
       }
     }
     $('#nav-clinique').html(tab[0]);
     $('#nav-opticiens').html(tab[1]);
     $('#nav-cab_dantaire').html(tab[2]);
     $('#nav-lab_radio').html(tab[3]);
     $('#nav-pharmacie').html(tab[4]);

   });
 });
 */