<?
namespace Kman\Communicator\Command;

use SplObserver;
use SplSubject;

class Say implements SplObserver
{
    public function update(SplSubject $subject)
    {
        $message = trim($subject->getMessage());
        if (!strpos($message, " ")) {
            return;
        }
        list($command, $what) = explode(' ', $message);
        if ($command == 'say') {
            $subject->setResponse($what);
        }
    }
}
