<?php
//page de la réservation d'une table
// Dépendances
require_once "models/Reservation.php";
require_once "services/Session.php";
require_once 'services/utils.php';
Session::start();


$reservationM=new reservation;

$message="";
if (!empty($_POST)){
    //Vérification de l'existence de la clé et de si elle est bien remplie.
   if(isset($_POST['number'],$_POST['date']) && !empty($_POST['number']) && !empty($_POST['date'])) {
       //Extraction des variables depuis le POST
        extract($_POST);
        $id=$_SESSION['login']['id'];
        //insertion des données dans la BDD
        $reservationM->add([
            ":number" => htmlspecialchars(stripslashes($number)),
            ":date" =>htmlspecialchars(stripslashes( $date)),
            ":time" =>htmlspecialchars(stripslashes($time)),
            ":user_id"=> htmlspecialchars(stripslashes($id)),
            
        ]);
        //si l'insertion est b1 faite un msg s'affiche
       $message="Your reservation was successfull!";

       
   }else{
       $message="*Tous les champs doivent être complétés";
   }
   
}
 

$pagePath = 'reservation';

// Rendu de la vue
render(__DIR__."/views/$pagePath", compact('reservationM','message'));