<?php
require_once('gfonctions.php');
include 'notificationInscription.php';	

//recuperation des données login
//create an array
$resultarray = array();
$count="";

function logger($mail,$password)
{
    global $db;
    # code...    
    if (isset($mail)){            
        //verification en base de donnee
        $requete = "SELECT count(*),
        nom,
        prenom,
        contact,
        civilite,
        type_user,
        premiere_fois,
        current_team_id,
        email                
        FROM 
        m_users 
        WHERE email = '".$mail."' AND password = '".md5($password)."' ";
        //resultat
        $exec_requete = mysqli_query($db,$requete);
        //$reponse = mysqli_fetch_array($exec_requete);
        
        while($row =mysqli_fetch_assoc($exec_requete))
        {
            $resultarray[] = $row;
            if ($row['count(*)']==1) {
                # code...
                $resultarray['auth'] = 1;
                $_SESSION["nom_user"]=$row['nom'];
                $_SESSION["prenom_user"]=$row['prenom'];
                $_SESSION["civilite"]=$row['civilite'];
                $_SESSION["email"]=$row['email'];
                $_SESSION["type_user"]=$row['type_user'];
                $_SESSION["uniqueid"]=$row['current_team_id'];					

            } else {
                # code...
                $resultarray['auth'] = 0;
            }
            if ($row['premiere_fois']=="oui") {
                # code...
                $_SESSION["isPremierPaiement"]=true;
            }
            else{
                $_SESSION["isPremierPaiement"]=false;
            }
        }

        //verification que l'utilisateur à realiser au moins une souscription
        if (isset($_SESSION["uniqueid"])) {
            # code...
            $verificationSouscription = "SELECT count(*)
            FROM souscription
            WHERE uniqueid = '".$_SESSION["uniqueid"]."'";
            //resultat
            $exec_verificationSouscription = mysqli_query($db,$verificationSouscription);
            //affectation du nombres de souscription
            $row =mysqli_fetch_assoc($exec_verificationSouscription);
            $resultarray['verificationSouscription'] = $row['count(*)'];
        }

        //mise au format json des informations
        $count= json_encode($resultarray);
        echo $count;

    }
}

function mailVerification($mail)
{
    global $db;
    # code...
    $valid=0;
    //verification en base de donnee
        $requete = "SELECT count(*)                
        FROM 
        m_users 
        WHERE email = '".$mail."'";
        //print_r($requete);
        
        //resultat
        $exec_requete = mysqli_query($db,$requete);
        while($row =mysqli_fetch_assoc($exec_requete))
        {
            $valid = $row['count(*)'];
        }

        //print_r($valid);
        
        return $valid;
}


//connexion
if (isset($_POST['l_email'])){

    logger($_POST['l_email'],$_POST['lpassword']);
}
//inscription
if (isset($_POST['r_email'])){
    $id=ID();
    //echo $_POST['r_email'];
    $mailExist=mailVerification($_POST['r_email']);
    if ($_POST['password_verif']==$_POST['r_password'] && $mailExist=="0") {
        # code...
        $requete = "INSERT INTO m_users SET
            nom = '".strtoupper($_POST['name'])."',
            prenom = '".strtoupper($_POST["firstname"])."',  
            contact = '".$_POST['contact']."',
            civilite = '".$_POST['civilite']."',
            type_user = '".RemoveSpecialChar3($_POST['TypeMembreRegister'])."', 
            email = '".$_POST['r_email']."',
            password = '".md5($_POST['r_password'])."',
            current_team_id='".$id."'       
            ";
        $exec_requete = mysqli_query($db,$requete);
        //echo($requete);
		
		//email de confirmation d'inscription
		emailconfirmationinscription($id,$_POST['r_password']);
        //connexion
        logger($_POST['r_email'],$_POST['r_password']);
    }
    else{

        $resultarray['auth'] = 0;
        $count = json_encode($resultarray);
        echo $count;

    }
}
if (isset($_POST['recup_email'])){
    $oldpass="";
    //verification de l'existance du mail
    $mailExist=mailVerification($_POST['recup_email']);
    //verification en base de donnee
    $requete = "SELECT * FROM 
    m_users 
    WHERE email = '".$_POST['recup_email']."'";    
    //resultat
    $exec_requete = mysqli_query($db,$requete);
    while($row =mysqli_fetch_assoc($exec_requete))
    {
        $oldpass = $row['password'];
    }

    if ($_POST['text_recup_email']=="") {
        # code...
        if ($mailExist == "0") {
            # code...
            $resultarray['auth'] = 0;
        }
        else {
            # code...
                        
            //email de confirmation d'inscription
            emailRecuperation($_POST['recup_email'],$oldpass);
            $resultarray['auth'] = 1;
            $resultarray['pass'] = 1;
        }
        $count = json_encode($resultarray);
        echo $count;
    }
    else {
        # code...
        if ($_POST['recup_password']==$_POST['confirm_recup_password'] && $_POST['text_recup_email']==$oldpass) {
            # code...
            //verification en base de donnee
            $requete = "UPDATE
            m_users 
            SET
            m_users.password='".md5($_POST['recup_password'])."'
            WHERE m_users.email = '".$_POST['recup_email']."'";    
            //resultat
            $exec_requete = mysqli_query($db,$requete);
            logger($_POST['recup_email'],$_POST['recup_password']);
        }
    }
}
    
?>