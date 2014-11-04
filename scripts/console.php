<?php
use Kman\Communicator\Cli;
use Kman\Communicator\Command\Demo;
use Kman\Megahal\Brain;

require_once '../vendor/autoload.php';
//Kman_Log::enable();
$kman  = new Cli();
$brain = new Brain();

@mkdir('/tmp/megadata');
$brain->setDataDir('/tmp/megadata');
$brain->load();
$kman->setBrain($brain);
$kman->addCommand(new Demo());
$kman->connect();
$brain->save();
