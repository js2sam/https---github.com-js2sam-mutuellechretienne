<?php
session_start();
//---------------------------------------------------------------
// connexion à la base de données
// $db_username = 'c1921668c_mucci';
// $db_password = 'Mucci2022@';
// $db_name     = 'c1921668c_souscription';
// $db_host     = '91.234.194.113';

//* connexion à la base de données test
$db_username = 'root';
$db_password = '';
$db_name     = 'c1921668c_souscription';
$db_host     = 'localhost';
$db = mysqli_connect($db_host, $db_username, $db_password,$db_name) or die('could not connect to database');
?>