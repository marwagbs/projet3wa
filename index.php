<?php
//affichage de la page acceuil
require "services/Session.php";
require_once 'services/utils.php';
require_once "models/User.php";

Session::start();

$feedbackM=new User;

if (isset($_REQUEST["file"])) {
  // Get parameters
  $file = urldecode($_REQUEST["file"]); 

  /*vérifier le nom de fichier*/
  if (preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $file)) {
    $filepath = "img/" . $file;

    // Process download
    if (file_exists($filepath)) {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($filepath));
      flush(); // Flush system output buffer
      readfile($filepath);
      die();
    } else {
      http_response_code(404);
      die();
    }
  } else {
    die("Invalid file name!");
  }
}


$feedback=$feedbackM->getFeedback();


// Titre de la page

$pagePath = 'home';

// Rendu de la vue
render(__DIR__."/views/$pagePath", compact('feedbackM','feedback'));