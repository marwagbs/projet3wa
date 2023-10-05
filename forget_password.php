<?php
//affichage de la page de connexion
//Appel de nos class nécessaires
require_once "models/User.php";
require_once "services/Session.php";
require "services/utils.php";
$checkUser= new User;
$email="";
$errors=[];
$token="";
$to="";
$subject="";
$message="";
$headers="";
function postData($data){
    $_POST[$data] ??= "";
    return (htmlspecialchars(stripslashes($_POST[$data])));
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $email=postData('email');
     if(!$email){
        $errors['email']="l'adreese e-mail est obligatoire";
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email']="Veuillez renseigner une adresse email valide";
    }
  
    if(count($errors) === 0){
        $user= $checkUser->findByEmail($email);
        try {
            // Si la méthode ne renvoie rien.
            if (empty($user)) {
                $errors["email"]="cette adresse email ne correspond à aucun compte";
            } else{
                //Utilisateur existe, on génère un token
               $token=uniqid();
                $to=$email;
                
                
                $subject="Réinitialisation de votre mot de passe";
                $headers = 'From: noreply@mad-up.com' . "\r\n";
                $headers .= 'Reply-To:  noreply@mad-up.com' . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $message= '<html lang="fr">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    
                    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
                    <title>Réinitialisation de mot de passe</title>
                </head>
                <body style="background:rgba(11,49,69,0.2); font-size:16px; font-family:"Montserrat", sans-serif;">
                    <header>
                        <section class="d-flex">
                            <div class=" mt-5 ms-5 me-5" >
                                <p class="text-center ms-5">Bonjour '.$user['first_name'].'</p>
                                <p class="text-center ms-5">Vous pouvez réinitialiser votre mot de passe <p>
                            </div>
                        </section>
                    </header>
                
                    <main>
                    
                    <section style="width:65%; margin:auto; background-color:#fff; padding:25px 35px">
                        <p class="text-center ps-3 pe-3">Pour réinitialiser votre mot de passe, rendez-vous à l\'adresse suivante:</p>
                        <a href="https://marwaghedamssi.sites.3wa.io/projet_3wa/token?token='.$token.' "
                        style="width: 450px;
                            background-color:#15acf2;
                            text-align: center;
                            padding: 10px;
                            color: #fff;
                            font-weight: bold;
                            display: block;
                            margin:auto;
                            font-size: 16px;
                            text-decoration:none;
                            border-radius:5px;"
                            > Cliquer ici pour réinitialiser votre mot de passe</a>
                        <hr style="width:50%; border:1px solid #15acf2; display:block; margin:auto; font-size:14px; margin-top:20px;">
                    
                        <p style="font-style:italic; color:#6a6a6a; text-align:center; font-size:12px">S\'il s\'agit d\'une erreur, igonrez cet e-mail et votre mot de passe ne changera pas.</p>
                    </section>
                    </main>
                
                </body>
                
                </html>';
    
    
                    //envoi 
                    if ( mail($to, $subject, $message, $headers)){

                      $checkUser->updateToken($email, $token);
                        $erros["message"]= "mail envoyé";
                      }else {
                        $erros["message"]= "une erreur s'est produit, veuillez résseayer plus tard";
                      }

            
                
            }
        } catch (DomainException $e) {
            echo $e->getMessage();
        }
    }
}
// Titre de la page

$pagePath = 'forget_password';

// Rendu de la vue
render(__DIR__."/views/$pagePath", compact('checkUser','errors','email','token','to', 'subject', 'message', 'headers'));