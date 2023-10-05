<?php
//affichage de la page de connexion
//Appel de nos class nécessaires
require_once "models/User.php";
require_once "services/Session.php";
require "services/utils.php";
$checkUser= new User;
$email="";
$password="";
$errors=[];
function postData($data){
    $_POST[$data] ??= "";
    return (htmlspecialchars(stripslashes($_POST[$data])));
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  
    $email=postData('email');
    $password=postData('password');
    
     if(!$email){
        $errors['email']="L'adreese e-mail est obligatoire";
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email']="Veuillez renseigner une adresse email valide";
    }
    if(!$password){
        $errors['password']="Le mot de passe est obligatoire";
    }
    
    if(count($errors) === 0){
        $user= $checkUser->findByEmail($email);
        try {
            // Si la méthode ne renvoie rien.
            if (empty($user)) {
                $errors["email"]="cette adresse email ne correspond à aucun compte";
            } else{
                //Utilisateur existe, on vérifie le MDP.
                if (password_verify($password, $user['password'])) {
                    //On enregirste l'utilisateur dans la session
                    Session::start();
                    //ça si que nous vient de la BDD
                    Session::init($user['id'],$user['first_name'], $user['last_name'], $email, $user['is_admin']);
                    Session::setError(); // Vider l'historique de notifs
                    header("location: index.php");
                } else {
                    //MDP invalide
                    $errros["password"]="Le mot de passe est incorrecte";
                }
            }
        } catch (DomainException $e) {
            echo $e->getMessage();
        }
    }
}







// if(!empty($_POST)) {
//     //Vérification de l'existence de la clé et de si elle est bien remplie.
//      if(array_key_exists('mail', $_POST) && !empty($_POST['mail']) && array_key_exists('password', $_POST) && !empty($_POST['password'])) {
//         //Extraction des variables depuis le POST
//         extract($_POST);
//         //Appel de la fonction pour vérifier l'email.
//         $user= $checkUser->findByEmail($mail);
//         try {
//             // Si la méthode ne renvoie rien.
//             if (empty($user)) {
//                 $message="cet email n'existe pas";
//             } else{
//                 //Utilisateur existe, on vérifie le MDP.
//                 if (password_verify($password, $user['password'])) {
//                     //On enregirste l'utilisateur dans la session
//                     Session::start();
//                     //ça si que nous vient de la BDD
//                     Session::init($user['id'],$user['first_name'], $user['last_name'], $mail, $user['is_admin']);
//                     Session::setError(); // Vider l'historique de notifs
//                     header("location: index.php");
//                 } else {
//                     //MDP invalide
//                     $message="mot de passe erroné";
//                 }
//             }
//         } catch (DomainException $e) {
//             echo $e->getMessage();
//         }
//      }
// }



// Titre de la page

$pagePath = 'authentification_user';

// Rendu de la vue
render(__DIR__."/views/$pagePath", compact('checkUser','errors','email','password'));