<?php
include 'gfonctions.php';

$json = file_get_contents("villes.json");
$villes = json_decode($json ,true);

// $jsondata = file_get_contents("data.json");
// $santecontents = json_decode($jsondata ,true);
$santecontents = isset($_SESSION["data"]) ? json_decode($_SESSION["data"],true) : null;

//----------------------gestion de la connection utilisateur---------------------------------

if(isset($_GET['liste'])){
  $choix=isset($_GET['choix']) ? $_GET['choix'] : null;
  $choix2=isset($_GET['choix2']) ? $_GET['choix2'] : null;
  $num=isset($_GET['num']) ? $_GET['num'] : null;

  //$count=0;
  foreach ($villes as $ville) {
    if ($ville['ville'][0]['nom']==strtolower($choix) && $num==1) {
      # code...      
      foreach ($ville['ville'][0]['commune'] as $villeselectionner) {
        # code...
        echo '<option value="'.$villeselectionner['nom'].'">'.ucfirst($villeselectionner['nom']).'</option>';
      }
      
    }

    for ($i=0; $i < count($ville['ville']); $i++) { 
      # code...
      if ($ville['ville'][$i]['nom']==strtolower($choix) && $num==2) {
        # code...  
        for ($j=0; $j <count($ville['ville'][$i]['commune']) ; $j++) { 
          # code...
          if ($ville['ville'][$i]['commune'][$j]['nom']==strtolower($choix2)) {
            # code...
            for ($k=0; $k <count($ville['ville'][$i]['commune'][$j]) ; $k++) {
              # code...
              echo '<option value="'.$ville['ville'][$i]['commune'][$j]['quartier'][$k]['nom'].'">'.ucfirst($ville['ville'][$i]['commune'][$j]['quartier'][$k]['nom']).'</option>';
            }
          }
        } 
      }
    }    
    //$count++;
    
  }
  
    
}

if(isset($_GET['fiche'])){
    $listeBeneficiaires="";

    $transactionid=isset($_GET['transactionid']) ? $_GET['transactionid'] : null;

    $requeteAdherent = "SELECT * FROM souscripteur where souscripteur.uniqueid = '". $transactionid."' OR souscripteur.token_notification= '".$transactionid."'  AND (payment_statut='ACCEPTED' OR payment_statut='SUCCESS') ";

    //print_r($requete);
    $exec_requeteAdherent = mysqli_query($db,$requeteAdherent);
    
    if (mysqli_num_rows($exec_requeteAdherent) > 0) {
        $requeteBeneficiaire = "SELECT * FROM beneficiaires where beneficiaires.uniqueid = '". $transactionid."'";

        $exec_requeteBeneficiaire = mysqli_query($db,$requeteBeneficiaire);

        if (mysqli_num_rows($exec_requeteBeneficiaire) > 0) {    
            // sortie des données pour chaques ligne
            $cpt=1;
            while($row = mysqli_fetch_assoc($exec_requeteBeneficiaire)) {
                $cpt++; 
                $listeBeneficiaires.='<tr><td class="text-center border-end">'.$cpt.'</td><td class="border-end">'.strtoupper(strtolower(str_replace('_',' ',$row["nom"]))).' '.ucfirst(strtolower(str_replace('_',' ',$row["prenom"]))).'</td><td class="text-center">'.firstupper($row["lien"]).'</td></tr>';
            }
        }
    }

    // de la valeur des types pour le calcul de la cotation  
    if (mysqli_num_rows($exec_requeteAdherent) > 0) {
        # code...
        $reponse = mysqli_fetch_array($exec_requeteAdherent);
        //$coefficient=(!empty($reponse["RaisonSocial"])) ? 1.03 : 1.08 ;
        //$accessoire=(!empty($reponse["RaisonSocial"])) ? 10000 : 3000 ;
        //$taxe=isset($reponse["valeur_prime"]) ? $reponse["valeur_prime"]*(1-(1/$coefficient)) : null ;
        //$primeht=isset($reponse["valeur_prime"]) ? $reponse["valeur_prime"]-$taxe-$accessoire : null;
        if ($reponse["payment_statut"]=='ACCEPTED' OR $reponse["payment_statut"]=='SUCCESS') {
            # code...
            echo'
                    <div class="pageprintcreator">                    
                    <span class="titre_demande text-center">
                        <h3 hidden>CONTRAT DE COUVERTURE MALADIE</h3>
                        <h3>Convention El Rapha</h3>
                    </span>
                    
                    <div class="doctitre text_gras mt-4 px-4 bg-secondary">
                        <p class="text-white">Informations sur le Souscripteur</p>
                    </div>
                    <div class="table-responsive text-start d-lg-flex justify-content-center">
                        <table class="table table-borderless table-sm w-100 my-3">
                            <tr>
                                <td>N° Souscripteur :</td><td class="text-end">'.$reponse["uniqueid"].'</td>
                            </tr>
                            <tr>
                                <td>Souscripteur :</td><td class="text-end">'.strtoupper($reponse["nom"]).' '.strtoupper($reponse["prenom"]).'</td>
                            </tr>
                            <tr>
                                <td>Adresse Géographique :</td><td class="text-end">'.$reponse["localite"].'</td>
                            </tr>
                            <tr>
                                <td>N° Téléphone :</td><td class="text-end">(225) '.formatPhoneNumber($reponse["numero_telephone"]).'</td>
                            </tr>
                            <tr>
                                <td>Secteur d\'Activité :</td><td class="text-end">'.strtoupper(str_replace('_',' ',$reponse["profession"])).'</td>
                            </tr>
                            <tr>
                                <td>Email :</td><td class="text-end">'.$reponse["email_souscripteur"].'</td>
                            </tr>
                        </table>
                    </div>
    
                    <div class="doctitre text_gras px-4 bg-secondary">
                        <p class="text-white">Informations sur la Convention</p>
                    </div>
                    <div class="table-responsive text-start d-lg-flex justify-content-center">
                        <table class="table table-borderless table-sm w-100 my-3">         
                            <tr>
                                <td>Formule :</td><td class="text-end">'.ucfirst(str_replace('_',' ',$reponse["produit_souscription"])).'</td>
                            </tr>
                            <tr>
                                <td>Taux de couverture :</td><td class="text-end"></td>
                            </tr>
                            <tr>
                                <td>Date d\'effet :</td><td class="text-end">'.date('d-m-Y', strtotime(substr($reponse["date_souscription"],0,10))).'</td>                            
                            <tr>                            
                                <td>Date d’échéance :</td><td class="text-end">'.date('d-m-Y', strtotime(substr($reponse["date_souscription"],0,10). ' + 364 days')) .'</td>
                            </tr>
                            <tr>
                                <td hidden>RESILIATION A L’ECHEANCE :</td><td hidden>Ferme</td>
                                <td>Nombre de Bénéficiaires :</td><td class="text-end">'.(intval($reponse["nombre_adulte"])+intval($reponse["nombre_enfants"])+intval($reponse["nombre_conjoint"])).'</td>
                            </tr>
                            <tr>                            
                                <td>Couverture Maladie :</td><td class="text-end">'.number_format(round((intval($reponse["valeur_prime"])-intval(10000)),0),0,""," ").'  FCFA</td>
                            </tr>
                            <tr>                            
                                <td>Droit d\'Adhésion :</td><td class="text-end">'.number_format(round(intval(10000),0),0,""," ").'  FCFA</td>
                            </tr>                        
                        </table>
                    </div>
                    <div class="bg-color-secondary">
                        <table class="table table-borderless table-sm w-100 text-white">
                            <td >Cotisation Totale :</td><td class="text-end">'.number_format(round($reponse["valeur_prime"],0),0,""," ").' FCFA</td>
                        </table>
                    </div>
                    
                    <div class="m-auto text-center">
                        <p>Les cartes digitales sont gratuites.</p>
                    </div>
                    <div class="m-auto text-center">
                        <p>Les cartes physiques sont à 1 000 FCFA par individu.</p>
                    </div>
                    <div class="m-auto mb-2" style="text-align: justify;">
                        <p>La loi N° 2014-131 du 24 Mars 2014, instituant la Couverture Maladie Universelle et son décret d’application n° 2017-46 du 25/01/2017 en son article 19, prévoit désormais, que « la mise en œuvre de toute couverture complémentaire n’est autorisée qu’au bénéfice de personnes assujetties à la couverture maladie universelle et en règle vis-à-vis de celle-ci ». Nous vous encourageons à procéder urgemment à l’immatriculation de toutes les bénéficiaires relevant de ladite convention et nous transmettre le numéro d’immatriculation CMU de chacun d’eux.</p>
                    </div>
    
                    <div class="m-auto text-center my-3">
                        <p class="text-primary fs-5">Liste des Bénéficiaires.</p>
                    </div>
    
                    <div>
                        <table class="table table-borderless table-sm w-100 my-3 border border-secondary">         
                            <tr class="bg-color-secondary text-white">
                                <td class="text-center w-25 border-end">N°</td>
                                <td class="border-end">Nom et Prénoms</td>
                                <td class="text-center border-end">Statut</td>
                            </tr>
                            <tr><td class="text-center border-end">1</td><td class="border-end">'.strtoupper(strtolower(str_replace('_',' ',$reponse["nom"]))).' '.ucfirst(strtolower(str_replace('_',' ',$reponse["prenom"]))).'</td><td class="text-center">'.firstupper($reponse["lien"]).'</td></tr> '.$listeBeneficiaires.'                                               
                        </table>
                    </div>
                    
                    <div class="cssform4 d-flex justify-content-between px-4 mb-5 d-none">
                        <div>
                            <p>POUR LE SOUSCRIPTEUR </p>
                        </div>
                        <div >
                            <p>POUR LA COMPAGNIE</p>
                        </div>
                    </div>
                </div>
            ';
        }
  }
  else {
    # code...
    echo'
    <p style="color: #be1d2e; text-align:center"> Désolé votre contrat ne peut être affiché. Merci de vérifier l\'effectivité de votre paiement.</p>
    ';
  }


}
if(isset($_GET['inscription'])){
    $type=isset($_GET['type']) ? $_GET['type'] : null;
    $echeancier=isset($_GET['echeancier']) ? json_decode(str_replace( array( '/' ), '-', $_GET['echeancier']), true) : null;
    $methode=isset($_GET['methode']) ? $_GET['methode'] : null;;
    $payment_token=isset($_GET['payment_token']) ? $_GET['payment_token'] : null;
    $transaction_id=isset($_GET['transaction_id']) ? $_GET['transaction_id'] : null;
    $token_notification=isset($_GET['token_notification']) ? $_GET['token_notification'] : null;
    $jsonfield_santecontents=isset($_GET['jsonfield_santecontents']) ? $_GET['jsonfield_santecontents'] : null;
    //ecriture des information de l'utilisateur dans la base de donnee
    $santecontents=json_decode($jsonfield_santecontents, true);

    //initialisation des requestes
    $requeteSouscripteur=$requeteSouscription=$requeteBeneficiaire="";

    
    //nombre de beneficiaire
    $nbrenfant=$nbreadulte=0;
    
    
    if ($type=="initial") {  
        //print_r('$nbrenfant='.$nbrenfant.' $nbreadulte='.$nbreadulte);
        //print_r($santecontents);
        //verification des variables a envoyer si famille ou individuel
        if ($santecontents["opt_produit"]=="individuel") {
            # code...
            // $requeteSouscripteur = "INSERT INTO souscripteur SET                
            //     uniqueid = '".$santecontents['_token']."',
            //     nom = '".strtoupper($santecontents["nom"])."',  
            //     Prenom = '".strtoupper($santecontents["prenom"])."',  
            //     profession = '".RemoveSpecialChar2($santecontents['profession'])."',
            //     date_naiss = '".$santecontents['date_naissance']."',
            //     sexe = '".$santecontents['sexe']."', 
            //     type_piece = '".$santecontents['type_piece']."',
            //     numero_piece = '".$santecontents['numero_piece']."',  
            //     numero_telephone = '".$santecontents['contact']."',
            //     email_souscripteur = '".$santecontents['email']."',  
            //     localite = '".$santecontents['ville']."',
            //     produit_souscription = '".$santecontents["opt_produit"]."',  
            //     valeur_prime = '".intval(preg_replace("/[^0-9]/", "", $santecontents['MontantCotisationZone0']))."',
            //     operateur_paiement='".$santecontents['operateur']."',
            //     nombre_adulte = '".$santecontents["nombre_personnel"]."', 
            //     lien = '".$santecontents['lien']."'
            //     ".";";
            $requeteSouscripteur = "UPDATE souscripteur SET valeur_prime = '".intval(preg_replace("/[^0-9]/", "", $santecontents['MontantCotisationZone0']))."' 
                WHERE uniqueid = '".$santecontents['_token']."' ;";
            //
            //insertion dans la table des paiemments
            $requeteSouscription = "INSERT INTO souscription SET                
                uniqueid = '".$santecontents['_token']."',
                nom = '".strtoupper($santecontents["nom"])."',  
                prenom = '".strtoupper($santecontents["prenom"])."',
                numero_telephone = '".($santecontents["status"]=="oui" ? $santecontents["contact_souscripteur"] : ($santecontents["contact1"]!=="" ? $santecontents["contact1"] : $santecontents["contact2"]))."',                
                produit_souscription = '".$santecontents["opt_produit"]."',  
                valeur_prime = '".intval(preg_replace("/[^0-9]/", "", $santecontents['MontantCotisationZone']))."',
                operateur_paiement='".$santecontents['operateur']."',
                solde_type='".$santecontents['methodePaiement']."'                                
                ".";";
        } else {
            # code...
            //AFFECTATION DU NOMBRE DE BENEFICIAIRE            
            // for ($i=1; $i <= $santecontents["nombre_enfant"] ; $i++) { 
            //     # code...
            //     if (isset($santecontents["nom_e".$i])) {
            //         # code...
            //         $nbrenfant+=$i;
            //     }
            // }
            // for ($i=1; $i <= $santecontents["nombre_adulte"] ; $i++) { 
            //     # code...
            //     if (isset($santecontents["nom_a".$i])) {
            //         # code...
            //         $nbreadulte+=$i;
            //     }
            // }
            
            // //inscription assurer principal

            //     nom = '".strtoupper($santecontents["nom"])."',  
            //     prenom = '".strtoupper($santecontents["prenom"])."',  
            //     profession = '".RemoveSpecialChar2($santecontents['profession'])."',
            //     date_naiss = '".$santecontents['date_naissance']."',
            //     sexe = '".$santecontents['sexe']."', 
            //     type_piece = '".$santecontents['type_piece']."',
            //     numero_piece = '".$santecontents['numero_piece']."',  
            //     numero_telephone = '".$santecontents['contact']."',
            //     email_souscripteur = '".$santecontents['email']."',  
            //     localite = '".$santecontents['ville']."',
            //     produit_souscription = '".$santecontents["opt_produit"]."',  
            //     operateur_paiement='".$santecontents['operateur']."',
            //     nombre_adulte = '".$santecontents["nombre_adulte"]."',  
            //     nombre_enfants = '".$santecontents["nombre_enfant"]."',
            //     lien = '".$santecontents['lien']."' 
            $requeteSouscripteur = "UPDATE souscripteur SET valeur_prime = '".intval(preg_replace("/[^0-9]/", "", $santecontents['MontantCotisationZone0']))."' 
                WHERE uniqueid = '".$santecontents['_token']."' ;";
            
            //insertion dans la table des paiemments
            $requeteSouscription = "INSERT INTO souscription SET                
                uniqueid = '".$santecontents['_token']."',
                nom = '".strtoupper($santecontents["nom"])."',  
                prenom = '".strtoupper($santecontents["prenom"])."',
                numero_telephone = '".($santecontents["status"]=="oui" ? $santecontents["contact_souscripteur"] : ($santecontents["contact1"]!=="" ? $santecontents["contact1"] : $santecontents["contact2"]))."',                
                produit_souscription = '".$santecontents["opt_produit"]."',  
                valeur_prime = '".intval(preg_replace("/[^0-9]/", "", $santecontents['MontantCotisationZone']))."',
                operateur_paiement='".$santecontents['operateur']."',
                solde_type='".$santecontents['methodePaiement']."'                                
                ".";";
            //
            // //inscription des adultes
            // for ($i=1; $i <=$santecontents["nombre_adulte"] ; $i++) { 
            //     # code...
            //     if (isset($santecontents["nom_a".$i])) {
            //         $requeteBeneficiaire="INSERT INTO beneficiaires SET                
            //         uniqueid = '".$santecontents['_token']."',
            //         nom = '".strtoupper($santecontents['nom_a'.$i])."',  
            //         prenom = '".strtoupper($santecontents['prenom_a'.$i])."',  
            //         profession = '".RemoveSpecialChar2($santecontents['profession_a'.$i])."',
            //         date_naiss = '".$santecontents['date_naissance_a'.$i]."',
            //         sexe = '".$santecontents['sexe_a'.$i]."', 
            //         type_piece = '".$santecontents['type_piece_a'.$i]."',
            //         numero_piece = '".$santecontents['numero_piece_a'.$i]."',  
            //         numero_telephone = '".$santecontents['contact_a'.$i]."',
            //         email_souscripteur = '".$santecontents['email_a'.$i]."',  
            //         localite = '".$santecontents['lieu_naissance_a'.$i]."',
            //         lien = '".$santecontents['lien_a'.$i]."'      
            //         ".";";
            //         $exec_requeteBeneficiaire = mysqli_query($db,$requeteBeneficiaire);
            //         echo ($requeteBeneficiaire);
            //     }

            // }
            // //inscription des  enfants
            // for ($j=1; $j <= $santecontents["nombre_enfant"] ; $j++) { 
            //     # code...
            //     if (isset($santecontents["nom_e".$j])) {
            //         $requeteBeneficiaire="INSERT INTO beneficiaires SET 
            //         uniqueid = '".$santecontents['_token']."',
            //         nom = '".strtoupper($santecontents['nom_e'.$j])."',  
            //         prenom = '".strtoupper($santecontents['prenom_e'.$j])."',  
            //         profession = '".RemoveSpecialChar2($santecontents['profession_e'.$j])."',
            //         date_naiss = '".$santecontents['date_naissance_e'.$j]."',
            //         sexe = '".$santecontents['sexe_e'.$j]."', 
            //         type_piece = '".$santecontents['type_piece_e'.$j]."',
            //         numero_piece = '".$santecontents['numero_piece_e'.$j]."',  
            //         numero_telephone = '".$santecontents['contact_e'.$j]."',
            //         email_souscripteur = '".$santecontents['email_e'.$j]."',  
            //         localite = '".$santecontents['lieu_naissance_e'.$j]."',
            //         lien = '".$santecontents['lien_e'.$j]."'       
            //         ".";";
            //         $exec_requeteBeneficiaire = mysqli_query($db,$requeteBeneficiaire);
            //         echo ($requeteBeneficiaire);
            //     }
            // }
        }
    }
    if ($type=="update") {
        # code...
        $requeteSouscripteur = " UPDATE souscripteur SET Payment_token = '".$payment_token."', token_notification = '".$token_notification."'  WHERE uniqueid = '".$transaction_id."' ";
        $requeteSouscription = " UPDATE souscription SET Payment_token = '".$payment_token."', token_notification = '".$token_notification."' WHERE uniqueid = '".$transaction_id."' ";
    }
    if ($type=="saveBeneficiaire") {
        $requeteSuppression = " DELETE souscripteur, beneficiaires FROM souscripteur, beneficiaires WHERE souscripteur.uniqueid='".$santecontents['_token']."' AND souscripteur.uniqueid = beneficiaires.uniqueid ";
        $exec_requeteSuppression = mysqli_query($db,$requeteSuppression);

        if ($santecontents["opt_produit"]=="individuel") {
            # code...
            $requeteSouscripteur = "INSERT INTO souscripteur SET                
                uniqueid = '".$santecontents['_token']."',
                nom = '".strtoupper($santecontents["nom"])."',  
                Prenom = '".strtoupper($santecontents["prenom"])."',  
                profession = '".RemoveSpecialChar2($santecontents['profession'])."',
                date_naiss = '".$santecontents['date_naissance']."',
                sexe = '".$santecontents['sexe']."', 
                type_piece = '".$santecontents['type_piece']."',
                numero_piece = '".$santecontents['numero_piece']."',  
                numero_telephone = '".($santecontents["status"]=="oui" ? $santecontents["contact_souscripteur"] : ($santecontents["contact1"]!=="" ? $santecontents["contact1"] : $santecontents["contact2"]))."',
                email_souscripteur = '".$santecontents['email']."',  
                localite = '".$santecontents['ville']."',
                produit_souscription = '".$santecontents["opt_produit"]."',  
                valeur_prime = '".intval(preg_replace("/[^0-9]/", "", $santecontents['MontantCotisationZone0']))."',
                operateur_paiement='".$santecontents['operateur']."',
                nombre_adulte = '".$santecontents["nombre_personnel"]."', 
                lien = '".$santecontents['lien']."'
                ".";";
            //
        } else {
            //inscription assurer principal
            $requeteSouscripteur = "INSERT INTO souscripteur SET                
                uniqueid = '".$santecontents['_token']."',
                nom = '".strtoupper($santecontents["nom"])."',  
                prenom = '".strtoupper($santecontents["prenom"])."',  
                profession = '".RemoveSpecialChar2($santecontents['profession'])."',
                date_naiss = '".$santecontents['date_naissance']."',
                sexe = '".$santecontents['sexe']."', 
                type_piece = '".$santecontents['type_piece']."',
                numero_piece = '".$santecontents['numero_piece']."',  
                numero_telephone = '".($santecontents["status"]=="oui" ? $santecontents["contact_souscripteur"] : ($santecontents["contact1"]!=="" ? $santecontents["contact1"] : $santecontents["contact2"]))."',
                email_souscripteur = '".$santecontents['email']."',  
                localite = '".$santecontents['ville']."',
                produit_souscription = '".$santecontents["opt_produit"]."',  
                valeur_prime = '".intval(preg_replace("/[^0-9]/", "", $santecontents['MontantCotisationZone0']))."',
                operateur_paiement='".$santecontents['operateur']."',
                nombre_adulte = '".$santecontents["nombre_adulte"]."',  
                nombre_enfants = '".$santecontents["nombre_enfant"]."',
                lien = '".$santecontents['lien']."' 
                ".";";
            //
            //inscription des adultes
            for ($i=1; $i <=$santecontents["nombre_adulte"] ; $i++) { 
                # code...
                if (isset($santecontents["nom_a".$i])) {
                    $requeteBeneficiaire="INSERT INTO beneficiaires SET                
                    uniqueid = '".$santecontents['_token']."',
                    nom = '".strtoupper($santecontents['nom_a'.$i])."',  
                    prenom = '".strtoupper($santecontents['prenom_a'.$i])."',  
                    profession = '".RemoveSpecialChar2($santecontents['profession_a'.$i])."',
                    date_naiss = '".$santecontents['date_naissance_a'.$i]."',
                    sexe = '".$santecontents['sexe_a'.$i]."', 
                    type_piece = '".$santecontents['type_piece_a'.$i]."',
                    numero_piece = '".$santecontents['numero_piece_a'.$i]."',  
                    numero_telephone = '".$santecontents['contact_a'.$i]."',
                    email_souscripteur = '".$santecontents['email_a'.$i]."',  
                    localite = '".$santecontents['lieu_naissance_a'.$i]."',
                    lien = '".$santecontents['lien_a'.$i]."'      
                    ".";";
                    $exec_requeteBeneficiaire = mysqli_query($db,$requeteBeneficiaire);
                    //echo ($requeteBeneficiaire);
                }

            }
            //inscription des  enfants
            for ($j=1; $j <= $santecontents["nombre_enfant"] ; $j++) { 
                # code...
                if (isset($santecontents["nom_e".$j])) {
                    $requeteBeneficiaire="INSERT INTO beneficiaires SET 
                    uniqueid = '".$santecontents['_token']."',
                    nom = '".strtoupper($santecontents['nom_e'.$j])."',  
                    prenom = '".strtoupper($santecontents['prenom_e'.$j])."',  
                    profession = '".RemoveSpecialChar2($santecontents['profession_e'.$j])."',
                    date_naiss = '".$santecontents['date_naissance_e'.$j]."',
                    sexe = '".$santecontents['sexe_e'.$j]."', 
                    type_piece = '".$santecontents['type_piece_e'.$j]."',
                    numero_piece = '".$santecontents['numero_piece_e'.$j]."',  
                    numero_telephone = '".$santecontents['contact_e'.$j]."',
                    email_souscripteur = '".$santecontents['email_e'.$j]."',  
                    localite = '".$santecontents['lieu_naissance_e'.$j]."',
                    lien = '".$santecontents['lien_e'.$j]."'       
                    ".";";
                    $exec_requeteBeneficiaire = mysqli_query($db,$requeteBeneficiaire);
                    //echo ($requeteBeneficiaire);
                }
            }
        }
    }
    if ($type=="saveEcheancier") {
        // code...
        print_r($echeancier);
        //encode back to json
        $data = json_encode($echeancier, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        //suppression du ficher s'il existe
        unlink('../echeanciers/'.$_SESSION['uniqueid'].'.json');
        //mise à jour du nouveau fichier
        file_put_contents('../echeanciers/'.$_SESSION['uniqueid'].'-'.$methode.'.json', $data);
    }
    if ($requeteSouscripteur!=="") {
        // code...
        $exec_requeteSouscripteur = mysqli_query($db,$requeteSouscripteur);
    }
    if ($requeteSouscription!=="") {
        // code...
        $exec_requeteSouscription = mysqli_query($db,$requeteSouscription);
    }
    //echo ($requeteSouscripteur.$requeteSouscription.$requeteBeneficiaire);
}

if(isset($_GET['reseauxupdate'])){
    //recuperation des infoation de centre
    $requestPayload=file_get_contents("php://input");
    //crud du reseau de soins
    file_put_contents('reseaux.json', $requestPayload);
}
//---------------------------------------------------------------
?>
