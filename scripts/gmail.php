<?php
use Kman\Communicator\Command\Demo;
use Kman\Communicator\Command\Say;
use Kman\Communicator\Xmpp;
use Kman\Megahal\Brain;

require_once 'helper.php';
$kman = new Xmpp('talk.google.com', 5222, 'user', 'password', 'xmpphp', 'gmail.com');
$command = new Demo();
$kman->addCommand($command);
$command = new Say();
$kman->addCommand($command);
$megahal = new Brain();
$kman->setBrain($megahal);
$kman->connect();
