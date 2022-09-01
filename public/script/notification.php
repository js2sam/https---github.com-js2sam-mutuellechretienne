<?php
require_once('dbconnection.php');
require '../PHPMailer/PHPMailerAutoload.php';

function emailconfirmation($transactionid,$type){

    //information du demandeur
    global $db;
    $rqst= "SELECT * FROM souscripteur WHERE souscripteur.uniqueid = '". $transactionid."' OR souscripteur.token_notification= '".$transactionid."'";
    $exec_rqst= mysqli_query($db, $rqst);
    $info = mysqli_fetch_assoc($exec_rqst);

    $body="";
    $subject="";
    //print_r($rqst);
    //precision du corps du mail
    if ($type=="1") {
        # code...
        $subject="Confirmation de Souscription Couverture Santé - ".strtoupper($info['nom'])." ".strtoupper($info['prenom'])." - ".strtoupper(str_replace('_',' ',$info["produit_souscription"]));
        $body="

        <h2>Bonjour ".(($info['sexe']=='M') ? 'M.' : 'Mme.' )." ".strtoupper($info['nom'])." ".strtoupper($info['prenom']).",</h2> 

        <p> Nous vous remercions pour votre adhésion en ligne. </p>
        <p> Dans le but de compléter votre dossier santé, prière transmettre pour chaque personne à couvrir :</p>
        <ul>
            <li>Une copie de la cni, de l’attestation ou du passeport pour les adultes</li>
            <li>Une copie de l’extrait de naissance pour les enfants ;</li>
            <li>Une photo d’identité ;</li>
            <li>Une copie de la carte CMU ou du récépissé ;</li>
            <li>Le reçu de paiement.</li>
            <li>Merci de télécharger votre contrat <a href='https://mutuellechretienne-ci.org/?transaction_id=".$info['uniqueid']."'>ICI</a>.</li>
        </ul>
        
        <br/>
        Cordialement";
    } else {
        # code...
        $subject="Rejet de Souscription Couverture Santé - ".strtoupper($info['nom'])." ".strtoupper($info['prenom'])." - ".strtoupper(str_replace('_',' ',$info["produit_souscription"]));
        $body="
        <h2>Bonjour ".(($info['sexe']=='M') ? 'M.' : 'Mme.' )." ".strtoupper($info['nom'])." ".strtoupper($info['prenom']).",</h2> 

        <p> Nous vous remercions pour votre tentative d'adhésion en ligne. </p>
        <p> Nous sommes cependant désolés de vous apprendre que votre paiement a malheureusement échoué.</p>
        <ul>
            <li>Merci d'essayer à nouveau en cliquant <a href='https://mutuellechretienne-ci.org/'>ICI</a>.</li>
        </ul>
        
        <br/>
        Cordialement";
    }

    

    //mail send sample code
    $mail = new PHPMailer();
    //$mail->SMTPDebug = 3;
    $mail->IsSMTP();
    $mail->SMTPAuth =true;
    $mail->SMTPSecure='tls';  //tls ssl
    $mail->Host = 'vps73274.serveur-vps.net';
    $mail->Port = 587;    // 587 465
    $mail->isHTML(true);
    $mail->CharSet='UTF-8';
    $mail->Username='souscription@amgs.africa';
    $mail->Password='Amgs@2021';
    $mail->SetFrom('souscription@amgs.africa','Souscription AMGS ');
    $mail->AddAddress($info['email_souscripteur']); 
    //$mail->AddAddress('samuel.blay@amgs.africa'); 
    //$mail->addBCC('souscription@amgs.africa');
    $mail->Subject = $subject;
    $mail->Body=$body;

    $mail->SMTPOptions = array(
        'ssl' => [
            'verify_peer' => false,
            'verify_depth' => false,
            'allow_self_signed' => false,
            'verify_peer_name' => false
        ]
    );
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        //echo 'Message sent!';
    }
}

function transactionupdate($transactionid){
    global $db;
    $data = array(
        "apikey"=> "8539322611e7c50b08515.35200648",
        "site_id"=> "622363",
        "transaction_id"=> $transactionid,
    );
    // Data is an array of key value pairs
    // to be reflected on the site$data = array
    $str_data = json_encode($data);
    //$str_data = isset($_GET['jsondata']) ? $_GET['jsondata'] : null;
    // Contains the url to post data
    $url_path = 'https://api-checkout.cinetpay.com/v2/payment/check';
    // Method specified whether to GET or
    // POST data with the content specified
    // by $data variable. 'http' is used
    // even in case of 'https'
        
    $options = array(
        'http' => array(
        'header' => "Content-Type: application/json\r\n".
                        "Content-Length: ".strlen($str_data)."\r\n".
                        "User-Agent:MyAgent/1.0\r\n",
        'method' => 'POST',
        'content' => $str_data)
    );
        
    // Create a context stream with
    // the specified options
    $stream = stream_context_create($options);
        
    // The data is stored in the 
    // result variable
    $result = file_get_contents($url_path, false, $stream);  
    $jsondata=json_decode($result, true);

    $requete = " UPDATE souscripteur SET payment_method = '".$jsondata['data']['payment_method']."', payment_statut = '".$jsondata['data']['status']."', date_souscription = '".$jsondata['data']['payment_date']."', payment_code='".$jsondata['code']."' WHERE uniqueid = '".$transactionid."' ";   
    $exec_requete = mysqli_query($db,$requete);
    $requete2 = " UPDATE souscription SET payment_method = '".$jsondata['data']['payment_method']."', payment_statut = '".$jsondata['data']['status']."', date_souscription = '".$jsondata['data']['payment_date']."', payment_code='".$jsondata['code']."' WHERE uniqueid = '".$transactionid."' ";   
    $exec_requete2 = mysqli_query($db,$requete2);

    $requete3 = " UPDATE m_users AS t1 JOIN souscripteur AS t2 ON t1.current_team_id=t2.uniqueid AND t2.token_notification='".$transactionid["notif_token"]."' SET t1.premiere_fois = 'non'";       
        $exec_requete3 = mysqli_query($db,$requete3);

    //! si le resultat de la transaction est ACCEPTED on envoie un mail
    if ($jsondata['data']['status']=="ACCEPTED") {
        # code...
        //! envoie du mail de confirmation
        emailconfirmation($transactionid,"1");
    }
    else {
        # code...
        //! envoie du mail de confirmation
        emailconfirmation($transactionid,"2");
    }
        
}
function transactionupdate2($transactionid){
    global $db;
    // $data = array(
    //     "apikey"=> "8539322611e7c50b08515.35200648",
    //     "site_id"=> "622363",
    //     "transaction_id"=> $transactionid,
    // );
    // // Data is an array of key value pairs
    // // to be reflected on the site$data = array
    // $str_data = json_encode($data);
    // //$str_data = isset($_GET['jsondata']) ? $_GET['jsondata'] : null;
    // // Contains the url to post data
    // $url_path = 'https://api-checkout.cinetpay.com/v2/payment/check';
    // // Method specified whether to GET or
    // // POST data with the content specified
    // // by $data variable. 'http' is used
    // // even in case of 'https'
        
    // $options = array(
    //     'http' => array(
    //     'header' => "Content-Type: application/json\r\n".
    //                     "Content-Length: ".strlen($str_data)."\r\n".
    //                     "User-Agent:MyAgent/1.0\r\n",
    //     'method' => 'POST',
    //     'content' => $str_data)
    // );
        
    // // Create a context stream with
    // // the specified options
    // $stream = stream_context_create($options);
        
    // // The data is stored in the 
    // // result variable
    // $result = file_get_contents($url_path, false, $stream);  
    // $jsondata=json_decode($result, true);
    
    
        # code...
        //mise à jour de la table souscripteur
        $requete = " UPDATE souscripteur SET payment_method = 'OM', payment_statut = '".$transactionid['status']."', date_souscription = '".date("Y-m-d H:i:s")."', payment_code='".$transactionid["txnid"]."' WHERE token_notification = '".$transactionid["notif_token"]."' ";
        $exec_requete = mysqli_query($db,$requete);
        //mise à jour de la table souscripteur
        $requete2 = " UPDATE souscription SET payment_method = 'OM', payment_statut = '".$transactionid['status']."', date_souscription = '".date("Y-m-d H:i:s")."', payment_code='".$transactionid["txnid"]."' WHERE token_notification = '".$transactionid["notif_token"]."' ";  
        //mise à jour de la table user      
        $exec_requete2 = mysqli_query($db,$requete2);
        $requete3 = " UPDATE m_users AS t1 JOIN souscripteur AS t2 ON t1.current_team_id=t2.uniqueid AND t2.token_notification='".$transactionid["notif_token"]."' SET t1.premiere_fois = 'non'";       
        $exec_requete3 = mysqli_query($db,$requete3);

    //! si le resultat de la transaction est ACCEPTED on envoie un mail success
    if ($transactionid['status']=="SUCCESS") {
        # code...
        //! envoie du mail de confirmation
        emailconfirmation($transactionid['notif_token'],"1");
    }
    else {
        # code...
        //! envoie du mail de confirmation
        emailconfirmation($transactionid['notif_token'],"2");

    }
        
}

$site_id=622363;
$recept_cpm_trans_id = isset($_GET['cpm_trans_id']) ? $_GET['cpm_trans_id'] : $_POST['cpm_trans_id'];
$recept_cpm_site_id = isset($_GET['cpm_site_id']) ? $_GET['cpm_site_id'] : $_POST['cpm_site_id'];

$body = file_get_contents("php://input");
//$object = json_decode($body, true);
//file_put_contents('notification.json', $body);

if ( $recept_cpm_trans_id && $recept_cpm_site_id) {
    if ($site_id==$recept_cpm_site_id) {
        # code...
        //? ecriture des informations de l'utilisateur dans la base de donnee
        transactionupdate($recept_cpm_trans_id);
        
        //$transaction_id="transaction_id1=".$recept_cpm_trans_id;
        //$site_id="site_id1=".$recept_cpm_site_id;
        //file_put_contents("datapaiement.json", $site_id." ".$transaction_id);
    }
    
}
if (isset($_REQUEST)) {
    # code...
    $body = file_get_contents("php://input");
    $object = json_decode($body, true);
    
    file_put_contents('notification.txt', $body);
    //file_put_contents('notification.txt', $object);

    //
    //? ecriture des informations de l'utilisateur dans la base de donnee
    transactionupdate2($object);

}
?>
