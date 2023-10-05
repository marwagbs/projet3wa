<?php
// Dépendances

require "services/Session.php";
require_once 'services/utils.php';
require_once "models/Order.php";
Session::start();
$orderM=new Order();
$order=$orderM->findAll();
$lastOrder = end($order);
$total=floatval($lastOrder['total']);




$pagePath = 'checkout';

// Rendu de la vue
render(__DIR__."/views/$pagePath",compact('orderM','order','lastOrder','total'));
