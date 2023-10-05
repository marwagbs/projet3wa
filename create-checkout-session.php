<?php
//affichage de la page de paiement
//dépendances
require './vendor/autoload.php';
require "services/Session.php";
Session::start();
//appel de la class
require_once "models/Order.php";
$orderM=new Order();
$order=$orderM->findAll();
$lastOrder = end($order);
$total=floatval($lastOrder['total']);
$orderId=$lastOrder['id'];
$totalCen=$total*100;


// Nous instancions Stripe en indiquand la clé privée, pour prouver que nous sommes bien à l'origine de cette demande
\Stripe\Stripe::setApiKey('sk_test_51K6CCbDqMESBrmee4xMmOa2m00DzA0gco8TTLElxqN0VgFsmMIBC6PZxa6zsXg4YcOCiUMwzVyxkLHcJPPn8Jnx700H4ooSkFV');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'https://marwaghedamssi.sites.3wa.io/projet_3wa';
// Nous créons l'intention de paiement et stockons la réponse dans la variable $checkout_session
$checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
          'name' => 'Your commande',
          'currency' => 'eur',
          'amount' => $totalCen,
          'quantity' => 1,
      ]],
    'mode' => 'payment',
      'success_url' => $YOUR_DOMAIN . '/success.php?session_id={CHECKOUT_SESSION_ID}',
      'cancel_url' => $YOUR_DOMAIN . '/cancel.php',
  ]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);




