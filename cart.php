<?php
// Dépendances
require_once "services/Session.php";
require_once 'services/utils.php';
Session::start();
//affichage de panier
$pagePath = 'cart';

// Rendu de la vue
render(__DIR__."/views/$pagePath");

