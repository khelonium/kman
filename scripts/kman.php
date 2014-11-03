<?php
require_once '../vendor/autoload.php';

function getWord($sentence)
{
    $words = explode(' ', $sentence);
    if(is_string($words)) {
        return $words;
    }
    return $words[rand(0,count($words)-1)];
}

$megahal = new Kman_Megahal_Brain();
$megahal->disableDebug();
$megahal->add('It is nothing , really it is nothing.');
$feeder = new Kman_Feeder($megahal);
$feeder->addDocument('test.txt');
echo $megahal->getSentence('operations');
echo "\n";
//    echo $megahal->getSentence('scripts')."\n";
die();
//for ($i =0; $i < 10;$i++)
//echo  "\n ---------------------------- \n";

$handler = fopen("php://stdin","r");
$message = "Hello";
echo "\nPhp Megahal \n";
while ($message != "bye\n") {
    echo "you>";
    $message = fgets($handler);
    $megahal->add($message);
    $word = getWord($message);
    $response =  $megahal->getSentence($word);
    echo "kman>$response\n";
}
?>
