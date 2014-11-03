<?php
require_once 'helper.php';
$kman = new Xmpp('talk.google.com', 5222, 'user', 'password', 'xmpphp', 'gmail.com');
$command = new Kman_Communicator_Command_Demo();
$kman->addCommand($command);
$command = new Kman_Communicator_Command_Say();
$kman->addCommand($command);
$megahal = new Brain();
$kman->setBrain($megahal);
$kman->connect();
