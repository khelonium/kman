<?php
/**
 * Kman
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * If you did not receive a copy of the license and are unable to
 * search for it , please send an email  to license@webuml.com 
 * so I can send you a copy immediately.  Of course, I don't care 
 * if you don't send a mail.  
 *
 * @category   Kman
 * @package    Kman_Log
 * @copyright  Copyright (c) 2008 Cosmin Dordea. (http://www.webuml.com)
 * @license    http://webuml.com/license/new-bsd     New BSD License
 */

/**
 * Kman logger.
 * @category Kman
 * @package Kman_Log
 * @author  Cosmin Dordea
 */
class Kman_Log
{
    /**
     * Logger object
     *
     * @var Kman_Log_Interface
     */
    private static $_logger  = null;
    
    private static $_enabled = false;
    
    public static function setLogger($logger)
    {
        self::$_logger = $logger;
    }
    
    private static function getLogger()
    {
        if(null == self::$_logger) {
            self::$_logger = new Zend_Log();
            $writer        = new Zend_Log_Writer_Stream('php://output');
            self::$_logger->addWriter($writer);
        }
        return self::$_logger;
    }
    
    public static function enable()
    {
        self::$_enabled = true;
    }
    
    public static function disabled()
    {
        self::$_enabled = false;
    }
    
    public static function isLogging()
    {
        return self::$_enabled;
    }
    
    public static function log($message, $priority =7)
    {
        if(false === self::isLogging()) {
            return;
        }
        
        $logger = self::getLogger();
        $logger->log($message, $priority);
    }
    
}
?>