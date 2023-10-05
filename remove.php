<?php
//suppression d'un article
// Dépendances
require_once "models/Product.php";
require_once "services/Session.php";
require_once 'services/utils.php';
Session::start();


$Mproduct=new Product;
$products = $Mproduct->findAll();
//récupération de l'id pour la suppression

$id=htmlspecialchars(stripslashes($_GET['id']));

$delete=$Mproduct->delete($id);
$maxRange = $Mproduct->priceDESC()['price'];
$minRange = $Mproduct->priceASC()['price'];

$pagePath = 'product';

// Rendu de la vue
render(__DIR__."/views/$pagePath", compact('Mproduct','products','id', 'maxRange','minRange'));