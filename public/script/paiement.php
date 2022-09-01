<?php
//**formatage des numeros de telephone******************* */
// function formatPhoneNumber($phoneNumberString) {
//   $cleaned = ('' + $phoneNumberString).str_replace(/\D/g, '');
//   $match = $cleaned.match(/^(1|)?(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/);
//   if ($match) {
//     //var intlCode = (match[1] ? '+1 ' : '');
//     return [ $match[2], ' ', $match[3], ' ', $match[4], ' ', $match[5], ' ', $match[6]].join('');
//   }
//   return null;
// }
$messageValue="";
$reponse=[];
//Fonction paiement orange------------------------------------------
//Generateur de jeton
function TokenGenerator($str_data){
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.orange.com/oauth/v3/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "grant_type=client_credentials",
        CURLOPT_HTTPHEADER => array(
            // Set here requred headers                
            "Authorization: Basic V2lBZUFEd2JJZEJiWlpVd05HUW9BZXlBRjQ4bjV6emY6Z0tWS251MDdIZUdUYjhlWg=="
        ),
    ));       
    $response = curl_exec($curl);
    $err = curl_error($curl);        
    
    curl_close($curl);

    if ($err) {
        $value="cURL Error #:" . $err;
        $messageValue=$value;
    } else {
        $messageValue=json_decode($response,true) ;
    }
    PaiementInitiation($messageValue['access_token'],$str_data);
}
function PaiementInitiation($request,$str_data){
    $token =$request;
    // Make Post Fields Array intval(preg_replace("/[^0-9]/", "", $str_data['MontantCotisationZone']))
    $data = [            
        "merchant_key"=> "512cfd56",
        "currency"=> "OUV",
        "order_id"=> $str_data['_token'].rand(0,999),
        "amount"=>100 , 
        "return_url"=> "https://mutuellechretienne-ci.org/?transaction_id=".$str_data['_token'],
        "cancel_url"=> "https://mutuellechretienne-ci.org/", 
        "notif_url"=> "https://mutuellechretienne-ci.org/script/notification.php", 
        "lang"=> "fr", 
        "reference"=> "ref Merchant TestOPE_0019078"            
    ];

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.orange.com/orange-money-webpay/dev/v1/webpayment",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            // Set here required headers 
            "Content-Type: application/json",
            "Accept: application/json",
            "Cache-Control: no-cache",
            "Authorization: Bearer ".$token               
        ),
    
    ));     
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    
    if ($err) {
        $messageValue="cURL Error #:" . $err;
    } else {
        $messageValue=json_decode($response,true);
        
    }
    //print_r($messageValue);
    // $url=$messageValue['payment_url'];
    // header("Location: ".$url);   
    $reponse["code"]=$messageValue['status'];
    $reponse["payment_url"]=$messageValue['payment_url'];
    $reponse["payment_token"]=$messageValue['pay_token'];
    $reponse["notif_token"]=$messageValue['notif_token'];
    $reponse["transaction_id"]=$str_data['_token'];
    $reponse=json_encode($reponse);
    echo $reponse;
}
//fonction de cinetpay----------------------------------------------
function PaiementGenerator($str_data){
    // Make Post Fields Array intval(preg_replace("/[^0-9]/", "", $str_data['MontantCotisationZone']))
    $data = [            
        "amount"=> 100, 
        "apikey"=> "8539322611e7c50b08515.35200648",
        "site_id"=> "622363",
        "currency"=> "XOF",
        "alternative_currency"=> "EUR",
        "transaction_id"=> $str_data['_token'],
        "customer_email"=> $str_data['email'],
        "customer_phone_number"=> $str_data['contact_souscripteur'],
        "customer_address"=> "BP502",
        "customer_city"=> $str_data['ville'],
        "customer_country"=> "CI",
        "customer_state"=> "CI",
        "customer_zip_code"=> "00225",
        "description"=> "PRODUIT COUVERTURE MALADIE",
        "customer_name"=> strtoupper($str_data['nom_souscripteur'])." (Tel: ".$str_data['contact_souscripteur'].")",
        "customer_surname"=> strtoupper($str_data['prenom_souscripteur']),
        "return_url"=> "https://mutuellechretienne-ci.org/index.php?transaction_id=".$str_data['_token'], 
        "notify_url"=> "https://mutuellechretienne-ci.org/script/notification.php",   
    ];


    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api-checkout.cinetpay.com/v2/payment",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            // Set here requred headers 
            "Accept: application/json",
            "Content-Type: application/json",            
        ),
    
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
        $messageValue="cURL Error #:" . $err;
    } else {
        $messageValue=json_decode($response, true);
    }
    //print_r($messageValue);
    //print_r($messageValue['data']['payment_url']);
    //header("Location: ".$url);
    //$reponse["notif_token"]=$messageValue['notif_token'];
    $reponse["code"]=$messageValue['code'];
    $reponse["payment_url"]=$messageValue['data']['payment_url'];
    $reponse["payment_token"]=$messageValue['data']['payment_token'];
    $reponse["transaction_id"]=$str_data['_token'];
    $reponse=json_encode($reponse);
    echo $reponse;
}

if (isset($_GET['paieprocess'])) {
// Data is an array of key value pairs
// to be reflected on the site$data = array
$str_data = isset($_GET['jsondata']) ? $_GET['jsondata'] : null;
$str_data = json_decode($str_data,true);
if ($str_data['operateur']=='orange') {
    # code...
    TokenGenerator($str_data);
}
if ($str_data['operateur']=='moov' || $str_data['operateur']=='mtn' || $str_data['operateur']=='visa') {
    # code...
    PaiementGenerator($str_data);
}

/*
//$str_data = isset($_GET['jsondata']) ? $_GET['jsondata'] : null;
// Contains the url to post data
$url_path = 'https://api-checkout.cinetpay.com/v2/payment';
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
echo $result;*/
//print_r($jsondata);
}
?>  