<?php
//affichage de la page ajout d'une nouvelle catégorie
// Dépendances
require_once "models/Category.php";
require "services/Session.php";
require_once 'services/utils.php';
Session::start();
// Instances nécessaire

$categoryM = new Category;

// Test pour Post
if(!empty($_POST)){
    // Si on a un post, c'est que le form a été soumis
    // Ici on traite le form
    extract($_POST);
    //ajout d'une nouvelle category
    $categoryM ->add([
        ":name" => htmlspecialchars(stripslashes($name)),
        ":description" =>htmlspecialchars(stripslashes( $description))
    ]);
}


$pagePath = 'addCategorie';

// Rendu de la vue
render(__DIR__."/views/$pagePath", compact('categoryM'));