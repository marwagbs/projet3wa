
<?php
//page de déconnextion
require "services/Session.php";
Session::start();
Session::destroy();
//on le derigie vers la page d'acceuil
header('Location: index.php');
exit;
?>