<?php
//affichage de la page qui contient tt le produit
// Dépendances
require_once "models/Product.php";
require_once "services/Session.php";
require_once 'services/utils.php';
Session::start();



$Mproduct=new Product;
 
$search=htmlspecialchars(stripslashes($_GET["q"]));
$products=$Mproduct->searchProduct($search);



$maxRange = $Mproduct->priceDESC()['price'];
$minRange = $Mproduct->priceASC()['price'];

//titre de la page
$pagePath = 'product';
// Rendu de la vue 
render(__DIR__."/views/$pagePath", compact('products','maxRange','minRange'));