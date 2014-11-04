<?php
/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 04/11/14
 * Time: 10:58
 */



class FooCommand implements SplObserver
{
    private $called = false;

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Receive update from subject
     * @link http://php.net/manual/en/splobserver.update.php
     * @param SplSubject $subject <p>
     * The <b>SplSubject</b> notifying the observer of an update.
     * </p>
     * @return void
     */
    public function update(SplSubject $subject)
    {
        $this->called = true;
    }

    /**
     * @return boolean
     */
    public function wasCalled()
    {
        return $this->called;
    }

} 