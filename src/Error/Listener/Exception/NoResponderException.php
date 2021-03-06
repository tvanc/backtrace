<?php
/**
 * @author Travis Van Couvering <travis@tvanc.com>
 */

namespace TVanC\Backtrace\Error\Listener\Exception;

/**
 * An exception for when a listener hears an error or exception, but isn't
 * equipped with an appropriate responder.
 */
class NoResponderException extends \Exception
{
    /**
     * @param \Throwable $originalException
     */
    public function __construct(\Throwable $originalException)
    {
        parent::__construct(
            $originalException->getMessage(),
            $originalException->getCode()
        );
    }
}
