<?php
//affichage de la page de connexion
//Appel de nos class nécessaires
require_once "models/User.php";
require_once "services/Session.php";
require "services/utils.php";
$token= new User;
$message="";
if (isset ($_GET['token']) AND !empty($_GET["token"]))
        {
            $email=$token->findToken($_GET['token']);

            if($email)
            {        
        //si le formulaire est correctement remplie
                if(!empty($_POST)){
                if ((isset($_POST["newPassword"]) AND !empty($_POST["newPassword"])) AND (isset($_POST["confirmPassword"]) AND !empty($_POST["confirmPassword"] )))
                {
                    //si les deux mot de passe sont identique    
                    if($_POST["newPassword"]=== $_POST["confirmPassword"]){
                            // var_dump($_POST["newPassword"], $_POST["confirmPassword"]);
                            // die;
                            $hashedPassword= password_hash(htmlspecialchars(stripslashes($_POST["newPassword"])),PASSWORD_DEFAULT);

                            $res=$token->updatePassword( $hashedPassword, $email);

                            $message= "Mot de passe modifié avec succés !!";
                    header ("Refresh:2;URL=https://mad-up.fr/fr/connexion");
                    //si les deux mot de passe ne sont pas identique
                    }else{
                    $message= "Les deux mot de passe ne sont pas identiques";
                    
                    }
                }
                //si l'utilisateur essaye de renvoyer un formulire vide
                else{
                    $message= "Veuillez remplir tous les champs du formulaire";
                }
                }
                
                include "views/formForgotPassword.phtml";

            }
    else{
        echo 'Votre lien n\'est plus valide';
        header ("Refresh:2;URL=https://marwaghedamssi.sites.3wa.io/projet_3wa/authentification.php");
    }
