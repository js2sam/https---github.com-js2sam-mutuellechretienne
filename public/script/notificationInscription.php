<?php
require_once('dbconnection.php');
require_once('gfonctions.php');
require '../PHPMailer/PHPMailerAutoload.php';


//email de confirmation d'inscription
function emailconfirmationinscription($uniqueid,$mdp){

    //information du demandeur
    global $db;
    $rqst= "SELECT * FROM m_users WHERE m_users.current_team_id = '". $uniqueid."' ";
    $exec_rqst= mysqli_query($db, $rqst);
    $info = mysqli_fetch_assoc($exec_rqst);

    
    //precision du responsable à qui envoyer le mail

    //mail send sample code
    $mail = new PHPMailer();
    //$mail->SMTPDebug = 3;
    $mail->IsSMTP();
    $mail->SMTPAuth =true;
    $mail->SMTPSecure='ssl';  //tls ssl
    $mail->Host = 'web44.lws-hosting.com';
    $mail->Port = 465;    // 587 465
    $mail->isHTML(true);
    $mail->CharSet='UTF-8';
    $mail->Username='info@mutuellechretienne-ci.org';
    $mail->Password='IF@202207';
	//$mail->Username='souscription@amgs.africa';
    //$mail->Password='Amgs@2021';
    $mail->SetFrom('info@mutuellechretienne-ci.org','Adhesion Mutuelle Chretienne');
    $mail->AddAddress($info['email']); 
    //$mail->AddAddress('samuel.blay@amgs.africa'); 
    $mail->addBCC('bsjsam@gmail.com');
    $mail->Subject = "Confirmation d'adhésion mutuelle chretienne " ;
    $mail->Body="

    <h2>Bienvenue ".(($info['civilite']=='Monsieur') ? 'M.' : 'Mme.' )." ".strtoupper(firstupper($info['nom']))." ".strtoupper(firstupper($info['prenom'])).",</h2> 

    <p> Nous vous remercions pour votre adhésion à la Mutuelle Chrétienne de Côte d’Ivoire. </p>
	<p>Vous êtes redevable du droit d'adhésion de 10 000 FCFA. </p>
    <p>Prière renseigner le questionnaire relatif aux informations de vos bénéficiaires dans le but de compléter votre contrat.</p>
    <p>Merci de prendre connaissance de l'intégralité de nos <a href='https://mutuellechretienne-ci.org/reglements.php'>Statuts et Règlements Intérieurs</a> . </p>
    <br/>
	
	<p><a href='https://mutuellechretienne-ci.org/reglements.pdf' target='_blank' rel='noopener noreferrer'>Connectez-vous</a> à votre espace afin de continuer vos enregistrements et effectuer vos paiements.</p>
                      
    <br/>
    Cordialement
    <p><strong>Mutuelle Chrétienne de Côte d’Ivoire</strong></p>";

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

//email de confirmation d'enregistrement des beneficiaires
function emailConfirmationEnregistrementBeneficiaire($uniqueid){
	//information du demandeur
    global $db;
    //$rqst= "SELECT * FROM souscription WHERE souscription.uniqueid = '". $uniqueid."' ";
    $rqst= "SELECT * FROM m_users WHERE m_users.current_team_id = '". $uniqueid."' ";
    $exec_rqst= mysqli_query($db, $rqst);
    $info = mysqli_fetch_assoc($exec_rqst);

    //mail send sample code
    $mail = new PHPMailer();
    //$mail->SMTPDebug = 3;
    $mail->IsSMTP();
    $mail->SMTPAuth =true;
    $mail->SMTPSecure='ssl';  //tls ssl
    $mail->Host = 'web44.lws-hosting.com';
    $mail->Port = 465;    // 587 465
    $mail->isHTML(true);
    $mail->CharSet='UTF-8';
    $mail->Username='info@mutuellechretienne-ci.org';
    $mail->Password='IF@202207';
	// $mail->Username='souscription@amgs.africa';
    // $mail->Password='Amgs@2021';
    $mail->SetFrom('info@mutuellechretienne-ci.org','Adhesion Mutuelle Chretienne');
    $mail->AddAddress($info['email']); 
    //$mail->AddAddress('samuel.blay@amgs.africa'); 
    $mail->addBCC('bsjsam@gmail.com');
	$mail->addAttachment('Convention BEKAGNI.pdf');
    $mail->Subject = "Confirmation d'enregistrement de vos beneficiaires" ;
    $mail->Body="

    <h2>Bonjour ".(($info['civilite']=='Monsieur') ? 'M.' : 'Mme.' )." ".strtoupper(firstupper($info['nom']))." ".strtoupper(firstupper($info['prenom'])).",</h2> 

    <p>	Nous vous remercions pour votre adhésion à la mutuelle chretienne. </p>
	<p>L'enregistrement de vos bénéficiaires à été bien effectué</p>
    <p>Merci de les verifier dans la liste ci-dessous</p>
    <br/>
	<p>+ LISTE DES BENEFICIAIRES DE VOTRE COUVERTURE MALADIE +</p>
	<br/>
	<p>NB:En cas de modification un nouveau mail vous sera envoyé</p>

    ".$_SESSION["membresValues"]."                      
    <br/>
    <br/> Cordialement";

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

//email de recupearation de mot de passe
function emailRecuperation($email,$mdpcode){

    //information du demandeur
    global $db;
    $rqst= "SELECT * FROM m_users WHERE m_users.email = '". $email."' ";
    $exec_rqst= mysqli_query($db, $rqst);
    $info = mysqli_fetch_assoc($exec_rqst);

    //print_r($info);
    //precision du responsable à qui envoyer le mail

    //mail send sample code
    $mail = new PHPMailer();
    //$mail->SMTPDebug = 3;
    $mail->IsSMTP();
    $mail->SMTPAuth =true;
    $mail->SMTPSecure='ssl';  //tls ssl
    $mail->Host = 'web44.lws-hosting.com';
    $mail->Port = 465;    // 587 465
    $mail->isHTML(true);
    $mail->CharSet='UTF-8';
    $mail->Username='info@mutuellechretienne-ci.org';
    $mail->Password='IF@202207';
	// $mail->Username='souscription@amgs.africa';
    // $mail->Password='Amgs@2021';
    $mail->SetFrom('info@mutuellechretienne-ci.org','Alerte de sécurité critique');
    $mail->AddAddress($info['email']); 
    //$mail->AddAddress('samuel.blay@amgs.africa'); 
    $mail->addBCC('bsjsam@gmail.com');
    $mail->Subject = "Demande de réinitialisation du mot de passe associé à votre compte mutuelle chretienne" ;
    $mail->Body="

    <h2>Bonjour ".(($info['civilite']=='Monsieur') ? 'M.' : 'Mme.' )." ".strtoupper(firstupper($info['nom']))." ".strtoupper(firstupper($info['prenom'])).",</h2> 

    <p>La mutuelle chretienne a reçu une demande de récupération de l'accès au compte ".$info['email']."

    <p>Si vous êtes à l'origine de cette demande, merci d'utiliser le code de reinitialisation suivant : <strong>".$mdpcode."</strong>.</p>

    <p>Si vous n'êtes pas à l'origine de cette demande, vous pouvez ignorer ce mail.</p>

    <br/>
    Cordialement,
    L'équipe de la mutuelle chretienne.
    ";

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

if(isset($_GET['sendmail'])) {
    # code...
	$typeDeMail=isset($_GET['typeDeMail']) ? $_GET['typeDeMail'] : null ;
	
    if($typeDeMail=='2'){
		emailConfirmationEnregistrementBeneficiaire($_SESSION["uniqueid"]);
	}

}

?>
