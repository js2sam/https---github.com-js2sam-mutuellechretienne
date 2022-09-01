<?php
require_once('dbconnection.php');

//globals functions
function firstupper($str){
    $unwanted_array = array(  'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E','Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U','Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c','è'=>'e', 'é'=>'&#233;', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o','ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'Ã©'=>'&#233;' );
    
    $res = ucfirst(strtolower(strtr( $str, $unwanted_array )));
    // Returning the result  
    return $res;
}

function typeproduit($valeur) {
    $type = array ("60"=>"KOUMETAI","70"=>"TCHERENIM","80"=>"FANGAN","90"=>"MASSAYA",);
    foreach($type as $x => $x_value){
        if ($valeur==$x) {
            # code...
            $type_valeur=$x_value;
        }
    }
    // Returning the result  
    return $type_valeur; 

}

//mise au format xx xx xx xx xx des numeros
function formatPhoneNumber($phoneNumberString) {
    $match = str_split($phoneNumberString, 2);
    if ($match) {
        $intlCode = $match[0].' '.$match[1].' '.$match[2].' '.$match[3].' '.$match[4];
        return  $intlCode ;
    }
    return null;
}

function typedetect($option_type_famille,$taux,$radio_set){
    $nature1 = array (
        "normal"=>"1",
        "entreprise"=>"2");
        foreach($nature1 as $x => $x_value){
            if ($option_type_famille==$x) {
                # code...
                $type_option_type_famille=$x_value;
            }
        }
    $nature2 = array (
        "60"=>"4",
        "70"=>"3",
        "80"=>"2",
        "90"=>"1",);
        foreach($nature2 as $y => $y_value){
            if ($taux==$y) {
                # code...
                $type_taux=$y_value;
            }
        }
    $nature3 = array (
        "bronze"=>"1",
        "argent"=>"2",
        "or"=>"3");
        foreach($nature3 as $z => $z_value){
            if ($radio_set==$z) {
                # code...
                $type_radio_set=$z_value;
            }
        }

    // Returning the result  
    return array($type_taux,$type_radio_set,$type_option_type_famille);
}

function calculcotation($varnbreadulte,$varnbrenfant,$vartype1,$vartype2,$vartype3){
    global $db;
    // obtension des informations de l'utilisateur depuis la page principale
    $nbreadulte = $varnbreadulte;
    $nbrenfant = $varnbrenfant;
    $type1 = $vartype1;
    $type2 = $vartype2;
    $type3 = $vartype3;
    if (isset($_GET['num'])) {
        # code...
        $num=$_GET['num'];
    }
    //$choix_cotation=$_GET["choix_cotation"];
    $choix_cotation="choix_cotation1";
    $taxe=0;
    $sql = " SELECT * FROM produit_table,coefficient_table WHERE id_produit='$type1' AND id_categorie='$type2' AND coefficient_table.id_coeff='$type3'";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) {
        $champ = mysqli_fetch_assoc($result);
        $primettc=(($nbreadulte*$champ["prime_adulte"])+($nbrenfant*$champ["prime_enfant"]));
        if ($choix_cotation=="choix_cotation1") {
        # code...
            if ($type3==1){
            # code...
            $taxe=$primettc*(1-(1/1.08));
            $accessoire=3000;
            }
            if ($type3==2){
            # code...
            $taxe=$primettc*(1-(1/1.08));
            $accessoire=3000;
            }
            if ($type3==3){
            # code...
            $taxe=$primettc*(1-(1/1.03));
            $accessoire=10000;
            }
            //********************la variable primet  et inverser a la varible prime ttc */
            $primeht=$primettc-$taxe-$accessoire;
            if ($primeht<0) {
            # code...
            $primeht=0;//evite la valeur negative dans primeht
            }
            $retVal = ($primettc<0) ? $primettc=0 :$primettc=$primettc;
            if($type3==1){
            $montant_prime=number_format(round($retVal,0),0,""," ")." FCFA";
            }
            if($type3==2){
            $montant_prime=number_format(round($retVal,0),0,""," ")." FCFA";
            }if($type3==3){
            $montant_prime=number_format(round($primettc,0),0,""," ")." FCFA";
            }
        }
    }
        return  array($montant_prime,$taxe,$primeht);
}

//appel de zone recurante
function zone_recurrente($valeur){
	switch ($valeur) {
		case 'zone_infosouscripteur':
            # code...
			$valeur= '
                <div class="section_title text-center"><h3>INFORMATIONS ADHERENT </h3></div>
                <div class="infosouscripteur1">
                    <div class="row">
                        <div class="col-lg-6 contact_name_col">
                            <label class="text-dark" for="exampleInputEmail1">Nom <span class="text-danger fw-bold">*</span></label>
                            <input name="nom_souscripteur" id="nom_souscripteur" type="text" class="contact_input nom_souscripteur toupper" placeholder="Nom" autocomplete="off" required readonly/>
                            <label class="text-danger fw-bold" id="error_name"></label>
                        </div>
                        <div class="col-lg-6">
                            <label class="text-dark" for="exampleInputEmail1">Prénoms <span class="text-danger fw-bold">*</span></label>
                            <input name="prenom_souscripteur" id="prenom_souscripteur" type="text" class="contact_input prenom_souscripteur toupper" placeholder="Prenom(s)" autocomplete="off" required readonly/>
                            <label class="text-danger fw-bold" id="error_firstname"></label>
                        </div>
                    </div>
            
                    <div class="row mt-2">
                        <div class="col-lg-6 contact_name_col contactadulte2">
                            <label class="text-dark" for="exampleInputEmail1">Numéro portable 1<span class="text-danger fw-bold">*</span></label>
                            <input name="contact_souscripteur" id="contact_souscripteur" type="number" class="contact_input contact_souscripteur contact_item" placeholder="Contact"  required readonly/>
                            <label class="text-danger fw-bold" id="error_contact"></label>
                        </div>
                        <div class="col-lg-6">
                            <label class="text-dark" for="exampleInputEmail1">Email <span class="text-danger fw-bold">*</span></label>
                            <input name="email_souscripteur" id="email_souscripteur" type="email" class="contact_input email_souscripteur email_item" placeholder="Email" required readonly/>
                            <label class="text-danger fw-bold" id="error_email"></label>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12 d-flex flex-wrap justify-content-start"> 
                            <div>
                                <label class="form-check-label text-dark mb-3" for="exampleRadios1">L&#039;adhérent fait-il partie du groupe de personnes à couvrir ? </label>
                            </div>                
                            <div class="form-check ms-5">
                                <input class="form-check-input status" type="radio" name="status" id="scrpt_amgs_oui" value="oui" onclick="info_souscripteur(1)">
                                <label class="form-check-label fw-bold text-dark" for="exampleRadios1">
                                    Oui
                                </label>
                            </div>
                            <div class="form-check ms-5">
                                <input class="form-check-input status" type="radio" name="status" id="scrpt_amgs_non" value="non" onclick="info_souscripteur(0)">
                                <label class="form-check-label fw-bold text-dark" for="exampleRadios2">
                                    Non
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <div id="alert_infos_souscripteur" class="row ml-1 d-none">
                        <div id="alert_infos_souscripteur1" class="col-12 alert text-white bg-color-secondary">
                            Veuillez renseigner correctement les informations relatives a l&#039;adhérent.
                            <br>
                            (Vous pouvez ajouter des numéros de différents reseaux avec le bouton " + ")
                        </div>
                    </div>                    
                </div>
                <hr>
            
                <div id="field_sante" class="field_sante">                 
                </div>'
                .zone_recurrente('zone_enfant').zone_recurrente('addPersCharge');
            break;
        case 'zone_enfant':
            # code...
            $valeur='
                <div id="field_enfant">
                </div>
                ';
            break; 
        case 'zone_boutton':
            # code...
            $valeur= '
                <div style="overflow:auto;">
                    <div style="float:right;">
                        <button type="button" class="contact_button_default bg-secondary border-white ml-1 mr-4" id="backBtn">
                            <span>Retour</span>
                            <span class="button_arrow bg-secondary"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                        </button>
                        <button type="button" class="contact_button  border-white" id="nextBtn" data-toggle="modal" data-target="#rgpd_form" data-backdrop="static" onclick="nextPrev(1)">
                            <span>Suivant</span>
                            <span class="button_arrow"><i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </span>
                        </button>
                    </div>
                </div>';
            break;
        case 'addPersCharge':
            # code...
            $valeur= '
                <div id="addPersCharge" class="row mt-2" hidden>
                    <div class="text-center col-lg-12 p-3">
                        <hr>
                        <h3>AJOUTER DES PERSONNES A COUVRIR</h3>
                    </div>
                    <div class="col-lg-6 mt-3">
                        <button type="button" style="height: 40px; width: 100%;" name="add" id="add" class="btn btn-info bg-color-secondary"  onclick="addPersCharge(0)" >Ajouter un adulte</button>
                    </div>
                    <div class="col-lg-6 mt-3">
                        <button type="button" style="height: 40px; width: 100%;" name="add_enfant" id="add_enfant" class="btn btn-info bg-color-secondary" onclick="addPersCharge(1)">Ajouter un enfant</button>
                    </div>
                </div>
                ';
            break;      
        case 'recapdevis':
            # code...
            $valeur= '
                    <div id="component_facturation" class="component_facturation"></div>
                    <div class="row">
                        <div class="col">
                            <div class="row justify-content-center">
                                <div class="col-lg-10 mt-3">                            
                                    <div hidden="" class="text-center text-dark h6 mt-5">
                                        Afin de pouvoir effectuer le paiement, nous vous invitons à remplir ce formulaire, en vue d&#039;avoir les informations neccessaires sur l&#039;adhérent pour valider le processus.
                                    </div>
                                    <div hidden class="text-center text-dark fw-bold mt-5" style="font-size: 20px">
                                        Procédez au paiement de votre cotisation
                                    </div>            
                                </div>        
                            </div>
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
                                        <label class="btn w-100 bg-color-primary text-start text-white text-sm ml-1" for="journalier">
                                            <input type="radio" id="journalier" class="methodePaiement" data-name="Par jour" value="journalier" name="methodePaiement" autocomplete="off"/>
                                            Par jour
                                        </label>
                                    </div>
                                    <div class="col-lg-3 option_pasteur_fidele p-2">
                                        <label class="btn w-100 bg-color-primary text-start text-white ml-1 text-sm" for="hebdomadaire">
                                            <input type="radio" id="hebdomadaire" class="methodePaiement" data-name="Par semaine" value="hebdomadaire" name="methodePaiement" autocomplete="off"/>
                                            Par semaine
                                        </label>
                                    </div>
                                    <div class="col-lg-3 option_eveques option_pasteur_fidele p-2">
                                        <label class="btn w-100 bg-color-primary text-start text-white ml-1 text-sm" for="mensuel">
                                            <input type="radio" id="mensuel" class="methodePaiement" data-name="Par mois" value="mensuel" name="methodePaiement" autocomplete="off"/>
                                            Par mois
                                        </label>
                                    </div>
                                    <div class="col-lg-3 option_eveques option_pasteur_fidele p-2">
                                        <label class="btn w-100 bg-color-primary text-start text-white ml-1 text-sm" for="annuelle">
                                            <input type="radio" id="annuelle" class="methodePaiement" data-name="Intégral" value="annuelle" name="methodePaiement" autocomplete="off"/>
                                            Par an
                                        </label>          
                                    </div>
                                </div>
                            </div>

                            <!-- explication du fractionnement -->
                            <div id="calendriertext1" class="mt-4 mx-auto w-85">
                            
                            </div>
                            <div class="row justify-content-center pt-3 d-none">
                                <div class="table-responsive">
                                    <table class="col-lg-6 table table-sm table-bordered w-75 m-auto">
                                        <thead>
                                        <tr class="d-none">
                                            <th scope="col"> </th>
                                            <th scope="col" class="coljour">Jour</th>
                                            <th scope="col" class="colsemaine">Semaine</th>
                                            <th scope="col" class="colmois">Mois</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="align-middle text-center" id="msgText">-</th>
                                                <td class="MontantCotisationZone d-none">
                                                    <input id="MontantCotisationZone" class="form-control text-center fw-bold bg-transparent border-0 fs-5" name="MontantCotisationZone" type="text" value="0" readonly/>
                                                </td>
                                            </tr>
                                            <tr class="colindividuel d-none">
                                                <th scope="row">Solo</th>
                                                <td class="coljour text-center">410 FCFA</td>
                                                <td class="colsemaine text-center">1 885 FCFA</td>
                                                <td class="colmois text-center">8 170 FCFA</td>
                                            </tr>
                                            <tr class="colfamille d-none">
                                                <th scope="row">Famille</th>
                                                <td class="coljour text-center">960 FCFA</td>
                                                <td class="colsemaine text-center">4 425 FCFA</td>
                                                <td class="colmois text-center">19 200 FCFA</td>
                                            </tr>                                
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- modele echeancier -->
                            <div class="accordion w-85 m-auto mt-3" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Voir la suite de l&#039;echéancier
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body table-responsive">
                                            <table class="table table-striped table-hover w-100" id="myTable">
                                                <thead>
                                                    <tr>                                                        
                                                        <th style="width: 135px;">Période</th>
                                                        <th class="text-end tableoneline">Date de paiement</th>
                                                        <th class="text-end">Cotisation</th>
                                                        <th class="text-end tableoneline">Reste à solder</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="calendriertext2">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>  
                            </div>                                                       
                                                        
                            <!-- payeurs marchands -->
                            <!-- message informatif -->
                            <div class="row justify-content-center mt-3" style="font-size: 20px">
                                <div class="text-center text-dark fw-bold mt-3">
                                    Veuillez sélectionner l&#039;opérateur de paiement qui vous convient
                                </div>
                            </div>
                            <!-- choix operateur -->
                            <div class="row mb-5 mt-4" id="assureur_list">
                                <!-- si client orange-->
                                <div class="col d-flex flex-column mx-auto ">
                                    <label for="paiement_orange" class="text-center">
                                        <img src="img/orange-mobile.jpg" style="height: 100px; width: 100px" class="rounded mb-2" alt="..." />
                                    </label>
                                    <input id="paiement_orange" class="form-radio-input mx-auto" type="radio" name="operateur" value="orange" checked/>
                                </div>
                                <!-- si client mtn-->
                                <div class="col d-flex flex-column mx-auto justify-content-center">
                                    <label for="paiement_mtn" class="text-center">
                                        <img src="img/mtn-mobile.jpg" style="height: 100px; width: 100px" class="rounded mb-2" alt="..." />
                                    </label>
                                    <input id="paiement_mtn" class="form-radio-input mx-auto" type="radio" name="operateur" value="mtn"/>
                                </div>
                                <!-- si client moov-->
                                <div class="col d-flex flex-column mx-auto justify-content-center">
                                    <label for="paiement_moov" class="text-center">
                                        <img src="img/moov-mobile.png"
                                    style="height: 100px; width: 100px" class="rounded mb-2" alt="..." />
                                    </label>
                                    <input id="paiement_moov" class="form-radio-input mx-auto" type="radio" name="operateur" value="moov"/>
                                </div>
                                <!-- si client wave-->
                                <div class="col d-flex flex-column mx-auto justify-content-center d-none">
                                    <label for="paiement_wave" class="text-center">
                                        <img src="img/wave.png" style="height: 100px; width: 100px" class="rounded mb-2" alt="..." />
                                    </label>
                                    <input id="paiement_wave" class="form-radio-input mx-auto" type="radio" name="operateur" value="wave"/>
                                </div>
                                <!-- si client visa-->
                                <div class="col d-flex flex-column mx-auto justify-content-center">
                                    <label for="paiement_visa" class="text-center">
                                        <img src="img/visa.png" style="height: 100px; width: 100px" class="rounded mb-2" alt="..." />
                                    </label>
                                    <input id="paiement_visa" class="form-radio-input mx-auto" type="radio" name="operateur" value="visa"/>
                                </div>
                                <!-- si client virement-->
                                <div class="col d-flex flex-column mx-auto justify-content-center d-none">
                                    <label for="paiement_bancaire" class="text-center">
                                        <img src="img/paiement-virement-bancaire.jpg" style="height: 100px; width: 100px" class="rounded mb-2" alt="..." />
                                    </label>
                                    <input id="paiement_bancaire" class="form-radio-input mx-auto" type="radio" name="operateur" value="virement"/>
                                </div>
                            </div>
                            <div class="row justify-content-md-center" hidden>
                                <input id="isPremierPaiement" class="form-control" name="isPremierPaiement" type="number" value="'.($_SESSION["isPremierPaiement"]==true?"10000":"0").'" readonly/>                                
                                <input id="MontantCotisationZone0" class="form-control" name="MontantCotisationZone0" type="number" value="0" readonly/>
                                <input name="stepZone" id="stepZone" class="form-control" type="number" value="0" readonly/>                                
                            </div>
                        </div>
                    </div>';
            break;
        case 'indicateur_etape':
            # code...
            $valeur= '
                <div class="row indicateur_etape">
                    <div class="col-lg-3">
                        <div class="event d-flex flex-row align-items-start justify-content-start">
                            <div>
                                <div id="tab1" class="step event_date_red d-flex flex-column align-items-center justify-content-center">
                                    <div class="event_day">1</div>
                                    <div class="event_month">Etape</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="event d-flex flex-row align-items-start justify-content-start">
                            <div>
                                <div id="tab2" class="step event_date_red d-flex flex-column align-items-center justify-content-center">
                                    <div class="event_day">2</div>
                                    <div class="event_month">Etape</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            break;
        case 'verifierinput':
            # code...
            $valeur='onchange="verifierinput()"';
            break;     
        case 'Définitiondestypesdecontrats':
            # code...
            $valeur='
                <h4>Définition des types de contrats  </h4>
                <p class="m-0"> <strong>Individuel :</strong> <span style="font-style: normal !important"> Une (1) seule personne </p>
                <p class="m-0"> <strong>Famille : </strong> <span style="font-style: normal !important"> Cinq(5) personnes (Père + Mère + 3 Enfants), mais il est possible de couvrir autant de personnes que vous souhaitez <span></p>
                <p class="m-0"><sup style="color: #BE1D2E !important" class="fw-bold text-danger">*</sup> Possibilité de composer son groupe. Exemple : 4 adultes, 17 enfants sans forcément lien de parenté</p>
                <p class="m-0"><sup style="color: #BE1D2E !important" class="fw-bold text-danger">**</sup> Tout seul, l’enfant est considéré comme adulte</p>
                <p class="m-0"><sup style="color: #BE1D2E !important" class="fw-bold text-danger">***</sup> Papa+ Maman+3 enfants</p>
                <br>            
                <h4 data-toggle="tooltip" title="La durée pendant laquelle vous n\'êtes pas couvert par les garanties d\'assurance dont le point de départ est la date de souscription">Délais de carence</h4>
                <p class="m-0">Frais médicaux : <span style="font-style: normal !important"> 1 mois </span></p>
                <p class="m-0">Opérations chirurgicales : <span style="font-style: normal !important"> 6 mois </span></p>
                <p class="m-0">Maternité : <span style="font-style: normal !important"> 9 mois </span></p>
                <p class="m-0">Lunetterie : <span style="font-style: normal !important"> 9 mois </span></p>
                <p class="m-0">Protèses dentaires : <span style="font-style: normal !important"> 9 mois </span></p>
                ';
            break;
        case 'Définitiondestypesdecontrats2':
            # code...
            $valeur='
                <table class="table table-responsive-sm table-borderless table-sm" style="font-size: 17px">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th colspan="3" class="text-center align-middle" data-toggle="tooltip" title="La durée pendant laquelle vous n\'êtes pas couvert par les garanties d\'assurance dont le point de départ est la date de souscription">Délais de carence</th>
                        </tr>
                    </thead>
                    <tbody>  
                        <tr>
                            <td>Frais médicaux : </td>
                            <td colspan="2" class="color-primary text-end" style="width: 350px;">1 mois</td>
                        </tr>
                        <tr>
                            <td>Opérations chirurgicales : </td>
                            <td colspan="2" class="color-primary text-end"> 6 mois</td>
                        </tr>
                        <tr>
                            <td>Maternité : </td>
                            <td colspan="2" class="color-primary text-end">9 mois</td>
                        </tr>
                        <tr>
                            <td>Lunetterie : </td>
                            <td colspan="2" class="color-primary text-end"> 9 mois</td>
                        </tr>
                        <tr>
                            <td>Prothèses dentaires : </td>
                            <td colspan="2" class="color-primary text-end">9 mois</td>
                        </tr>
                    </tbody>                                    
                </table>
                ';
            break;
        case 'inputcodeapporteur':
            # code...
            $valeur='
                <div class="col-lg-12 contact_name_col" hidden>
                    <label class="text-dark me-3">Avez vous un code de recommandation <span onmouseover="details(1)"><i class="fa fa-question-circle fa-1x text-danger" aria-hidden="true"></i></span></label>
                    <input type="radio" id="coderecomande-1" name="coderecomande" value="oui" onclick="coderec(1)"><label class="ms-2 me-3" for="coderecomande-1">Oui</label>
                    <input type="radio" id="coderecomande-2" name="coderecomande" value="non" checked onclick="coderec(0)"><label class="ms-2" for="coderecomande-2">Non</label>
                </div>
                <div class="col-lg-3 col-md-6 mb-3" id="code_recomande">
                    
                </div>
                <div hidden class="col-lg-4 alert-invalidcoderec"><p class="text-danger"><small>Votre code de recomandation est invalide</small></p></div>
                ';
            break;     
        default:
            # code...
            $valeur= '<span class="aucun_retour" style="color: #be1d2e;" >Désolé cette partie presente un soucis veuillez contacter l\'administrateur<span>';
            break;
		}
    return $valeur;
}
function zone_recurrente2($valeur,$specification){
    $valeur= '
                <div class="text-center contact_name_col col-lg-12 mt-3">
                    <h3>Veuillez nous indiquer si vous souffrez de l\'une des pathologies suivantes :</h3>
                </div>

                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_diabete_item exclusion_item" type="checkbox" value="" name="diabete'.$specification.'" id="diabete'.$specification.'">
                        <label class="form-check-label text-dark" for="diabete'.$specification.'">
                            Diabète
                        </label>
                    </div>
                </div>
                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_cardio_vasculaire_item exclusion_item" type="checkbox" value="" name="cardio_vasculaire'.$specification.'" id="cardio_vasculaire'.$specification.'">
                        <label class="form-check-label text-dark" for="cardio_vasculaire'.$specification.'">
                            Maladies cardio-vasculaires
                        </label>
                    </div>
                </div>

                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_hta_item exclusion_item" type="checkbox" value="" name="hta'.$specification.'" id="hta'.$specification.'">
                        <label class="form-check-label text-dark" for="hta'.$specification.'">
                            HTA
                        </label>
                    </div>
                </div>

                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_avc_item exclusion_item" type="checkbox" value="" name="avc'.$specification.'" id="avc'.$specification.'">
                        <label class="form-check-label text-dark" for="avc'.$specification.'">
                            AVC
                        </label>
                    </div>
                </div>

                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_infarctus_item exclusion_item" type="checkbox" value="" name="infarctus'.$specification.'" id="infarctus'.$specification.'">
                        <label class="form-check-label text-dark" for="infarctus'.$specification.'">
                            Infarctus
                        </label>
                    </div>
                </div>
                                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_asthme_item exclusion_item" type="checkbox" value="" name="asthme'.$specification.'" id="asthme'.$specification.'">
                        <label class="form-check-label text-dark" for="asthme'.$specification.'">
                            Asthme
                        </label>
                    </div>
                </div>
                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_bronchite_chrnonique_item exclusion_item" type="checkbox" value="" name="bronchite_chrnonique'.$specification.'" id="bronchite_chrnonique'.$specification.'">
                        <label class="form-check-label text-dark" for="bronchite_chrnonique'.$specification.'">
                            Bronchites chroniques, Sinusites chroniques
                        </label>
                    </div>
                </div>
                                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_drepanocytose_item exclusion_item" type="checkbox" value="" name="drepanocytose'.$specification.'" id="drepanocytose'.$specification.'">
                        <label class="form-check-label text-dark" for="drepanocytose'.$specification.'">
                            Drépanocytose
                        </label>
                    </div>
                </div>
                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_ulcere_gastro_item exclusion_item" type="checkbox" value="" name="ulcere_gastro'.$specification.'" id="ulcere_gastro'.$specification.'">
                        <label class="form-check-label text-dark" for="ulcere_gastro'.$specification.'">
                            Ulcère Gastro-Duodénal chronique ;
                        </label>
                    </div>
                </div>
                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_insuffisance_renale_item  exclusion_item" type="checkbox" value="" name="insuffisance_renale'.$specification.'" id="insuffisance_renale'.$specification.'">
                        <label class="form-check-label text-dark" for="insuffisance_renale'.$specification.'">
                            Insuffisance rénale chronique
                        </label>
                    </div>
                </div>

                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_anemie_chronique_item  exclusion_item" type="checkbox" value="" name="anemie_chronique'.$specification.'" id="anemie_chronique'.$specification.'">
                        <label class="form-check-label text-dark" for="anemie_chronique'.$specification.'">
                            Anémie chronique
                        </label>
                    </div>
                </div>
                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_myopathie_item exclusion_item" type="checkbox" value="" name="myopathie'.$specification.'" id="myopathie'.$specification.'">
                        <label class="form-check-label text-dark" for="myopathie'.$specification.'">
                            Myopathies
                        </label>
                    </div>
                </div>                               
                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_toute_forme_de_cancers_item exclusion_item" type="checkbox" value="" name="toute_forme_de_cancers'.$specification.'" id="toute_forme_de_cancers'.$specification.'">
                        <label class="form-check-label text-dark" for="toute_forme_de_cancers'.$specification.'">
                            Toute forme de cancers
                        </label>
                    </div>
                </div>

                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_toute_forme_de_tumeur_item exclusion_item" type="checkbox" value="" name="toute_forme_de_tumeur'.$specification.'" id="toute_forme_de_tumeur'.$specification.'">
                        <label class="form-check-label text-dark" for="toute_forme_de_tumeur'.$specification.'">
                            Toute forme de tumeur
                        </label>
                    </div>
                </div>
                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_vih_sida_item exclusion_item" type="checkbox" value="" name="vih_sida'.$specification.'" id="vih_sida'.$specification.'">
                        <label class="form-check-label text-dark" for="vih_sida'.$specification.'">
                            Infection VIH/SIDA
                        </label>
                    </div>
                </div>

                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_hepatite_b_c_item exclusion_item" type="checkbox" value="" name="hepatite_b_c'.$specification.'" id="hepatite_b_c'.$specification.'">
                        <label class="form-check-label text-dark" for="hepatite_b_c'.$specification.'">
                            Hépatite B et C
                        </label>
                    </div>
                </div>
                ';
    return $valeur;
}
//--------------------------------------------------------------------------------

    function ID()
    {
        # code...
        $str = 'abcdefghijklmnopqrstuvwxyz01234567891011121314151617181920212223242526';

        $shuffled = str_shuffle($str);
        $shuffled = substr($shuffled,1,9);
        $newid='SANTE'.strtoupper($shuffled);

        return $newid;
    }
//------------------------------------------------------------------------------------
//retrait des caracteres speciaux--------------------------------------
function RemoveSpecialChar1($str) { 
      
    // Using str_replace() function  
    // to replace the word  
    $res = str_replace( array( '\'', '"', ' ' , ',' , ';', '<', '>' ), '_', $str);
      
    // Returning the result  
    return $res; 
}
function RemoveSpecialChar2($str){
  $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', '\''=>'&#039;', '"'=>'&#039;&#039;' , ' '=>'_', ','=>'&#44;', ';'=>'&#59;', '<'=>'_', '>'=>'_');
    $res = strtr( $str, $unwanted_array );
    // Returning the result  
    return $res;
}    
function RemoveSpecialChar3($str){
  $unwanted_array = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E','Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U','Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c','è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o','ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y');
    $res = strtr( $str, $unwanted_array );
    // Returning the result  
    return $res;
} 
?>