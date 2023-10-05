<?php
//insertion dans la BDD le panier enregistré dans le localstorage
require_once "models/OrderProduct.php";
require_once "models/Order.php";
require "services/Session.php";

Session::start();
$orderM=new Order();
$orderProductM= new OrderProduct();

$user_id=$_SESSION['login']['id'];
$cart=json_decode($_GET["cart"]);
// var_dump($cart);
$total=0;
//boucle pour calculer le total de panier
foreach($cart as $product){
    
        $total+= $product->price * $product->qtt;
        
     
}
//calcul de TVA
$tva=$total*0.1;



//insertion des données de la table order

$order= $orderM->add([
        ":tva"=>$tva,
        ":total"=>$total,
        ":user_id"=>$user_id,
        ]);

$order_id=$order;

//insertion chaque ligne de commande dans la table order_Product
foreach($cart as $product){
   //$quantity=strval($product->qtt);
    $orderPoduct = $orderProductM->add([
        ":quantity"=>$product->qtt,
        ":order_id"=>$order_id,
        ":product_id"=>$product->id,
        ":price"=>$product->price,
        
        ]);
}




