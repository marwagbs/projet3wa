<?php
//affichage de la page success aprés le paiment
//dépendance
require "services/Session.php";

Session::start();
require "views/success.phtml";




