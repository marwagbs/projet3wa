<?php
// Dépendances
require_once "models/Feedback.php";

require_once 'services/utils.php';
require "services/Session.php";
Session::start();

$feedbackM=new Feedback;

$message="";
if (!empty($_POST)){
    //Vérification de l'existence de la clé et de si elle est bien remplie.
   if(array_key_exists('comment', $_POST) && !empty($_POST['comment'])) {
       //Extraction des variables depuis le POST
        extract($_POST);
        $id=$_SESSION['login']['id'];
        //insertion des données dans la BDD
        $feedbackM->add([
            ":comment" => htmlspecialchars(stripslashes($comment)),
            ":user_id"=>htmlspecialchars(stripslashes( $id)),
            
        ]);
        //si l'insertion est b1 faite un msg s'affiche
    $message="Merci pour votre commentaire!";
}
}

$pagePath = 'feedback';

// Rendu de la vue
render(__DIR__."/views/$pagePath",compact('feedbackM','message'));


