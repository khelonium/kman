<?php
require_once '../vendor/autoload.php';
//Kman_Log::enable();
$kman  = new Kman_Communicator_Cli();
$brain = new Kman_Megahal_Brain();

@mkdir('/tmp/megadata');
$brain->setDataDir('/tmp/megadata');
$brain->load();
$kman->setBrain($brain);
$kman->addCommand(new Kman_Communicator_Command_Demo());
$kman->connect();
$brain->save();
