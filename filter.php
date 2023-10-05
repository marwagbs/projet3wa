<?php
require_once "models/Product.php";
require_once "services/Session.php";
require_once 'services/utils.php';
Session::start();

$Mproduct=new Product();
$filter = htmlspecialchars(stripslashes($_GET["filterlist"]));
$minPrice = htmlspecialchars(stripslashes($_GET['minPrice']));
$maxPrice  =htmlspecialchars(stripslashes( $_GET['maxPrice']));

$products=$Mproduct->filterByOrder($minPrice,$maxPrice,$filter);

 if($minPrice == '' && $maxPrice == ''){
            $maxRange = $Mproduct->priceDESC()['price'];
            $minRange = $Mproduct->priceASC()['price'];
        } else {
            $minRange =$minPrice;
            $maxRange =$maxPrice;
}

//titre de la page
$pagePath = 'product';
// Rendu de la vue
render(__DIR__."/views/$pagePath", compact('products','Mproduct','minRange','maxRange','minPrice','maxPrice'));