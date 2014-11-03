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
 * so I can send you a copy immediately. Of course, I don't care
 *  if you don't send a mail.  
 *
 * @category   Kman
 * @package    Kman_Log
 * @copyright  Copyright (c) 2008 Cosmin Dordea. (http://www.webuml.com)
 * @license    http://webuml.com/license/new-bsd     New BSD License
 */

/**
 * Log interface.
 * Note , you don't actually have to implement it , 
 * just provide this method in your logger. This
 * interface serves more as a reference.
 * @category Kman
 * @package Kman_Log
 * @author Cosmin Dordea
 */
interface Kman_Log_Interface
{
    /**
     * Your custom logger must have this function.
     * Priorities are as follows:
     *
     * EMERG   = 0;  // Emergency: system is unusable
     * ALERT   = 1;  // Alert: action must be taken immediately
     * CRIT    = 2;  // Critical: critical conditions
     * ERR     = 3;  // Error: error conditions
     * WARN    = 4;  // Warning: warning conditions
     * NOTICE  = 5;  // Notice: normal but significant condition
     * INFO    = 6;  // Informational: informational messages
     * DEBUG   = 7;  // Debug: debug messages
     * 
     * @param string $message
     * @param int $priority priority, bds style
     */
    public function log($message, $priority);
}
?>