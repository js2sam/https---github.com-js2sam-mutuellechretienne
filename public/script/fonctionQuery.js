// this code is to solve bootstrap modal switching bug
// $('.modal').on('shown.bs.modal', function (e) {
//   $("body").addClass("modal-open")
// });

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
//*************fonction menu mobile et autres au chargement de la page********* */
$(document).ready(function () {
  //recharge des informations saisie de l'utilisateur
  checkCookie();
  //action du menu mobile
  $(".hamburger i").click(function() {
    $(".trans_400").css("right","0px");
  });
  $(".menu_close i").click(function() {
    $(".trans_400").css("right","");
    //console.log($(".trans_400"));

  // var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  // var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  //   return new bootstrap.Tooltip(tooltipTriggerEl)
  // })
  //tooltips
  $('[data-bs-toggle="tooltip"]').tooltip();
  //comment the following line out to see page move on click
  $('a[data-bs-toggle-toggle="tooltip"]').click(function(e){e.preventDefault()})
  });
  //transfert des informations dans le register
  $('#LoginModalCenter').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('titre') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-body #TypeMembreRegister').val(recipient)
  })
  // numero de telephone
  $('.contact_item').focusout(function(){
    //reinitialisation de la couleur du numero
    $(this).removeClass("orangenumber moovnumber mtnnumber");

    let regex = /^[\+]?[0-9]{2}?[0-9]{2}?[0-9]{6}$/;//regex de verificetion
    
    res = regex.test($(this).val().replace(/\s/g, ''));  
    if (!res && $(this).val() !== "") {
        //message de remplacement du corps du message
        $('#saisieincompletes').find('.modal-body').html("Le numéro de téléphone <span class='fw-bold'>"+$(this).val()+"</span> n'est pas conforme. <br> Merci de renseigner un numéro valide. Ex: 01 02 03 04 05");
        $('#saisieincompletes').modal('show');
        $(this).val('');
    }
    if (res && $(this).val() !== "") {
      var reseauType=$(this).val();
      let contactID=$(this).attr('id');
      //console.log(reseauType.substring(0,2));
      //if (reseauType !== "") {        
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
      //} else {
      //  $(this).removeClass("orangenumber moovnumber mtnnumber");
      //}
    }  
    
  });
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
    cptcount=0;
    //console.log(cpt);
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
        '<label class="text-dark" for="exampleInputEmail1">Numéro portable ' + cptcount + '<span class="text-danger fw-bold">*</span></label><div class="input-group mb-3">' +
        '<input name="contact" id="contact" type="number" class="contact_input contact_item" placeholder="Contact" value=" " aria-label="" aria-describedby="basic-addon1" style="width: 86%;"><i class="btn text-primary align-self-center border border-0 p-0 btnNumberRemove material-icons align-middle fs-2" data-nberzone="' + cpt + '" data-bs-toggle="tooltip" data-bs-placement="top" title="retirer le autre numero" >&#xf230;</i></div><label class="text-danger fw-bold" id="contact_error"></label></div>';
      $(zone).eq(position).after(toadd);
    }
    else {
      //$(this).removeClass('btnNumberAdd');
    }
    reload_js('script/fonction.js');
  });
  //bouton ajout de numero supplementaire
  $('.btnNumberRemove').on("click", function () {
    $(this).parent().parent().remove();
    cpt = $(this).data("nberzone");
    cptcount = 0;
    // if ($("." + cpt).length < 3 && !$(this).hasClass('lcontact')) { 

    // }
  });
  // de l'adresse email
  $('.email_item').focusout(function(){
      let regex = /^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9\\-]+([_|\.|-]­{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$/;//regex de verificetion
      res= regex.test($(this).val());
      if (!res && $(this).val()!=="") {
        //message de remplacement du corps du message
        $('#saisieincompletes').find('.modal-body').html("L'adresse email <span class='fw-bold'>"+$(this).val()+"</span> n'est pas conforme. <br> Merci de renseigner une adresse email valide. Ex: nom@site.com");
        $('#saisieincompletes').modal('show');
        $(this).val('');
      }
      else{
        $(this).val($(this).val().toLowerCase());
      }
  });
});
//controle de la date de naissance
$('.date_naissance_item').focusout(function () {
  userinput = $(this).val().substring(0, 10);
  //console.log(new Date(userinput));
  var actuel = new Date().toISOString().slice(0, 10);
  //console.log(new Date(actuel));
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
      if (testage!==0) {        
        $('#infos_age_limite').modal('show');
      }
      //$(this).val('');
    }
  }
  //console.log(actuel==userinput);    
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
  var tabsouscripteur = [$('#name_souscripteur').val(), $('#prenom_souscripteur').val(), $('#contact').val()]
  var modal = $(this)
  modal.find('.modal-title').text('Nouveau message à ' + recipient)
  modal.find('.modal-body #recipient-name').val(recipient)
  modal.find('.modal-body #nom_prenom').val(tabsouscripteur[0] + ' ' + tabsouscripteur[1])
  modal.find('.modal-body #telephone').val(tabsouscripteur[2])
})

//***************fonction affichage des details*************
function details(paramets) {
  $('#details'+paramets).modal('show');
}

//generation de commune au choix de la ville sur la liste
$(".ville_item").change(function(){
  //var selectedville = $(this).children("option:selected").val();
  chargecommune();
});

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
  }
  else {
    //...the form gets submitted:
    $(".login").submit();
    return false;
  }

});
$('.validation_r').on("click", function () {
  if (!validateForm('inscription')) {
    return false;
  }
  else {
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
    if(!validateForm('formRecuperation')) {
      return false;
    }
    else {
      //...the form gets submitted:
      $(".formRecuperation").submit();
      return false;
    }
  }
  
});
//envoie du formulaire
$(".inscription , .login , .formRecuperation").on("submit", function (e) {
  var typeform=$(this).attr('id');
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
      setCookie('userinfo', response, 1);
      //console.log(jsonObjectConnect);
      //inscription
      if (typeform=="formInscription") {
        if (jsonObjectConnect.auth==0) {
            $("#msg").html(
          '<div class="alert alert-info"><i class="fa fa-exclamation-triangle"></i> Il y a une erreur dans le login ou le mot de passe, ou email à déja été utilisé</div>'
          );
        }
        if (jsonObjectConnect.auth==1) {
          if (jsonObjectConnect[0].type_user == "Pasteurs, Pretres et Fideles") {
            choix("pasteursEtFideles", jsonObjectConnect);
            //modification de l'url
            window.history.pushState("", "", '/?register=true&produit=pasteursEtFideles');
          }
          if (jsonObjectConnect[0].type_user == "Eveques") {
            choix("eveques", jsonObjectConnect);
            //modification de l'url
            window.history.pushState("", "", '/?register=true&produit=eveques');
          }
          //fermeture du modal
          $('#LoginModalCenter').modal('hide');
        }
      }
      if (typeform == "formLogin") {
          if (jsonObjectConnect.auth==1) {
            //verification si la premier paiement n'est pas effectuer
            if (jsonObjectConnect[0].premiere_fois=='oui') {
              if (jsonObjectConnect[0].type_user == "Pasteurs, Pretres et Fideles") {
                choix("pasteursEtFideles", jsonObjectConnect);
                //modification de l'url
                window.history.pushState("", "", '?login=true&produit=pasteursEtFideles');
              }
              if (jsonObjectConnect[0].type_user == "Eveques") {
                choix("eveques", jsonObjectConnect);
                //modification de l'url
                window.history.pushState("", "", '?login=true&produit=eveques');
              }
            } else {
              choix("suitePaie", jsonObjectConnect);
              //modification de l'url
              window.history.pushState("", "", '?login=true&produit=suitePaie');
            }            

            //fermeture du modal
            $('#LoginModalCenter').modal('hide');
          }
          else{
            $("#msg2").html(
          '<div class="alert alert-info"><i class="fa fa-exclamation-triangle"></i> Il y a une erreur dans le login et ou le mot de passe.</div>'
          );
          }
      }
      if (typeform == "formRecuperation") {
        if (jsonObjectConnect.auth == 0) {
          $("#msgrecuperation").html(
            '<div class="alert alert-info"><i class="fa fa-exclamation-triangle"></i> Il y a une erreur dans le email ce dernier n\'existe pas</div>'
          );
          $(".zonerecup").addClass('d-none');
        }
        if (jsonObjectConnect.auth == 1 && jsonObjectConnect.pass==1) {
          $("#msgrecuperation").html(
            '<div class="alert alert-info"><i class="fa fa-exclamation-triangle"></i> Un code de recuperation vous à été envoyé à l\'email indiqué, merci de le renseigner en dessous</div>'
          );
          $(".zonerecup").removeClass('d-none');
          $('.validation_recuperation').data('name','confirmation');

        }
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
      console.log('nok error');
      //$("#msg").html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Il y a eu un problème.</div>');
    }
  });
});
/*********************selection de mode de paiement */
$('input:radio').change(function () { //Clicking input radio
  var radioClickedName = $(this).attr('name');
  var radioClickedId = $(this).attr('id');
  
  //affichage des champs de details de menaces
  if (radioClickedName == 'methodePaiement') {
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
    calendrierDePaiement();
  }
  //affichage des champs de methode de paiement
  if (radioClickedName == 'methodePaiement1') {
    if (radioClickedId == 'journalier1') {
      $('.methodePaiement').eq(0).prop("checked", true)
      $('.colmois, .colsemaine').addClass('d-none');
      $('.coljour, .colannuelle').removeClass('d-none');
      CalculDuMontantDeCotisation("0", ".coljour")
    }
    if (radioClickedId == 'hebdomadaire1') {
      $('.methodePaiement').eq(1).prop("checked", true)
      $('.colmois, .coljour').addClass('d-none');
      $('.colsemaine, .colannuelle').removeClass('d-none');
      CalculDuMontantDeCotisation("0", ".colsemaine")
    }
    if (radioClickedId == 'mensuel1') {
      $('.methodePaiement').eq(2).prop("checked", true)
      $('.coljour, .colsemaine').addClass('d-none');
      $('.colmois, .colannuelle').removeClass('d-none');
      CalculDuMontantDeCotisation("0", ".colmois")
    }
    if (radioClickedId == 'annuelle1') {
      $('.methodePaiement').eq(3).prop("checked", true)
      $('.colannuelle, .colfamille, .colindividuel').addClass('d-none');
      CalculDuMontantDeCotisation("0", ".colannuelle")
    }
  }
  //action de paiement pour la suite des cotisation
  if (radioClickedName == 'methodePaiement3') {
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
  }
});
//choix du produit
$(".opt_produit").click(function () {
  //info_souscripteur2();
  info_souscripteur(2);
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

  if ($(this).attr('id')=="nombre_enfant" && $(this).val()<0) {
    $(this).val('3');
  }
  if ($(this).attr('id')=="nombre_adulte" && $(this).val()<1) {
    $(this).val('2');
  }

});

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
  let newMontantFormate = (new Intl.NumberFormat('fr-FR', {currency: 'XOF',style: 'currency'}).format(newMontant));
  $("#MontantCotisationZone,#MontantCotisationZoneDuplication").val(newMontantFormate);
  if ($(".methodePaiement:checked").val() == "annuelle") {
    $("#MontantCotisationZone0").val(newMontant);
  }
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
function calendrierDePaiement(params) {
  let methodePaiement = document.getElementsByClassName("methodePaiement");
  let methodePaiementValue;
  var tableData="";
  var cotisation=0;
  var MontantInitial = 0;
  var MontantToPay = (new Intl.NumberFormat('fr-FR', {currency: 'XOF',style: 'currency'}).format(parseInt($("#MontantCotisationZone").val().replace(/\s/g, ''))));
  var droitAdhesion = 0;
  var nextPay = message1 = message2 = "";
  var msgText = "Premier paiement";
  let TabMethodePaiement={"annuelle":'1',"mensuel":'12',"hebdomadaire":'52',"journalier":'365'}
  for (let index = 0; index < methodePaiement.length; index++) {
    if (methodePaiement[index].checked == true) {
      methodePaiementValue=methodePaiement[index].value;
      var periodeDePaiement = TabMethodePaiement[methodePaiementValue];
      
      //calcule du montant restant
      var MontantRestant=parseInt($("#primevalue").text().replace(/\s/g, ''))-parseInt($("#MontantCotisationZone").val().replace(/\s/g, ''))+parseInt($("#isPremierPaiement").val());
      var MontantRestantFormater=(new Intl.NumberFormat('fr-FR', {currency: 'XOF',style: 'currency'}).format(MontantRestant));
      
      //affectation de la variable du droit d'adhesion
      droitAdhesion = (new Intl.NumberFormat('fr-FR', {currency: 'XOF',style: 'currency'}).format(parseInt($("#isPremierPaiement").val())));
  
      //var MontantInitialFormater=($("#primevalue"))? (new Intl.NumberFormat('fr-FR', {currency: 'XOF',style: 'currency'}).format(parseInt($("#primevalue").text().replace(/\s/g, '')))) : (new Intl.NumberFormat('fr-FR', {currency: 'XOF',style: 'currency'}).format(parseInt($("#primevalue2").text().replace(/\s/g, '')))) ;

      var MontantInitialFormater=($("#primevalue").length==1)? (new Intl.NumberFormat('fr-FR', {currency: 'XOF',style: 'currency'}).format(parseInt($("#primevalue").text().replace(/\s/g, '')))) : (new Intl.NumberFormat('fr-FR', {currency: 'XOF',style: 'currency'}).format(parseInt($("#primevalue2").text().replace(/\s/g, ''))))
  
      // Create new Date instance
      var date = new Date();
      var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      tableData = '<div class="row px-2"><div class="col-sm-6 col-lg-4 fs-6">Paiement N° 1 </div><div class="col-sm-6 fs-5 col-lg-8 text-start">' + date.toLocaleDateString("fr-FR", options) + '</div></div>';
      switch(methodePaiementValue) {
          case "journalier":
            // code block
            cotisation=parseInt($("#primevalue").text().replace(/\s/g, '')) / 365;
            date.setMonth(date.getMonth() + 1);
            date=new Date(date.getFullYear(),date.getMonth(), 1);            
            nextPay=date.toLocaleDateString("fr-FR", options)
            for (var i = 1; i < parseInt(periodeDePaiement)-60; i++) {              
              // Add a day
              tableData+='<div class="row px-2"><div class="col-sm-6 col-lg-4 fs-6">Paiement N° '+(i+1)+'</div><div class="col-sm-6 fs-5 col-lg-8 text-start">'+date.toLocaleDateString("fr-FR", options)+'</div></div>';
              date.setDate(date.getDate() + 1);
            }
            break;
          case "hebdomadaire":
            // code block
            cotisation=parseInt($("#primevalue").text().replace(/\s/g, '')) / 52;
            date.setMonth(date.getMonth() + 1);
            date=new Date(date.getFullYear(),date.getMonth(), 1);
            nextPay=date.toLocaleDateString("fr-FR", options)
            for (var i = 1; i < parseInt(periodeDePaiement)-8; i++) {
              // Add a day
              tableData += '<div class="row px-2"><div class="col-sm-6 col-lg-4 fs-6">Paiement N° ' + (i + 1) + '</div><div class="col-sm-6 col-lg-8 fs-5 text-start">' + date.toLocaleDateString("fr-FR", options) + '</div></div>';
              date.setDate(date.getDate() + 7);
              
            }
            break;
          case "mensuel":
            // code block
            cotisation=parseInt($("#primevalue").text().replace(/\s/g, '')) / 12;
            date.setMonth(date.getMonth() + 1);
            date=getNextMonday(new Date(date.getFullYear(),date.getMonth(), 10));
            nextPay=date.toLocaleDateString("fr-FR", options)
            for (var i = 1; i < parseInt(periodeDePaiement)-2; i++) {
              // Add a day
              tableData+='<div class="row px-2"><div class="col-sm-6 col-lg-4 fs-6">Paiement N° '+(i+1)+'</div><div class="col-sm-6 fs-5 col-lg-8 text-start">'+date.toLocaleDateString("fr-FR", options)+'</div></div>';
              date.setMonth(date.getMonth() + 1);
            }
            
            break;
        default:
          msgText = "Paiement Intégral";
          nextPay=date.toLocaleDateString("fr-FR", options)           
          tableData+='<div class="row px-2"><div class="col-sm-6 col-lg-4 fs-6">Paiement</div><div class="col-sm-6 fs-5 col-lg-8 text-start">'+date.toLocaleDateString("fr-FR", options)+'</div></div>';

        }
    }
  }
    cotisation=(new Intl.NumberFormat('fr-FR', {
    currency: 'XOF',style: 'currency'}).format(cotisation));

  if (nextPay!==(new Date().toLocaleDateString("fr-FR", options))) {
    message1 = '<p class="fs-6"> Votre prochain paiement est pour le <span class = "fw-bold fs-6">' + nextPay + '</span></p>';
  }
  if (methodePaiementValue !== "annuelle") {
      message2 = '<p class="fs-6"> Le montant de celui-ci est <span class = "fw-bold fs-6">' + MontantPartiel + '</span></p>';
  }
  //$("#msgText").text(msgText);
  msgText == "Premier paiement" ? $("#msgText").text("1er Paiement") : $("#msgText").text(msgText);
  $("#calendriertext1").html('<div class="row px-2"><div class="col-sm-6 fs-6">Mode de paiement actuel : </div><div class="col-sm-6 fs-5 text-lg-end">' + $(".methodePaiement:checked").data('name') + '</div></div><div class="row px-2"><div class="col-sm-6 fs-6">Couverture maladie : </div><div class="col-sm-6 fs-5 text-lg-end">' + MontantInitialFormater + '</div></div><div class="row px-2"><div class="col-sm-6 fs-6">Droit d\'adhésion : </div><div class="col-sm-6 fs-5 text-lg-end">' + droitAdhesion + '</div></div><div class="row px-2 d-none"><div class="col-sm-6 fs-6">Montant total à payer : </div><div class="col-sm-6 fs-5 text-lg-end">' + $("#MontantCotisationZone0").val() + '</div></div><hr><div class="row px-2 fw-bold"><div class="col-sm-6 fs-4">' + msgText + ' : </div><div class="col-sm-6 fs-4 text-lg-end">' + MontantToPay + '</div></div><div class="row px-2 d-none"><div class="col-sm-6 fs-6">Montant total restant : </div><div class="col-sm-6 fs-5 text-lg-end">' + MontantRestantFormater + '</div></div><div class="row px-2 d-none"><div class="col-sm-6 col-lg-9 ps-lg-0 fs-6">NB: Vous paierez pour chacun de vos prochains paiement le montant de : </div><div class="col-sm-6 col-lg-3 pe-lg-0 fs-5 text-lg-end">' + cotisation + '</div></div>');

  // html('<p class="fs-6">Mode de paiement choisi : <span class = "fw-bold fs-5">' + $(".methodePaiement:checked").data('name') + '</span></p><p class="fs-6">Montant total à payer :  <span class = "fw-bold fs-5">' + MontantInitialFormater +'<p class="fs-6 "> Premier paiement : <span class = "fw-bold fs-5">' + $("#MontantCotisationZone").val() + '</span></p>'+ '<p class="fs-6">Montant total restant: <span class = "fw-bold fs-5">' + MontantRestantFormater + '</br>'+ '<p class="fs-6">NB: Vous paierez pour chacun de vos prochains paiement, le montant de : <span class = "fw-bold fs-5">' + cotisation )
  $("#calendriertext2").html(tableData);
  $('#calendrier').modal('show');
}
//GenerateurPaiement du montant partiel
function GenerateurPaiement(params) {
  var xhttp = new XMLHttpRequest();
  console.log(params);
  var info = "&jsondata=" + JSON.stringify(params);
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var jsonObject= JSON.parse(this.response);
      //console.log(this.responseText);             
      if (jsonObject.code == 201) {
          notifToken = (jsonObject.notif_token) ? jsonObject.notif_token : 'none'
          inscription('update', jsonObject.payment_token, jsonObject.transaction_id, notifToken);
          location.replace(jsonObject.payment_url);
        }
        // if (jsonObject.code!=201) {
        //   console.log(jsonObject.code+" "+jsonObject.message);
        // }
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
};
/*********************************************************** */
var currentTab = 0; // Current tab is set to be the first tab (0)
//choix de l'offre
function choix(offre,informations) {
  //generation de l'id unique
  var info = offre;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("containerlog").innerHTML = this.response;
      if (offre=='suitePaie') {
        $(document).ready(function(){
            $('#containerlog').removeClass('col-lg-6').addClass('col-lg-7');
        })
      }
      // Display the current tab
      showTab(currentTab);
      reload_js('script/fonction.js');
      //affectation des variables
      $('#name_souscripteur').val(informations[0].nom);
      $('#prenom_souscripteur').val(informations[0].prenom);
      $('#contact').val(informations[0].contact);
      $('#email').val(informations[0].email);
      $('.logout').removeClass('d-none');
      
    }
  };
  xhttp.open("GET", "./script/loader.php?" + info, true);
  xhttp.send();

}

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tabstep");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("nextBtn").children[0].innerHTML = "SOUSCRIRE";
    document.getElementById("nextBtn").setAttribute("data-target", "#rgpd_form");
    document.getElementById("nextBtn").setAttribute("onclick", "nextPrev(1)");
    document.getElementById("backBtn").setAttribute("onclick", "history.back()");
    
  } else {
    document.getElementById("backBtn").setAttribute("onclick", "nextPrev(-1)");
    if (n==1) {
      document.getElementById("nextBtn").children[0].innerHTML = "SUIVANT";
      document.getElementById("nextBtn").setAttribute("onclick", "choixmodal()");
      if (document.getElementById("nextBtn").getAttribute("data-target")=="#devis_sant") {
        document.getElementById("nextBtn").removeAttribute("data-target");
      }
    }
    //document.getElementById("backBtn").style.display = "none";
    //document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    //document.getElementById("nextBtn").children[0].innerHTML = "SUIVANT";
    //document.getElementById("nextBtn").setAttribute("data-target", "#devis_sant");
    $("#nextBtn").attr("onclick", "recapdevis(1)");
    document.getElementById("nextBtn").children[0].innerHTML = "Payer ma cotisation";
    
  } else {
    //document.getElementById("nextBtn").children[0].innerHTML = "SOUSCRIRE";
    //document.getElementById("nextBtn").setAttribute("data-target", "#rgpd_form");
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}
function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tabstep");
    // Exit the function if any field in the current tab is invalid:
    //if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    // console.log('n='+n);
    // console.log('currentTab=' + currentTab);
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
      //...the form gets submitted:
      //document.getElementById("form_souscrire_sante").submit();
      return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}
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
  let zonesouscripteur=document.getElementsByClassName("infosouscripteur1");
  let x1=zonesouscripteur[0].children[0].children[0].children[1].value;
  let x2=zonesouscripteur[0].children[0].children[1].children[1].value;
  let x3=zonesouscripteur[0].children[1].children[0].children[1].value;
  let x4=zonesouscripteur[0].children[1].children[1].children[1].value;
  let typecontrat=$('#option_type_famille').val();
  var info="&nom="+x1+"&prenom="+x2+"&contact="+x3+"&email="+x4+"&typecontrat="+typecontrat;
  if (num == 1) {
      var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            cache_info.innerHTML=this.response;
            //reload_js('script/fonction.js');            
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
              
          }
      };
      xhttp.open("GET", "./script/loader.php?info_assurer"+info, true);
      xhttp.send();
  }
  info_souscripteur2();
  reload_js('script/fonction.js');
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
        //$('.colfamille').addClass('d-none');
        //$('.colindividuel').removeClass('d-none');
      }
  } else {
    $(".option_type_famille").attr('hidden',false);
    $(".famille_simple").attr('hidden',false);      
    cache_addPersCharge[0].removeAttribute('hidden');
    //$('.colindividuel').addClass('d-none');
    //$('.colfamille').removeClass('d-none');
            
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
function addPersCharge(num) {
  var cache_info=document.getElementById("field_sante");
  var cache_info2=document.getElementById("field_enfant");

  let n_enfant = parseInt($("#nombre_enfant").val());
  let n_adulte = parseInt($("#nombre_adulte").val());
 
  if (num == 0 && n_adulte !== 0) {
      if ($("#field_sante .adfilA").length+$("#field_sante #adfil0").length < n_adulte) {
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
              } else {
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
        $('#saisieincompletes').modal('show')
      }
    }
}
function removePersCharge(num) {
  document.getElementById(num).remove();
}
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
//envoie de mail
function sendmail(typeDeMail){
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
      if (this.responseText) {
              // var newpage = window.open('');
              // setTimeout(() => newpage, 1000);
              // newpage.document.write(this.responseText);
              // newpage.focus();
              $("#impressresult").html(this.responseText);
              $("#impressionmodal").modal("show");
            }
            else{
              newpage = window.close('')
            }
            
        }
    };   
    xhttp.open("GET", "./script/script.php?fiche"+info, true);
    xhttp.send()
}
//!-********************Impression*******************************
//fonction pour imprimer une demande--------------------------------
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
/***********suite de paiement***********/
//$("#PaiemmentModal").click(function () {
$('#PaiemmentModal').on('shown.bs.modal', function () {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("PaiemmentModalBody").innerHTML = this.response;
      // Display the current tab      
      reload_js('script/fonction.js');
      //affectation des variables      

    }
  };
  xhttp.open("GET", "./script/loader.php?paie", true);
  xhttp.send();
});

//*********logout */
function logout(params) {
  origin = document.location.origin + document.location.pathname;
  window.location.replace(origin);  
}
//!-****************************fonction de verification/controles *******************************


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