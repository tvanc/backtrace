<?php
/**
 * TODO Add @file documentation
 *
 * @author Travis Uribe <travis@tvanc.com>
 */

namespace tvanc\backtrace\Test\Error\Handle;


interface HandlerTestInterface
{
    public function testCatchThrowable();


    public function testHandleError();
}