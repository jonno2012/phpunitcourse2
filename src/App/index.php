<?php

require_once dirname(__FILE__, 3) . '/vendor/autoload.php';

 use App\CardGame;
 use App\CardIncrementor;

$cardGame = new CardGame(new CardIncrementor());
$cards = $cardGame->setCards()->getCards();
var_dump($cards);