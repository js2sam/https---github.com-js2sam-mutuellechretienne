<?php
session_start();
require_once('dbconnection.php');

//---------------------------------------------------------------
$code_uni=preg_replace('/\s+/', '', date("Ymd-His"));
//---------------------------------------------------------------
$json = file_get_contents("villes.json");
$villes = json_decode($json ,true);

$infoadherentjson = file_get_contents("infoadherent.json");
$infoadherents = json_decode($infoadherentjson ,true);

function firstupper($str){
    $unwanted_array = array(  'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                              'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                              'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                              'è'=>'e', 'é'=>'&#233;', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                              'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
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
                <div class="section_title text-center"><h3>INFORMATIONS DU SOUSCRIPTEUR </h3></div>
                <div class="infosouscripteur1">
                    <div class="row">
                        <div class="col-lg-6 contact_name_col">
                            <label class="text-dark" for="exampleInputEmail1">Nom <span class="text-danger fw-bold">*</span></label>
                            <input name="name" id="name_souscripteur" type="text" class="contact_input nom_souscripteur toupper" placeholder="Nom" required readonly/>
                            <label class="text-danger fw-bold" id="error_name"></label>
                        </div>
                        <div class="col-lg-6">
                            <label class="text-dark" for="exampleInputEmail1">Prénoms <span class="text-danger fw-bold">*</span></label>
                            <input name="firstname" id="prenom_souscripteur" type="text" class="contact_input prenom_souscripteur toupper" placeholder="Prenom(s)" required readonly/>
                            <label class="text-danger fw-bold" id="error_firstname"></label>
                        </div>
                    </div>
            
                    <div class="row mt-2">
                        <div class="col-lg-6 contact_name_col">
                            <label class="text-dark" for="exampleInputEmail1">Numéro Portable<span class="text-danger fw-bold">*</span></label>
                            <input name="contact" id="contact" type="number" class="contact_input contact_souscripteur contact_item" placeholder="Contact" required readonly/>
                            <label class="text-danger fw-bold" id="error_contact"></label>
                        </div>
                        <div class="col-lg-6">
                            <label class="text-dark" for="exampleInputEmail1">Email <span class="text-danger fw-bold">*</span></label>
                            <input name="email" id="email" type="email" class="contact_input email_souscripteur email_item" placeholder="Email" required readonly/>
                            <label class="text-danger fw-bold" id="error_email"></label>
                        </div>
                    </div>
                    <div class="row flex-nowrap mt-3">
                        <div class="col-lg-12 d-flex justify-content-between"> 
                            <div>
                                <label class="form-check-label text-dark mb-3" for="exampleRadios1">Le souscripteur fait-il partie du groupe de personnes à couvrir ? </label>
                            </div>                
                            <div class="form-check">
                                <input class="form-check-input status" type="radio" name="status" id="scrpt_amgs_oui" value="oui" onclick="info_souscripteur(1)">
                                <label class="form-check-label fw-bold text-dark" for="exampleRadios1">
                                    Oui
                                </label>
                            </div>
                            <div class="form-check ml-5">
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
                            Veuillez renseigner correctement les informations relatives au souscripteur.
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
        case 'pathologies':
            # code...
            $valeur= '
                <div class="text-center contact_name_col col-lg-12 mt-3">
                    <h3>Veuillez nous indiquer si vous souffrez de l\'une des pathologies suivantes</h3>
                </div>

                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_diabete_item exclusion_item" type="checkbox" value="" id="diabete">
                        <label class="form-check-label text-dark" for="diabete">
                            Diabète
                        </label>
                    </div>
                </div>
                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_cardio_vasculaire_item exclusion_item" type="checkbox" value="" id="cardio_vasculaire">
                        <label class="form-check-label text-dark" for="cardio_vasculaire">
                            Maladies cardio-vasculaires
                        </label>
                    </div>
                </div>

                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_hta_item exclusion_item" type="checkbox" value="" id="hta">
                        <label class="form-check-label text-dark" for="hta">
                            HTA
                        </label>
                    </div>
                </div>

                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_avc_item exclusion_item" type="checkbox" value="" id="avc">
                        <label class="form-check-label text-dark" for="avc">
                            AVC
                        </label>
                    </div>
                </div>

                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_infarctus_item exclusion_item" type="checkbox" value="" id="infarctus">
                        <label class="form-check-label text-dark" for="infarctus ">
                            Infarctus
                        </label>
                    </div>
                </div>
                                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_asthme_item exclusion_item" type="checkbox" value="" id="asthme">
                        <label class="form-check-label text-dark" for="asthme">
                            Asthme
                        </label>
                    </div>
                </div>
                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_bronchite_chrnonique_item exclusion_item" type="checkbox" value="" id="bronchite_chrnonique">
                        <label class="form-check-label text-dark" for="bronchite_chrnonique">
                            Bronchites chroniques, Sinusites chroniques
                        </label>
                    </div>
                </div>
                                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_drepanocytose_item exclusion_item" type="checkbox" value="" id="drepanocytose">
                        <label class="form-check-label text-dark" for="drepanocytose">
                            Drépanocytose
                        </label>
                    </div>
                </div>
                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_ulcere_gastro_item exclusion_item" type="checkbox" value="" id="ulcere_gastro">
                        <label class="form-check-label text-dark" for="ulcere_gastro">
                            Ulcère Gastro-Duodénal chronique ;
                        </label>
                    </div>
                </div>
                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_insuffisance_renale_item  exclusion_item" type="checkbox" value="" id="insuffisance_renale">
                        <label class="form-check-label text-dark" for="insuffisance_renale">
                            Insuffisance rénale chronique
                        </label>
                    </div>
                </div>

                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_anemie_chronique_item  exclusion_item" type="checkbox" value="" id="anemie_chronique">
                        <label class="form-check-label text-dark" for="anemie_chronique">
                            Anémie chronique
                        </label>
                    </div>
                </div>
                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_myopathie_item exclusion_item" type="checkbox" value="" id="myopathie">
                        <label class="form-check-label text-dark" for="myopathie">
                            Myopathies
                        </label>
                    </div>
                </div>                               
                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_toute_forme_de_cancers_item exclusion_item" type="checkbox" value="" id="toute_forme_de_cancers">
                        <label class="form-check-label text-dark" for="toute_forme_de_cancers">
                            Toute forme de cancers
                        </label>
                    </div>
                </div>

                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_toute_forme_de_tumeur_item exclusion_item" type="checkbox" value="" id="toute_forme_de_tumeur">
                        <label class="form-check-label text-dark" for="toute_forme_de_tumeur">
                            Toute forme de tumeur
                        </label>
                    </div>
                </div>
                
                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_vih_sida_item exclusion_item" type="checkbox" value="" id="vih_sida">
                        <label class="form-check-label text-dark" for="vih_sida">
                            Infection VIH/SIDA
                        </label>
                    </div>
                </div>

                <div class="col-lg-6 contact_name_col mt-3 pl-5">
                    <div class="form-check">
                        <input class="form-check-input exclu_hepatite_b_c_item exclusion_item" type="checkbox" value="" id="hepatite_b_c">
                        <label class="form-check-label text-dark" for="hepatite_b_c">
                            Hépatite B et C
                        </label>
                    </div>
                </div>
                ';
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
                        <button type="button" class="contact_button_default border-white ml-1 mr-4" id="backBtn">
                            <span>Retour</span>
                            <span class="button_arrow"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                        </button>
                        <button type="button" class="contact_button border-white" id="nextBtn" data-toggle="modal" data-target="#rgpd_form" data-backdrop="static" onclick="nextPrev(1)">
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
                    <div class="text-center col-lg-12">
                        <h3>Ajout des personnes à charges</h3>
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
                <div id="step3" class="tabstep">
                    <div class="row">
                        <div class="col">
                            <div class="row justify-content-center">
                                <div class="col-lg-10 mt-3">                            
                                    <div hidden="" class="text-center text-dark h6 mt-5">
                                        Afin de pouvoir effectuer le paiement, nous vous invitons à remplir ce formulaire, en vue d&#039;avoir les informations neccessaires sur le souscripteur pour valider le processus.
                                    </div>
                                    <div class="section_title text-center mt-5">
                                        <h2>Procédez au paiement de votre cotisation</h2>
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
                            <div class="row justify-content-around text-center">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <div class="col option_pasteur_fidele">
                                        <label class="btn bg-color-primary text-white text-sm ml-1" for="journalier">
                                            <input type="radio" id="journalier" class="methodePaiement" value="journalier" name="methodePaiement" autocomplete="off"/>
                                            Par jour
                                        </label>
                                    </div>
                                    <div class="col option_pasteur_fidele">
                                        <label class="btn bg-color-primary text-white ml-1 text-sm" for="hebdomadaire">
                                            <input type="radio" id="hebdomadaire" class="methodePaiement" value="hebdomadaire" name="methodePaiement" autocomplete="off"/>
                                            Par semaine
                                        </label>
                                    </div>
                                    <div class="col option_eveques option_pasteur_fidele">
                                        <label class="btn bg-color-primary text-white ml-1 text-sm" for="mensuel">
                                            <input type="radio" id="mensuel" class="methodePaiement" value="mensuel" name="methodePaiement" autocomplete="off"/>
                                            Par mois
                                        </label>
                                    </div>
                                    <div class="col option_eveques option_pasteur_fidele">
                                        <label class="btn bg-color-primary text-white ml-1 text-sm" for="annuelle">
                                            <input type="radio" id="annuelle" class="methodePaiement" value="annuelle" name="methodePaiement" autocomplete="off" checked/>
                                            Intégralement
                                        </label>          
                                    </div>
                                </div>
                            </div>

                            <!-- explication du fractionnement -->
                            <div>                        
                                <div class="row justify-content-center pt-3">
                                    <table class="col-lg-6 table2 table-sm table-bordered2">
                                        <thead>
                                        <tr class="colannuelle d-none">
                                            <th scope="col"> </th>
                                            <th scope="col" class="coljour">Jour</th>
                                            <th scope="col" class="colsemaine">Semaine</th>
                                            <th scope="col" class="colmois">Mois</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1er Paiement</th>
                                                <td class="MontantCotisationZone">
                                                    <input id="MontantCotisationZone" class="form-control text-center border-0" name="MontantCotisationZone" type="text" value="0" readonly/>
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
                            <!-- payeurs marchands -->
                            <!-- message informatif -->
                            <div class="row justify-content-center mt-3" style="font-size: 20px">
                                <div class="text-center text-dark fw-bold mt-3">
                                    Veuillez selectionner l&#039;operateur de paiement qui vous convient
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
                                <div class="col d-flex flex-column mx-auto justify-content-center">
                                    <label for="paiement_wave" class="text-center">
                                        <img src="img/wave.png" style="height: 100px; width: 100px" class="rounded mb-2" alt="..." />
                                    </label>
                                    <input id="paiement_wave" class="form-radio-input mx-auto" type="radio" name="operateur" value="wave"/>
                                </div>
                                <!-- si client visa-->
                                <div class="col d-flex flex-column mx-auto justify-content-center">
                                    <label for="paiement_visa" class="text-center">
                                        <img src="img/visa.png"
                                    style="height: 100px; width: 100px" class="rounded mb-2" alt="..." />
                                    </label>
                                    <input id="paiement_visa" class="form-radio-input mx-auto" type="radio" name="operateur" value="visa"/>
                                </div>
                                <!-- si client virement-->
                                <div class="col d-flex flex-column mx-auto justify-content-center">
                                    <label for="paiement_bancaire" class="text-center">
                                        <img src="img/paiement-virement-bancaire.jpg"
                                    style="height: 100px; width: 100px" class="rounded mb-2" alt="..." />
                                    </label>
                                    <input id="paiement_bancaire" class="form-radio-input mx-auto" type="radio" name="operateur" value="virement"/>
                                </div>
                            </div>
                            <div class="row justify-content-md-center" hidden>
                                <input id="isPremierPaiement" class="form-control" name="isPremierPaiement" type="number" value="'.($_SESSION["isPremierPaiement"]==true?"10000":"0").'" readonly/>
                                <button type="button" class="contact_button" onclick="GenerateurPaiment(1)">
                                    <span>Payer ma prime </span>
                                    <span class="button_arrow"><i class="fa fa-credit-card" aria-hidden="true"></i></span
                                </button>
                            </div>
                        </div>
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
                <br> 
                <h4 data-toggle="tooltip" title="La durée pendant laquelle vous n\'êtes pas couvert par les garanties d\'assurance dont le point de départ est la date de souscription">Délais de carence</h4>
                <p class="m-0">Frais médicaux : <span style="font-style: normal !important"> 1 mois </span></p>
                <p class="m-0">Opérations chirurgicales : <span style="font-style: normal !important"> 6 mois </span></p>
                <p class="m-0">Maternité : <span style="font-style: normal !important"> 9 mois </span></p>
                <p class="m-0">Lunetterie : <span style="font-style: normal !important"> 9 mois </span></p>
                <p class="m-0">Protèses dentaires : <span style="font-style: normal !important"> 9 mois </span></p>
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



if (isset($_GET['pasteursEtFideles'])) {
    $uniqueid=isset($_GET['uniqueid']) ? $_GET['uniqueid'] : null;
    # code...
    echo '                 
        <div class="col-lg-12 m-auto">
            <div class="section_title text-center " hidden>
                <h2 style="color: #000000 !important">Offre santé</h2>
            </div>

            <form method="POST" action="" accept-charset="UTF-8" class="contact_form" id="form_souscrire_sante" '.zone_recurrente('verifierinput').' enctype="multipart/form-data">
                <input name="_token" type="hidden" value="'.$uniqueid.'">
                <div class="col-lg-12 offset-lg-4" id="micro" style="display: none;">
                <!-------indicateur etape------>
                '.zone_recurrente('indicateur_etape').'
                <!-------indicateur etape------>
                </div>
                
                <div id="step1" class="tabstep">
                    <div class="col-lg-10 offset-lg-1">                                    
                        <div class="section_title text-center" hidden>
                            <h3 class="color-primary">TARIFS PRODUIT <span class="text-uppercase">"PASTEURS, PRETRES ET FIDELES"</span> </h3>
                        </div>
                    </div>

                    <section class="tabs">
                        <div hidden>
                            <input id="tab-1" style=" " type="radio" value="bronze" name="radio-set" class="tab-selector-1" checked="checked" />
                            <label for="tab-1" style=" cursor: default;" class="tab-label-1">Bronze</label>
                            
                        </div> 
                        <div class="content" style="min-height: fit-content !important;">
                            <div class="content-1">
                                <table class="table table-responsive-sm table-bordered table-sm" style="font-size: 17px" >
                                    <thead class="text-dark">
                                        <tr class="fw-bold text-white bg-dark" style="font-size: 18px">
                                            <th colspan="2">Tarifs</th>
                                            
                                        </tr>
                                        <tr style="font-size: 17px">
                                            <th>Composition <sup style="color: #BE1D2E !important" class="fw-bold text-danger">(*)</sup></th>
                                                                                                        
                                            <th>Prime TTC</th>                                                    
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark h6 bg-white" style="font-size: 17px">
                                    <tr >
                                        <td class="">Famille <sup class="fw-bold text-danger">(***)</sup></td>
                                        
                                        <td class="w-44 color-primary">230 000 FCFA</td>
                                    </tr>                                                                                                       
                                    <tr >
                                        <td class="">Adulte</td>
                                        
                                        <td class="color-primary">98 000 FCFA</td>
                                    </tr>

                                    <tr >
                                        <td class="">Enfant <sup class="fw-bold text-danger">(**)</sup></td>
                                        
                                        <td class="color-primary">73 500 FCFA</td>
                                    </tr>

                                    </tbody>
                                </table>

                                <table class="table table-responsive-sm table-striped table-bordered table-sm mt-1" style="font-size: 15px" >
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th style="width: 440px;">Soins Ambulatoires et Hospitaliers</th>
                                            <th>Taux de remboursement</th>
                                            <th>Plafonds (en FCFA)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark" style="font-size: 16px">
                                        <tr>
                                            <td class="fw-bold ">CONSULTATION</td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Consultation Généraliste</td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Consultation Spécialiste</td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Frais pharmaceutiques &amp; Produits </td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Radiologie &amp; Imagerie </td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Explorations fonctionnelles</td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Analyses Biologiques</td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Frais de traitements préventifs (vaccins) selon le tarif de l&#039;INHP</td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">50 000</td>
                                        </tr>
                                        <tr>
                                            <td>Frais de traitements spécifiques anti retro-viraux</td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">50 000</td>
                                        </tr>
                                        <tr>
                                            <td>Auxiliaires médicaux et AMI</td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">50 000</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">DENTISTERIE Soins</td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Consultation et soins</td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Prothèses dentaires (y compris Orthodontie des enfants de moins 16 ans)</td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">80 000</td>
                                        </tr>
                                        <tr>
                                            <td>Autres prothèses (orthopédique, auditive etc..)</td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">80 000</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">HOSPITALISATION</td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Hébergement (y compris hébergement de la mère accompagnant un enfant de 7 ans)</td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">20 000 F CFA/Jour</td>
                                        </tr>
                                        <tr>
                                            <td>Frais de traitement médicaux &amp; chirurgicaux</td>
                                            <td rowspan="5" class="text-center align-middle">80%</td>
                                            <td rowspan="5" class="text-center align-middle" >150 0000 FCFA par hospitalisation dans les limites de deux(2) hospitalisations par an</td>
                                        </tr>
                                        <tr>
                                            <td>Visite Généraliste</td>
                                            <td hidden class="text-center align-middle">Forfait</td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Visite Spécialiste </td>
                                            <td hidden class="text-center align-middle">Forfait</td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Petite Chirurgie / Soins</td>
                                            <td hidden class="text-center align-middle">Forfait</td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>AMI</td>
                                            <td hidden class="text-center align-middle">Forfait</td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">MATERNITE</td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Frais pré &amp; post Natal avec 03 échographies maximum</td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Accouchement simple</td>
                                            <td rowspan="3" class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">150 000</td>
                                        </tr>
                                        <tr>
                                            <td>Accouchement Multiple</td>
                                            <td hidden class="text-center align-middle">Forfait</td>
                                            <td class="text-end align-middle">200 000</td>
                                        </tr>
                                        <tr>
                                            <td>Accouchement Chirurgical</td>
                                            <td hidden class="text-center align-middle">Forfait</td>
                                            <td class="text-end align-middle">300 000</td>
                                        </tr>
                                        <tr>
                                            <td>Versement forfaitaire sur présentation de l&#039;extrait d&#039;acte de naissance (accouchement hors hôpital)</td>
                                            <td class="text-center align-middle">Forfait</td>
                                            <td class="text-end align-middle">60 000</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">OPTIQUE</td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Verres et Montures sans les commodités (antireflets, photogray, etc,)</td>
                                            <td class="text-center align-middle">Forfait</td>
                                            <td class="text-center align-middle">60 000 tous les deux(2) an calendaire</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Dioptrie de + ou - 0,25</td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-end align-middle">exclus</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">TRANSPORT</td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Ambulance</td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">20 000</td>
                                        </tr>                                                
                                    </tbody>
                                </table>
                            
                                <table class="table table-responsive-sm table-bordered table-sm mt-1" style="font-size: 15px ;color: black" >
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th colspan="2" class="text-center align-middle">Plafond annuel</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                    <tr>
                                        <td>Individuel </td>
                                        <td class="w-44 color-primary">1 000 000 FCFA/pers</td>
                                    </tr>
                                    <tr hidden>
                                        <td>Enfant </td>
                                        <td class="color-primary">165 000 FCFA/enfant</td>
                                    </tr>
                                    <tr>
                                        <td>Famille </td>
                                        <td class="color-primary">2 500 000 FCFA/famille</td>
                                    </tr>
                                    </tbody>
                                </table>
                                
                                '.zone_recurrente("Définitiondestypesdecontrats").'
                                
                                <br>
                                <h3 hidden class="text-danger">
                                    NB : les primes communiquées sont sous réserve d&#039;éventuelles surprimes pour risque aggravé après examen du bulletin d’adhésion.
                                </h3>
                            </div>                                                
                        </div>
                    </section>                                    
                </div>

                <div id="step2" class="tabstep">
                    <div id="produitSelectionne" class="col-lg-10 offset-lg-1">
                        <div class="section_title text-center">
                            <h6 style="line-height: 2em;">
                                Les déclarations de bases de l&#039;adhérent constituent la base d&#039;un contrat maladie.
                                Par conséquent nous vous invitons à répondre aux questionnaires ci-dessous avec sincèrité et exactitude.
                            </h6> 
                        </div>
                        <div hidden style="font-size: 1.5em !important" class="text-center alert alert-info fw-bold">
                        FANGAN <span id="produitSelectionne">PASTEURS ET FIDELES</span> 80 %
                        </div>
                    </div>
        
                    <div class="row mt-5" id="contrat">

                    '.zone_recurrente('inputcodeapporteur').'

                        <div class="col-lg-12 contact_name_col">
                            <div class="row flex-nowrap mt-3">
                                <div class="col-lg-12 d-flex justify-content-between"> 
                                    <div>
                                        <label class="form-check-label text-dark mb-3" for="exampleRadios1">Type de contrat : </label>
                                    </div>                
                                    <div class="form-check">
                                        <input class="form-check-input opt_produit" type="radio" name="opt_produit" id="famille" value="famille">
                                        <label class="form-check-label fw-bold text-dark" for="exampleRadios1">
                                            Contrat Famille
                                        </label>
                                    </div>
                                    <div class="form-check ml-5">
                                        <input class="form-check-input opt_produit" type="radio" name="opt_produit" id="Contrat_Individuel" value="individuel" checked>
                                        <label class="form-check-label fw-bold text-dark" for="exampleRadios2">
                                            Contrat Individuel
                                        </label>
                                    </div>
                                    <label class="text-danger fw-bold" id="opt_error"></label>
                                </div>
                            </div>
                        </div>

                        <input id="taux"  name="taux" type="hidden" value="80" hidden />
                        <input id="typeMembre" name="typeMembre" type="hidden" value="pasteursEtFideles" hidden />
                        
                        <div class="col-lg-12 contact_name_col mt-3" hidden>
                            <label class="text-dark" for="option_type_famille"> S\'agit-il d\'une entreprise ? <span class="text-danger fw-bold">*</span></label>
                            <select name="option_type_famille" id="option_type_famille" class="contact_input" onchange="info_souscripteur3()">
                                <option value="normal">NON </option>
                                <option value="entreprise">OUI</option>
                            </select>
                            <label class="text-danger fw-bold" id="option_type_famille_error"></label>
                        </div>

                        <div class="col-lg-4 contact_name_col mt-3 famille_entreprise" hidden>
                            <label class="text-dark" for="nombre_personnel">Nombre d\'employés <span class="text-danger fw-bold">*</span></label>
                            <input class="contact_input" id="nombre_personnel"  type="number" name="nombre_personnel" min="0" value="1" />
                        </div>

                        <div class="col-lg-4 contact_name_col mt-3 famille_entreprise" hidden>
                            <label class="text-dark" for="nombre_conjoint">Nombre de conjoints <span class="text-danger fw-bold">*</span></label>
                            <input class="contact_input" id="nombre_conjoint"  type="number" name="nombre_conjoint" min="0" value="0" />
                        </div>

                        <div class="col-lg-4 contact_name_col mt-3 famille_entreprise" hidden>
                            <label class="text-dark" for="nombre_enfant_entreprise">Nombre d\'enfants <span class="text-danger fw-bold">*</span></label>
                            <input class="contact_input" id="nombre_enfant_entreprise"  type="number" name="nombre_enfant_entreprise" min="0" value="0" />
                        </div>

                        
                        <div class="col-lg-6 contact_name_col mt-3 famille_simple" hidden>
                            <label class="text-dark" for="nombre_enfant">Nombre d\'enfants <span class="text-danger fw-bold">*</span></label>
                            <input class="contact_input" id="nombre_enfant"  type="number" name="nombre_enfant" min="0" value="0" />
                        </div>

                        <div class="col-lg-6 contact_name_col mt-3 famille_simple" hidden>
                            <label class="text-dark" for="nombre_adulte">Nombre d\'adultes <span class="text-danger fw-bold">*</span></label>
                            <input class="contact_input" id="nombre_adulte"  type="number" name="nombre_adulte" min="0" value="0" />
                        </div>
                        
                        <div hidden class="nbfamille_groupe col-lg-6 contact_name_col mt-3">
                            <label class="text-dark" for="exampleInputEmail1">Nombre de famille/personne <span class="text-danger fw-bold">*</span></label>
                            <input contenteditable="true" disabled name="nbfamille" value="1" id="nbfamille" type="number" class="contact_input " placeholder="Nombre de famille/personne"  value="">
                            <label class="text-danger fw-bold" id="nbfamille_error"></label>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div hidden id="fam" class="section_title text-center"><h3>FAMILLE 01 </h3></div>'.
                    zone_recurrente("zone_infosouscripteur").'
                </div>'.zone_recurrente('recapdevis').zone_recurrente("zone_boutton").'                             
            </form>
        </div>            
    ';
    
}
if (isset($_GET['info_assurer'])) {
    $nom=isset($_GET['nom']) ? $_GET['nom'] : null;
    $prenom=isset($_GET['prenom']) ? $_GET['prenom'] : null;
    $contact=isset($_GET['contact']) ? $_GET['contact'] : null;
    $email=isset($_GET['email']) ? $_GET['email'] : null;
    $typecontrat=isset($_GET['typecontrat']) ? $_GET['typecontrat'] : null;
    $masquetypecontrat = ($typecontrat=="normal") ? "hidden" : "" ;
    echo'
    <div class="section_title text-center"><h3>Assuré(e) principal(e) </h3></div>
        <div id="adfil0">
            <div class="row mt-3">
                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Nom <span class="text-danger fw-bold">*</span></label>
                    <input contenteditable="true" name="nom" id="nom" type="text" class="contact_input nom_item toupper" placeholder="Nom" value="'.strtoupper($nom).'" >
                    
                </div>
                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Prénoms <span class="text-danger fw-bold">*</span></label>
                    <input name="prenom" id="prenom" type="text" class="contact_input prenom_item toupper" placeholder="Prenom(s)" value="'.strtoupper($prenom).'" >
                    
                </div>

                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Sexe <span class="text-danger fw-bold">*</span></label>
                    <select name="sexe" id="sexe" class="contact_input sexe_item">
                        <option value="">Choisir Votre sexe </option>
                        <option value="M">Homme (Masculin)</option>
                        <option value="F">Femme (Feminin)</option>
                    </select>
                    
                </div>
                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Numéro CMU <span class="text-danger fw-bold">*</span></label>
                    <input name="numero_cmu" id="numero_cmu" type="text" class="contact_input numero_cmu" placeholder="saisir le numéro CMU" value=" ">
                    
                </div>

                <div class="col-lg-3 contact_name_col mt-3 contactediv">
                    <label class="text-dark labelcontacttest" for="exampleInputEmail1">Numéro portable <span class="text-danger fw-bold">*</span></label>                    
                        <input name="contact" id="contact" type="number" class="contact_input contact_item" placeholder="Contact" value="'.$contact.'" aria-label="" aria-describedby="basic-addon1">
                    <label class="text-danger fw-bold" id="contact_error"></label>
                </div>


                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Email <span class="text-danger fw-bold">*</span></label>
                    <input name="email" id="email" type="text" class="contact_input email_item" placeholder="Email" value="'.$email.'">
                    <label class="text-danger fw-bold" id="email_error"></label>
                </div>
            
                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="profession">Secteur d&#39;activit&#233;</label>
                    <select name="profession" id="profession" class="contact_input profession_item">
                        <option value="">Choisissez le secteur</option>';
                        foreach ($infoadherents[4]['activites'] as $activites) {
                            echo '<option value="'.$activites['activite'].'">'.$activites['activite'].'</option>';
                        }                        
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="profession_error"></label>
                </div>
            
                <div hidden class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="service">Service</label>
                    <input name="service" id="service" type="text" class="contact_input service_item" placeholder="Votre service" value="Votre service" >
                    <label class="text-danger fw-bold" id="service_error"></label>
                </div>

                <div '.$masquetypecontrat.' class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="organisation">Nom Entreprise <span class="text-danger fw-bold">*</span></label>
                    <input name="organisation" id="organisation" type="text" class="contact_input organisation_item" placeholder="Votre organisation" value=" ">
                    <label class="text-danger fw-bold" id="organisation_error"></label>
                </div>

                
                <div hidden class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="matricule_organisation">Matricule Organisation</label>
                    <input name="matricule_organisation" id="matricule_organisation" type="text" class="contact_input matricule_organisation_item" placeholder="Le matricule de votre organisation" value="Le matricule de votre organisation">
                    <label class="text-danger fw-bold" id="matricule_organisation_error"></label>
                </div>

                
                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark fs-0-8" for="categorie_professionnelle">Catégorie Professionnelle</label>
                    <select name="categorie_professionnelle" id="categorie_professionnelle" class="contact_input categorie_professionnelle_item">
                        <option value="">Choisissez la Catégorie</option>';
                        foreach ($infoadherents[5]['categorie_professionnelles'] as $categorie_professionnelles) {
                            echo '<option value="'.$categorie_professionnelles['categorie'].'">'.$categorie_professionnelles['categorie'].'</option>';
                        }                        
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="categorie_professionnelle_error"></label>
                </div>
                
                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark fs-0-8" for="situation_M">Situation matrimoniale</label>
                    <select name="situation_M" id="situation_M" class="contact_input civilite_item">
                        <option value="">Choisissez la situation</option>';
                        foreach ($infoadherents[0]['civilite'] as $civilite) {
                            echo '<option value="'.$civilite['titre'].'">'.$civilite['titre'].'</option>';
                        }                        
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="civilite_error"></label>
                </div>

                <div class="col-lg-3 contact_name_col mt-3" hidden>
                    <label class="text-dark" for="exampleInputEmail1">Taille <span class="text-danger fw-bold">*</span></label>
                    <input name="taille" id="taille" type="text" class="contact_input taille_item" placeholder="1m10" value="NA">
                    <label class="text-danger fw-bold" id="Taille_assure_error"></label>
                </div>
                <div class="col-lg-3 contact_name_col mt-3" hidden>
                    <label class="text-dark" for="exampleInputEmail1">Poids (en KG)<span class="text-danger fw-bold">*</span></label>
                    <input name="poids_assure" id="poids" type="text" class="contact_input poids_item" placeholder="50" value="NA">
                    <label class="text-danger fw-bold" id="poids_error"></label>
                </div>
            
                <div class="col-lg-3 contact_name_col mt-3" hidden>
                    <label class="text-dark" for="exampleInputEmail1">Tension artérielle <span class="text-danger fw-bold">*</span></label>
                    <input name="tension_arterielle" id="tension_arterielle" type="text" class="contact_input tension_arterielle_item" placeholder="120mm/80mm" value="NA">
                    <label class="text-danger fw-bold" id="tension_arterielle_error"></label>
                </div>

                <div class="col-lg-3 contact_name_col mt-3" hidden>
                    <label class="text-dark" for="exampleInputEmail1">Groupe sanguin</label>
                    <select name="groupe_sanguin" id="groupe_sanguin" class="contact_input groupe_sanguin_item">
                        <option value="NA">Choisir Votre groupe sanguin</option>';
                        //foreach ($infoadherents[3]['groupe_sanguin'] as $groupe_sanguin) {
                            //echo '<option value="'.$groupe_sanguin['groupe'].'">'.$groupe_sanguin['groupe'].'</option>';
                        //}
                        
                    echo'
                    </select>
                    <!--<input name="" id="groupe_sanguin" type="text" class="contact_input groupe_sanguin_item" placeholder="Groupe sanguin">-->
                    <label class="text-danger fw-bold" id="groupe_sanguin_error"></label>
                </div>
                                        
                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="type_piece">Type de pièce <span class="text-danger fw-bold">*</span></label>
                    <select name="type_piece" id="type_piece" class="contact_input type_piece_item">
                        <option value="">Choisissez le type de pièce</option>';
                        foreach ($infoadherents[1]['piece_identite'] as $piece_identite) {
                            echo '<option value="'.$piece_identite['id'].'">'.$piece_identite['piece'].'</option>';
                        }
                        
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="type_piece_error"></label>
                </div>

            
                <div hidden class="col-lg-3 contact_name_col mt-3 saisir_autre_piece">
                    <label class="text-dark" for="saisir_autre_piece">Indiquez le nom de la pièce <span class="text-danger fw-bold">*</span></label>
                    <input name="saisir_autre_piece" id="saisir_autre_piece" type="text" class="contact_input saisir_autre_piece_item" placeholder="Saisir le nom de la pièce" value="Saisir le nom de la pièce">
                    <label class="text-danger fw-bold" id="saisir_autre_piece_error"></label>
                </div>
                
                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="numero_piece">Numéro de pièces <span class="text-danger fw-bold">*</span></label>
                    <input name="numero_piece" id="numero_piece" type="text" class="contact_input numero_piece_item" placeholder="Saisir le numéro de pièce" >
                    <label class="text-danger fw-bold" id="numero_piece_error"></label>
                </div>

                
                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Date de naissance <span class="text-danger fw-bold">*</span></label>
                    <input name="date_naissance" id="date_naissance" type="date" class="contact_input date_naissance_item" placeholder="Date de naissance">
                    
                </div>

                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Lieu de naissance </label>
                    <select name="lieu_naissance" id="lieu_naissance" class="contact_input lieu_naissance_item">
                        <option value="">Choix lieu de naissance</option>
                        <option value="Hors du pays">Hors du pays</option>';
                        foreach ($villes as $ville) {
                            echo '<option value="'.ucfirst($ville['ville'][0]['nom']).'">'.ucfirst($ville['ville'][0]['nom']).'</option>';
                        }
                        
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="lieu_naissance_error"></label>
                </div>
                
                <input name="lien" id="lien" value="Adh&#233;rent principal" type="text" class="contact_input lien_item" value="lien" hidden>
           
                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Ville de residence <span class="text-danger fw-bold">*</span></label>
                    <select name="ville" id="ville" class="contact_input ville_item">
                        <option value="">Choix ville</option>';
                        foreach ($villes as $ville) {
                            echo '<option value="'.ucfirst($ville['ville'][0]['nom']).'">'.ucfirst($ville['ville'][0]['nom']).'</option>';
                        }
                        
                    echo'
                    </select>
                    
                </div>
                <div hidden class="col-lg-3 contact_name_col mt-3" id="choix_commune">
                    <label class="text-dark" for="exampleInputEmail1">Commune <span class="text-danger fw-bold">*</span></label>
                    <select name="commune" id="commune" class="contact_input commune_item">
                        <option value="na">Choix commune</option>
                        
                    </select>
                    <label class="text-danger fw-bold" id="commune_error"></label>
                </div>

                <div hidden class="col-lg-3 contact_name_col mt-3" id="saisie_commune">
                    <label class="text-dark" for="exampleInputEmail1">Commune (A saisir) <span class="text-danger fw-bold">*</span></label>
                    <input name="commune_scd" id="commune_scd" type="text" class="contact_input" placeholder="Saisir votre commune" value=" ">
                    <label class="text-danger fw-bold" id="commune_scd_error"></label>
                </div>

                <!--<div class="col-lg-3 contact_name_col mt-3" id="choix_quartier">
                    <label class="text-dark" for="exampleInputEmail1">Quartier </label>
                    <select name="quartier" id="quartier" class="contact_input">
                        <option value="NA">Choix quartier</option>
                    </select>
                    <label class="text-danger fw-bold" id="quartier_error"></label>
                </div>

                <div hidden class="col-lg-3 contact_name_col mt-3" id="saisie_quartier">
                    <label class="text-dark" for="exampleInputEmail1">Quartier <span class="text-danger fw-bold">*</span></label>
                    <input name="quartier_scd" id="quartier_scd" type="text" class="contact_input" placeholder="Saisir votre quartier" value="Saisir votre quartier">
                    <label class="text-danger fw-bold" id="quartier_scd_error"></label>
                </div>-->
               
                <div hidden class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="resident">Est-il résident ? </label>
                    <select name="resident" id="resident" class="contact_input resident_item">
                        <option value="non">NON</option>
                        <option value="oui">OUI</option>
                    </select>
                    <label class="text-danger fw-bold" id="resident_error"></label>
                </div>
                        
                <div hidden class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="type_agent">Type agent <span class="text-danger fw-bold">*</span></label>
                    <select name="type_agent" id="type_agent" class="contact_input type_agent_item">
                        <option value="ND">Non Défini - ND</option>
                    </select>
                    <label class="text-danger fw-bold" id="type_agent_error"></label>
                </div>

                
                <div hidden class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="activation_sms">Activer les SMS ?</label>
                    <select name="activation_sms" id="activation_sms" class="contact_input activation_sms_item">
                        <option value="non">NON</option>
                        <option value="oui">OUI</option>
                    </select>
                    <label class="text-danger fw-bold" id="activation_sms_error"></label>
                </div>

            
                <div hidden class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="site_web">Site Web </label>
                    <input name="site_web" id="site_web" type="text" class="contact_input site_web_item" placeholder="Indiquez votre site web" value="Indiquez votre site web">
                    <label class="text-danger fw-bold" id="site_web_error"></label>
                </div>
      
                <div hidden class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="adresse_postale">Adresse postale <span class="text-danger fw-bold">*</span></label>
                    <input name="adresse_postale" id="adresse_postale" type="text" class="contact_input adresse_postale_item" placeholder="Indiquez votre adresse postale" value="Indiquez votre adresse postale">
                    <label class="text-danger fw-bold" id="adresse_postale_error"></label>
                </div>'.
                zone_recurrente('pathologies').
            '</div>
        </div>
    </div>';
    
}
if (isset($_GET['recapdevis'])) {
    # code...
    echo'
    <div class="row">
        <div class="col">
            <div class="mt-5">

                <div class="col-lg-10 offset-lg-1">
                    
                    <div class="section_title text-center"><h2 style="color: #000000 !important">Couverture Santé </h2></div>
                    <div class="section_subtitle"></div>
                </div>

                <form method="POST" action="" accept-charset="UTF-8" class="contact_form" id="form_sant"><input name="_token" type="hidden" value="'.$uniqueid.'">

                    <!-- form -->
                        <div class="step1"> 
                            <div style="margin-top: -4% !important" class="col-lg-10 offset-lg-1">
                                <div style="background-color: #AEAEAE !important; color: #000000 !important;"  class="section_title alert text-center">
                                    Notre politique de souscription n\'inclut pas de questionnaire à remplir.<br>
                                    <strong>Vous pourvez dès à présent passer à l\'obtention de votre recapitulatif puis au paiement de votre cotisation.</strong>
                                </div>
                            </div>

                            <div class="col-lg-10 offset-lg-1 mt-4">
                                <div class="section_title text-center">
                                    <h3 class="fw-bold" style="color: #21301a !important;"> 
                                        LES DOCUMENTS À FOURNIR
                                    </h3>
                                </div>
                            </div>

                            <div class="col-lg-10 offset-lg-1">
                                <div class="row mt-4">
                                    <div class="col-lg-3">
                                        <div style="color: #000000 !important; background-color: #AEAEAE !important; border-color: #BE1D2E !important; height: 100% !important; box-shadow: 3px 2px 2px #BE1D2E;" class="card">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    
                                                    <img src="img/infos_sante_1.png"/>
                                                    <div class="mt-3 text-gray fw-bold">Copie de la Cni ou passeport ou attestation d’identité pour les adultes</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div style="color: #000000 !important; background-color: #AEAEAE !important; border-color: #BE1D2E !important; height: 100% !important; box-shadow: 3px 2px 2px #BE1D2E;" class="card">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    
                                                    <img src="img/infos_sante_2.png"/>
                                                    <div class="mt-3 text-gray fw-bold">Copie de l’extrait de naissance pour les enfants</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div style="color: #000000 !important; background-color: #AEAEAE !important; border-color: #BE1D2E !important; height: 100% !important; box-shadow: 3px 2px 2px #BE1D2E;" class="card">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    
                                                    <img src="img/infos_sante_3.png"/>
                                                    <div class="mt-3 text-gray fw-bold">Une photo pour chaque membre</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div style="color: #000000 !important; background-color: #AEAEAE !important; border-color: #BE1D2E !important; height: 100% !important; box-shadow: 3px 2px 2px #BE1D2E;" class="card">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    
                                                    <img src="img/infos_sante_4.png"/>
                                                    <div class="mt-3 text-gray fw-bold">Copie de la carte CMU ou récépissé d’enrôlement CMU</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div hidden class="col-lg-10 offset-lg-1 mt-2">
                                <div class="section_title alert alert-success text-center">
                                    Afin de permettre une réelle autonomie de nos partenaires, vous avez la possibilité de renseigner les informations et télécharger les pièces jointes pour ensuite éditer les cartes santés après validation
                                    <strong>AMGS.</strong>
                                </div>
                            </div>

                            <div class="col-lg-10 offset-lg-1 mt-4">
                                <div class="section_title text-center">
                                    <h3 class="fw-bold" style="color: #21301a !important;"> 
                                    LISTE DES EXAMENS MEDICAUX POUR LES PERSONNES DE + DE 65 ANS
                                    </h3>
                                </div>
                            </div>

                            <div class="col-lg-10 offset-lg-1 mt-2">
                                <div style="border-width: medium !important; border-color: #000000 !important; background-color: #FFFFFF !important; color: #000000 !important;" class="section_title text-center alert alert-dark">
                                    Pour tous les propects de plus de 65 ans, il peut y avoir une dérogation des médécins conseils après analyse des examens suivants :
                                </div>
                            </div>
                            <div class="col-lg-10 offset-lg-1 mt-2">
                                <div class="section_title text-center">
                                    <img width="50%" src="img/examen_medicaux.png"/>
                                </div>
                            </div> 
                            
                            <div class="mt-5">

                                <button class="contact_button_default previous_url ml-3" type="reset"><span><a class="text-white" href="http://app.amgs.africa/test/paiementoffline">Annuler</a></span><span class="button_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
                                
                                <button type="button" class="contact_button apercu_sante" data-toggle="modal" data-target="#devis_sant" data-backdrop="static"><span>Aperçu du contrat</span><span class="button_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>

                            </div>
                            
                        </div>

                </form>

            </div>
        </div>
    </div>';
    
}
if (isset($_GET['paie'])) {
    # code...
    echo'
    <div class="row justify-content-center">
        <div class="col-lg-10 mt-3">
            <div class="section_title text-center"><h2></h2></div>
            <div hidden="" class="text-center text-dark h6 mt-5"> Afin de pouvoir effectuer le paiement, nous vous invitons à remplir ce formulaire, en vue d&#039;avoir les informations neccessaires sur le souscripteur pour valider le processus. </div>
            <div class="section_title text-center mt-5"><h2>Procédez au paiement de votre prime</h2></div>            
        </div>        
    </div>
    <!-- message informatif -->
    <div class="row justify-content-center">
        <div class="col-lg-10 mt-3" style="font-size: 20px">
            <div class="text-center text-dark fw-bold mt-3">
                Veuillez demarrer le processus en cliquant sur le bouton ci-dessous
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
    <div class="row justify-content-around text-center">
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <div class="col">
                <label class="btn 
                 text-white text-sm ml-1" for="journalier">
                    <input type="radio" id="journalier" value="journalier" name="methodePaiement" autocomplete="off" checked/>
                    Par jour
                </label>
            </div>
            <div class="col">
                <label class="btn bg-color-primary text-white ml-1 text-sm" for="hebdomadaire">
                    <input type="radio" id="hebdomadaire" value="hebdomadaire" name="methodePaiement" autocomplete="off"/>
                    Par semaine
                </label>
            </div>
            <div class="col">
                <label class="btn bg-color-primary text-white ml-1 text-sm" for="mensuel">
                    <input type="radio" id="mensuel" value="mensuel" name="methodePaiement" autocomplete="off"/>
                    Par mois
                </label>
            </div>
            <div class="col">
                <label class="btn bg-color-primary text-white ml-1 text-sm" for="annuelle">
                    <input type="radio" id="annuelle" value="annuelle" name="methodePaiement" autocomplete="off"/>
                    Annuelle
                </label>          
            </div>
        </div>
    </div>

    <!-- explication du fractionnement -->

    <div class="row justify-content-center mt-3 colannuelle" style="font-size: 20px">
        <div class="text-center text-dark fw-bold mt-3">
        Explication du fractionnement
        </div>
    </div>
    <div class="row justify-content-center pt-3 colannuelle">
        <table class="col-lg-6 table2 table-sm table-bordered2">
            <thead>
            <tr>
                <th scope="col"> </th>
                <th scope="col" class="coljour">Jour</th>
                <th scope="col" class="colsemaine">Semaine</th>
                <th scope="col" class="colmois">Mois</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Solo</th>
                <td class="coljour">410 FCFA</td>
                <td class="colsemaine">1 885 FCFA</td>
                <td class="colmois">8 170 FCFA</td>
            </tr>
            <tr>
                <th scope="row">Famille</th>
                <td class="coljour">960 FCFA</td>
                <td class="colsemaine">4 425 FCFA</td>
                <td class="colmois">19 200 FCFA</td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- payeurs marchands -->
    <!-- message informatif -->
    <div class="row justify-content-center mt-3" style="font-size: 20px">
        <div class="text-center text-dark fw-bold mt-3">
            Veuillez l&#039;operateur de paiement qui vous convient
        </div>
    </div>
    <!-- choix operateur -->
    <div class="row mb-5 mt-4" id="assureur_list">
        <!-- si client orange-->
        <div class="col d-flex flex-column mx-auto ">
            <label for="paiement_orange" class="text-center">
                <img src="img/orange-mobile.jpg" style="height: 100px; width: 100px" class="rounded mb-2" alt="..." />
            </label>
            <input id="paiement_orange" class="form-radio-input mx-auto" type="radio" name="operateur" value="orange"/>
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
        <div class="col d-flex flex-column mx-auto justify-content-center">
            <label for="paiement_wave" class="text-center">
                <img src="img/wave.png" style="height: 100px; width: 100px" class="rounded mb-2" alt="..." />
            </label>
            <input id="paiement_wave" class="form-radio-input mx-auto" type="radio" name="operateur" value="wave"/>
        </div>
        <!-- si client visa-->
        <div class="col d-flex flex-column mx-auto justify-content-center">
            <label for="paiement_visa" class="text-center">
                <img src="img/visa.png"
              style="height: 100px; width: 100px" class="rounded mb-2" alt="..." />
            </label>
            <input id="paiement_bancaire" class="form-radio-input mx-auto" type="radio" name="operateur" value="visa"/>
        </div>
        <!-- si client virement-->
        <div class="col d-flex flex-column mx-auto justify-content-center">
            <label for="paiement_bancaire" class="text-center">
                <img src="img/paiement-virement-bancaire.jpg"
              style="height: 100px; width: 100px" class="rounded mb-2" alt="..." />
            </label>
            <input id="paiement_bancaire" class="form-radio-input mx-auto" type="radio" name="operateur" value="virement"/>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <button type="button" class="contact_button" onclick="GenerateurPaiment(1)">
            <span>Payer ma prime </span>
            <span class="button_arrow"><i class="fa fa-credit-card" aria-hidden="true"></i></span
        button>
    </div>';
    
}
if (isset($_GET['suitePaie'])) {
    # code...
    echo'

    <div class="row p-t-155">
        <div>
            <h3>Résumé de vos paiements</h3>
        </div>
        <div class="col-md-10 bg-color-primary p-b-55">
            <!-- DATA TABLE -->
            <div class="row py-3 justify-content-between colannuelle">
                <table class="col-lg-4 ml-3 table table-sm table-bordered bg-white">
                    <thead>
                    <tr>
                        <th scope="col" colspan="3">Information adhérent</th>                        
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Nom :</th>
                        <td colspan="2">'.$_SESSION["nom_user"].'</td>
                                                
                    </tr>
                    <tr>
                        <th scope="row">Prénom(s) :</th>
                        <td colspan="2">'.$_SESSION["prenom_user"].'</td>                        
                    </tr>
                    </tbody>                   
                </table>
                <div class="col-lg-2">
                    <button type="button" class="btn btn-warning" onclick="window.location.reload();">Se deconnecter</button>
                </div>
            </div>            
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <div class="rs-select2--light rs-select2--md" hidden>
                        <select class="contact_input form-control-sm js-select2" name="property">
                            <option selected="selected">All Properties</option>
                            <option value="">Option 1</option>
                            <option value="">Option 2</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                    <div class="rs-select2--light rs-select2--sm" hidden>
                        <select class="contact_input form-control-sm js-select2" name="time">
                            <option selected="selected">Today</option>
                            <option value="">3 Days</option>
                            <option value="">1 Week</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>                    
                </div>
                <div class="table-data__tool-right">                    
                    <div class="rs-select2--dark rs-select2--dark2">
                        <button type="button" class="btn btn-success" >Effectuer un paiement</button>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>
            </div>
            <div class="table-responsive table-responsive-data2">
                <table class="table w-100 table-data2">
                    <thead>
                        <tr>                            
                            <th>Type</th>
                            <th></th>                            
                            <th>Details</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Montant</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="tr-shadow">                            
                            <td>Journalier</td>
                            <td>
                                <span class="block-email">0778575698</span>
                            </td>
                            <td class="desc">Cotisation pasteur</td>
                            <td>2018-09-27 02:12</td>
                            <td>
                                <span class="status--process">Effectué</span>
                            </td>
                            <td>179.00 FCFA</td>
                            <td>
                                <div class="table-data-feature">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Send">                                        
                                        <i class="material-icons" data-toggle="tooltip" title="envoyer">&#xe163;</i>
                                    </button>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="material-icons" data-toggle="tooltip" title="edit">&#xe3c9;</i>
                                    </button>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="material-icons" data-toggle="tooltip" title="delete">&#xe872;</i>
                                    </button>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                        <i class="material-icons" data-toggle="tooltip" title="more">&#xe5d4;</i>
                                    </button>
                                </div>
                            </td>
                        </tr>                        
                        <tr class="spacer"></tr>
                        <tr class="tr-shadow">
                            
                            <td>Hebdomadaire</td>
                            <td>
                                <span class="block-email">0778575698</span>
                            </td>
                            <td class="desc">Cotisation pasteur</td>
                            <td>2018-09-25 19:03</td>
                            <td>
                                <span class="status--denied">Refusé</span>
                            </td>
                            <td>1199.00 FCFA</td>
                            <td>
                                <div class="table-data-feature">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                        <i class="material-icons" data-toggle="tooltip" title="envoyer">&#xe163;</i>
                                    </button>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="material-icons" data-toggle="tooltip" title="edit">&#xe3c9;</i>
                                    </button>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="material-icons" data-toggle="tooltip" title="delete">&#xe872;</i>
                                    </button>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                        <i class="material-icons" data-toggle="tooltip" title="more">&#xe5d4;</i>
                                    </button>
                                </div>
                            </td>
                        </tr>                        
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>';
    
}
if (isset($_GET['pageimpressionfiche'])) {
    # code...
    $transactionid=isset($_GET['transactionid']) ? $_GET['transactionid'] : null;
    echo'
    <div class="row">
        <div class="col-lg-10 offset-lg-1 mt-3">
            <div class="section_title text-center"><h2></h2></div>
            <div hidden="" class="text-center text-dark h6 mt-5"> Afin de pouvoir effectuer le paiement, nous vous invitons à remplir ce formulaire, en vue d\'avoir les informations neccessaires sur le souscripteur pour valider le processus. </div>
            <div class="section_title text-center mt-5"><h2>Votre paiement à été effectué</h2></div>
            
        </div>
        
    </div>

    <!-- message informatif -->
    <div class="col-lg-10 offset-lg-1 mt-3" style="font-size: 20px; margin-bottom:50px">
        <div class="section_title text-center"><h2></h2></div>
        <div class="text-center text-dark fw-bold mt-5">
            <p>Merci d’imprimez votre contrat ci-dessous</p>
            <!--<p>- Rendez-vous dans nos locaux muni de votre contrat afin de procéder à votre paiement</p>-->
        </div>
    </div>

    <div class="row justify-content-md-center" >
        <button type="button" class="contact_button" onclick="immpressionFiche(\''.$transactionid.'\')"><span>Imprimer le contrat</span><span class="button_arrow"><i class="fa fa-credit-card" aria-hidden="true"></i></span></button>
    </div>';
    
}
if (isset($_GET['infosante'])) {

    $jsonfield_santecontents=isset($_GET['jsonfield_santecontents']) ? $_GET['jsonfield_santecontents'] : null;
    //ecriture des information de l'utilisateur dans la base de donnee
    //file_put_contents("data.json", $jsonfield_santecontents);
    $_SESSION["data"]=$jsonfield_santecontents;
    $santecontents=json_decode($jsonfield_santecontents, true);
    
    echo'
        <div class="col-lg-10 offset-lg-1">
            <div class="section_title text-center" hidden>
                <h3 class="text-uppercase " style="color:#000000 !important">Couverture Santé<br>
                    <span style="color:#21301A !important"> Contrat '.$santecontents["opt_produit"].'  <span></span></span>
                </h3>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <span class="text-dark fw-bold text-uppercase">INFORMATIONS DU SOUSCRIPTEUR</span>
            </div>
            <div class="card-body">
                <div class="row text-dark h5" style="font-size: 18px">
                    <div class="col-lg-12">
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td class="fw-bold text-dark w-40">Nom : </td>
                                    <td class="pl-3 ">'.firstupper($santecontents["name"]).'</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Prénoms : </td>
                                    <td class="pl-3 ">'.firstupper($santecontents["firstname"]).'</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Contact : </td>
                                    <td class="pl-3 ">'.$santecontents["contact"].'</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Email : </td>
                                    <td class="pl-3">'.$santecontents["email"].'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <span class="text-dark fw-bold text-uppercase">Adhérent principal</span>
            </div>
            <div class="card-body">
                <div class="row text-dark h5" style="font-size: 20px">
                    <div class="col-lg-12">
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td class="fw-bold text-dark w-40">Nom et Prénoms : </td>
                                    <td class="pl-3 "> '.firstupper($santecontents["nom"]).' '.firstupper($santecontents["prenom"]).'</td>
                                </tr>';
                                if ($santecontents["numero_cmu"]!==" ") {
                                    echo '<tr><td class="fw-bold text-dark">Numéro CMU: </td>
                                    <td class="pl-3 text-uppercase">'.$santecontents["numero_cmu"].'</td>
                                </tr>';
                                }
                                echo'
                                <tr hidden>
                                    <td class="fw-bold text-dark">Numéro client: </td>
                                    <td class="pl-3 text-uppercase" id="uid">'.$santecontents["_token"].'</td>
                                </tr><tr>
                                    <td class="fw-bold text-dark">Téléphone : </td>
                                    <td class="pl-3">'.$santecontents["contact"].'</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Sexe : </td>
                                    <td class="pl-3">'.$santecontents["sexe"].'</td>
                                </tr>

                                <tr hidden>
                                    <td class="fw-bold text-dark">Poids en KG : </td>
                                    <td class="pl-3">'.$santecontents["poids_assure"].'</td>
                                </tr>
                                <tr hidden>
                                    <td class="fw-bold text-dark">Taille : </td>
                                    <td class="pl-3">'.$santecontents["taille"].'</td>
                                </tr>
                                <tr hidden>
                                    <td class="fw-bold text-dark">Tension artérielle : </td>
                                    <td class="pl-3">'.$santecontents["tension_arterielle"].'</td>
                                </tr>


                                <tr>
                                    <td class="fw-bold text-dark">Email : </td>
                                    <td class="pl-3">'.$santecontents["email"].'</td>
                                </tr><tr>
                                    <td class="fw-bold text-dark">Profession: </td>
                                    <td class="pl-3">'.firstupper($santecontents["profession"]).'</td>
                                </tr><tr>
                                    <td class="fw-bold text-dark"> Ville de residence : </td>
                                    <td class="pl-3">'.$santecontents["ville"].'</td>
                                </tr><tr hidden>
                                    <td class="fw-bold text-dark"> Commune : </td>
                                    <td class="pl-3">'.firstupper($santecontents["commune"]).'</td>
                                </tr>';
                                /*if (firstupper($santecontents["quartier"])!=="Choix quartier") {
                                    # code...
                                    echo '<tr><td class="fw-bold text-dark"> Quartier : </td>
                                    <td class="pl-3">'.firstupper($santecontents["quartier"]).'</td>
                                    </tr>';
                                }*/
                                echo'
                                    <tr>
                                    <td class="fw-bold text-dark">Date de naissance : </td>
                                    <td class="pl-3">'.date("d-m-Y",strtotime($santecontents["date_naissance"])).'</td>
                                </tr>';
                                if (firstupper($santecontents["lieu_naissance"])!==" ") {
                                    # code...
                                    echo '<tr><td class="fw-bold text-dark"> Lieu de naissance : </td>
                                    <td class="pl-3">'.firstupper($santecontents["lieu_naissance"]).'</td>
                                    </tr>';
                                }
                                echo'                                
                                <tr hidden>
                                    <td class="fw-bold text-dark" >Groupe sanguin : </td>
                                    <td class="pl-3">'.$santecontents["groupe_sanguin"].'</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Statut : </td>
                                    <td class="pl-3">'.firstupper($santecontents["lien"]).'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    ';
    
    for ($i=1; $i <= $santecontents["nombre_enfant"] ; $i++) { 
        # code...
        if (isset($santecontents["nom_e".$i])) {
            # code...
            echo '
            <div class="card mt-3">
                <div class="card-header">
                    <span class="text-dark fw-bold text-uppercase">Adhérent Enfant N°'.$i.'</span>
                </div>
                <div class="card-body">
                    <div class="row text-dark h5" style="font-size: 20px">
                        <div class="col-lg-10">
                            <table class="w-100">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold text-dark">Nom et Prénoms : </td>
                                        <td class="pl-3 "> '.firstupper($santecontents["nom_e".$i]).' '.firstupper($santecontents["prenom_e".$i]).'</td>
                                    </tr>
                                    <tr hidden>
                                        <td class="fw-bold text-dark">Numéro client: </td>
                                        <td class="pl-3 text-uppercase">'.$santecontents["_token"].$i.'</td>
                                    </tr><tr>
                                        <td class="fw-bold text-dark">Téléphone : </td>
                                        <td class="pl-3">'.$santecontents["contact_e".$i].'</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-dark">Sexe : </td>
                                        <td class="pl-3">'.$santecontents["sexe_e".$i].'</td>
                                    </tr>

                                    <tr hidden>
                                        <td class="fw-bold text-dark">Poids en KG : </td>
                                        <td class="pl-3">'.$santecontents["poids_e".$i].'</td>
                                    </tr>
                                    <tr hidden>
                                        <td class="fw-bold text-dark">Taille : </td>
                                        <td class="pl-3">'.$santecontents["taille_e".$i].'</td>
                                    </tr>
                                    <tr hidden>
                                        <td class="fw-bold text-dark">Tension artérielle : </td>
                                        <td class="pl-3">'.$santecontents["tension_arterielle_e".$i].'</td>
                                    </tr>


                                    <tr>
                                        <td class="fw-bold text-dark">Email : </td>
                                        <td class="pl-3">'.$santecontents["email_e".$i].'</td>
                                    </tr><tr>
                                        <td class="fw-bold text-dark"> Profession: </td>
                                        <td class="pl-3"> '.firstupper($santecontents["profession_e".$i]).'</td>
                                    </tr><tr>
                                        <td class="fw-bold text-dark">Date de naissance : </td>
                                        <td class="pl-3">'.date("d-m-Y",strtotime($santecontents["date_naissance_e".$i])).'</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-dark">Lieu de naissance : </td>
                                        <td class="pl-3">'.firstupper($santecontents["lieu_naissance_e".$i]).'</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-dark">Statut : </td>
                                        <td class="pl-3">'.firstupper($santecontents["lien_e".$i]).'</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
        
    }
    for ($i=1; $i <= $santecontents["nombre_adulte"] ; $i++) { 
        # code...
        if (isset($santecontents["nom_a".$i])) {
            echo '
            <div class="card mt-3">
                <div class="card-header">
                    <span class="text-dark fw-bold text-uppercase">Adhérent Adulte N°'.$i.'</span>
                </div>
                <div class="card-body">
                    <div class="row text-dark h5" style="font-size: 20px">
                        <div class="col-lg-10">
                            <table class="w-100">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold text-dark">Nom et Prénoms : </td>
                                        <td class="pl-3 text-uppercase"> '.firstupper($santecontents["nom_a".$i]).' '.firstupper($santecontents["prenom_a".$i]).'</td>
                                    </tr>
                                    <tr hidden>
                                        <td class="fw-bold text-dark">Numéro client: </td>
                                        <td class="pl-3 text-uppercase">'.$santecontents["_token"].$i.'</td>
                                    </tr><tr>
                                        <td class="fw-bold text-dark">Téléphone : </td>
                                        <td class="pl-3">'.$santecontents["contact_a".$i].'</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-dark">Sexe : </td>
                                        <td class="pl-3">'.$santecontents["sexe_a".$i].'</td>
                                    </tr>

                                    <tr hidden>
                                        <td class="fw-bold text-dark">Poids en KG : </td>
                                        <td class="pl-3">'.$santecontents["poids_a".$i].'</td>
                                    </tr>
                                    <tr hidden>
                                        <td class="fw-bold text-dark">Taille : </td>
                                        <td class="pl-3">'.$santecontents["taille_a".$i].'</td>
                                    </tr>
                                    <tr hidden>
                                        <td class="fw-bold text-dark">Tension artérielle : </td>
                                        <td class="pl-3">'.$santecontents["tension_arterielle_a".$i].'</td>
                                    </tr>


                                    <tr>
                                        <td class="fw-bold text-dark">Email : </td>
                                        <td class="pl-3">'.$santecontents["email_a".$i].'</td>
                                    </tr><tr>
                                        <td class="fw-bold text-dark"> Profession: </td>
                                        <td class="pl-3"> '.firstupper($santecontents["profession_a".$i]).'</td>
                                    </tr><tr>
                                        <td class="fw-bold text-dark">Date de naissance : </td>
                                        <td class="pl-3">'.date("d-m-Y",strtotime($santecontents["date_naissance_a".$i])).'</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-dark">Lieu de naissance : </td>
                                        <td class="pl-3">'.firstupper($santecontents["lieu_naissance_a".$i]).'</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-dark">Statut : </td>
                                        <td class="pl-3">'.firstupper($santecontents["lien_a".$i]).'</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
    }

}
if (isset($_GET['devis'])) {
    # code...
    $jsonfield_santecontents=isset($_GET['jsonfield_santecontents']) ? $_GET['jsonfield_santecontents'] : null;
    $santecontents=json_decode($jsonfield_santecontents, true);
    

    //tableau de calcule de cotisation
    $formules=array(
        array("Evêques","450000","160000","120000"),
        array("Direction Générale","340000","115000","86250"),
        array("pasteursEtFideles","230000","98000","73500")
    );
    $tableAutiliser="";
    foreach ($formules as $formule) {
        # code...
        if ($formule[0]==$santecontents["typeMembre"]) {
            # code...
            $tableAutiliser=$formule;
        }
    }
    //detection de la valeur des types pour le calcul de la cotation
    //$tabtype=typedetect($santecontents["option_type_famille"],$santecontents["taux"],$santecontents["radio-set"]);
    $nbreadulte="";
    $nbrenfant="";
    $montantCotisation="";
    //verification des variables a envoyer si famille ou individuel
    if ($santecontents["opt_produit"]=="individuel") {
        # code...
        $nbreadulte=1;
        $nbrenfant=0;
    } else {
        # code...
        if ($santecontents["option_type_famille"]=="normal") {
            # code...
            $nbreadulte=intval($santecontents["nombre_adulte"]);
            $nbrenfant=intval($santecontents["nombre_enfant"]);
        } else {
            # code...
            $nbreadulte=intval($santecontents["nombre_personnel"])+intval($santecontents["nombre_conjoint"]);
            $nbrenfant=intval($santecontents["nombre_enfant_entreprise"]);
        }
        
    }
    //calcul du montant de la cotisation
    if ($santecontents["opt_produit"]=="individuel") {
        # code...
        $montantCotisation=$tableAutiliser[2];
    }
    if ($santecontents["opt_produit"]=="famille") {
        # code...
        //$primettc=(($nbreadulte*$champ["prime_adulte"])+($nbrenfant*$champ["prime_enfant"]));
        $montantCotisation=$tableAutiliser[3];
    }
    //print_r("nbreadulte=".$nbreadulte." nbrenfant=".$nbrenfant." type_taux=".$tabtype[0]." type_radio_set=".$tabtype[1]." type_option_type_famille=".$tabtype[2]);
    //print_r("nbreadulte=".$nbreadulte." nbrenfant=".$nbrenfant);
    //$tabtype2=calculcotation($nbreadulte,$nbrenfant,$tabtype[0],$tabtype[1],$tabtype[2]);
    
    $part='<h5 class="modal-title h3 fw-bold text-dark" id="LabelAccident" hidden>Dévis SANTE-'.strtoupper($santecontents["radio-set"]).'-MUCCI-'.$code_uni.'</h5>
                <button type="button" class="close d-none" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true"></span>
                </button>//
            <div class="section_title text-center">
                <h2><span class="text-danger" style="color:#BE1D2E !important">Contrat '.$santecontents["opt_produit"].'</span></h2>
            </div>
            <div class="card mt-3">
                <div class="card-header"><span class="text-dark fw-bold text-uppercase"> facturation globale du contrat</span></div>
                    <div class="card-body">
                        <div class="row text-dark h5">
                            <div class="col-lg-12">
                                <table class="table table-bordered" style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <td class="fw-bold">Désignation</td>
                                            <td class="text-end fw-bold">Montant</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr hidden="">
                                            <td>Prime nette </td>
                                            <td class="text-end">56 482 FCFA</td>
                                            
                                        </tr>
                                        <tr hidden="">
                                            <td> Coût des accessoires </td>
                                            <td class="text-end"> 4 000 FCFA </td>
                                        </tr>
                                        <tr hidden="">
                                            <td> Taxes </td>
                                            <td class="text-end"> 4 519 FCFA </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Cotisation totale</td>
                                            <td style="font-size: 1.5em; color:#BE1D2E !important" class="text-end text-danger fw-bold" id="primevalue">'.number_format(round($montantCotisation,0),0,""," ")." FCFA".'</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        echo $part;
}
if (isset($_GET['add_adherent'])) {
    # code...
    $type_adherent=isset($_GET['type_adherent']) ? $_GET['type_adherent'] : null;
    $type_adherent_id=isset($_GET['type_adherent_id']) ? $_GET['type_adherent_id'] : 'fil0';
    $type_adherent_id++;
   

    if ($type_adherent==0) {
        # code...
        echo'
        <div id="'.$type_adherent_id.'" class="adfilA" >
            <div class="col-lg-10 offset-lg-1 mt-3">
                <div class="section_title text-center">
                    <h2></h2>
                </div>
                <div class="section_title text-center charge_3">
                    <h3>Adulte N°'.substr($type_adherent_id,5,1).'</h3>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Nom <span class="text-danger fw-bold">*</span></label>
                    <input contenteditable="true" name="nom_a'.substr($type_adherent_id,5,1).'" id="nom_a'.substr($type_adherent_id,5,1).'" type="text" class="contact_input nom_item toupper" onchange="verifier_nom_beneficiaire()" placeholder="Nom" value="">
                    <label hidden="" class="text-danger fw-bold" id="nom_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>
                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Prénom(s) <span class="text-danger fw-bold">*</span></label>
                    <input name="prenom_a'.substr($type_adherent_id,5,1).'" id="prenom_a'.substr($type_adherent_id,5,1).'" onchange="verifier_prenom_beneficiaire()" type="text" class="contact_input prenom_item toupper" placeholder="Prenom(s)" value="">
                    <label hidden="" class="text-danger fw-bold" id="prenom_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>
                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Sexe <span class="text-danger fw-bold">*</span></label>
                    <select name="sexe_a'.substr($type_adherent_id,5,1).'" id="sexe_a'.substr($type_adherent_id,5,1).'" onchange="verifier_sexe_beneficiaire()" class="contact_input sexe_item">
                        <option value="sexe">Choisir Votre sexe</option>
                        <option value="H">Homme</option>
                        <option value="F">Femme</option>
                    </select><label hidden="" class="text-danger fw-bold" id="error_sexe_a'.substr($type_adherent_id,5,1).'"></label>
                </div>

                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="type_piece">Type de pièce <span class="text-danger fw-bold">*</span></label>
                    <select name="type_piece_a'.substr($type_adherent_id,5,1).'" id="type_piece_a'.substr($type_adherent_id,5,1).'" onchange="verifier_type_piece_beneficiaire()" class="contact_input type_piece_item">
                        <option value="">Choisissez le type de pièce</option>';
                        foreach ($infoadherents[1]['piece_identite'] as $piece_identite) {
                            echo '<option value="'.$piece_identite['id'].'">'.$piece_identite['piece'].'</option>';
                        }
                        
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="type_piece_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>

                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="numero_piece_a'.substr($type_adherent_id,5,1).'">Numéro de pièces <span class="text-danger fw-bold">*</span></label>
                    <input name="numero_piece_a'.substr($type_adherent_id,5,1).'" id="numero_piece_a'.substr($type_adherent_id,5,1).'" onchange="verifier_numero_piece_beneficiaire()" type="text" class="contact_input numero_piece_item" placeholder="Saisir le numéro de pièce">
                    <label class="text-danger fw-bold" id="numero_piece_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>

                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="profession_a'.substr($type_adherent_id,5,1).'">Profession / Fonction </label><input name="profession_a'.substr($type_adherent_id,5,1).'" id="profession_a'.substr($type_adherent_id,5,1).'" type="text" class="contact_input profession_item" placeholder="Profession"><label class="text-danger fw-bold" id="profession_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>
                <div hidden="" class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="service_3">Service <span class="text-danger fw-bold">*</span></label>
                    <input name="service" id="service_3" type="text" class="contact_input service_item" placeholder="Votre service" value="Votre service"><label class="text-danger fw-bold" id="service_error_3"></label>
                </div>
                <div hidden="" class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="organisation_3">Organisation <span class="text-danger fw-bold">*</span></label>
                    <input name="organisation" id="organisation_3" type="text" class="contact_input organisation_item" placeholder="Votre organisation"value="Votre organisation">
                    <label class="text-danger fw-bold" id="organisation_error_3"></label>
                </div>

                <div hidden="" class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="matricule_organisation_3">Matricule Organisation <span class="text-danger fw-bold">*</span></label>
                    <input name="matricule_organisation" id="matricule_organisation_3" type="text" class="contact_input matricule_organisation_item" placeholder="Le matricule de votre organisation" value="Le matricule de votre organisation">
                    <label class="text-danger fw-bold" id="matricule_organisation_error_3"></label>
                </div>

                <div hidden="" class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="categorie_professionnelle_3">Numéro de pièces <span class="text-danger fw-bold">*</span></label>
                    <input name="categorie_professionnelle" id="categorie_professionnelle_3" type="text" class="contact_input categorie_professionnelle_item" placeholder="Votre catégorie professionnelle" value="Votre catégorie professionnelle">
                    <label class="text-danger fw-bold" id="categorie_professionnelle_error_3"></label>
                </div>

                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="civilite">Civilité</label>
                    <select name="civilite_a'.substr($type_adherent_id,5,1).'" id="civilite_a'.substr($type_adherent_id,5,1).'" class="contact_input civilite_item">
                        <option value="">Choisissez la civilité</option>';
                        foreach ($infoadherents[0]['civilite'] as $civilite) {
                            echo '<option value="'.$civilite['titre'].'">'.$civilite['titre'].'</option>';
                        }
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="civilite_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>

                <div class="col-lg-3 mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Date de naissance <span class="text-danger fw-bold">*</span></label>
                    <input name="date_naissance_a'.substr($type_adherent_id,5,1).'" id="datenaissance_a'.substr($type_adherent_id,5,1).'" onchange="verifier_date_naissance_beneficiaire()" type="date" class="contact_input date_naissance_item" placeholder="Date de naissance">
                    <label hidden="" class="text-danger fw-bold" id="datenaissance_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>

                <div class="col-lg-3 mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Lieu de naissance </label>
                    <input name="lieu_naissance_a'.substr($type_adherent_id,5,1).'" id="lieu_naissance_a'.substr($type_adherent_id,5,1).'" onchange="verifier_date_naissance_beneficiaire()" type="text" class="contact_input lieu_naissance_item" placeholder="Lieu de naissance">
                    <label class="text-danger fw-bold" id="lieu_naissance_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>

                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Contact <span class="text-danger fw-bold">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend d-flex align-items-stretch">
                            <button class="btn btn-outline-secondary d-flex align-items-center" type="button"><i class="material-icons" data-toggle="tooltip" title="ajouter">&#xe147;</i></button>
                        </div>
                        <input name="contact_a'.substr($type_adherent_id,5,1).'" id="contact_a'.substr($type_adherent_id,5,1).'" type="text" class="contact_input contact_item" placeholder="Contact" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <label class="text-danger fw-bold" id="contact_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>

                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Email </label>
                    <input name="email_a'.substr($type_adherent_id,5,1).'" id="email_a'.substr($type_adherent_id,5,1).'" type="text" class="contact_input email_item" placeholder="Email"><label class="text-danger fw-bold" id="email_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>
                
                <div class="col-lg-3 mb-3 contact_name_col mt-3" id="liens">
                    <label class="text-dark" for="exampleInputEmail1">Liens <span class="text-danger fw-bold">*</span></label>
                    <select name="lien_a'.substr($type_adherent_id,5,1).'" id="lien_a'.substr($type_adherent_id,5,1).'" class="contact_input lien_item" onchange="verifier_lien_beneficiaire()">
                        <option value="" disabled="" selected="">- Sélectionner une relation -</option>';
                        foreach ($infoadherents[2]['lien_parente'] as $lien_parente) {
                            echo '<option value="'.$lien_parente['lien'].'">'.$lien_parente['lien'].'</option>';
                        }
                        
                    echo'
                    </select>
                    <label hidden="" class="text-danger fw-bold" id="lien_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>
                
                <div hidden="" class="col-lg-3 contact_name_col mt-3"><label class="text-dark" for="resident">Est-il résident ?</label>
                    <select name="resident" id="resident_3" class="contact_input resident_item">
                        <option value="non">NON</option>
                        <option value="oui">OUI</option>
                    </select>
                    <label class="text-danger fw-bold" id="resident_error"></label>
                </div>

                <div hidden="" class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="type_agent">Type agent<span class="text-danger fw-bold">*</span></label>
                    <select name="type_agent" id="type_agent_3" class="contact_input type_agent_item">
                        <option value="ND">Non Défini - ND</option>
                    </select><label class="text-danger fw-bold" id="type_agent_error"></label>
                </div>

                <div hidden="" class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="activation_sms">Activer les SMS ?</label>
                    <select name="activation_sms" id="activation_sms_3" class="contact_input activation_sms_item">
                        <option value="non">NON</option>
                        <option value="oui">OUI</option>
                    </select>
                    <label class="text-danger fw-bold" id="activation_sms_error"></label>
                </div>'.
                zone_recurrente('pathologies').
            '</div>
            <button style="width: 100%" id="remove'.substr($type_adherent_id,5,1).'" class="btn btn-danger remove_field mt-4" onclick="removePersCharge(\''.$type_adherent_id.'\')">Retirer la personne à charge N°'.substr($type_adherent_id,5,1).'
            </button>
        </div>
        ';
    } else {
        # code...
        echo'
        <div id="'.$type_adherent_id.'" class="adfilE">
            <div class="col-lg-10 offset-lg-1 mt-3">
                <div class="section_title text-center">
                    <h2></h2>
                </div>
                <div class="section_title text-center charge_0">
                    <h3>Enfant N°'.substr($type_adherent_id,4,1).' </h3>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Nom <span class="text-danger fw-bold">*</span></label>
                    <input contenteditable="true" name="nom_e'.substr($type_adherent_id,4,1).'" id="nom_e'.substr($type_adherent_id,4,1).'" type="text" class="contact_input nom_item toupper" onchange="verifier_nom_beneficiaire()" placeholder="Nom" value="">
                    <label hidden="" class="text-danger fw-bold" id="nom_error_e'.substr($type_adherent_id,4,1).'"></label>
                </div>

                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Prénom(s) <span class="text-danger fw-bold">*</span></label>
                    <input name="prenom_e'.substr($type_adherent_id,4,1).'" id="prenom_e'.substr($type_adherent_id,4,1).'" onchange="verifier_prenom_beneficiaire()" type="text" class="contact_input prenom_item toupper" placeholder="Prenom(s)" value="">
                    <label hidden="" class="text-danger fw-bold" id="prenom_error_e'.substr($type_adherent_id,4,1).'"></label>
                </div>

                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Sexe <span class="text-danger fw-bold">*</span>
                    </label>
                    <select name="sexe_e'.substr($type_adherent_id,4,1).'" id="sexe_e'.substr($type_adherent_id,4,1).'" class="contact_input sexe_item" onchange="verifier_sexe_beneficiaire()">
                        <option value="sexe">Choisir Votre sexe</option>
                        <option value="H">Homme</option>
                        <option value="F">Femme</option>
                    </select>
                    <label hidden="" class="text-danger fw-bold" id="error_sexe_e'.substr($type_adherent_id,4,1).'"></label>
                </div>

                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Groupe sanguin </label>
                    <select name="groupe_sanguin_e'.substr($type_adherent_id,4,1).'" id="groupe_sanguin_e'.substr($type_adherent_id,4,1).'" class="contact_input groupe_sanguin_item">
                        <option value=" ">Choisir votre groupe_sanguin </option>';
                        foreach ($infoadherents[3]['groupe_sanguin'] as $groupe_sanguin) {
                            echo '<option value="'.$groupe_sanguin['groupe'].'">'.$groupe_sanguin['groupe'].'</option>';
                        }
                        
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="groupe_sanguin_error"></label>
                </div>

                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="type_piece">Type de pièce <span class="text-danger fw-bold">*</span>
                    </label>
                    <select name="type_piece_e'.substr($type_adherent_id,4,1).'" id="type_piece_e'.substr($type_adherent_id,4,1).'" onchange="verifier_type_piece_beneficiaire()" class="contact_input type_piece_item">';
                    foreach ($infoadherents[1]['piece_identite'] as $piece_identite) {
                        echo '<option value="'.$piece_identite['id'].'">'.$piece_identite['piece'].'</option>';
                    }
                    
                echo'
                    </select>
                    <label class="text-danger fw-bold" id="type_piece_error_e'.substr($type_adherent_id,4,1).'"></label>
                </div>

                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="numero_piece_0">Numéro de pièces <span class="text-danger fw-bold">*</span>
                    </label>
                    <input name="numero_piece_e'.substr($type_adherent_id,4,1).'" id="numero_piece_e'.substr($type_adherent_id,4,1).'" type="text" onchange="verifier_numero_piece_beneficiaire()" class="contact_input numero_piece_item" placeholder="Saisir le numéro de pièce">
                    <label class="text-danger fw-bold" id="numero_piece_error_e'.substr($type_adherent_id,4,1).'"></label>
                </div>

                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="profession_0">Profession / Fonction </label>
                    <input name="profession_e'.substr($type_adherent_id,4,1).'" id="profession_e'.substr($type_adherent_id,4,1).'" type="text" class="contact_input profession_item" placeholder="Profession">
                    <label class="text-danger fw-bold" id="profession_error_e'.substr($type_adherent_id,4,1).'"></label>
                </div>

                <div hidden="" class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="service_0">Service <span class="text-danger fw-bold">*</span>
                    </label>
                    <input name="service" id="service_0" type="text" class="contact_input service_item" placeholder="Votre service" value="Votre service">
                    <label class="text-danger fw-bold" id="service_error_0"></label>
                </div>

                <div hidden="" class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="organisation_0">Organisation <span class="text-danger fw-bold">*</span>
                    </label>
                    <input name="organisation" id="organisation_0" type="text" class="contact_input organisation_item" placeholder="Votre organisation" value="Votre organisation">
                    <label class="text-danger fw-bold" id="organisation_error_0"></label>
                </div>

                <div hidden="" class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="matricule_organisation_0">Matricule Organisation <span class="text-danger fw-bold">*</span>
                    </label>
                    <input name="matricule_organisation" id="matricule_organisation_0" type="text" class="contact_input matricule_organisation_item" placeholder="Le matricule de votre organisation" value="Le matricule de votre organisation">
                    <label class="text-danger fw-bold" id="matricule_organisation_error_0"></label>
                </div>

                <div hidden="" class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="categorie_professionnelle_0">Numéro de pièces <span class="text-danger fw-bold">*</span>
                    </label>
                    <input name="categorie_professionnelle" id="categorie_professionnelle_0" type="text" class="contact_input categorie_professionnelle_item" placeholder="Votre catégorie professionnelle" value="Votre catégorie professionnelle">
                    <label class="text-danger fw-bold" id="categorie_professionnelle_error_0"></label>
                </div>

                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="civilite">Civilité</label>
                    <select name="civilite_e'.substr($type_adherent_id,4,1).'" id="civilite_e'.substr($type_adherent_id,4,1).'" class="contact_input civilite_item">
                        <option value="">Choisissez la civilité</option>';
                        foreach ($infoadherents[0]['civilite'] as $civilite) {
                            echo '<option value="'.$civilite['titre'].'">'.$civilite['titre'].'</option>';
                        }
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="civilite_error"></label>
                </div>

                <div class="col-lg-3 mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Date de naissance <span class="text-danger fw-bold">*</span>
                    </label>
                    <input name="date_naissance_e'.substr($type_adherent_id,4,1).'" min="2021-07-12" max="2002-07-12" id="datenaissance_e'.substr($type_adherent_id,4,1).'" onchange="verifier_date_naissance_beneficiaire()" type="date" class="contact_input date_naissance_item" placeholder="Date de naissance">
                    <label hidden="" class="text-danger fw-bold" id="datenaissance_error_0"></label>
                </div>

                <div class="col-lg-3 mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Lieu de naissance </label>
                    <input name="lieu_naissance_e'.substr($type_adherent_id,4,1).'" id="lieu_naissance_e'.substr($type_adherent_id,4,1).'" type="text" class="contact_input lieu_naissance_item" placeholder="Lieu de naissance">
                    <label class="text-danger fw-bold" id="lieu_naissance_error_e'.substr($type_adherent_id,4,1).'"></label>
                </div>

                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Contact <span class="text-danger fw-bold">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend d-flex align-items-stretch">
                            <button class="btn btn-outline-secondary d-flex align-items-center" type="button"><i class="material-icons" data-toggle="tooltip" title="ajouter">&#xe147;</i></button>
                        </div>
                        <input name="contact_e'.substr($type_adherent_id,4,1).'" id="contact_e'.substr($type_adherent_id,4,1).'" type="text" class="contact_input contact_item" placeholder="Contact" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <label class="text-danger fw-bold" id="contact_error_e'.substr($type_adherent_id,4,1).'"></label>
                </div>

                <div class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Email </label>
                    <input name="email_e'.substr($type_adherent_id,4,1).'" id="email_e'.substr($type_adherent_id,4,1).'" type="text" class="contact_input email_item" placeholder="Email">
                    <label class="text-danger fw-bold" id="email_error_e'.substr($type_adherent_id,4,1).'"></label>
                </div>

                <div class="col-lg-3 mb-3 contact_name_col mt-3" id="liens">
                    <label class="text-dark" for="exampleInputEmail1">Liens <span class="text-danger fw-bold">*</span>
                    </label>
                    <select name="lien_e'.substr($type_adherent_id,4,1).'" id="lien_e'.substr($type_adherent_id,4,1).'" class="contact_input lien_item" onchange="verifier_lien_beneficiaire()">
                        <option value="" disabled="" selected="">- Sélectionner une relation -</option>';
                        foreach ($infoadherents[2]['lien_parente'] as $lien_parente) {
                            echo '<option value="'.$lien_parente['lien'].'">'.$lien_parente['lien'].'</option>';
                        }
                        
                    echo'
                    </select>
                    <label hidden="" class="text-danger fw-bold" id="lien_error_e'.substr($type_adherent_id,4,1).'"></label>
                </div>
                <div hidden="" class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="resident">Est-il résident ?</label>
                    <select name="resident" id="resident_0" class="contact_input resident_item">
                        <option value="non">NON</option>
                        <option value="oui">OUI</option>
                    </select>
                    <label class="text-danger fw-bold" id="resident_error"></label>
                </div>
                <div hidden="" class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="type_agent">Type agent <span class="text-danger fw-bold">*</span>
                    </label>
                    <select name="type_agent" id="type_agent_0" class="contact_input type_agent_item">
                        <option value="ND">Non Défini - ND</option>
                    </select>
                    <label class="text-danger fw-bold" id="type_agent_error"></label>
                </div>
                <div hidden="" class="col-lg-3 contact_name_col mt-3">
                    <label class="text-dark" for="activation_sms">Activer les SMS ?</label>
                    <select name="activation_sms" id="activation_sms0" class="contact_input activation_sms_item">
                        <option value="non">NON</option>
                        <option value="oui">OUI</option>
                    </select>
                    <label class="text-danger fw-bold" id="activation_sms_error"></label>
                </div>'.
                zone_recurrente('pathologies').
            '</div>
            <button style="width: 100%" id="remove'.substr($type_adherent_id,4,1).'" class="btn btn-danger remove_field mt-4" onclick="removePersCharge(\''.$type_adherent_id.'\')">Retirer la personne à charge N°'.substr($type_adherent_id,4,1).'</button>
        </div>
        ';
    }
    
}
?>


<?php if (isset($_GET['eveques'])) ?>
    <?php $uniqueid=isset($_GET['uniqueid']) ? $_GET['uniqueid'] : null; ?>
     
        <div class="col-lg-12 m-auto">
            <div class="section_title text-center " hidden>
                <h2 style="color: #000000 !important">Offre santé</h2>
            </div>

            <form method="POST" action="" accept-charset="UTF-8" class="contact_form" id="form_souscrire_sante" '.zone_recurrente('verifierinput').' enctype="multipart/form-data">
                <input name="_token" type="hidden" value="'.$uniqueid.'">
                <div class="col-lg-12 offset-lg-4" id="micro" style="display: none;">
                <!-------indicateur etape------>
                <?php zone_recurrente('indicateur_etape')?>
                <!-------indicateur etape------>
                </div>
                
                <div id="step1" class="tabstep">
                    
                    <div class="col-lg-10 offset-lg-1">
                        <div class="section_title text-center"><h2></h2></div>
                        <div class="section_title text-center" hidden><h3 class="color-primary">TARIFS PRODUIT <span class="text-uppercase">"EVÊQUES"</span> </h3></div>
                    </div>

                    <section class="tabs">
                        <div hidden>
                            <input id="tab-1" style=" " type="radio" value="bronze" name="radio-set" class="tab-selector-1" checked="checked" />
                            <label for="tab-1" style=" cursor: default;" class="tab-label-1">Bronze</label>
                        </div>
                        <div class="content" style="min-height: fit-content !important;">
                            <div class="content-1">
                                <table class="table table-responsive-sm table-bordered table-sm " style="font-size: 17px" >
                                    <thead class="text-dark">
                                        <tr class="fw-bold text-white bg-dark" style="font-size: 18px">
                                            <th colspan="2">Tarifs</th>                                            
                                        </tr>
                                        <tr style="font-size: 17px">
                                            <th>Composition</th>
                                            <th>Prime TTC</th>                                                    
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark h6 bg-white" style="font-size: 17px">
                                    <tr >
                                        <td class="">Famille (Père + Mère + 3 Enfants)</td>
                                        
                                        <td class="w-44 color-primary">450 000 FCFA</td>
                                    </tr>
                                    
                                    <tr >
                                        <td class="">Adulte Supplementaire</td>
                                        
                                        <td class="color-primary">160 000 FCFA</td>
                                    </tr>

                                    <tr >
                                        <td class="">Enfant Supplementaire</td>
                                        
                                        <td class="color-primary">120 000 FCFA</td>
                                    </tr>

                                    </tbody>
                                </table>

                                <table class="table table-responsive-sm table-striped table-bordered table-sm mt-1" style="font-size: 15px" >
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th style="width: 440px;">Soins Ambulatoires et Hospitaliers</th>
                                            <th>Taux de remboursement</th>
                                            <th>Plafonds (en FCFA)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark" style="font-size: 16px">
                                        <tr>
                                            <td class="fw-bold ">CONSULTATION</td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Consultation Généraliste</td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Consultation Spécialiste</td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Frais pharmaceutiques &amp; Produits </td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Radiologie &amp; Imagerie </td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Explorations fonctionnelles</td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Analyses Biologiques</td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Frais de traitements préventifs (vaccins) selon le tarif de l&#039;INHP</td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">50 000</td>
                                        </tr>
                                        <tr>
                                            <td>Frais de traitements spécifiques anti retro-viraux</td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">50 000</td>
                                        </tr>
                                        <tr>
                                            <td>Auxiliaires médicaux et AMI</td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">50 000</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">DENTISTERIE Soins</td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Consultation et soins</td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Prothèses dentaires (y compris Orthodontie des enfants de moins 16 ans)</td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">80 000</td>
                                        </tr>
                                        <tr>
                                            <td>Autres prothèses (orthopédique, auditive etc..)</td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">80 000</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">HOSPITALISATION</td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Hébergement (y compris hébergement de la mère accompagnant un enfant de 7 ans)</td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">20 000 F CFA/Jour</td>
                                        </tr>
                                        <tr>
                                            <td>Frais de traitement médicaux &amp; chirurgicaux</td>
                                            <td rowspan="5" class="text-center align-middle">100%</td>
                                            <td rowspan="5" class="text-center align-middle" >150 0000 FCFA par hospitalisation dans les limites de deux(2) hospitalisations par an</td>
                                        </tr>
                                        <tr>
                                            <td>Visite Généraliste</td>
                                            <td hidden class="text-center align-middle">Forfait</td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Visite Spécialiste </td>
                                            <td hidden class="text-center align-middle">Forfait</td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Petite Chirurgie / Soins</td>
                                            <td hidden class="text-center align-middle">Forfait</td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>AMI</td>
                                            <td hidden class="text-center align-middle">Forfait</td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">MATERNITE</td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Frais pré &amp; post Natal avec 03 échographies maximum</td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Accouchement simple</td>
                                            <td rowspan="3" class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">150 000</td>
                                        </tr>
                                        <tr>
                                            <td>Accouchement Multiple</td>
                                            <td hidden class="text-center align-middle">Forfait</td>
                                            <td class="text-end align-middle">200 000</td>
                                        </tr>
                                        <tr>
                                            <td>Accouchement Chirurgical</td>
                                            <td hidden class="text-center align-middle">Forfait</td>
                                            <td class="text-end align-middle">300 000</td>
                                        </tr>
                                        <tr>
                                            <td>Versement forfaitaire sur présentation de l&#039;extrait d&#039;acte de naissance (accouchement hors hôpital)</td>
                                            <td class="text-center align-middle">Forfait</td>
                                            <td class="text-end align-middle">60 000</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">OPTIQUE</td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Verres et Montures sans les commodités (antireflets, photogray, etc,)</td>
                                            <td class="text-center align-middle">Forfait</td>
                                            <td class="text-center align-middle">60 000 tous les deux(2) an calendaire</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Dioptrie de + ou - 0,25</td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-end align-middle">exclus</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">TRANSPORT</td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Ambulance</td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">20 000</td>
                                        </tr>
                                
                                    </tbody>
                                </table>
                                
                                <table class="table table-responsive-sm table-bordered table-sm mt-1" style="font-size: 15px ;color: black" >
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th colspan="2" class="text-center align-middle">Plafond annuel</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        <tr>
                                            <td>Individuel </td>
                                            <td class=" w-44 color-primary">1 000 000 FCFA/pers</td>
                                        </tr>
                                        <tr hidden>
                                            <td>Enfant </td>
                                            <td class="color-primary">165 000 FCFA/enfant</td>
                                        </tr>
                                        <tr>
                                            <td>Famille </td>
                                            <td class="color-primary">2 500 000 FCFA/famille</td>
                                        </tr>
                                    </tbody>
                                    
                                </table>
                                
                                '.zone_recurrente("Définitiondestypesdecontrats2").'
                                
                                <br>
                                <h3 hidden class="text-danger">
                                    NB : les primes communiquées sont sous réserve d&#039;éventuelles surprimes pour risque aggravé après examen du bulletin d’adhésion.
                                </h3>
                            </div>                               
                        </div>
                    </section>                                    
                </div>

                <div id="step2" class="tabstep">
                    <div id="produitSelectionne" class="col-lg-10 offset-lg-1">
                        <div class="section_title text-center">
                            <h6 style="line-height: 2em;">
                                Les déclarations de bases de l&#039;adhérent constituent la base d&#039;un contrat maladie.
                                Par conséquent nous vous invitons à répondre aux questionnaires ci-dessous avec sincèrité et exactitude.
                            </h6> 
                        </div>
                        <div hidden style="font-size: 1.5em !important" class="text-center alert alert-info fw-bold">
                            MASSAYA <span id="produitSelectionne">EVEQUES</span> 90 %
                        </div>
                    </div>
        
                    <div class="row mt-5" id="contrat">

                    '.zone_recurrente('inputcodeapporteur').'

                        <div class="col-lg-12 contact_name_col">
                            <div class="row flex-nowrap mt-3">
                                <div class="col-lg-12 d-flex justify-content-between"> 
                                    <div>
                                        <label class="form-check-label text-dark mb-3" for="exampleRadios1">Type de contrat : </label>
                                    </div>                
                                    <div class="form-check">
                                        <input class="form-check-input opt_produit" type="radio" name="opt_produit" id="famille" value="famille" checked>
                                        <label class="form-check-label fw-bold text-dark" for="exampleRadios1">
                                            Contrat Famille
                                        </label>
                                    </div>
                                    <div class="form-check ml-5 d-none">
                                        <input class="form-check-input opt_produit" type="radio" name="opt_produit" id="Contrat_Individuel" value="individuel">
                                        <label class="form-check-label fw-bold text-dark" for="exampleRadios2">
                                            Contrat Individuel
                                        </label>
                                    </div>
                                    <label class="text-danger fw-bold" id="opt_error"></label>
                                </div>
                            </div>
                        </div>

                        <input id="taux"  name="taux" type="hidden" value="100" hidden />
                        <input id="typeMembre" name="typeMembre" type="hidden" value="Evêques" hidden />
                        
                        <div class="col-lg-12 contact_name_col mt-3" hidden>
                            <label class="text-dark" for="option_type_famille"> S\'agit-il d\'une entreprise ? <span class="text-danger fw-bold">*</span></label>
                            <select name="option_type_famille" id="option_type_famille" class="contact_input" onchange="info_souscripteur3()">
                                <option value="normal">NON </option>
                                <option value="entreprise">OUI</option>
                            </select>
                            <label class="text-danger fw-bold" id="option_type_famille_error"></label>
                        </div>

                        <div class="col-lg-4 contact_name_col mt-3 famille_entreprise" hidden>
                            <label class="text-dark" for="nombre_personnel">Nombre d\'employés <span class="text-danger fw-bold">*</span></label>
                            <input class="contact_input" id="nombre_personnel"  type="number" name="nombre_personnel" min="0" value="1" />
                        </div>

                        <div class="col-lg-4 contact_name_col mt-3 famille_entreprise" hidden>
                            <label class="text-dark" for="nombre_conjoint">Nombre de conjoints <span class="text-danger fw-bold">*</span></label>
                            <input class="contact_input" id="nombre_conjoint"  type="number" name="nombre_conjoint" min="0" value="0" />
                        </div>

                        <div class="col-lg-4 contact_name_col mt-3 famille_entreprise" hidden>
                            <label class="text-dark" for="nombre_enfant_entreprise">Nombre d\'enfants <span class="text-danger fw-bold">*</span></label>
                            <input class="contact_input" id="nombre_enfant_entreprise"  type="number" name="nombre_enfant_entreprise" min="0" value="0" />
                        </div>

                        <div class="col-lg-6 contact_name_col mt-3 famille_simple">
                            <label class="text-dark" for="nombre_adulte">Nombre d\'adultes <span class="text-danger fw-bold">*</span></label>
                            <input class="contact_input" id="nombre_adulte"  type="number" name="nombre_adulte" min="2" value="2"/>
                        </div>

                        <div class="col-lg-6 contact_name_col mt-3 famille_simple">
                            <label class="text-dark" for="nombre_enfant">Nombre d\'enfants <span class="text-danger fw-bold">*</span></label>
                            <input class="contact_input" id="nombre_enfant"  type="number" name="nombre_enfant" min="3" value="3" />
                        </div>

                        
                        
                        <div hidden class="nbfamille_groupe col-lg-6 contact_name_col mt-3">
                            <label class="text-dark" for="exampleInputEmail1">Nombre de famille/personne <span class="text-danger fw-bold">*</span></label>
                            <input contenteditable="true" disabled name="nbfamille" value="1" id="nbfamille" type="number" class="contact_input " placeholder="Nombre de famille/personne"  value="">
                            <label class="text-danger fw-bold" id="nbfamille_error"></label>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div hidden id="fam" class="section_title text-center"><h3>FAMILLE 01 </h3></div>
                    <?php zone_recurrente("zone_infosouscripteur")?>
                </div><?php zone_recurrente('recapdevis').zone_recurrente("zone_boutton")?>
            </form>                  
        </div>
    ';
