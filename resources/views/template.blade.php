<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title> @yield('title')</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/css/Navbar-Right-Links-icons.css">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" type="text/css" href="assets/css/contact.css">
        <!--     Fonts and icons from creative     -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" href="assets/css/styles0.css" />
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
        <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
    </head>
    <body style="background: rgba(255,255,255,0);">
    <!-- headers -->
        <header>
            <nav class="d-none d-lg-flex d-xl-flex d-xxl-flex p-3 bg-primary d-flex justify-content-between">
                <div class="ms-5 col-lg-4"><a class="text-white text-decoration-none" href="#">Email : Info@mutuellechretienne-ci.org</a></div>
                <div class="pe-5 col-lg-4 text-end"><a class="text-white text-decoration-none" href="#">Suivez-nous sur</a><i class="fab fa-facebook-square text-white px-2"></i><i class="fab fa-instagram text-white"></i></div>
            </nav>
            <nav class="navbar navbar-light navbar-expand-md shadow px-lg-5">
                <div class="container-fluid">
                    <img class="img-fluid" src="assets/img/pasteur.png" width="53" height="52">
                    <a class="navbar-brand d-none d-lg-block fs-6 fw-bold ms-1 text-primary" href="#">Mutuelle Chrétienne de Côte d'Ivoire
                    </a>
                    <a class="navbar-brand d-sm-none d-md-none d-lg-none fw-bold ms-1 text-primary" style="font-size: 0.8rem;" href="#">Mutuelle Chrétienne de Côte d'Ivoire
                    </a>
                    <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse justify-content-end" id="navcol-1">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="@yield('state_accueil_active') menu-link nav-link pb-1" href="{{route('accueil')}}">Accueil</a>
                                <div  @yield('state_accueil')></div>
                            </li>
                            <li class="nav-item">
                                <a class="@yield('state_apropos_active') nav-link menu-link" href="{{route('apropos')}}" >À propos de nous</a>
                                <div @yield('state_apropos')></div>
                            </li>
                            <li class="nav-item">
                                <a class="@yield('state_nosoffres_active') nav-link menu-link" href="{{route('nosoffres')}}">Nos offres</a>
                                <div @yield('state_nosoffres')></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#" data-bs-toggle="modal" data-bs-target="#contacter_nous" data-bs-backdrop="static" data-whatever="info@mutuellechretienne-ci.org">Contactez-nous</a>
                                <div></div>
                            </li>
                        </ul>
                        <button type="button" class="btn bg-secondary text-white rounded logout d-none" onclick="logout();">Se deconnecter</button>
                    </div>
                </div>
            </nav>
        </header>
    <!-- headers -->

    <!-- contents -->
        <div class="container w-100">
            <div class="row min-vh-100">
                @yield('content')             
            </div>
        </div>
    <!-- contents -->

    <!-- modales -->
        <!-- Modal 1-->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">INFORMATION</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" style="text-align: justify;">
                        Règles de souscription</br></br>
                        - Assuré (Enfants): de 0 à 21 ans</br>
                        NB : si l’assuré a entre 21 ans révolu et 26 ans maximum, il peut avoir le statut « Enfant » sous
                        réserve de présentation d’un certificat de scolarité</br></br>
                        - Assuré (Adultes): plus de 21 ans à 65 ans</br>
                        NB : les personnes âgées de plus de 65 ans peuvent être assurées sous réserve de l’accord des
                        médecins-conseils de AMGS</br>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">J'ai Compris</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 2 rgpd_form-->
        <div class="modal" id="rgpd_form" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark font-weight-bold h5">Collecte de données à caractère personnel</h5>
                        <!--<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>-->
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="sante " id="produit_retour">
                        <div style="line-height: 2em;" class="text-dark h6">
                            Dans le cadre de la souscription à ce service, vos données personnelles seront collectées
                            conformément
                            à l'article 28 de la loi ivoirienne N° 2013-450 du 19 Juin 2013 relative à la protection des
                            données à caractère personnel. <br>

                            <div class="mt-2"><strong>La finalité de ce traitement est </strong>: La souscription aux
                                produits d’assurance et la déclaration des sinistres.</div>
                            <!-- <div class="mt-2"><strong>Les destinataires sont </strong>: les compagnies d'assurance et les courtiers en assurance.</div> -->
                        </div>
                        <div style="line-height: 2em;" class="text-dark font-weight-bold h6">
                            Votre consentement, vous permettra de poursuivre le processus afin de payer votre prime
                            d'assurance.
                        </div>
                        <!-- <div style="line-height: 2em;color: #BE1D2E !important" class="text-danger font-weight-bold h6">
                            En cas de refus, vous serez redirigé vers le choix de votre produit. 
                            
                        </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-secondary text-white"><a class="text-white" id="myRGPD"
                                href="#">Je refuse</a></button>

                        <button type="button" class="btn text-white bg-secondary" data-bs-dismiss="modal" onclick="buttonupdate(0)">OK,
                            J'accepte</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 3 -->
        <!-- Extra large modal infos_sante-->
        <div class="modal fade bd-example-modal-lg" id="infos_sante" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h3 font-weight-bold text-dark" id="LabelAccident"> </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="container text-center px-2 pt-3">
                        <h4>Merci de vérifier l'exactitude des informations saisies avant de passer à l'étape suivante.</h4>
                    </div>
                    <div class="modal-body text-dark h6">
                        <!-- <div class="row mt-5 mb-5 spinner">
                            <img style="margin-left:45%" src="https://amgs.eu-gb.mybluemix.net/images/spinner.svg"
                                height="80px" width="80px">
                        </div> -->

                        <div id="component_infos" class="component_infos h7"></div>

                        <!--<div class="component_facturation"></div>

                        <div class="component_contrat"></div> data-bs-toggle="modal" data-bs-target="#devis_sant"-->

                        <div class="row mt-5 mb-5 condittions" hidden="">
                            <div class="form-check">
                                <label class="form-check-label text-danger" for="defaultCheck1">
                                    <strong style="color: #BE1D2E !important"> NB : </strong>
                                </label>
                                <br>
                                <label class="form-check-label text-dark" for="defaultCheck1">
                                    <span style="line-height: 2em" class="mt-2">Vous devez remplir les informations
                                        manquantes dans votre compte qui sera crée à la suite du paiement.</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" class="btn bg-secondary text-white" style="background-color: #AEAEAE !important">Modifier les informations</button>
                        <button type="button" class="btn text-white bg-primary" data-bs-dismiss="modal"  id="valider_sante1" onclick="recapdevis(0);sendmail(2)">Poursuivre</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Extra large modal recap devis -->
        <div class="modal fade bd-example-modal-lg" id="devis_sant" data-bs-backdrop="static"  tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div id="modalheader" class="modal-header">
                        <h5 class="modal-title h3 font-weight-bold text-dark" id="LabelAccident"> </h5>
                        <button type="button" class="btn-close d-none" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body text-dark h6">

                        <!-- <div id="component_facturation" class="component_facturation"></div> -->

                        <div class="row justify-content-center my-3">
                            <!-- message informatif -->
                            <div class="text-center text-dark fw-bold mt-3" style="font-size: 20px">
                                Comment voulez-vous payer ?
                            </div>
                        </div>
                        <!-- mode de payement fractionner -->
                        <div class="row justify-content-around text-start">
                            <div class="row flex btn-group btn-group-toggle justify-content-center" data-toggle="buttons">
                                <div class="col-lg-3 option_pasteur_fidele p-2">
                                    <label class="btn w-100 bg-color-primary text-start text-white text-sm ml-1" for="journalier1">
                                        <input type="radio" id="journalier1" class="methodePaiement1" data-name="Par jour" value="journalier" name="methodePaiement1" autocomplete="off"/>
                                        Par jour
                                    </label>
                                </div>
                                <div class="col-lg-3 option_pasteur_fidele p-2">
                                    <label class="btn w-100 bg-color-primary text-start text-white ml-1 text-sm" for="hebdomadaire1">
                                        <input type="radio" id="hebdomadaire1" class="methodePaiement1" data-name="Par semaine" value="hebdomadaire" name="methodePaiement1" autocomplete="off"/>
                                        Par semaine
                                    </label>
                                </div>
                                <div class="col-lg-3 option_eveques option_pasteur_fidele p-2">
                                    <label class="btn w-100 bg-color-primary text-start text-white ml-1 text-sm" for="mensuel1">
                                        <input type="radio" id="mensuel1" class="methodePaiement1" data-name="Par mois" value="mensuel" name="methodePaiement1" autocomplete="off"/>
                                        Par mois
                                    </label>
                                </div>
                                <div class="col-lg-3 option_eveques option_pasteur_fidele p-2">
                                    <label class="btn w-100 bg-color-primary text-start text-white ml-1 text-sm" for="annuelle1">
                                        <input type="radio" id="annuelle1" class="methodePaiement1" data-name="Intégral" value="annuelle1" name="methodePaiement1" autocomplete="off"/>
                                        Par an
                                    </label>          
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-around text-center">
                            <input id="MontantCotisationZoneDuplication" class="form-control text-center fw-bold bg-transparent border-0 fs-5" name="MontantCotisationZoneDuplication" type="text" value="0" readonly/>
                        </div>

                        <div id="component_infos2" class="component_infos h7" hidden></div>

                        <div class="col-lg-12 col-md-12 mt-4">
                            
                        </div>

                        <div class="p-2 condittions">
                            <div class="form-check">
                                <input class="form-check-input cdgAmgs" type="checkbox" value="" id="agree"
                                    onclick="buttonupdate(1)">
                                <label class="form-check-label text-dark" for="agree">
                                    J'accepte <span style="color: #BE1D2E !important" class="font-weight-bold" hidden>les
                                        conditions générales et particulières
                                    </span>

                                    <label hidden id="valider_sante_error" style="color: #BE1D2E !important"
                                        class="font-weight-bold"></span>
                                    </label>
                            </div>
                        </div>


                        <div class="row mt-2 mb-2 surprime" hidden>
                            <div class="form-check">
                                <label class="form-check-label text-danger" for="defaultCheck1">
                                    Votre formulaire sera envoyé au medecin conseil de la compagnie d'assurance pour
                                    l'analyse
                                    des réponses dont les surprimes n'ont pas encore été déterminées.</label>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer" id="paie">
                        <!--  <a type="button" id="" href="pdf" class="btn text-white" style="background-color: #ff9933">Récapitulatif des questionnaires</a>-->

                        <a type="button" href="#" class="btn bg-secondary text-white" style="background-color:#AEAEAE !important">Annuler</a>
                        <a hidden type="button" data-bs-dismiss="modal" id="paiement_sante" href="#" class="btn text-white bg-primary" onclick=" sendmail('2');">Poursuivre</a>

                    </div>
                </div>
            </div>
        </div>
        <!-- Extra large modal infos_maladies_exclusives-->
        <div class="modal fade" id="infos_maladies_exclusives" tabindex="-1" role="dialog" data-bs-backdrop="static"
            data-bs-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h3 font-weight-bold text-dark">MALADIE(S) EXCLUE(S) DETECTEE(S)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body text-dark h6">

                        <div class="row">
                            <div class="col-lg-12">
                                <div style="border-color: #FF0000 !important; height: 100% !important" class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <div class="mt-3 mb-3 text-gray font-weight-bold" id="text_exclusion">Un ou
                                                plusieurs de vos assurés souffrent d'une `maladie exclue` <sup>*</sup>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div style="border-color: #FF0000 !important; height: 100% !important" class="card">
                                    <div>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#contacter_nous"
                                            data-bs-whatever="sante@amgs.africa"><button style="width: 100% !important"
                                                class="contact_button"><span>CONTACTER UN MEDECIN CONSEIL</span><span
                                                    class="button_arrow"><i class="fa fa-credit-card"
                                                        aria-hidden="true"></i></span></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div style="background-color: #AEAEAE !important;" class="alert col-lg-12 mr-3">
                                <p style="color: #000000 !important;"><sup style="color: #BE1D2E !important;"
                                        class="font-weight-bold" id="text_exclusion2">*</sup> Une maladie exclue est une
                                    maladie qui n'est pas assurée ;</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Extra large modal infos_age_limite-->
        <div class="modal fade" id="infos_age_limite" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myLargeModalLabel2" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h3 font-weight-bold text-dark">AGE LIMITE DETECTE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body text-dark h6">

                        <div class="row">
                            <div class="col-lg-12">
                                <div style="border-color: #FF0000 !important; height: 100% !important" class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <div class="mt-3 mb-3 text-gray font-weight-bold" id="text_exclusion">Un ou
                                                plusieurs de vos assurés ont atteint l'age limite pour soucrire à une
                                                assurance <sup>*</sup> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div style="border-color: #FF0000 !important; height: 100% !important" class="card">
                                    <div>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#contacter_nous"
                                            data-bs-whatever="sante@amgs.africa"><button style="width: 100% !important"
                                                class="contact_button"><span>CONTACTER UN MEDECIN CONSEIL</span><span
                                                    class="button_arrow"><i class="fa fa-credit-card"
                                                        aria-hidden="true"></i></span></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div hidden class="modal-footer">
                        <div hidden class="row">
                            <div style="background-color: #AEAEAE !important;" class="alert col-lg-12 mr-3">
                                <p style="color: #000000 !important;"><sup style="color: #BE1D2E !important;"
                                        class="font-weight-bold" id="text_exclusion2"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Extra large modal contacter nous -->
        <div class="modal fade" id="contacter_nous" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-color-primary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">LAISSEZ UN MESSAGE A NOS RESPONSABLES
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="Noms et Prenoms" class="col-form-label">Noms et Prenoms:</label>
                                <input type="text" class="contact_input" id="nom_prenom">
                            </div>
                            <div class="form-group">
                                <label for="Téléphone" class="col-form-label">Téléphone:</label>
                                <input type="text" class="contact_input" id="telephone">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Recepteur:</label>
                                <input type="text" class="contact_input" id="recipient-name" readonly>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="contact_input" style="height: 155px;" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-secondary text-white" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn bg-primary text-white" data-bs-dismiss="modal">Envoyer un message</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal information code recommandation demande ajout de -->
        <div class="modal fade" id="details1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-color-primary">
                        <h5 class="modal-title font-weight-bold text-white" id="exampleModalLongTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">                        
                        <div class="col-lg-12 contact_name_col mt-3" id="saisie_lieu_de_naissance">
                            <label class="text-dark pb-2" for="exampleInputEmail1">Veuillez saisir le lieu de naissance <span class="text-danger fw-bold">*</span></label>
                            <input name="saisie_lieu_de_naissance_scd" id="saisie_lieu_de_naissance_scd" type="text" class="contact_input" placeholder="Saisir votre lieu de naissance">
                            <label class="text-danger fw-bold" id="saisie_lieu_de_naissance_scd_error"></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-primary text-white" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn bg-secondary text-white" data-bs-dismiss="modal" id="addingButton" onclick="addlieu()" data-nberzone="">Ajouter</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal calendrier de paiemment-->
        <div class="modal fade" id="calendrier" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-color-primary">
                        <h3 class="modal-title text-white" id="exampleModalLongTitle">Mode de paiement</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">                       
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-secondary text-white" data-bs-dismiss="modal">Modifier</button>
                        <button type="button" class="btn bg-primary text-white" data-bs-dismiss="modal">Continuer</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal login et connexion-->
        <div class="modal fade" id="LoginModalCenter" tabindex="-1" role="dialog" aria-labelledby="LoginModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header pb-0">
                        <ul class="nav nav-tabs flex-nowrap w-100" id="myTab" role="tablist">
                            <li class="nav-item w-50 flex-fill">
                                <a class="nav-link active" id="inscription-tab" data-bs-toggle="tab" href="#inscription" role="tab" aria-controls="inscription" aria-selected="true">Inscription</a>
                            </li>
                            <li class="nav-item w-50 flex-fill">
                                <a class="nav-link" id="login-tab" data-bs-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="false">Login</a>
                            </li>                
                        </ul>            
                    </div>
                    <div class="modal-body">
                        <div class="tab-content" id="myTabContent">
                            <!-- zone inscription -->
                            <div class="tab-pane fade show active" id="inscription" role="tabpanel" aria-labelledby="inscription-tab"> 
                                <div id="msg"></div>                  
                                <form class="inscription" id="formInscription" action="" method="post" enctype="multipart/form-data" onSubmit="return false;">
                                    <div class="row">
                                        <div class="col-lg-6 pr-0">Inscription en tant que :</div>
                                        <div class="col-lg-6"><input name="TypeMembreRegister" id="TypeMembreRegister" type="text" class="form-control form-control-sm" readonly/></div>                        
                                    </div>
                                    <div class="row mt-3 d-flex justify-content-center">
                                        <div class="col-lg-4">
                                            <input class="form-check-input" type="radio" name="civilite" id="civilite_m" value="Monsieur" checked>
                                            <label class="form-check-label font-weight-bold text-dark pl-0" for="exampleRadios1">
                                                Monsieur
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input class="form-check-input" type="radio" name="civilite" id="civilite_mde" value="Madame">
                                            <label class="form-check-label font-weight-bold text-dark pl-0" for="exampleRadios1">
                                                Madame
                                            </label>
                                        </div>                        
                                        <div class="col-lg-4">
                                            <input class="form-check-input" type="radio" name="civilite" id="civilite_mdle" value="Mademoiselle">
                                            <label class="form-check-label font-weight-bold text-dark pl-0" for="exampleRadios1">
                                                Mademoiselle
                                            </label>
                                        </div>                        
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-6">
                                            <label class="text-dark" for="exampleInputEmail1">Nom <span class="text-danger font-weight-bold">*</span></label>
                                            <input name="name" id="name" type="text" class="form-control form-control-sm text-capitalize" required/>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="text-dark" for="exampleInputEmail1">Prénom(s) <span class="text-danger font-weight-bold">*</span></label>
                                            <input name="firstname" id="firstname" type="text" class="form-control form-control-sm text-capitalize" required/>
                                        </div>                        
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-6">
                                            <label class="text-dark labelcontacttest" for="exampleInputEmail1">Contact <span class="text-danger font-weight-bold">*</span></label>
                                            <input name="contact" id="contact" type="text" class="form-control form-control-sm contact_item lcontact" autocomplete="off" required/>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="text-dark" for="exampleInputEmail1">E-mail <span class="text-danger font-weight-bold">*</span></label>
                                            <input name="r_email" id="r_email" type="email" class="form-control form-control-sm email_item" autocomplete="off" required/>
                                        </div>                        
                                    </div>                    
                                    <div class="row mt-3">
                                        <div class="col-lg-6">
                                            <label class="text-dark" for="exampleInputEmail1">Mot de passe <span class="text-danger font-weight-bold">*</span></label>
                                            <input name="r_password" id="r_password" type="password" class="form-control form-control-sm" autocomplete="off" required/>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="text-dark" for="exampleInputEmail1">Confirmer mot de passe <span class="text-danger font-weight-bold">*</span></label>
                                            <input name="password_verif" id="password_verif" type="password" class="form-control form-control-sm" autocomplete="off" required/>
                                        </div>                        
                                    </div>
                                    <div class="row mt-3 p-3">
                                        <div class="col-lg-1"><input class="form-check-input ml-1" type="checkbox" value="adhere" id="adhere">
                                        </div>
                                        <div class="col-lg-11 pl-0">
                                            <label class="p-0 text-justify" style="font-size: x-small;">Je reconnais avoir lu <a href="reglements.pdf" target="_blank" rel="noopener noreferrer">Statuts et règlements intérieurs</a> . Je reconnais être membre de la Mutuelle Chrétienne ou je desire adhérer à la Mutuelle Chrétienne et à m'acquiter du droit d'adhésion qui est de 10 000 fcfa
                                            </label>
                                        </div>                   
                                    </div>
                                </form>
                                <div class="row flex-nowrap mt-3">
                                    <div class="col-lg-12 d-flex justify-content-between">
                                        <button type="button" class="btn text-white bg-secondary" data-bs-dismiss="modal">Fermer</button>                                    
                                        <button type="button" class="btn bg-primary validation_r text-white" style="display: none;">Inscription</button>
                                    </div>             
                                </div>
                            </div>
                            <!-- zone connexion -->
                            <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">
                                <div id="msg2"></div>
                                <form class="login" id="formLogin" action="" method="post" enctype="multipart/form-data" onSubmit="return false;">
                                    <div class="row pl-3">
                                        <div class="col-lg-12 col-md-6  form-group">
                                            <label for="exampleInputEmail1">E-mail</label>
                                            <input type="email" name="l_email" id="l_email" class="form-control form-control-sm" id="exampleInputEmail1">                        
                                        </div>
                                    </div>
                                    <div class="row pl-3">
                                        <div class="col-lg-12 col-md-6 form-group">
                                            <label for="exampleInputPassword1">Mot de passe</label>
                                            <input type="password" name="lpassword" id="lpassword" class="form-control form-control-sm" id="exampleInputPassword1">
                                        </div>
                                    </div>
                                    <div class="row p-2">
                                        <div class="col-lg-6 form-check pl-1">
                                            <input type="checkbox" class="form-check-input" id="showpassword">
                                            <label class="form-check-label pl-1" for="showpassword">Afficher le mot de passe</label>
                                        </div>                   
                                        <div class="col-lg-6 form-check pl-1 text-end">
                                            <a href="#recuperation" data-bs-toggle="modal" data-bs-target="#recoverModal">Mot de passe oublié</a>
                                        </div>                   
                                    </div>
                                </form>
                                <div class="row flex-nowrap mt-3">
                                    <div class="col-lg-12 d-flex justify-content-between">
                                        <button type="button" class="btn text-white bg-secondary" data-bs-dismiss="modal">Fermer</button>            
                                    
                                        <button type="button" class="btn text-white bg-primary validation_l">Login</button>
                                    </div>                        
                                </div>                   
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" hidden>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="recoverModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">Recuperez votre mot de passe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="msgrecuperation"></div>
                    <form class="formRecuperation" id="formRecuperation" action="" method="post" enctype="multipart/form-data" onSubmit="return false;">
                        <div class="row pl-3">
                            <div class="col-lg-12 col-md-6  form-group">
                                <label for="exampleInputEmail1">E-mail</label>
                                <input type="email" name="recup_email" id="recup_email" class="form-control form-control-sm" id="exampleInputEmail1">                        
                            </div>
                        </div>                                               
                        <div class="row pl-3">
                            <div class="col-lg-12 col-md-6 zonerecup form-group d-none">
                                <label for="exampleInputEmail1">Code recuperation</label>
                                <input type="text" name="text_recup_email" id="text_recup_email" class="form-control form-control-sm" id="exampleInputEmail1">                        
                            </div>
                        </div>                                               
                        <div class="row pl-3">
                            <div class="col-lg-12 col-md-6 zonerecup form-group d-none">
                                <label for="exampleInputPassword1">Nouveau mot de passe</label>
                                <input type="password" name="recup_password" id="recup_password" class="form-control form-control-sm" id="exampleInputPassword1">
                            </div>
                        </div>                                              
                        <div class="row pl-3">
                            <div class="col-lg-12 col-md-6 zonerecup form-group d-none">
                                <label for="exampleInputPassword1">Confirmation mot de passe</label>
                                <input type="password" name="confirm_recup_password" id="confirm_recup_password" class="form-control form-control-sm" id="exampleInputPassword1">
                            </div>
                        </div>                                              
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-secondary text-white validation_recuperation" data-name="recuperation">Recuperer</button>
                </div>
                </div>
            </div>
        </div>
        <!-- Paiement screen modal -->
        <div class="modal fade" id="PaiemmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-color-primary">
                <h5 class="modal-title text-white" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="PaiemmentModalBody">
                
                </div>
                <div class="modal-footer">
                <button type="button" class="btn bg-secondary text-white" data-bs-dismiss="modal">Annuler</button>                                
                <button type="button" class="btn bg-primary text-white" data-bs-dismiss="modal">Payer cotisation</button>                                
                </div>
            </div>
            </div>
        </div>
        <!-- Modal impression-->
        <div class="modal fade" id="impressionmodal" data-bs-backdrop="false" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="impressionmodalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-color-primary">
                        <h5 class="modal-title" id="impressionmodalLabel"></h5>
                        <!-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body" id="impressresult">
                        <div id="espace">
                            
                        </div>
                        <div class="col-lg-12 col-md-12 mt-4 convention d-none">
                            {{-- <iframe src="MUCCIConventionElRaffa.pdf" width="100%" height="10000"></iframe> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-secondary text-white" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn bg-primary text-white btnimpression d-none" onclick="imprimer()">Imprimer</button>
                        <!-- <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="payermaprime">Payer ma 
                            prime</button>-->
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal remplissage incomplet-->
        <div class="modal fade" id="saisieincompletes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-color-primary">
                        <h5 class="modal-title text-white" id="exampleModalLongTitle">ATTENTION !</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body" id="saisieincompletestext" style="color: #BE1D2E">
                        Merci de renseigner tous les champs soulignés en rouge !
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-secondary text-white" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- modales -->
    
    <!-- scripts -->
        <script src="assets/js/jquery-3.5.1.min.js"></script>
        <script src="assets/js/jquery.dataTables.min.js" ></script>
        <script src="assets/bootstrap/js/popper.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-cookie-consent-settings.js"></script>
        <script src="script/fonction.js"></script>
        {{-- 
                
        
        
        
         --}}
    <!-- scripts -->
    </body>
</html>