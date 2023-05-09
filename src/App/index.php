<?php

require_once dirname(__FILE__, 3) . '/vendor/autoload.php';

 use App\CardGame;
 use App\EarthlyObject;
 use App\Weight;

//$cardGame = new CardGame();
//$cards = $cardGame->setCards()->getCards();
//var_dump($cards);

$objectWeight = (new EarthlyObject(70, new Weight()))->setWeight();

echo $objectWeight->getWeight() . PHP_EOL;