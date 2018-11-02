<?php
/**
 * TODO Add @file documentation
 *
 * @author Travis Uribe <travis@tvanc.com>
 */

namespace tvanc\backtrace\Test\Error\Handler;

use tvanc\backtrace\Error\Responder\ErrorResponderInterface;

/**
 * Class TestErrorHandler
 */
class TestErrorResponder implements ErrorResponderInterface
{
    private $caughtThrowable = false;
    private $handledError = false;


    /**
     * @return bool
     */
    public function caughtThrowable(): bool
    {
        return $this->caughtThrowable;
    }


    /**
     * @param bool $caughtThrowable
     *
     * @return TestErrorResponder
     */
    public function setCaughtThrowable(bool $caughtThrowable): TestErrorResponder
    {
        $this->caughtThrowable = $caughtThrowable;

        return $this;
    }


    /**
     * @return bool
     */
    public function handledError(): bool
    {
        return $this->handledError;
    }


    /**
     * @param bool $handledError
     *
     * @return TestErrorResponder
     */
    public function setHandledError(bool $handledError): TestErrorResponder
    {
        $this->handledError = $handledError;

        return $this;
    }


    /**
     * @param \Throwable $throwable
     *
     * @return mixed
     */
    public function handleException(\Throwable $throwable)
    {
        $this->caughtThrowable = true;

        return true;
    }


    public function considerException(\Throwable $throwable): bool
    {
        return true;
    }
}