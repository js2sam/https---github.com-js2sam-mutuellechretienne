<?php
//-----------------------------------------------
session_start();
// connexion à la base de données
$db1_username = 'root';
$db1_password = 'amgs2020';
$db1_name     = 'souscription_test';
$db2_name     = 'souscription';
$db1_host     = 'localhost';
$db1 = mysqli_connect($db1_host, $db1_username, $db1_password,$db1_name) or die('could not connect to database');
$db2 = mysqli_connect($db1_host, $db1_username, $db1_password,$db2_name) or die('could not connect to database');
//---------------------------------------------------------------
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
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
    $res = strtr( $str, $unwanted_array );
    // Returning the result  
    return $res;
}  
$n1="";
$n2="";
$date_demande=date("Y-m-d H:i:s");
if (isset($_POST['nom'])) {
    # code...
    $n1 = mysqli_real_escape_string($db2,htmlspecialchars(strtolower(RemoveSpecialChar1(RemoveSpecialChar2($_POST['nom'])))));
  }
if (isset($_POST['prenom'])) {
# code...
    $n2 = mysqli_real_escape_string($db2,htmlspecialchars(strtolower(RemoveSpecialChar1(RemoveSpecialChar2($_POST['prenom'])))));
}
$NometPrenom=$n1." ".$n2;
if (isset($_POST['RaisonSociale'])) {
    # code...
        $RaisonSociale = mysqli_real_escape_string($db2,htmlspecialchars(strtolower(RemoveSpecialChar1(RemoveSpecialChar2($_POST['RaisonSociale'])))));
    }else { $RaisonSociale="";}
$date_naiss=mysqli_real_escape_string($db2,htmlspecialchars($_POST['date_naiss']));
$sexe=mysqli_real_escape_string($db2,htmlspecialchars($_POST['sexe']));
$piece=mysqli_real_escape_string($db2,htmlspecialchars($_POST['piece']));
$numpiece = mysqli_real_escape_string($db2,htmlspecialchars(strtolower(RemoveSpecialChar1(RemoveSpecialChar2($_POST['numpiece'])))));
$tel=mysqli_real_escape_string($db2,htmlspecialchars(strtolower(RemoveSpecialChar1(RemoveSpecialChar2($_POST['phone_number'])))));
$email=mysqli_real_escape_string($db2,htmlspecialchars($_POST['email']));
$habitation=mysqli_real_escape_string($db2,htmlspecialchars($_POST['habitation']));
if (isset($_POST['NombreAdulte'])) {
  # code...
  $NombreAdulte = mysqli_real_escape_string($db2,htmlspecialchars(strtolower(RemoveSpecialChar1(RemoveSpecialChar2($_POST['NombreAdulte'])))));
}else { $NombreAdulte=0;}
if (isset($_POST['nbre_emp1'])) {
  # code...
  $nbre_emp1 = mysqli_real_escape_string($db2,htmlspecialchars(strtolower(RemoveSpecialChar1(RemoveSpecialChar2($_POST['nbre_emp1'])))));
}else { $nbre_emp1=0;}    
if (isset($_POST['nbre_conj'])) {
  # code...
  $nbre_conj = mysqli_real_escape_string($db2,htmlspecialchars(strtolower(RemoveSpecialChar1(RemoveSpecialChar2($_POST['nbre_conj'])))));
}else { $nbre_conj=0;}
if (isset($_POST['nbre_autres_assure'])) {
  # code...
  $nbre_autres_assure = mysqli_real_escape_string($db2,htmlspecialchars(strtolower(RemoveSpecialChar1(RemoveSpecialChar2($_POST['nbre_autres_assure'])))));
}else { $nbre_autres_assure=0;}
if (isset($_POST['NombreEnfant'])) {
    # code...
    $nbre_enft = mysqli_real_escape_string($db2,htmlspecialchars(strtolower(RemoveSpecialChar1(RemoveSpecialChar2($_POST['NombreEnfant'])))));
  }else { $nbre_enft=0;}

$formuleCouverture=mysqli_real_escape_string($db2,htmlspecialchars(strtolower(RemoveSpecialChar1(RemoveSpecialChar2($_POST['formuleCouverture'])))));

$total_prime=intval(str_replace( array( ' ' ), '',$_POST['total_prime'])); 

if($NometPrenom !==""){
  $requete = "INSERT INTO presouscripteur
  (raison_social,nom_prenom,date_naiss,sexe_sous,piece_sous,numpiece_sous,numtel_sous,email_sous,localite,nbre_adulte,nbre_enf_sous,nbre_conj_sous,nbre_autrass_sous,date_sous,produit_souscription,valeur_prime)
  VALUES ('$RaisonSociale','$NometPrenom','$date_naiss','$sexe','$piece','$numpiece','$tel','$email','$habitation','$NombreAdulte','$nbre_enft','$nbre_conj','$nbre_autres_assure','$date_demande','$formuleCouverture','$total_prime')";
  $exec_requete = mysqli_query($db1,$requete);
  print_r($requete);
  header('Location: ../index.php?redirect=1');

            
}else {
    //lorsque tout est echoue on vas sur la page principale echec
    header('Location: ../index.php?redirect=2');
}





//-----------------------------------------------
?>