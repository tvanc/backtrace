<?php
/**
 * @author Travis Raymond Uribe <turibe@rentecdirect.com>
 * @copyright 2018 Rentec Direct
 * @license Proprietary
 */

namespace tvanc\backtrace;

use tvanc\backtrace\Backtrace\HeavyBacktraceStagesTrait;
use tvanc\backtrace\Error\Listen\ErrorListener;

/**
 * A convenience interface for using this library.
 */
final class Backtrace
{
    /**
     * TODO Refactor this to somewhere better.
     *
     * @param \Throwable $throwable
     * @param bool       $shorten
     *
     * @return string
     */
    static function getErrorType($throwable, $shorten = true)
    {
        if ($throwable instanceof \ErrorException) {
            $severity = $throwable->getSeverity();

            $typeNameMap = [
                E_ERROR => 'Fatal error',
                E_PARSE => 'Parse error',
                E_CORE_ERROR => 'Core error',
                E_COMPILE_ERROR => 'Compile error',
                E_USER_ERROR => 'User error',
                E_NOTICE => 'Notice',
                E_DEPRECATED => 'Deprecated',
                E_USER_NOTICE => 'User notice',
                E_WARNING => 'Warning',
                E_USER_WARNING => 'User warning',
                E_CORE_WARNING => 'Core warning',
                E_COMPILE_WARNING => 'Compile warning',
                E_STRICT => 'Strict message',
                E_RECOVERABLE_ERROR => 'Recoverable error',
                E_USER_DEPRECATED => 'User deprecated',
            ];

            return $typeNameMap[$severity];
        }

        $className = get_class($throwable);
        $slashPos = strrpos($className, '\\');

        if ($shorten && $slashPos !== false) {
            return substr($className, $slashPos + 1);
        }

        return $className;
    }


    public static function createListener()
    {
        return new ErrorListener();
    }
}
