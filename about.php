<?php
//affichage de la page about
//dépendance
require_once "services/Session.php";
require_once 'services/utils.php';
Session::start();


$pagePath = 'about';

// Rendu de la vue
render(__DIR__."/views/$pagePath");