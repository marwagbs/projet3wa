<?php
// Dépendances

require "services/Session.php";
Session::start();

//page d'annulation de paiement
require "views/cancel.phtml";