<?php
//affichage de la page d'inscription
//Appel de fichier User.
require_once "models/User.php";
require_once "services/Session.php";
require_once 'services/utils.php';

$addUser= new User; 
$errors=[];
$firstName="";
$lastName="";
$phoneNumber="";
$email="";
$password="";
$confirm_password="";
function postData($data){
    $_POST[$data] ??= "";
    return (htmlspecialchars(stripslashes($_POST[$data])));
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstName=postData('firstname');
    $lastName=postData('lastname');
    $phoneNumber=postData('phonenumber');
    $email=postData('email');
    $password=postData('password');
    $confirm_password=postData('confirm_password');
    $is_news=postData('isnews');
    $invalidCheck=postData('invalidCheck');
    //mot de passe compliqué
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    // var_dump($firstName,$lastName,$phoneNumber,$email,$password,$confirm_password, $is_news);
    if(!$firstName){
        $errors['firstname']="le prénom est obligatoire";
    }else if(strlen($firstName)<4 || strlen($firstName)>16 ){
        $errors['firstname']="le prénom doit etres compris entre 6 et  16 caractères";
    }
 
   if(!$lastName){
        $errors['lastname']="le nom est obligatoire";
    }else if(strlen($lastName)<6 || strlen($lastName)>18 ){
        $errors['lastname']="le nom doit etres compris entre 6 et  16 caractères";
    }
    if(!$phoneNumber){
        $errors['phonenumber']="le numéro de téléphone est obligatoire";
    }
    if(!$email){
        $errors['email']="l'adreese e-mail est obligatoire";
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email']="Veuillez renseigner une adresse email valide";
    }
    if(!$password){
        $errors['password']="le mot de passe est obligatoire";
    } else if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){
        $errors['password']="Le mot de passe doit comporter au moins 8 caractères et doit inclure au moins une lettre majuscule, un chiffre et un caractère spécial.";
    }
    if(!$confirm_password){
        $errors['confirm_password']="la confirmation de  mot de passe est obligatoire";
    }
    if($password && $confirm_password && strcmp($password,$confirm_password)!==0){
        $errors['confirm_password']="le mot de passe n'est pas identique";
    }
    if(!$invalidCheck){
        $errors['invalidCheck']="Vous devez accepter avant de soumettre.";
    }
    
    if(count($errors) === 0){
        //Verifier si mail exist
            if ($addUser->findByEmail($email))
            {
                $errors['email']="Cette adreese email existe déja";
            }
            else{
        
         $addUser->add([
                ':email' => $email,
                ':password' => password_hash($password,PASSWORD_DEFAULT),
                ':firstName' => $firstName,
                ':lastName' => $lastName,
                ':phoneNumber' => $phoneNumber,
                ':isNews' => $isnews ? 1: 0
                ]);
            header("location: authentification.php");
            exit();
        }
    }
}

//AFFICHAGE À TRAVERS LA VIEW
$pagePath = 'registration_user';

// Rendu de la vue
render(__DIR__."/views/$pagePath", compact('addUser','errors','firstName','lastName','password','email','confirm_password','phoneNumber'));

