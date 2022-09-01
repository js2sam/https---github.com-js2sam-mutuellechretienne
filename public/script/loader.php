<?php
require_once('dbconnection.php');
include 'gfonctions.php';
//---------------------------------------------------------------
$code_uni=preg_replace('/\s+/', '', date("Ymd-His"));
//---------------------------------------------------------------
$json = file_get_contents("villes.json");
$villes = json_decode($json ,true);

$infoadherentjson = file_get_contents("infoadherent.json");
$infoadherents = json_decode($infoadherentjson ,true);

$messageuser="Bienvenue ".$_SESSION["civilite"]." ".$_SESSION["nom_user"]." ".ucfirst(strtolower($_SESSION["prenom_user"]))." ";


if (isset($_GET['eveques'])) {
    //$uniqueid=isset($_GET['uniqueid']) ? $_GET['uniqueid'] : null;
    # code...
    echo ' 
        <div class="col-lg-12 m-auto p-2">
            <div class="section_title text-center " hidden>
                <h2 style="color: #000000 !important">Offre santé</h2>
            </div>

            <form method="POST" action="" accept-charset="UTF-8" class="contact_form" id="form_souscrire_sante" '.zone_recurrente('verifierinput').' enctype="multipart/form-data">
                <input hidden name="_token" id="_token" type="text" value="'.$_SESSION["uniqueid"].'">
                <div class="col-lg-12 offset-lg-4" id="micro" style="display: none;">
                <!-------indicateur etape------>
                '.zone_recurrente('indicateur_etape').'
                <!-------indicateur etape------>
                </div>
                
                <div id="step1" class="tabstep">
                    
                    <div class="col-lg-10 mb-4">
                        <div class="section_title messageuser"><h3>'.$messageuser.'</h3></div>
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
                                        <tr class="fw-bold text-white bg-primary" style="font-size: 18px">
                                            <th colspan="3">Tarifs</th>                                            
                                        </tr>
                                        <tr style="font-size: 17px">
                                            <th>Composition</th>
                                            <th colspan="2">Cotisation TTC</th>                                                    
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark h6 bg-white" style="font-size: 17px">
                                    <tr >
                                        <td class="">Famille (Père + Mère + 3 Enfants)</td>
                                        
                                        <td colspan="2" class="color-primary text-end" style="width: 350px;">450 000 FCFA</td>
                                    </tr>
                                    
                                    <tr >
                                        <td class="">Adulte Supplémentaire</td>
                                        
                                        <td colspan="2" class="color-primary text-end">160 000 FCFA</td>
                                    </tr>

                                    <tr >
                                        <td class="">Enfant Supplémentaire</td>
                                        
                                        <td colspan="2" class="color-primary text-end">120 000 FCFA</td>
                                    </tr>

                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th style="width: 440px;">Soins ambulatoires et hospitaliers</th>
                                            <th style="width: 150px;" class="text-center">Remboursement</th>
                                            <th style="width: 150px;" class="text-center">Plafonds en FCFA</th>
                                        </tr>
                                    </thead>
                                        <tr>
                                            <td class="fw-bold text-white bg-secondary" colspan="3">CONSULTATION</td>
                                            <td hidden class="text-center align-middle"></td>
                                            <td hidden class="text-end align-middle"></td>
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
                                            <td>Frais pharmaceutiques et Produits </td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Radiologie et Imagerie </td>
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
                                            <td>Frais de traitements préventifs selon le tarif de l&#039;INHP</td>
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
                                            <td class="fw-bold text-white bg-secondary" colspan="3">DENTISTERIE</td>
                                            <td hidden class="text-center align-middle"></td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Consultation et soins</td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Prothèses dentaires</td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">80 000</td>
                                        </tr>
                                        <tr>
                                            <td>Autres prothèses </td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">80 000</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-white bg-secondary" colspan="3">HOSPITALISATION</td>
                                            <td hidden class="text-center align-middle"></td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Hébergement </td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle d-flex justify-content-end"><i hidden class="material-icons align-baseline" data-bs-toggle="tooltip" data-bs-placement="top" title="Montant pour un jour y compris hébergement de la mère accompagnant un enfant de 7 ans">&#xe88e;</i>20 000</td>
                                        </tr>
                                        <tr>
                                            <td>Frais de traitement médicaux et chirurgicaux</td>
                                            <td rowspan="5" class="text-center align-middle">100%</td>
                                            <td rowspan="5" class="text-end align-middle">
                                            <div class="align-middle d-flex justify-content-end align-items-stretch">
                                                <i hidden class="material-icons" data-bs-toggle="tooltip" data-bs-placement="top" title="Montant par hospitalisation dans les limites de deux hospitalisations par an">&#xe88e;</i>150 000 </td>
                                            </div>
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
                                            <td class="fw-bold text-white bg-secondary" colspan="3">MATERNITE</td>
                                            <td hidden class="text-center align-middle"></td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Frais pré et post Natal avec 03 échographies maximum</td>
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
                                            <td>Versement forfaitaire sur présentation de l&#039;extrait d&#039;acte de naissance </td>
                                            <td class="text-center align-middle">Forfait</td>
                                            <td class="text-end align-middle">60 000</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-white bg-secondary" colspan="3">OPTIQUE</td>
                                            <td hidden class="text-center align-middle"></td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Verres et Montures sans les commodités </td>
                                            <td class="text-center align-middle">Forfait</td>
                                            <td class="text-end align-middle d-flex justify-content-end">
                                                <i hidden class="material-icons align-baseline" data-bs-toggle="tooltip" data-bs-placement="top" title="Tous les deux ans calendaire">&#xe88e;</i>60 000</td>
                                        </tr>
                                        <tr>
                                            <td>Dioptrie de + ou - 0,25</td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-end align-middle">exclus</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-white bg-secondary" colspan="3">TRANSPORT</td>
                                            <td hidden class="text-center align-middle"></td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Ambulance</td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle">20 000</td>
                                        </tr>                                
                                
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th colspan="3" class="text-center align-middle">Plafond annuel</th>
                                        </tr>
                                    </thead>
                                        <tr>
                                            <td>Individuel </td>
                                            <td colspan="2" class="color-primary text-end" style="width: 350px;">1 000 000 FCFA</td>
                                        </tr>
                                        <tr hidden>
                                            <td>Enfant </td>
                                            <td colspan="2" class="color-primary">165 000 FCFA/enfant</td>
                                        </tr>
                                        <tr>
                                            <td>Famille </td>
                                            <td colspan="2" class="color-primary text-end">2 500 000 FCFA</td>
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
                    <div id="produitSelectionne" class="col-lg-12">
                        <div class="section_title text-center">
                            <h6 style="line-height: 1.5em;">
                                Les déclarations de l&#039;adhérent constituent la base d&#039;un contrat maladie.
                                <br>Nous vous invitons à répondre aux questionnaires ci-dessous avec sincèrité et exactitude.
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
                                        <label class="form-check-label fw-bold text-dark" for="famille">
                                            Contrat Famille
                                        </label>
                                    </div>
                                    <div class="form-check ml-5 d-none">
                                        <input class="form-check-input opt_produit" type="radio" name="opt_produit" id="Contrat_Individuel" value="individuel">
                                        <label class="form-check-label fw-bold text-dark" for="Contrat_Individuel">
                                            Contrat Individuel
                                        </label>
                                    </div>
                                    <label class="text-danger fw-bold" id="opt_error"></label>
                                </div>
                            </div>
                        </div>

                        <input id="taux"  name="taux" type="hidden" value="100" hidden />
                        <input id="typeMembre" name="typeMembre" type="hidden" value="Evêques" hidden />
                        
                        <!--
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

                        <div hidden class="nbfamille_groupe col-lg-6 contact_name_col mt-3">
                            <label class="text-dark" for="exampleInputEmail1">Nombre de famille/personne <span class="text-danger fw-bold">*</span></label>
                            <input contenteditable="true" disabled name="nbfamille" value="1" id="nbfamille" type="number" class="contact_input " placeholder="Nombre de famille/personne"  value="">
                            <label class="text-danger fw-bold" id="nbfamille_error"></label>
                        </div>
                        -->

                        <div class="col-lg-6 contact_name_col mt-3 famille_simple">
                            <label class="text-dark" for="nombre_adulte">Nombre d\'adultes <span class="text-danger fw-bold">*</span></label>
                            <input class="contact_input" id="nombre_adulte"  type="number" name="nombre_adulte" min="2" value="2"/>
                        </div>

                        <div class="col-lg-6 contact_name_col mt-3 famille_simple">
                            <label class="text-dark" for="nombre_enfant">Nombre d\'enfants <span class="text-danger fw-bold">*</span></label>
                            <input class="contact_input" id="nombre_enfant"  type="number" name="nombre_enfant" min="3" value="3" />
                        </div>

                        
                        
                    </div>
                    <br>
                    <hr>
                    <div hidden id="fam" class="section_title text-center"><h3>FAMILLE 01 </h3></div>'.
                    zone_recurrente("zone_infosouscripteur").'
                </div><div id="step3" class="tabstep">'.zone_recurrente('recapdevis').'</div>'.zone_recurrente("zone_boutton").'
            </form>                  
        </div>
    ';
}
if (isset($_GET['pasteursEtFideles'])) {
    //$uniqueid=isset($_GET['uniqueid']) ? $_GET['uniqueid'] : null;
    # code...
    echo '                 
        <div class="col-lg-12 m-auto p-2">
            <div class="section_title text-center " hidden>
                <h2 style="color: #000000 !important">Offre santé</h2>
            </div>

            <form method="POST" action="" accept-charset="UTF-8" class="contact_form" id="form_souscrire_sante" '.zone_recurrente('verifierinput').' enctype="multipart/form-data">
                <input hidden name="_token" id="_token" type="text" value="'.$_SESSION["uniqueid"].'">
                <div class="col-lg-12 offset-lg-4" id="micro" style="display: none;">
                <!-------indicateur etape------>
                '.zone_recurrente('indicateur_etape').'
                <!-------indicateur etape------>
                </div>
                
                <div id="step1" class="tabstep">
                    <div class="col-lg-10 mb-4">                                    
                        <div class="section_title">
                            <div class="section_title messageuser"><h3>'.$messageuser.'</h3></div>
                            <h3 class="color-primary" hidden>TARIFS PRODUIT <span class="text-uppercase">"PASTEURS, PRETRES ET FIDELES"</span> </h3>
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
                                        <tr class="fw-bold text-white bg-primary" style="font-size: 18px">
                                            <th colspan="3">Tarifs</th>
                                            
                                        </tr>
                                        <tr style="font-size: 17px">
                                            <th>Composition</th>
                                            <th colspan="2">Cotisation TTC</th>                                                    
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark h6 bg-white" style="font-size: 17px">
                                    <tr >
                                        <td class="">Famille (Père + Mère + 3 Enfants)</td>
                                        
                                        <td colspan="2" class="color-primary text-end">230 000 FCFA</td>
                                    </tr>                                                                                                       
                                    <tr >
                                        <td class="">Adulte Supplémentaire</td>
                                        
                                        <td colspan="2" class="color-primary text-end">98 000 FCFA</td>
                                    </tr>

                                    <tr >
                                        <td class="">Enfant Supplémentaire</td>
                                        
                                        <td colspan="2" class="color-primary text-end">73 500 FCFA</td>
                                    </tr>

                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th style="width: 440px;">Soins ambulatoires et hospitaliers</th>
                                            <th style="width: 150px;" class="text-center">Remboursement</th>
                                            <th style="width: 150px;" class="text-center">Plafonds en FCFA</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark" style="font-size: 16px">
                                        <tr>
                                            <td class="fw-bold text-white bg-secondary" colspan="3">CONSULTATION</td>
                                            <td hidden class="text-center align-middle"></td>
                                            <td hidden class="text-end align-middle"></td>
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
                                            <td>Frais pharmaceutiques et Produits </td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Radiologie et Imagerie </td>
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
                                            <td>Frais de traitements préventifs selon le tarif de l&#039;INHP</td>
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
                                            <td class="fw-bold text-white bg-secondary" colspan="3">DENTISTERIE</td>
                                            <td hidden class="text-center align-middle"></td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Consultation et soins</td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">100 000</td>
                                        </tr>
                                        <tr>
                                            <td>Prothèses dentaires</td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">80 000</td>
                                        </tr>
                                        <tr>
                                            <td>Autres prothèses</td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">80 000</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-white bg-secondary" colspan="3">HOSPITALISATION</td>
                                            <td hidden class="text-center align-middle"></td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Hébergement </td>
                                            <td class="text-center align-middle">100%</td>
                                            <td class="text-end align-middle d-flex justify-content-end"><i hidden class="material-icons align-baseline" data-bs-toggle="tooltip" data-bs-placement="top" title="Montant pour un jour y compris hébergement de la mère accompagnant un enfant de 7 ans">&#xe88e;</i>20 000</td>
                                        </tr>
                                        <tr>
                                            <td>Frais de traitement médicaux et chirurgicaux</td>
                                            <td rowspan="5" class="text-center align-middle">100%</td>
                                            <td rowspan="5" class="text-end align-middle">
                                            <div class="align-middle d-flex justify-content-end align-items-stretch">
                                                <i hidden class="material-icons" data-bs-toggle="tooltip" data-bs-placement="top" title="Montant par hospitalisation dans les limites de deux hospitalisations par an">&#xe88e;</i>150 000 </td>
                                            </div>
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
                                            <td class="fw-bold text-white bg-secondary" colspan="3">MATERNITE</td>
                                            <td hidden class="text-center align-middle"></td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Frais pré et post Natal avec 03 échographies maximum</td>
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
                                            <td>Versement forfaitaire sur présentation de l&#039;extrait d&#039;acte de naissance </td>
                                            <td class="text-center align-middle">Forfait</td>
                                            <td class="text-end align-middle">60 000</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-white bg-secondary" colspan="3">OPTIQUE</td>
                                            <td hidden class="text-center align-middle"></td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Verres et Montures sans les commodités </td>
                                            <td class="text-center align-middle">Forfait</td>
                                            <td class="text-end align-middle d-flex justify-content-end">
                                                <i hidden class="material-icons align-baseline" data-bs-toggle="tooltip" data-bs-placement="top" title="Tous les deux ans calendaire">&#xe88e;</i>60 000</td>
                                        </tr>
                                        <tr>
                                            <td>Dioptrie de + ou - 0,25</td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-end align-middle">exclus</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-white bg-secondary" colspan="3">TRANSPORT</td>
                                            <td hidden class="text-center align-middle"></td>
                                            <td hidden class="text-end align-middle"></td>
                                        </tr>
                                        <tr>
                                            <td>Ambulance</td>
                                            <td class="text-center align-middle">80%</td>
                                            <td class="text-end align-middle">20 000</td>
                                        </tr>
                                    
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th colspan="3" class="text-center align-middle">Plafond annuel</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                    <tr>
                                        <td>Individuel </td>
                                        <td colspan="2" class="color-primary text-end" style="width: 350px;">1 000 000 FCFA</td>
                                    </tr>
                                    <tr hidden>
                                        <td>Enfant </td>
                                        <td colspan="2" class="color-primary">165 000 FCFA/enfant</td>
                                    </tr>
                                    <tr>
                                        <td>Famille </td>
                                        <td colspan="2" class="color-primary text-end">2 500 000 FCFA</td>
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
                    <div id="produitSelectionne" class="col-lg-12">
                        <div class="section_title text-center">
                            <h6 style="line-height: 1.5em;">
                                Les déclarations de l&#039;adhérent constituent la base d&#039;un contrat maladie.
                                <br>Nous vous invitons à répondre aux questionnaires ci-dessous avec sincèrité et exactitude.
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
                                <div class="col-lg-12 d-flex flex-column flex-lg-row"> 
                                    <div class="col-sm-12 col-lg-4">
                                        <label class="form-check-label text-dark mb-3" for="exampleRadios1">Type de contrat : </label>
                                    </div>                
                                    <div class="form-check col-sm-12 col-lg-4">
                                        <input class="form-check-input opt_produit" type="radio" name="opt_produit" id="famille" value="famille">
                                        <label class="form-check-label fw-bold text-dark" for="famille">
                                            Contrat Famille
                                        </label>
                                    </div>
                                    <div class="form-check col-sm-12 col-lg-4 ml-5">
                                        <input class="form-check-input opt_produit" type="radio" name="opt_produit" id="Contrat_Individuel" value="individuel" checked>
                                        <label class="form-check-label fw-bold text-dark" for="Contrat_Individuel">
                                            Contrat Individuel
                                        </label>
                                    </div>
                                    <label class="text-danger fw-bold" id="opt_error"></label>
                                </div>
                            </div>
                        </div>

                        <input id="taux"  name="taux" type="hidden" value="80" hidden />
                        <input id="typeMembre" name="typeMembre" type="hidden" value="pasteursEtFideles" hidden />
                        
                        <!-- 
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

                        <div hidden class="nbfamille_groupe col-lg-6 contact_name_col mt-3">
                            <label class="text-dark" for="exampleInputEmail1">Nombre de famille/personne <span class="text-danger fw-bold">*</span></label>
                            <input contenteditable="true" disabled name="nbfamille" value="1" id="nbfamille" type="number" class="contact_input " placeholder="Nombre de famille/personne">
                            <label class="text-danger fw-bold" id="nbfamille_error"></label>
                        </div>

                        -->

                        
                        <div class="col-lg-6 contact_name_col mt-3 famille_simple" hidden>
                            <label class="text-dark" for="nombre_enfant">Nombre d\'enfants <span class="text-danger fw-bold">*</span></label>
                            <input class="contact_input" id="nombre_enfant"  type="number" name="nombre_enfant" min="3" value="3" />
                        </div>

                        <div class="col-lg-6 contact_name_col mt-3 famille_simple" hidden>
                            <label class="text-dark" for="nombre_adulte">Nombre d\'adultes <span class="text-danger fw-bold">*</span></label>
                            <input class="contact_input" id="nombre_adulte"  type="number" name="nombre_adulte" min="2" value="2" />
                        </div>
                        
                        
                    </div>
                    <br>
                    <hr>
                    <div hidden id="fam" class="section_title text-center"><h3>FAMILLE 01 </h3></div>'.
                    zone_recurrente("zone_infosouscripteur").'
                </div><div id="step3" class="tabstep">'.zone_recurrente('recapdevis').'</div>'.zone_recurrente("zone_boutton").'                             
            </form>
        </div>            
    ';
    
}
if (isset($_GET['info_assurer'])) {
    $nom=isset($_GET['nom']) ? $_GET['nom'] : null;
    $disabled=isset($_GET['nom']) ? "disabled" : "";
    $hidden=isset($_GET['nom']) ? "hidden" : "";
    $prenom=isset($_GET['prenom']) ? $_GET['prenom'] : null;
    $contact=isset($_GET['contact']) ? $_GET['contact'] : null;
    $email=isset($_GET['email']) ? $_GET['email'] : null;
    $typecontrat=isset($_GET['typecontrat']) ? $_GET['typecontrat'] : null;
    $masquetypecontrat = ($typecontrat=="normal") ? "hidden" : "" ;
    
    //affectation du sexe de l'adherent
    $selected1=$selected2=$no=" ";
    $na="";
    $naClassConctact="";
    if($nom){
        $no=2;
        $na=' ';
        $naClassConctact="second_contact";
        if ($_SESSION["civilite"]=="Monsieur") {
            # code...
            $selected1="selected";
        } else {
            # code...
            $selected2="selected";
        } 
    }
    else{
        $no=1;        
    };    
    echo'
    <div class="section_title text-center"><h3>ADHERENT PRINCIPAL</h3></div>
        <div id="adfil0">
            <div class="row mt-3">
                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Nom <span class="text-danger fw-bold">*</span></label>
                    <input contenteditable="true" name="nom" id="nom" type="text" class="contact_input nom_item toupper" '.$disabled.' placeholder="Nom" value="'.strtoupper($nom).'" >
                    
                </div>
                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Prénoms <span class="text-danger fw-bold">*</span></label>
                    <input name="prenom" id="prenom" type="text" class="contact_input prenom_item toupper" '.$disabled.' placeholder="Prenom(s)" value="'.strtoupper($prenom).'" >
                    
                </div>

                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Sexe <span class="text-danger fw-bold">*</span></label>
                    <select name="sexe" id="sexe" class="contact_input sexe_item" '.$disabled.'>
                        <option value="">Choisir Votre sexe </option>
                        <option value="M" '.$selected1.'>Homme (Masculin)</option>
                        <option value="F" '.$selected2.'>Femme (Feminin)</option>
                    </select>
                    
                </div>
                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Numéro CMU </label>
                    <input name="numero_cmu" id="numero_cmu" type="text" class="contact_input numero_cmu" placeholder="saisir le numéro CMU" value=" ">
                    
                </div>

                <div class="col-lg-4 contact_name_col mt-3 contactadulte'.$no.'">
                    <label class="text-dark labelcontacttest" for="exampleInputEmail1">Numéro portable '.$no.' <span '.$hidden.' class="text-danger fw-bold">*</span></label>
                    <div class="input-group mb-3">  
                        <input name="contact'.$no.'" id="contact'.$no.'" type="text" class="contact_input contact_item '.$naClassConctact.'" placeholder="Contact" aria-label="" aria-describedby="basic-addon1" style="width: 86%;" value="'.$na.'" autocomplete="off">
                        <i class="btn text-primary align-self-center border border-0 p-0 btnNumberAdd material-icons align-middle fs-2" data-nberzone="contactadulte'.$no.'" data-bs-toggle="tooltip" data-bs-placement="top" title="ajouter un autre numero" >&#xe146;</i>                  
                    </div>
                    <label class="text-danger fw-bold" id="contact_error"></label>
                </div>


                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Email <span class="text-danger fw-bold">*</span></label>
                    <input name="email" id="email" type="text" class="contact_input email_item" placeholder="Email" value="'.$email.'" '.$disabled.'>
                    <label class="text-danger fw-bold" id="email_error"></label>
                </div>
            
                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="profession">Secteur d&#39;activit&#233; <span class="text-danger fw-bold">*</span></label>
                    <select name="profession" id="profession" class="contact_input profession_item" onchange="addprofession(\'profession\',\'categorie_professionnelle\')">
                        <option value="">Choisissez le secteur</option>';
                        foreach ($infoadherents[4]['activites'] as $activites) {
                            echo '<option value="'.$activites['activite'].'">'.$activites['activite'].'</option>';
                        }                        
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="profession_error"></label>
                </div>
            
                <div hidden class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="service">Service</label>
                    <input name="service" id="service" type="text" class="contact_input service_item" placeholder="Votre service" value="Votre service" >
                    <label class="text-danger fw-bold" id="service_error"></label>
                </div>

                <div hidden class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="organisation">Nom Entreprise <span class="text-danger fw-bold">*</span></label>
                    <input name="organisation" id="organisation" type="text" class="contact_input organisation_item" placeholder="Votre organisation" value=" ">
                    <label class="text-danger fw-bold" id="organisation_error"></label>
                </div>

                
                <div hidden class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="matricule_organisation">Matricule Organisation</label>
                    <input name="matricule_organisation" id="matricule_organisation" type="text" class="contact_input matricule_organisation_item" placeholder="Le matricule de votre organisation" value="Le matricule de votre organisation">
                    <label class="text-danger fw-bold" id="matricule_organisation_error"></label>
                </div>

                
                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="categorie_professionnelle">Catégorie professionnelle <span class="text-danger fw-bold">*</span></label>
                    <select name="categorie_professionnelle" id="categorie_professionnelle" class="contact_input categorie_professionnelle_item">
                        <option value="">Choisissez la Catégorie</option>';
                        foreach ($infoadherents[5]['categorie_professionnelles'] as $categorie_professionnelles) {
                            echo '<option value="'.$categorie_professionnelles['categorie'].'" class="'.$categorie_professionnelles['categorie2'].'">'.$categorie_professionnelles['categorie'].'</option>';
                        }                        
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="categorie_professionnelle_error"></label>
                </div>
                
                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="situation_M">Situation matrimoniale <span class="text-danger fw-bold">*</span></label>
                    <select name="situation_M" id="situation_M" class="contact_input civilite_item">
                        <option value="">Choisissez la situation</option>';
                        foreach ($infoadherents[0]['civilite'] as $civilite) {
                            echo '<option value="'.$civilite['titre'].'">'.$civilite['titre'].'</option>';
                        }                        
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="civilite_error"></label>
                </div>

                <div class="col-lg-4 contact_name_col mt-3" hidden>
                    <label class="text-dark" for="exampleInputEmail1">Taille <span class="text-danger fw-bold">*</span></label>
                    <input name="taille" id="taille" type="text" class="contact_input taille_item" placeholder="1m10" value="NA">
                    <label class="text-danger fw-bold" id="Taille_assure_error"></label>
                </div>
                <!--
                <div class="col-lg-4 contact_name_col mt-3" hidden>
                    <label class="text-dark" for="exampleInputEmail1">Poids (en KG)<span class="text-danger fw-bold">*</span></label>
                    <input name="poids_assure" id="poids" type="text" class="contact_input poids_item" placeholder="50" value="NA">
                    <label class="text-danger fw-bold" id="poids_error"></label>
                </div>
                -->
                <div class="col-lg-4 contact_name_col mt-3" hidden>
                    <label class="text-dark" for="exampleInputEmail1">Tension artérielle <span class="text-danger fw-bold">*</span></label>
                    <input name="tension_arterielle" id="tension_arterielle" type="text" class="contact_input tension_arterielle_item" placeholder="120mm/80mm" value="NA">
                    <label class="text-danger fw-bold" id="tension_arterielle_error"></label>
                </div>

                <div class="col-lg-4 contact_name_col mt-3" hidden>
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
                                        
                <div class="col-lg-4 contact_name_col mt-3">
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

            
                <div hidden class="col-lg-4 contact_name_col mt-3 saisir_autre_piece">
                    <label class="text-dark" for="saisir_autre_piece">Indiquez le nom de la pièce <span class="text-danger fw-bold">*</span></label>
                    <input name="saisir_autre_piece" id="saisir_autre_piece" type="text" class="contact_input saisir_autre_piece_item" placeholder="Saisir le nom de la pièce" value="Saisir le nom de la pièce">
                    <label class="text-danger fw-bold" id="saisir_autre_piece_error"></label>
                </div>
                
                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="numero_piece">Numéro de pièce <span class="text-danger fw-bold">*</span></label>
                    <input name="numero_piece" id="numero_piece" type="text" class="contact_input numero_piece_item" placeholder="Saisir le numéro de pièce" >
                    <label class="text-danger fw-bold" id="numero_piece_error"></label>
                </div>

                
                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Date de naissance <span class="text-danger fw-bold">*</span></label>
                    <input name="date_naissance" id="date_naissance" type="date" class="contact_input date_naissance_item adulte_date" placeholder="Date de naissance">
                    
                </div>

                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Lieu de naissance <span class="text-danger fw-bold">*</span></label>
                    <select name="lieu_naissance" id="lieu_naissance" class="contact_input lieu_naissance_item">
                        <option value="">Choix lieu de naissance</option>
                        <option value="A">Hors du pays</option>';
                        foreach ($villes as $ville) {
                            echo '<option value="'.ucfirst($ville['ville'][0]['nom']).'">'.ucfirst($ville['ville'][0]['nom']).'</option>';
                        }
                        
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="lieu_naissance_error"></label>
                </div>
                
                <input name="lien" id="lien" value="Adh&#233;rent principal" type="text" class="contact_input lien_item" value="lien" hidden>
                
                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Ville de résidence <span class="text-danger fw-bold">*</span></label>
                    <select name="ville" id="ville" class="contact_input ville_item">
                        <option value="">Choix ville</option>';
                        foreach ($villes as $ville) {
                            echo '<option value="'.ucfirst($ville['ville'][0]['nom']).'">'.ucfirst($ville['ville'][0]['nom']).'</option>';
                        }
                        
                    echo'
                    </select>
                    
                </div>
                <div hidden class="col-lg-4 contact_name_col mt-3" id="choix_commune">
                    <label class="text-dark" for="exampleInputEmail1">Commune <span class="text-danger fw-bold">*</span></label>
                    <select name="commune" id="commune" class="contact_input commune_item">
                        <option value="na">Choix commune</option>
                        
                    </select>
                    <label class="text-danger fw-bold" id="commune_error"></label>
                </div>

                <div hidden class="col-lg-4 contact_name_col mt-3" id="saisie_commune">
                    <label class="text-dark" for="exampleInputEmail1">Commune (A saisir) <span class="text-danger fw-bold">*</span></label>
                    <input name="commune_scd" id="commune_scd" type="text" class="contact_input" placeholder="Saisir votre commune" value=" ">
                    <label class="text-danger fw-bold" id="commune_scd_error"></label>
                </div>

                <!--<div class="col-lg-4 contact_name_col mt-3" id="choix_quartier">
                    <label class="text-dark" for="exampleInputEmail1">Quartier </label>
                    <select name="quartier" id="quartier" class="contact_input">
                        <option value="NA">Choix quartier</option>
                    </select>
                    <label class="text-danger fw-bold" id="quartier_error"></label>
                </div>

                <div hidden class="col-lg-4 contact_name_col mt-3" id="saisie_quartier">
                    <label class="text-dark" for="exampleInputEmail1">Quartier <span class="text-danger fw-bold">*</span></label>
                    <input name="quartier_scd" id="quartier_scd" type="text" class="contact_input" placeholder="Saisir votre quartier" value="Saisir votre quartier">
                    <label class="text-danger fw-bold" id="quartier_scd_error"></label>
                </div>-->
               
                <div hidden class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="resident">Est-il résident ? </label>
                    <select name="resident" id="resident" class="contact_input resident_item">
                        <option value="non">NON</option>
                        <option value="oui">OUI</option>
                    </select>
                    <label class="text-danger fw-bold" id="resident_error"></label>
                </div>
                        
                <div hidden class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="type_agent">Type agent <span class="text-danger fw-bold">*</span></label>
                    <select name="type_agent" id="type_agent" class="contact_input type_agent_item">
                        <option value="ND">Non Défini - ND</option>
                    </select>
                    <label class="text-danger fw-bold" id="type_agent_error"></label>
                </div>

                
                <div hidden class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="activation_sms">Activer les SMS ?</label>
                    <select name="activation_sms" id="activation_sms" class="contact_input activation_sms_item">
                        <option value="non">NON</option>
                        <option value="oui">OUI</option>
                    </select>
                    <label class="text-danger fw-bold" id="activation_sms_error"></label>
                </div>

            
                <div hidden class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="site_web">Site Web </label>
                    <input name="site_web" id="site_web" type="text" class="contact_input site_web_item" placeholder="Indiquez votre site web" value="Indiquez votre site web">
                    <label class="text-danger fw-bold" id="site_web_error"></label>
                </div>
      
                <div hidden class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="adresse_postale">Adresse postale <span class="text-danger fw-bold">*</span></label>
                    <input name="adresse_postale" id="adresse_postale" type="text" class="contact_input adresse_postale_item" placeholder="Indiquez votre adresse postale" value="Indiquez votre adresse postale">
                    <label class="text-danger fw-bold" id="adresse_postale_error"></label>
                </div>'.
                zone_recurrente2('pathologies','_adh_principal').
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

                <form method="POST" action="" accept-charset="UTF-8" class="contact_form" id="form_sant"><input name="_token" type="hidden" value="'.$_SESSION["uniqueid"].'">

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
    $montantAcotiser= isset($_GET['partCotisation']) ? $_GET['partCotisation'] : $_SESSION["partCotisation"];
    $changementMethode=isset($_GET['changementMethode']) ? $_GET['changementMethode'] : null;
    
    //affichage des bouttons de selection de la methode de payement
    $affichBouton="d-none";
    

    if ($changementMethode=="true") {
        # code...
         $affichBouton="";
    }
    
    # code...
    echo '
        <div class="row">
            <div class="col">
                <div class="row justify-content-center">
                    <div class="col-lg-10 mt-3">                            
                        <div hidden="" class="text-center text-dark h6 mt-5">
                            Afin de pouvoir effectuer le paiement, nous vous invitons à remplir ce formulaire, en vue d&#039;avoir les informations neccessaires sur l&#039;adhérent pour valider le processus.
                        </div>
                        <div class="section_title text-center mt-5">
                            <h2>Procédez au paiement de votre cotisation</h2>
                        </div>            
                    </div>        
                </div>
                <div class="row justify-content-center my-3 '.$affichBouton.'">
                    <!-- message informatif -->
                    <div class="text-center text-dark fw-bold mt-3" style="font-size: 20px">
                        Comment voulez-vous payer ?
                    </div>
                </div>
                <!-- mode de payement fractionner -->
                <div class="row justify-content-around text-start '.$affichBouton.'">
                    <div class="row flex btn-group btn-group-toggle justify-content-center" data-toggle="buttons">
                        <div class="col-lg-3 option_pasteur_fidele p-2">
                            <label class="btn w-100 bg-color-primary text-start text-white text-sm ml-1" for="journalier3">
                                <input type="radio" id="journalier3" class="methodePaiement" data-dividenumber="365" data-name="par jour" value="journalier" name="methodePaiement3" autocomplete="off"/>
                                Par jour
                            </label>
                        </div>
                        <div class="col-lg-3 option_pasteur_fidele p-2">
                            <label class="btn w-100 bg-color-primary text-start text-white ml-1 text-sm" for="hebdomadaire3">
                                <input type="radio" id="hebdomadaire3" class="methodePaiement" data-dividenumber="52" data-name="par semaine" value="hebdomadaire" name="methodePaiement3" autocomplete="off"/>
                                Par semaine
                            </label>
                        </div>
                        <div class="col-lg-3 option_eveques option_pasteur_fidele p-2">
                            <label class="btn w-100 bg-color-primary text-start text-white ml-1 text-sm" for="mensuel3">
                                <input type="radio" id="mensuel3" class="methodePaiement" data-dividenumber="12" data-name="par mois" value="mensuel" name="methodePaiement3" autocomplete="off"/>
                                Par mois
                            </label>
                        </div>
                        <div class="col-lg-3 option_eveques option_pasteur_fidele p-2">
                            <label class="btn w-100 bg-color-primary text-start text-white ml-1 text-sm" for="annuelle3">
                                <input type="radio" id="annuelle3" class="methodePaiement" data-dividenumber="1" data-name="Intégral" value="annuelle" name="methodePaiement3" autocomplete="off"/>
                                Par an
                            </label>          
                        </div>
                    </div>
                </div>

                <!-- explication du fractionnement -->
                <div id="calendriertext1" class="mt-4 mx-auto w-85">
                
                </div>
                <div class="row justify-content-center pt-3">
                    <table class="col-lg-6 table2 table-sm table-bordered2">
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
                                <th scope="row" class="d-none">1er Paiement</th>
                                <td class="MontantCotisationZone">
                                    <input id="MontantCotisationZone" class="form-control text-center border-0" name="MontantCotisationZone" type="text" value="'.number_format(round($montantAcotiser,0),0,""," ").' FCFA" readonly/>
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
                <!-- modele echeancier 
                    <div class="accordion w-85 m-auto mt-3" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Voir la suite de l&#039;echeancier
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
                    </div>-->
                                                      
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
                    <div class="col d-flex flex-column mx-auto justify-content-center d-none">
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
                    <div class="col d-flex flex-column mx-auto justify-content-center d-none">
                        <label for="paiement_bancaire" class="text-center">
                            <img src="img/paiement-virement-bancaire.jpg"
                        style="height: 100px; width: 100px" class="rounded mb-2" alt="..." />
                        </label>
                        <input id="paiement_bancaire" class="form-radio-input mx-auto" type="radio" name="operateur" value="virement"/>
                    </div>
                </div>
                <div class="row justify-content-md-center" hidden>
                    <input id="isPremierPaiement" class="form-control" name="isPremierPaiement" type="number" value="'.($_SESSION["isPremierPaiement"]==true ? "10000":"0").'" hidden readonly/>
                    <input id="MontantCotisationZone0" class="form-control" name="MontantCotisationZone0" type="number" value="'.$_SESSION["montantCotisationRestant"].'" readonly/>
                    <div id="primevalue2">'.$_SESSION["montantCotisationRestant"].'</div>
                    <button type="button" class="btn bg-color-primary text-white" onclick="GenerateurPaiment(1)">Payer ma cotisation
                    </button>
                </div>
            </div>
            </div>
        </div>
    ';   
}
if (isset($_GET['suitePaie'])) {

    # code...
    $sql = "SELECT * FROM souscription WHERE uniqueid='".$_SESSION["uniqueid"]."' ORDER BY souscription.date_souscription DESC ";
    $result = mysqli_query($db, $sql);

    $sql2 = "SELECT * FROM souscripteur WHERE uniqueid='".$_SESSION["uniqueid"]."'";
    $result2 = mysqli_query($db, $sql2);
    $info = mysqli_fetch_assoc($result2);

    $sql3 = "SELECT sum(valeur_prime) FROM souscription WHERE uniqueid='".$_SESSION["uniqueid"]."'";
    $result3 = mysqli_query($db, $sql3);
    $info2 = mysqli_fetch_assoc($result3);


    $infoValeurPrime=isset($info['valeur_prime']) ? $info['valeur_prime'] : "0";
    $sommeValeurPrime=isset($info2['sum(valeur_prime)']) ? $info2['sum(valeur_prime)'] : "0";

    $montantCotisationRestant=intval($infoValeurPrime)-intval($sommeValeurPrime);
    $datarow='';
    $datapart=$datapart1='';
    $solde_type="";


    //transfert du montant restant à payer
    $_SESSION["montantCotisationRestant"]=$montantCotisationRestant;
    $_SESSION["montantCotisation"]=$infoValeurPrime;
    $_SESSION["partCotisation"]=isset($info['cotisation_part']) ? $info['cotisation_part'] : "0";

    //print_r(mysqli_num_rows($result));
    
    //nombre de paiement deja en base
    $nbrPaiementEnBase=mysqli_num_rows($result);

    if (mysqli_num_rows($result) > 0) {    
        // sortie des données pour chaques ligne
        $cpt=0;
        while($row = mysqli_fetch_assoc($result)) {
        $cpt++;            
        if ($row['payment_statut']=="SUCCESS") {
            # code...
            $datapart= '
            <div class="table-data-feature">
                <i class="material-icons text-secondary" data-bs-toggle="tooltip" title="reussi">&#xe86c;</i>
            </div>
            ';
            $datapart1='Payé';
        } else {
            # code...
            $datapart= '
            <div class="table-data-feature">
                <i class="material-icons text-danger" data-bs-toggle="tooltip" title="echec">&#xe5c9;</i>
            </div>
            ';
            $datapart1='A payé';
        }
        $datarow.='<tr class="tr-shadow">                            
                                <td>'.firstupper($row['solde_type']).'</td>
                                <td>
                                    <span class="block-email">'.$row['numero_telephone'].'</span>
                                </td>
                                <td class="desc">Paiement N° '.$cpt.'</td>
                                <td>'.date('d-m-Y', strtotime($row['date_creation'])).'</td>
                                <td>
                                    <span class="status--process">'.$datapart1.'</span>
                                </td>
                                <td class="text-end">'.number_format(round($row['valeur_prime'],0),0,""," ").' FCFA</td>
                                <td>'.$datapart.'</td>
                            </tr>                        
                            ';
        //recuperation du dernier paiement <tr class="spacer"></tr>
        if ($solde_type!==firstupper($row['solde_type'])) {
            # code...
            $solde_type=firstupper($row['solde_type']);
            $changementMethode=1;
        } else {
            # code...
            $solde_type=firstupper($row['solde_type']);
        }
        
        
        } 
    } 
    else {
    $datarow= '<tr class="tr-shadow"><td colspan="7" class="text-center"><span class="aucun_retour" style="color: #be1d2e;" >Vous n\'avez pas encore effectué de paiement. Prière procéder à un premier versement.<span> </br> <button type="button" class="btn bg-secondary text-white rounded" data-bs-toggle="modal" data-bs-target="#PaiemmentModal" data-bs-backdrop="static" id="EffectuerPaieBtn" data-methode="'.$solde_type.'">Effectuer un paiement</button></td></tr>';
        }

    if (isset($info['cotisation_part'])) {
        # code...
        //recuperation du reste des paiements echeancer data from json
        $data = file_get_contents('../echeanciers/'.$_SESSION['uniqueid'].'-'.$solde_type.'.json');
        //decode into php array
        $data= json_decode($data);
    
        for ($i=$nbrPaiementEnBase; $i < count($data) ; $i++) { 
            # code...
            if ($i==$nbrPaiementEnBase) {
                # code...
                $icone= '<a href="#" class="text-secondary" data-bs-toggle="modal" data-bs-target="#PaiemmentModal" data-bs-backdrop="static" data-montant="'.preg_replace("/[^0-9]/", "", strval($data[$i]->Cotisation)).'"  data-methode="'.$solde_type.'" id="EffectuerPaieBtn"><i class="material-icons" data-bs-toggle="tooltip" title="paye" >&#xe850;</i></a>';
            } else {
                # code...
                $icone= '<i class="material-icons text-danger" data-bs-toggle="tooltip" title="echec">&#xe5c9;</i>';
            }
            $datarow.='<tr class="tr-shadow">                            
                                    <td>'.firstupper($solde_type).'</td>
                                    <td>
                                        <span class="block-email">'.$info['numero_telephone'].'</span>
                                    </td>
                                    <td class="desc">'.$data[$i]->Période.'</td>
                                    <td>'.date('d-m-Y', strtotime($data[$i]->Date)).'</td>
                                    <td>
                                        <span class="status--process">A payé</span>
                                    </td>
                                    <td class="text-end">'.number_format(round(preg_replace("/[^0-9]/", "", strval($data[$i]->Cotisation)),0),0,""," ").' FCFA</td>
                                    <td><div class="table-data-feature">'.$icone.'</div>
                                    </td>
                                </tr>';
        }
    }

    echo'

    <div class="row p-2">
        <div class="ps-4">
            <h3 class="fw-bold">Suivi de vos paiements</h3>

            <!-- DATA TABLE -->
            <div class="row py-3 justify-content-between">
                <div class="col-lg-6 ml-3">
                    <table class="table table-sm table-bordered bg-white">
                        <thead>
                        <tr>
                            <th scope="col" colspan="3">Informations Adhérent</th>                        
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">Nom :</th>
                            <td colspan="2">'.$_SESSION["nom_user"].'</td>
                                                    
                        </tr>
                        <tr>
                            <th scope="row">Prénoms :</th>
                            <td colspan="2">'.$_SESSION["prenom_user"].'</td>                        
                        </tr>                        
                        <tr>
                            <th scope="row">Cotisation :</th>
                            <td>'.$solde_type.'</td>
                            <td><div class="form-check form-switch"><input class="form-check-input " type="checkbox" role="switch" id="flexSwitchCheckDefault" value="oui"><label class="form-check-label" for="flexSwitchCheckDefault">Changer</label></div></td>                        
                        </tr>                        
                        </tbody>                   
                    </table>
                </div>
                <div class="col-lg-6">
                    <button type="button" class="btn btn-warning rounded d-none" onclick="window.location.reload();">Se deconnecter</button>
                    <table class="table table-sm table-bordered bg-white">
                        <thead>
                        <tr>
                            <th scope="col" colspan="3">Informations Cotisation</th>                        
                        </tr>
                        </thead>
                        <tbody>                        
                        <tr>
                            <th scope="row">Cotisation totale</th>
                            <td colspan="2" class="text-end">'.number_format(round($infoValeurPrime,0),0,""," ").' FCFA</td>                        
                        </tr>
                        <tr>
                            <th scope="row">Cotisation soldée</th>
                            <td colspan="2" class="text-end">'.number_format(round($sommeValeurPrime,0),0,""," ").' FCFA</td>                        
                        </tr>
                        <tr>
                            <th scope="row">Cotisation restante</th>
                            <td colspan="2" class="text-end">'.number_format(round($montantCotisationRestant,0),0,""," ").' FCFA</td>                        
                        </tr>
                        </tbody>                   
                    </table>
                </div>
            </div>            
            <div class="table-data__tool d-flex flex-column mb-4">
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
				<div class="table-data__tool-right d-flex justify-content-end mb-2">                    
                    <div class="rs-select2--dark rs-select2--dark2">
						<button type="button" class="btn bg-primary text-white rounded" id="GestionContratBtn">Gerer mon contrat</button>
						
						<button type="button" class="btn bg-primary text-white rounded d-none" id="GestionPaieBtn">Gere mon plan financier</button>
						
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>
            </div>
            <div class="table-responsive table-responsive-data2">
                <table id="myTable2" class="table w-100 table-data2">
                    <thead>
                        <tr>                            
                            <th>Type</th>
                            <th>Numéro</th>                            
                            <th class="text-center">Détails</th>
                            <th class="text-center">Date</th>
                            <th>Statut</th>
                            <th class="text-center">Montant</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        '.$datarow.'                        
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
            <div hidden="" class="text-center text-dark h6 mt-5"> Afin de pouvoir effectuer le paiement, nous vous invitons à remplir ce formulaire, en vue d\'avoir les informations neccessaires sur l&#039;adhérent pour valider le processus. </div>
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

    $infoasssur1=$infoasssur2=$infoasssur3="";
    
    $infoasssur1='
        <div class="col-lg-10 offset-lg-1">
            <div class="section_title text-center" hidden>
                <h3 class="text-uppercase " style="color:#000000 !important">Couverture Santé<br>
                    <span style="color:#21301A !important"> Contrat '.$santecontents["opt_produit"].'  <span></span></span>
                </h3>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <span class="text-dark fw-bold text-uppercase">INFORMATIONS ADHERENT</span>
            </div>
            <div class="card-body">
                <div class="row text-dark h5" style="font-size: 18px">
                    <div class="col-lg-12">
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td class="fw-bold text-dark w-40">Nom : </td>
                                    <td class="pl-3 ">'.firstupper($santecontents["nom_souscripteur"]).'</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Prénoms : </td>
                                    <td class="pl-3 ">'.firstupper($santecontents["prenom_souscripteur"]).'</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Contact : </td>
                                    <td class="pl-3 ">'.($santecontents["status"]=="oui" ? $santecontents["contact_souscripteur"] : ($santecontents["contact1"]!=="" ? $santecontents["contact1"] : $santecontents["contact2"])).'</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Email : </td>
                                    <td class="pl-3">'.$santecontents["email_souscripteur"].'</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <span class="text-dark fw-bold text-uppercase">ADHERENT PRINCIPAL</span>
            </div>
            <div class="card-body">
                <div class="row text-dark h5" style="font-size: 18px">
                    <div class="col-lg-12">
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td class="fw-bold text-dark w-40">Nom et Prénoms : </td>
                                    <td class="pl-3 "> '.firstupper($santecontents["nom"]).' '.firstupper($santecontents["prenom"]).'</td>
                                </tr>'.($santecontents["numero_cmu"]!==" " ? '<tr><td class="fw-bold text-dark">Numéro CMU: </td>
                                    <td class="pl-3 text-uppercase">'.$santecontents["numero_cmu"].'</td>
                                </tr>' : '' ).'                                
                                <tr hidden>
                                    <td class="fw-bold text-dark">Numéro client: </td>
                                    <td class="pl-3 text-uppercase" id="uid">'.$santecontents["_token"].'</td>
                                </tr><tr>
                                    <td class="fw-bold text-dark">Téléphone : </td>
                                    <td class="pl-3">'.($santecontents["status"]=="oui" ? $santecontents["contact_souscripteur"] : ($santecontents["contact1"]!=="" ? $santecontents["contact1"] : $santecontents["contact2"])).'</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Sexe : </td>
                                    <td class="pl-3">'.$santecontents["sexe"].'</td>
                                </tr>                                
                                <tr>
                                    <td class="fw-bold text-dark">Email : </td>
                                    <td class="pl-3">'.$santecontents["email"].'</td>
                                </tr><tr>
                                    <td class="fw-bold text-dark">Secteur d&#039;activité : </td>
                                    <td class="pl-3">'.firstupper($santecontents["profession"]).'</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark"> Ville de residence : </td>
                                    <td class="pl-3">'.$santecontents["ville"].'</td>
                                </tr>                                
                                <tr>
                                    <td class="fw-bold text-dark">Date de naissance : </td>
                                    <td class="pl-3">'.date("d-m-Y",strtotime($santecontents["date_naissance"])).'</td>
                                </tr>'.($santecontents["lieu_naissance"]!==" " ? '<tr><td class="fw-bold text-dark"> Lieu de naissance : </td>
                                    <td class="pl-3">'.firstupper($santecontents["lieu_naissance"]).'</td>
                                    </tr>' : '' ).'
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
    // echo '
    //     <div class="col-lg-10 offset-lg-1">
    //         <div class="section_title text-center" hidden>
    //             <h3 class="text-uppercase " style="color:#000000 !important">Couverture Santé<br>
    //                 <span style="color:#21301A !important"> Contrat '.$santecontents["opt_produit"].'  <span></span></span>
    //             </h3>
    //         </div>
    //     </div>
    //     <div class="card mt-3">
    //         <div class="card-header">
    //             <span class="text-dark fw-bold text-uppercase">INFORMATIONS ADHERENT</span>
    //         </div>
    //         <div class="card-body">
    //             <div class="row text-dark h5" style="font-size: 18px">
    //                 <div class="col-lg-12">
    //                     <table class="table table-borderless table-sm">
    //                         <tbody>
    //                             <tr>
    //                                 <td class="fw-bold text-dark w-40">Nom : </td>
    //                                 <td class="pl-3 ">'.firstupper($santecontents["name"]).'</td>
    //                             </tr>
    //                             <tr>
    //                                 <td class="fw-bold text-dark">Prénoms : </td>
    //                                 <td class="pl-3 ">'.firstupper($santecontents["firstname"]).'</td>
    //                             </tr>
    //                             <tr>
    //                                 <td class="fw-bold text-dark">Contact : </td>
    //                                 <td class="pl-3 ">'.$santecontents["contact"].'</td>
    //                             </tr>
    //                             <tr>
    //                                 <td class="fw-bold text-dark">Email : </td>
    //                                 <td class="pl-3">'.$santecontents["email"].'</td>
    //                             </tr>
    //                         </tbody>
    //                     </table>
    //                 </div>
    //             </div>
    //         </div>
    //     </div>
    //     <div class="card mt-3">
    //         <div class="card-header">
    //             <span class="text-dark fw-bold text-uppercase">ADHERENT PRINCIPAL</span>
    //         </div>
    //         <div class="card-body">
    //             <div class="row text-dark h5" style="font-size: 20px">
    //                 <div class="col-lg-12">
    //                     <table class="table table-borderless table-sm">
    //                         <tbody>
    //                             <tr>
    //                                 <td class="fw-bold text-dark w-40">Nom et Prénoms : </td>
    //                                 <td class="pl-3 "> '.firstupper($santecontents["nom"]).' '.firstupper($santecontents["prenom"]).'</td>
    //                             </tr>';
    //                             if ($santecontents["numero_cmu"]!==" ") {
    //                                 echo '<tr><td class="fw-bold text-dark">Numéro CMU: </td>
    //                                 <td class="pl-3 text-uppercase">'.$santecontents["numero_cmu"].'</td>
    //                             </tr>';
    //                             }
    //                             echo'
    //                             <tr hidden>
    //                                 <td class="fw-bold text-dark">Numéro client: </td>
    //                                 <td class="pl-3 text-uppercase" id="uid">'.$santecontents["_token"].'</td>
    //                             </tr><tr>
    //                                 <td class="fw-bold text-dark">Téléphone : </td>
    //                                 <td class="pl-3">'.$santecontents["contact"].'</td>
    //                             </tr>
    //                             <tr>
    //                                 <td class="fw-bold text-dark">Sexe : </td>
    //                                 <td class="pl-3">'.$santecontents["sexe"].'</td>
    //                             </tr>

    //                             <tr hidden>
    //                                 <td class="fw-bold text-dark">Poids en KG : </td>
    //                                 <td class="pl-3">'.$santecontents["poids_assure"].'</td>
    //                             </tr>
    //                             <tr hidden>
    //                                 <td class="fw-bold text-dark">Taille : </td>
    //                                 <td class="pl-3">'.$santecontents["taille"].'</td>
    //                             </tr>
    //                             <tr hidden>
    //                                 <td class="fw-bold text-dark">Tension artérielle : </td>
    //                                 <td class="pl-3">'.$santecontents["tension_arterielle"].'</td>
    //                             </tr>


    //                             <tr>
    //                                 <td class="fw-bold text-dark">Email : </td>
    //                                 <td class="pl-3">'.$santecontents["email"].'</td>
    //                             </tr><tr>
    //                                 <td class="fw-bold text-dark">Secteur d&#039;activité : </td>
    //                                 <td class="pl-3">'.firstupper($santecontents["profession"]).'</td>
    //                             </tr><tr>
    //                                 <td class="fw-bold text-dark"> Ville de residence : </td>
    //                                 <td class="pl-3">'.$santecontents["ville"].'</td>
    //                             </tr><tr hidden>
    //                                 <td class="fw-bold text-dark"> Commune : </td>
    //                                 <td class="pl-3">'.firstupper($santecontents["commune"]).'</td>
    //                             </tr>';
    //                             /*if (firstupper($santecontents["quartier"])!=="Choix quartier") {
    //                                 # code...
    //                                 echo '<tr><td class="fw-bold text-dark"> Quartier : </td>
    //                                 <td class="pl-3">'.firstupper($santecontents["quartier"]).'</td>
    //                                 </tr>';
    //                             }*/
    //                             echo'
    //                                 <tr>
    //                                 <td class="fw-bold text-dark">Date de naissance : </td>
    //                                 <td class="pl-3">'.date("d-m-Y",strtotime($santecontents["date_naissance"])).'</td>
    //                             </tr>';
    //                             if (firstupper($santecontents["lieu_naissance"])!==" ") {
    //                                 # code...
    //                                 echo '<tr><td class="fw-bold text-dark"> Lieu de naissance : </td>
    //                                 <td class="pl-3">'.firstupper($santecontents["lieu_naissance"]).'</td>
    //                                 </tr>';
    //                             }
    //                             echo'                                
    //                             <tr hidden>
    //                                 <td class="fw-bold text-dark" >Groupe sanguin : </td>
    //                                 <td class="pl-3">'.$santecontents["groupe_sanguin"].'</td>
    //                             </tr>
    //                             <tr>
    //                                 <td class="fw-bold text-dark">Statut : </td>
    //                                 <td class="pl-3">'.firstupper($santecontents["lien"]).'</td>
    //                             </tr>
    //                         </tbody>
    //                     </table>
    //                 </div>
    //             </div>
    //         </div>
    //     </div>
    // ';
    
    for ($i=1; $i <= $santecontents["nombre_enfant"] ; $i++) { 
        # code...
        if (isset($santecontents["nom_e".$i])) {
            # code...
            $infoasssur2.= '
            <div class="card mt-3">
                <div class="card-header">
                    <span class="text-dark fw-bold text-uppercase">BENEFICIAIRE ENFANT N°'.$i.'</span>
                </div>
                <div class="card-body">
                    <div class="row text-dark h5" style="font-size: 18px">
                        <div class="col-lg-12">
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold text-dark w-40">Nom et Prénoms : </td>
                                        <td class="pl-3"> '.firstupper($santecontents["nom_e".$i]).' '.firstupper($santecontents["prenom_e".$i]).'</td>
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
                                    <tr>
                                        <td class="fw-bold text-dark">Secteur d&#039;activité : </td>
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
            // echo'
            // <div class="card mt-3">
            //     <div class="card-header">
            //         <span class="text-dark fw-bold text-uppercase">BENEFICIAIRE ENFANT N°'.$i.'</span>
            //     </div>
            //     <div class="card-body">
            //         <div class="row text-dark h5" style="font-size: 20px">
            //             <div class="col-lg-12">
            //                 <table class="table table-borderless table-sm">
            //                     <tbody>
            //                         <tr>
            //                             <td class="fw-bold text-dark w-40">Nom et Prénoms : </td>
            //                             <td class="pl-3"> '.firstupper($santecontents["nom_e".$i]).' '.firstupper($santecontents["prenom_e".$i]).'</td>
            //                         </tr>
            //                         <tr hidden>
            //                             <td class="fw-bold text-dark">Numéro client: </td>
            //                             <td class="pl-3 text-uppercase">'.$santecontents["_token"].$i.'</td>
            //                         </tr><tr>
            //                             <td class="fw-bold text-dark">Téléphone : </td>
            //                             <td class="pl-3">'.$santecontents["contact_e".$i].'</td>
            //                         </tr>
            //                         <tr>
            //                             <td class="fw-bold text-dark">Sexe : </td>
            //                             <td class="pl-3">'.$santecontents["sexe_e".$i].'</td>
            //                         </tr>
            //                         <tr>
            //                             <td class="fw-bold text-dark">Secteur d&#039;activité : </td>
            //                             <td class="pl-3"> '.firstupper($santecontents["profession_e".$i]).'</td>
            //                         </tr><tr>
            //                             <td class="fw-bold text-dark">Date de naissance : </td>
            //                             <td class="pl-3">'.date("d-m-Y",strtotime($santecontents["date_naissance_e".$i])).'</td>
            //                         </tr>
            //                         <tr>
            //                             <td class="fw-bold text-dark">Lieu de naissance : </td>
            //                             <td class="pl-3">'.firstupper($santecontents["lieu_naissance_e".$i]).'</td>
            //                         </tr>
            //                         <tr>
            //                             <td class="fw-bold text-dark">Statut : </td>
            //                             <td class="pl-3">'.firstupper($santecontents["lien_e".$i]).'</td>
            //                         </tr>
            //                     </tbody>
            //                 </table>
            //             </div>
            //         </div>
            //     </div>
            // </div>
            // ';
        }
        
    }
    for ($i=1; $i <= $santecontents["nombre_adulte"] ; $i++) { 
        # code...
        if (isset($santecontents["nom_a".$i])) {
            $infoasssur3.= '
            <div class="card mt-3">
                <div class="card-header">
                    <span class="text-dark fw-bold text-uppercase">BENEFICIAIRE ADULTE N°'.$i.'</span>
                </div>
                <div class="card-body">
                    <div class="row text-dark h5" style="font-size: 18px">
                        <div class="col-lg-12">
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold text-dark w-40">Nom et Prénoms : </td>
                                        <td class="pl-3">'.firstupper($santecontents["nom_a".$i]).' '.firstupper($santecontents["prenom_a".$i]).'</td>
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

                                    <tr>
                                        <td class="fw-bold text-dark">Email : </td>
                                        <td class="pl-3">'.$santecontents["email_a".$i].'</td>
                                    </tr><tr>
                                        <td class="fw-bold text-dark">Secteur d&#039;activité : </td>
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
            // echo '
            // <div class="card mt-3">
            //     <div class="card-header">
            //         <span class="text-dark fw-bold text-uppercase">BENEFICIAIRE ADULTE N°'.$i.'</span>
            //     </div>
            //     <div class="card-body">
            //         <div class="row text-dark h5" style="font-size: 20px">
            //             <div class="col-lg-12">
            //                 <table class="table table-borderless table-sm">
            //                     <tbody>
            //                         <tr>
            //                             <td class="fw-bold text-dark w-40">Nom et Prénoms : </td>
            //                             <td class="pl-3">'.firstupper($santecontents["nom_a".$i]).' '.firstupper($santecontents["prenom_a".$i]).'</td>
            //                         </tr>
            //                         <tr hidden>
            //                             <td class="fw-bold text-dark">Numéro client: </td>
            //                             <td class="pl-3 text-uppercase">'.$santecontents["_token"].$i.'</td>
            //                         </tr><tr>
            //                             <td class="fw-bold text-dark">Téléphone : </td>
            //                             <td class="pl-3">'.$santecontents["contact_a".$i].'</td>
            //                         </tr>
            //                         <tr>
            //                             <td class="fw-bold text-dark">Sexe : </td>
            //                             <td class="pl-3">'.$santecontents["sexe_a".$i].'</td>
            //                         </tr>                                 

            //                         <tr>
            //                             <td class="fw-bold text-dark">Email : </td>
            //                             <td class="pl-3">'.$santecontents["email_a".$i].'</td>
            //                         </tr><tr>
            //                             <td class="fw-bold text-dark">Secteur d&#039;activité : </td>
            //                             <td class="pl-3"> '.firstupper($santecontents["profession_a".$i]).'</td>
            //                         </tr><tr>
            //                             <td class="fw-bold text-dark">Date de naissance : </td>
            //                             <td class="pl-3">'.date("d-m-Y",strtotime($santecontents["date_naissance_a".$i])).'</td>
            //                         </tr>
            //                         <tr>
            //                             <td class="fw-bold text-dark">Lieu de naissance : </td>
            //                             <td class="pl-3">'.firstupper($santecontents["lieu_naissance_a".$i]).'</td>
            //                         </tr>
            //                         <tr>
            //                             <td class="fw-bold text-dark">Statut : </td>
            //                             <td class="pl-3">'.firstupper($santecontents["lien_a".$i]).'</td>
            //                         </tr>
            //                     </tbody>
            //                 </table>
            //             </div>
            //         </div>
            //     </div>
            // </div>
            // ';
        }
    }

    //affichade de tous les menbres
    $_SESSION["membresValues"]=$infoasssur1.$infoasssur2.$infoasssur3;
    echo $infoasssur1.$infoasssur2.$infoasssur3;

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
    $nbreadulte=0;
    $nbrenfant=0;
    $montantCotisation=0;
    //verification des variables a envoyer si famille ou individuel
    if ($santecontents["opt_produit"]=="individuel") {
        # code...
        $nbreadulte=1;
        $nbrenfant=0;
    } else {
        # code...
        if ($santecontents["option_type_famille"]=="normal") {
            # code...
            if (intval($santecontents["nombre_adulte"]) - 2 > 0) {
                # code...
                $nbreadulte=intval($santecontents["nombre_adulte"]) - 2;
            }
            if (intval($santecontents["nombre_enfant"]) - 3 > 0) {
                # code...
                $nbrenfant=intval($santecontents["nombre_enfant"]) - 3;
            }
            
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
        //print_r("nbreadulte=".$nbreadulte." nbrenfant=".$nbrenfant);
        $montantCotisation=$tableAutiliser[1]+($nbreadulte*$tableAutiliser[2])+($nbrenfant*$tableAutiliser[3]);
        
        
    }
    //print_r("nbreadulte=".$nbreadulte." nbrenfant=".$nbrenfant." type_taux=".$tabtype[0]." type_radio_set=".$tabtype[1]." type_option_type_famille=".$tabtype[2]);
    //print_r("nbreadulte=".$nbreadulte." nbrenfant=".$nbrenfant);
    //$tabtype2=calculcotation($nbreadulte,$nbrenfant,$tabtype[0],$tabtype[1],$tabtype[2]);


    
    $part='<h5 class="modal-title h3 fw-bold text-dark" id="LabelAccident" hidden>Dévis SANTE-'.strtoupper($santecontents["radio-set"]).'-MUCCI-'.$code_uni.'</h5>
                <button type="button" class="close d-none" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true"></span>
                </button>//
            <div class="section_title text-center">
                <h2><span class="text-primary">Contrat '.$santecontents["opt_produit"].'</span></h2>
            </div>
            <div class="card mt-3">
                <div class="card-header" hidden><span class="text-dark fw-bold text-uppercase"> facturation globale du contrat</span></div>
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
                                            <td class="fw-bold">Couverture maladie</td>
                                            <td style="font-size: 1.5em;" class="text-end text-primary fw-bold" id="primevalue">'.number_format(round($montantCotisation,0),0,""," ")." FCFA".'</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
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
                    <h3>ADULTE N°'.substr($type_adherent_id,5,1).'</h3>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Nom <span class="text-danger fw-bold">*</span></label>
                    <input contenteditable="true" name="nom_a'.substr($type_adherent_id,5,1).'" id="nom_a'.substr($type_adherent_id,5,1).'" type="text" class="contact_input nom_item toupper" onchange="verifier_nom_beneficiaire()" placeholder="Nom" value="">
                    <label hidden="" class="text-danger fw-bold" id="nom_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>
                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Prénom(s) <span class="text-danger fw-bold">*</span></label>
                    <input name="prenom_a'.substr($type_adherent_id,5,1).'" id="prenom_a'.substr($type_adherent_id,5,1).'" onchange="verifier_prenom_beneficiaire()" type="text" class="contact_input prenom_item toupper" placeholder="Prenom(s)" value="">
                    <label hidden="" class="text-danger fw-bold" id="prenom_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>
                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Sexe <span class="text-danger fw-bold">*</span></label>
                    <select name="sexe_a'.substr($type_adherent_id,5,1).'" id="sexe_a'.substr($type_adherent_id,5,1).'" onchange="verifier_sexe_beneficiaire()" class="contact_input sexe_item">
                        <option value="sexe">Choisir Votre sexe</option>
                        <option value="H">Homme</option>
                        <option value="F">Femme</option>
                    </select><label hidden="" class="text-danger fw-bold" id="error_sexe_a'.substr($type_adherent_id,5,1).'"></label>
                </div>

                <div class="col-lg-4 contact_name_col mt-3">
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

                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="numero_piece_a'.substr($type_adherent_id,5,1).'">Numéro de pièce <span class="text-danger fw-bold">*</span></label>
                    <input name="numero_piece_a'.substr($type_adherent_id,5,1).'" id="numero_piece_a'.substr($type_adherent_id,5,1).'" onchange="verifier_numero_piece_beneficiaire()" type="text" class="contact_input numero_piece_item" placeholder="Saisir le numéro de pièce">
                    <label class="text-danger fw-bold" id="numero_piece_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>

                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="profession_a'.substr($type_adherent_id,5,1).'">Secteur d&#039;activité : </label>
                    <select name="profession_a'.substr($type_adherent_id,5,1).'" id="profession_a'.substr($type_adherent_id,5,1).'" type="text" class="contact_input profession_item" placeholder="Profession" onchange="addprofession(\'profession_a'.substr($type_adherent_id,5,1).'\',\'categorie_professionnelle_a'.substr($type_adherent_id,5,1).'\')">
                        <option value="">Choisissez le secteur</option>';
                        foreach ($infoadherents[4]['activites'] as $activites) {
                            echo '<option value="'.$activites['activite'].'">'.$activites['activite'].'</option>';
                        }                        
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="profession_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>

                <div hidden="" class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="service_3">Service <span class="text-danger fw-bold">*</span></label>
                    <input name="service" id="service_3" type="text" class="contact_input service_item" placeholder="Votre service" value="Votre service"><label class="text-danger fw-bold" id="service_error_3"></label>
                </div>
                <div hidden="" class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="organisation_3">Organisation <span class="text-danger fw-bold">*</span></label>
                    <input name="organisation" id="organisation_3" type="text" class="contact_input organisation_item" placeholder="Votre organisation"value="Votre organisation">
                    <label class="text-danger fw-bold" id="organisation_error_3"></label>
                </div>

                <div hidden="" class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="matricule_organisation_3">Matricule Organisation <span class="text-danger fw-bold">*</span></label>
                    <input name="matricule_organisation" id="matricule_organisation_3" type="text" class="contact_input matricule_organisation_item" placeholder="Le matricule de votre organisation" value="Le matricule de votre organisation">
                    <label class="text-danger fw-bold" id="matricule_organisation_error_3"></label>
                </div>

                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark fs-0-8" for="categorie_professionnelle">Catégorie professionnelle</label>
                    <select name="categorie_professionnelle_a'.substr($type_adherent_id,5,1).'" id="categorie_professionnelle_a'.substr($type_adherent_id,5,1).'" class="contact_input categorie_professionnelle_item">
                        <option value="">Choisissez la Catégorie</option>';
                        foreach ($infoadherents[5]['categorie_professionnelles'] as $categorie_professionnelles) {
                            echo '<option value="'.$categorie_professionnelles['categorie'].'" class="'.$categorie_professionnelles['categorie2'].'">'.$categorie_professionnelles['categorie'].'</option>';
                        }                        
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="categorie_professionnelle_error"></label>
                </div>

                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="civilite">Situation matrimoniale</label>
                    <select name="civilite_a'.substr($type_adherent_id,5,1).'" id="civilite_a'.substr($type_adherent_id,5,1).'" class="contact_input civilite_item">
                        <option value="">Choisissez la situation</option>';
                        foreach ($infoadherents[0]['civilite'] as $civilite) {
                            echo '<option value="'.$civilite['titre'].'">'.$civilite['titre'].'</option>';
                        }
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="civilite_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>

                <div class="col-lg-4 mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Date de naissance <span class="text-danger fw-bold">*</span></label>
                    <input name="date_naissance_a'.substr($type_adherent_id,5,1).'" id="datenaissance_a'.substr($type_adherent_id,5,1).'" onchange="verifier_date_naissance_beneficiaire()" type="date" class="contact_input date_naissance_item adulte_date" placeholder="Date de naissance">
                    <label hidden="" class="text-danger fw-bold" id="datenaissance_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>

                <div class="col-lg-4 mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Lieu de naissance </label>
                    
                    <select  name="lieu_naissance_a'.substr($type_adherent_id,5,1).'" id="lieu_naissance_a'.substr($type_adherent_id,5,1).'" onchange="verifier_date_naissance_beneficiaire()" type="text" class="contact_input lieu_naissance_item" placeholder="Lieu de naissance">
                        <option value="">Choix lieu de naissance</option>
                        <option value="A">Hors du pays</option>';
                        foreach ($villes as $ville) {
                            echo '<option value="'.ucfirst($ville['ville'][0]['nom']).'">'.ucfirst($ville['ville'][0]['nom']).'</option>';
                        }
                        
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="lieu_naissance_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>

                <div class="col-lg-4 contact_name_col mt-3 contact_a'.substr($type_adherent_id,5,1).' ">
                    <label class="text-dark" for="exampleInputEmail1">Numéro portable 1<span class="text-danger fw-bold">*</span></label>
                    <div class="input-group mb-3">
                        <input name="contact_a'.substr($type_adherent_id,5,1).'" id="contact_a'.substr($type_adherent_id,5,1).'" type="text" class="contact_input contact_item" placeholder="Contact" aria-label="" aria-describedby="basic-addon1" style="width: 86%;">
                        <i class="btn text-primary align-self-center border border-0 p-0 btnNumberAdd material-icons align-middle fs-2" data-nberzone="contact_a'.substr($type_adherent_id,5,1).'" data-bs-toggle="tooltip" data-bs-placement="top" title="ajouter un autre numero" >&#xe146;</i>                  
                    </div>                    
                    <label class="text-danger fw-bold" id="contact_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>

                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Email </label>
                    <input name="email_a'.substr($type_adherent_id,5,1).'" id="email_a'.substr($type_adherent_id,5,1).'" type="text" class="contact_input email_item" placeholder="Email"><label class="text-danger fw-bold" id="email_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>
                
                <div class="col-lg-4 mb-3 contact_name_col mt-3" id="liens">
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
                
                <div hidden="" class="col-lg-4 contact_name_col mt-3"><label class="text-dark" for="resident">Est-il résident ?</label>
                    <select name="resident" id="resident_3" class="contact_input resident_item">
                        <option value="non">NON</option>
                        <option value="oui">OUI</option>
                    </select>
                    <label class="text-danger fw-bold" id="resident_error"></label>
                </div>

                <div hidden="" class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="type_agent">Type agent<span class="text-danger fw-bold">*</span></label>
                    <select name="type_agent" id="type_agent_3" class="contact_input type_agent_item">
                        <option value="ND">Non Défini - ND</option>
                    </select><label class="text-danger fw-bold" id="type_agent_error"></label>
                </div>

                <div hidden="" class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="activation_sms">Activer les SMS ?</label>
                    <select name="activation_sms" id="activation_sms_3" class="contact_input activation_sms_item">
                        <option value="non">NON</option>
                        <option value="oui">OUI</option>
                    </select>
                    <label class="text-danger fw-bold" id="activation_sms_error"></label>
                </div>'.
                zone_recurrente2('pathologies','_a'.substr($type_adherent_id,5,1)).
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
                    <h3>ENFANT N°'.substr($type_adherent_id,4,1).' </h3>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Nom <span class="text-danger fw-bold">*</span></label>
                    <input contenteditable="true" name="nom_e'.substr($type_adherent_id,4,1).'" id="nom_e'.substr($type_adherent_id,4,1).'" type="text" class="contact_input nom_item toupper" onchange="verifier_nom_beneficiaire()" placeholder="Nom" value="">
                    <label hidden="" class="text-danger fw-bold" id="nom_error_e'.substr($type_adherent_id,4,1).'"></label>
                </div>

                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Prénom(s) <span class="text-danger fw-bold">*</span></label>
                    <input name="prenom_e'.substr($type_adherent_id,4,1).'" id="prenom_e'.substr($type_adherent_id,4,1).'" onchange="verifier_prenom_beneficiaire()" type="text" class="contact_input prenom_item toupper" placeholder="Prenom(s)" value="">
                    <label hidden="" class="text-danger fw-bold" id="prenom_error_e'.substr($type_adherent_id,4,1).'"></label>
                </div>

                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Sexe <span class="text-danger fw-bold">*</span>
                    </label>
                    <select name="sexe_e'.substr($type_adherent_id,4,1).'" id="sexe_e'.substr($type_adherent_id,4,1).'" class="contact_input sexe_item" onchange="verifier_sexe_beneficiaire()">
                        <option value="sexe">Choisir Votre sexe</option>
                        <option value="H">Homme</option>
                        <option value="F">Femme</option>
                    </select>
                    <label hidden="" class="text-danger fw-bold" id="error_sexe_e'.substr($type_adherent_id,4,1).'"></label>
                </div>

                
                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="type_piece">Type de pièce <span class="text-danger fw-bold">*</span>
                    </label>
                    <select name="type_piece_e'.substr($type_adherent_id,4,1).'" id="type_piece_e'.substr($type_adherent_id,4,1).'" onchange="verifier_type_piece_beneficiaire()" class="contact_input type_piece_item">
                    <option value="">Choisissez le type de pièce</option>';
                    foreach ($infoadherents[1]['piece_identite'] as $piece_identite) {
                        echo '<option value="'.$piece_identite['id'].'">'.$piece_identite['piece'].'</option>';
                    }
                    
                echo'
                    </select>
                    <label class="text-danger fw-bold" id="type_piece_error_e'.substr($type_adherent_id,4,1).'"></label>
                </div>

                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="numero_piece_0">Numéro de pièce <span class="text-danger fw-bold">*</span>
                    </label>
                    <input name="numero_piece_e'.substr($type_adherent_id,4,1).'" id="numero_piece_e'.substr($type_adherent_id,4,1).'" type="text" onchange="verifier_numero_piece_beneficiaire()" class="contact_input numero_piece_item" placeholder="Saisir le numéro de pièce">
                    <label class="text-danger fw-bold" id="numero_piece_error_e'.substr($type_adherent_id,4,1).'"></label>
                </div>
                
                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="profession_a'.substr($type_adherent_id,5,1).'">Status scolaire : </label>
                    <select name="profession_e'.substr($type_adherent_id,4,1).'" id="profession_e'.substr($type_adherent_id,4,1).'" type="text" class="contact_input profession_item">
                        <option value="">Choisissez le secteur</option>';
                        foreach ($infoadherents[6]['categorie_professionnellesE'] as $activites) {
                            echo '<option value="'.$activites['categorie'].'">'.$activites['categorie'].'</option>';
                        }                        
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="profession_error_a'.substr($type_adherent_id,5,1).'"></label>
                </div>

                <div hidden="" class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="service_0">Service <span class="text-danger fw-bold">*</span>
                    </label>
                    <input name="service" id="service_0" type="text" class="contact_input service_item" placeholder="Votre service" value="Votre service">
                    <label class="text-danger fw-bold" id="service_error_0"></label>
                </div>

                <div hidden="" class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="organisation_0">Organisation <span class="text-danger fw-bold">*</span>
                    </label>
                    <input name="organisation" id="organisation_0" type="text" class="contact_input organisation_item" placeholder="Votre organisation" value="Votre organisation">
                    <label class="text-danger fw-bold" id="organisation_error_0"></label>
                </div>

                <div hidden="" class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="matricule_organisation_0">Matricule Organisation <span class="text-danger fw-bold">*</span>
                    </label>
                    <input name="matricule_organisation" id="matricule_organisation_0" type="text" class="contact_input matricule_organisation_item" placeholder="Le matricule de votre organisation" value="Le matricule de votre organisation">
                    <label class="text-danger fw-bold" id="matricule_organisation_error_0"></label>
                </div>

                <div hidden="" class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="categorie_professionnelle_0">Numéro de pièces <span class="text-danger fw-bold">*</span>
                    </label>
                    <input name="categorie_professionnelle" id="categorie_professionnelle_0" type="text" class="contact_input categorie_professionnelle_item" placeholder="Votre catégorie professionnelle" value="Votre catégorie professionnelle">
                    <label class="text-danger fw-bold" id="categorie_professionnelle_error_0"></label>
                </div>
                
                <div class="col-lg-4 mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Date de naissance <span class="text-danger fw-bold">*</span>
                    </label>
                    <input name="date_naissance_e'.substr($type_adherent_id,4,1).'" min="'.date('d-m-Y', strtotime(date('Y-m-d'). ' - 7300 days')) .'" max="'.date('Y-m-d').'" id="datenaissance_e'.substr($type_adherent_id,4,1).'" onchange="verifier_date_naissance_beneficiaire()" type="date" class="contact_input date_naissance_item enfant_date" placeholder="Date de naissance">
                    <label hidden="" class="text-danger fw-bold" id="datenaissance_error_0"></label>
                </div>

                <div class="col-lg-4 mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Lieu de naissance </label>
                    <select name="lieu_naissance_e'.substr($type_adherent_id,4,1).'" id="lieu_naissance_e'.substr($type_adherent_id,4,1).'" type="text" class="contact_input lieu_naissance_item" placeholder="Lieu de naissance">
                        <option value="">Choix lieu de naissance</option>
                        <option value="A">Hors du pays</option>';
                        foreach ($villes as $ville) {
                            echo '<option value="'.ucfirst($ville['ville'][0]['nom']).'">'.ucfirst($ville['ville'][0]['nom']).'</option>';
                        }
                        
                    echo'
                    </select>
                    <label class="text-danger fw-bold" id="lieu_naissance_error_e'.substr($type_adherent_id,4,1).'"></label>
                </div>

                <div class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="exampleInputEmail1">Numéro portable</label>
                    <input name="contact_e'.substr($type_adherent_id,4,1).'" id="contact_e'.substr($type_adherent_id,4,1).'" type="text" class="contact_input contact_item" placeholder="Contact" aria-label="" aria-describedby="basic-addon1" value=" ">                   
                    <label class="text-danger fw-bold" id="contact_error_e'.substr($type_adherent_id,4,1).'"></label>
                </div>

                <div class="col-lg-4 contact_name_col mt-3" hidden>
                    <label class="text-dark" for="exampleInputEmail1">Email </label>
                    <input name="email_e'.substr($type_adherent_id,4,1).'" id="email_e'.substr($type_adherent_id,4,1).'" type="text" class="contact_input email_item" placeholder="Email" value="NA">
                    <label class="text-danger fw-bold" id="email_error_e'.substr($type_adherent_id,4,1).'"></label>
                </div>

                <div class="col-lg-4 mb-3 contact_name_col mt-3" id="liens">
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
                <div hidden="" class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="resident">Est-il résident ?</label>
                    <select name="resident" id="resident_0" class="contact_input resident_item">
                        <option value="non">NON</option>
                        <option value="oui">OUI</option>
                    </select>
                    <label class="text-danger fw-bold" id="resident_error"></label>
                </div>
                <div hidden="" class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="type_agent">Type agent <span class="text-danger fw-bold">*</span>
                    </label>
                    <select name="type_agent" id="type_agent_0" class="contact_input type_agent_item">
                        <option value="ND">Non Défini - ND</option>
                    </select>
                    <label class="text-danger fw-bold" id="type_agent_error"></label>
                </div>
                <div hidden="" class="col-lg-4 contact_name_col mt-3">
                    <label class="text-dark" for="activation_sms">Activer les SMS ?</label>
                    <select name="activation_sms" id="activation_sms0" class="contact_input activation_sms_item">
                        <option value="non">NON</option>
                        <option value="oui">OUI</option>
                    </select>
                    <label class="text-danger fw-bold" id="activation_sms_error"></label>
                </div>'.
                zone_recurrente2('pathologies','_e'.substr($type_adherent_id,5,1)).
            '</div>
            <button style="width: 100%" id="remove'.substr($type_adherent_id,4,1).'" class="btn btn-danger remove_field mt-4" onclick="removePersCharge(\''.$type_adherent_id.'\')">Retirer la personne à charge N°'.substr($type_adherent_id,4,1).'</button>
        </div>
        ';
    }   
}
?>
