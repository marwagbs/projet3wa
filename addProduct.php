<?php
//affichage de la page ajout d'un nouveau produit
// Dépendances
// Appel de nos class nécessaires
require_once "models/Product.php";
require_once "models/Category.php";
require "services/Session.php";
require "services/utils.php";
Session::start();
// Instances nécessaire
$productM = new Product;
$categoryM = new Category;
$error=[];
// Test Get or Post
if(empty($_POST)){
    // Http type GET
    // Ici on distribue des infos, si nécessaires
    $categories = $categoryM->findAll();
    
    // require "views/addProduct.phtml";
} else {
    // var_dump($_POST);
    //le chemain
    $uploadDir = "img/";
    //créations d'une variable picture
    $picture = $uploadDir . DIRECTORY_SEPARATOR . basename($_FILES["picture"]["name"]);
    $uploadOk = true;
   
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["picture"]["tmp_name"]);
      if($check !== false) {
        $error= "File is an image - " . $check["mime"] . ".";
        $uploadOk = true;
      } else {
        $error= "File is not an image.";
        $uploadOk = false;
      }
    }
    
    // Check if file already exists
    if (file_exists($picture)) {
      $error= "Sorry, file already exists.";
      $uploadOk = false;
    }
    
    // Check file size
    if ($_FILES["picture"]["size"] > 5000000) {
      $error= "Sorry, your file is too large.";
      $uploadOk = false;
    }
    
    $imageFileType = explode('.', $picture)[1];
    // Allow certain file formats
    if($imageFileType !== "jpg" && $imageFileType !== "jpeg" && $imageFileType !== "png") {
      $error= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = false;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk === false) {
      $error= "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["picture"]["tmp_name"], $picture)) {
        $error= "The file ". htmlspecialchars(basename($_FILES["picture"]["name"])). " has been uploaded.";
      } else {
        $error= "Sorry, there was an error uploading your file.";
      }
    }

    // Si on a un post, c'est que le form a été soumis
    // Ici on traite le form
    extract($_POST);

    $categories = $categoryM->findAll();
    $productM->add([
        ":name" => htmlspecialchars(stripslashes($name)),
        ":description" => htmlspecialchars(stripslashes($description)),
        ":price" =>htmlspecialchars(stripslashes( $price)),
        ":picture" =>htmlspecialchars(stripslashes($picture)),
        ":category" => htmlspecialchars(stripslashes($category))
        
    ]);
    header("location: addProduct.php");
}

// Titre de la page
$pagePath = 'addProduct';

// Rendu de la vue
render(__DIR__."/views/$pagePath", compact('categoryM','categories','productM','error'));
